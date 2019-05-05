<?php
namespace App\Http\Controllers;
use App\Book;
use App\Customer;
use App\Cart;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Dompdf\Dompdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
    public function salesDataTable(Datatables $datatables)
    {
        $request = $datatables->getRequest();

        $cart = Cart::select(['id', 'created_at', 'subtotal', 'total', 'balance']);

        if($request->start_date){
            $cart = $cart->whereBetween('created_at', [$request->start_date, $request->end_date]);

        }
        return $datatables->eloquent($cart)
                        ->editColumn('created_at', function ($user) {
                            return $user->created_at->format('d-m-Y');
                        })
                        ->filterColumn('created_at', function ($query, $keyword) {
                            $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
                        })
                        ->addColumn('invoice', function ($cart) {
                            // return `<a href="reports/invoice/pdf/'.$cart->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Invoice</a>`;
                        })
                        ->toJson(); 
    }
    public function showChildSales($id){
        $cart = Cart::find($id);
        return view('reports.showChildSales', ['cart' => $cart]);
    }
    public function salesDetail()
    {        
        return view('reports/salesDetail');
    }
    public function invoice($id){
        $cart = Cart::find($id);
        $customer = Customer::find($id = $cart->customer_id);
        return view('reports/invoice', compact('cart', 'customer'));
    }
    public function pdf($id){
        $data['cart'] = Cart::find($id);

        $data['customer'] = Customer::find($id = $data['cart']->customer_id);
        $pdf = PDF::loadView('reports.invoicePdf', $data)->setPaper('a4', 'potrait');
        return $pdf->stream('invoice.pdf');
    }
}

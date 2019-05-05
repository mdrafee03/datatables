<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Free Bootstrap Invoice</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="{!! asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="{!! asset('assets/css/styles.css') !!}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body>
    <div class="container" id="invoice">
        <div class="row pad-top-botm ">
            <div class="col-sm-12 text-center">
                <h3>Safa Marwa Boi Ghor</h3>
                <p>
                    <i>Address :</i> close to Kuet post office,
                    <br />
                    kuet road, Khulna
                    <br />
                    <i>Call :</i> 01854402551
                </p>
            </div>
        </div>
        <hr>
        <hr>
        <div class="row client-info">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <strong>{{ $customer->name }} </strong>
                <br />
                <b>University :</b> {{ $customer->university }}
                <br />
                <b>Phone :</b> {{ $customer->mobile }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12" style="padding-left: 350px">

                <b>Invoice: #</b>{{ $cart->id }}
                <br />
                <b>Date: </b>{{ $cart->created_at->format('Y-m-d') }}
                <br />
                <b>Balance: </b>{{ $customer->balance }} Tk
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive invoice ">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Book Name</th>
                                <th>S/R.</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->books as $books)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $books->title }}</td>
                                <td>{{ $books->pivot->sellOrReturn}}</td>
                                <td>{{ $books->pivot->price }}</td>
                                <td>{{ $books->pivot->quantity }}</td>
                                <td>{{ ($books->pivot->price)*($books->pivot->quantity) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <td>SUBTOTAL:</td>
                                <td>{{ $cart->subtotal }}Tk</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td>BALANCE:</td>
                                <td>{{ $customer->balance }}Tk</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td>GRAND TOTAL:</td>
                                <td>{{ $cart->total }}Tk</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
        <div class="row"> 
            <div class="col-md-9"></div>
            <div class="col-sm-12 col-md-2 text-center" style="padding-top: 100px">
            <p style="border-top: 1px dotted black">Signature of seller</p>
            </div>
        </div>
        <div class="row gpdf"> 
            <div class="col-sm-12 text-center">
            <a href="{{ url('reports/invoice/pdf/'.$cart->id) }}"class="btn btn-info " role="button" >Create PDF</a>
            <a href="{{ url('carts/create') }}"class="btn btn-info " role="button" >Cart</a>
            </div>
            
        </div>
    </div>
<script type="text/javascript">
    $('.gpdf').click(function(){
        $('.gpdf').hide();
    })
    
</script>

</body>

</html>
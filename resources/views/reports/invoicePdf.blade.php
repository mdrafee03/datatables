<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Free Bootstrap Invoice</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="C:\laragon\www\datatables\public\assets\css\bootstrap.min.css" rel="stylesheet" />

    <style>
        .invoice table tfoot td {
            border: none
        }

     

        .seller {
            padding-top: 100px;
            width: 200px;
            text-align: center;
            margin-left: 65%;
        }
        tfoot td{
            font-size: 1.1rem;
        }
    </style>

</head>

<body>
    <div class="container-fluid" id="invoice">
        <div class="row ">
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
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <strong>{{ $customer->name }} </strong>
                <br />
                <b>University :</b> {{ $customer->university }}
                <br />
                <b>Phone :</b> {{ $customer->mobile }}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12" style="padding-left: 550px">

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
                                <td class="text-right">subtotal:</td>
                                <td>{{ $cart->subtotal }}Tk</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right">Balance:</td>
                                <td>{{ $customer->balance }}Tk</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-right">Grand Total:</td>
                                <td>{{ $cart->total }}Tk</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="seller">
                <p style="border-top: 1px dotted black">Signature of seller</p>
            </div>
        </div>
    </div>

</body>

</html>
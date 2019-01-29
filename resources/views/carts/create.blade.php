@extends('templates.master')

@section('content')
<h2>Cart</h2>
<hr/>
    <div class="container-fluid">
    <form action="{{ route('carts.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="search-wrapper">
                    <select class="search form-control">
                        <option value=""><i class="fa fa-search"></i></option>
                        @foreach($books as $book)
                            <option value="{{ $book }}">{{ $book->title.' - '.$book->author.' ['.$book->status.']' }}</option>
                        @endforeach
                    </select>
                </div>
                <table class="table" id="orderList">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Sell or Return</th>
                            <th>price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="cartTable">  
                    </tbody>
                </table>
                <div class="subtotal">
                    <p><span>Subtotal: </span><span id="subtotal" class="amountTotal"></span></p>
                </div>    
            </div>
            <div class="col-md-4">
                <div class="customer">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control phone" id="phone" placeholder="Enter phone Number" aria-label="Username" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text" id="searchByPhone"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div id="customer-detail" class="customer-detail text-center" style="display:none">
                        <input type="text" class="customer-id" name="customer_id" value="" hidden>
                        <div class="customer-name"></div>
                        <div class="customer-balance-wrapper">Balance: &#2547;<span class="customer-balance"></span></div>
                            <div class="btn-group row customer-action" role="group" aria-label="Basic example">
                                <a href="" class="btn btn-secondary btn-info col-6 customer-edit">Edit</a>
                                <button type="button" class="btn btn-secondary btn-dark col-6 customer-detach">Detach</button>
                            </div>
                        </div>
                    <div id="customer-input" class="customer-input" style="display:none" data-action="{{ route('customers.store') }}">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="Full name" aria-label="name" aria-describedby="basic-addon1" id="customer-name">
                        </div>
                        <input type="text" id="customer-input-mobile" name="mobile" value="" hidden>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-university" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" name="university" class="form-control" placeholder="University" aria-label="university" aria-describedby="basic-addon1" id="university">
                        </div>
                        <div class="text-center customer-input-submit">
                            <button type="button" class="btn btn-outline-secondary new-customer">Add new Customer</button>
                        </div>
                    </div>
                </div>
                <div class="register-box">
                    <ul class="list-group discount">
                        <li class="list-group-item">
                            <span>Discount on all product</span>
                            <span class="float-right"><input type="number" name="discount" id="discount"> %</span>
                        </li>
                    </ul>
                    <div class="amount row">
                            <div class="total-amount col-6">
                                <div class="amount-heading">Total</div>
                                <div class="amount-number">&#2547; <span class="amountTotal amountTotal-number"></span></div>
                                <input type="hidden" name = "totalAmount" class="amountTotal-number-hidden">

                            </div>
                            <div class="total-amount-balance col-6">
                                <div class="amount-heading">Balance</div>
                                <div class="amount-number">&#2547; <span class="amountTotal balanceTotal-number"></span></div>
                                <input type="hidden" class="balanceTotal-number-hidden">
                            </div>
                            
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Complete Sale</button>
                </div>
            <br/>
            
            </div>
    </form>
</div>

<table id="cartRowTemplate" style="display: none">
    <tr class="cartRow">
        <td class="title"></td>
        <td class="sellOrReturn">
            <input type="hidden" name="book_id[]" class="book_id">
            <select name="sellOrReturn[]" class="form-control">
                <option value="sell" selected>Sell</option>
                <option value="return">Return</option>
            </select>
        </td>
        <td class="price"></td>
        <td class="quantity"><input class="inputQty" name="inputQty[]" type="number">(<span class="availableQty"></span>)</td>
        <td class="total">0</td>
    </tr>
</table>
@endsection

@push('scripts')
<script type="text/javascript">

    $('.search').select2({
        placeholder: 'Select an item',
        width: '100%',
    });
    $('.search').on('change', function(){
        var data = JSON.parse($(".search option:selected").val());
        var cartRow = $('#cartRowTemplate .cartRow').clone();
        $(cartRow).find('.book_id').val(data.id);
        $(cartRow).find('.title').html(data.title+' ['+data.status+']');
        $(cartRow).find('.price').html(data.price);
        $(cartRow).find('.availableQty').html(data.quantity);
        $(cartRow).find('.total').html(data.price);
        $('#cartTable').append(cartRow);


    })
    $(document).on('keyup', '.inputQty', function(){
        var parent = $(this).closest('tr');
        var inputQty = parseInt(parent.find('.inputQty').val());
        var availableQty = parseInt(parent.find('.availableQty').text());
        if(inputQty > availableQty){
            $(parent).find('.inputQty').val(availableQty);
            inputQty = availableQty;
        }
        $(parent).find('.total').html(parseFloat(parent.find('.price').text())*inputQty);
        var sum = 0;
        $(parent).parent().find('.total').each(function(){
            sum+= parseInt($(this).text())
        });
        $('.amountTotal').html(sum); 
    })
    $('#phone').keypress(function(event)
    {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            searchByPhone($(this).val());
        }  
    })
    $('#searchByPhone').click(function(){
        searchByPhone($('#phone').val());
    })
    function searchByPhone(phone){
        $.get('../customers/by-phone/' + phone)
        .then(function(customer){
            $("#customer-detail").hide();
            $("#customer-input").hide();
            if(customer){
                $('.customer-id').val(customer['id']);              
                for (key in customer) {
                    $('.customer-'+key+'').text(customer[key]);
                }
                $("#customer-detail").show();
                // edit
                $(".customer-edit").attr("href", '/customers/'+customer["id"]+'/edit');
                // detach
                $('.customer-detach').click(function(){
                    $("#customer-detail").hide();
                })
            }
            else{
                $("#customer-input").show();
                $("#customer-input-mobile").val(phone);
            }
            
            
        });
    }
    $(document).on('click', '.new-customer', function(e) { 
        e.preventDefault();
        var url = $("#customer-input").attr('data-action');
        var data = {
            _token: $("[name=_token]").val(),
            mobile: $("#customer-input-mobile").val(),
            name: $("#customer-name").val(),
            university: $("#university").val()
        };
        $.post(url, data)
        .then(function(customer){
            if(customer){              
                for (key in customer) {
                    $('.customer-'+key+'').text(customer[key]);
                }
                $('#customer-input').hide();
                $("#customer-detail").show();
                // edit
                $(".customer-edit").attr("href", '/customers/'+customer["id"]+'/edit');
                // detach
                $('.customer-detach').click(function(){
                    $("#customer-detail").hide();
                })
            }
        })
    });
    $('#discount').on('change', function(){
        var subtotal = parseInt($('#subtotal').text());
        var discount = parseInt($('#discount').val());
        var totalAfterDiscount = (subtotal-subtotal*discount/100).toFixed();
        $(".amountTotal-number").text(totalAfterDiscount);

    })
    $('.amountTotal-number').bind("DOMSubtreeModified", function(){
        var amountTotal = $('.amountTotal-number').text();
        $(".amountTotal-number-hidden").val(amountTotal);
    });
    $('.balanceTotal-number').bind("DOMSubtreeModified", function(){
        var amountTotal = $('.balanceTotal-number').text();
        $(".balanceTotal-number-hidden").val(amountTotal);
    });
</script>

@endpush
</body>
</html>
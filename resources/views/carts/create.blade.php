@extends('templates.master')

@section('content')
<h2>Cart</h2>
<hr/>
    <div class="container-fluid">
    <form action="{{ route('carts.store') }}" method="POST" id="form"> 
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
                <table class="table table-bordered" id="orderList">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Sell or Return</th>
                            <th>price</th>
                            <th>Qty</th>
                            <th>Disc%</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="cartTable">  
                    </tbody>
                </table>
                <div class="subtotal">
                    <span>Subtotal: </span><span id="subtotal" class="amountTotal"></span>
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
                    <div class="amount row">
                            <div class="total-amount col-6">
                                <div class="amount-heading">Total</div>
                                <div class="amount-number">&#2547; <span class="amountTotal-number"></span></div>
                                <input type="hidden" name = "totalAmount" class="amountTotal-number-hidden">

                            </div>
                            <div class="total-amount-balance col-6">
                                <div class="amount-heading">Balance</div>
                                <div class="amount-number">&#2547; <span class="balanceTotal-number"></span></div>
                                <input type="hidden" name="totalBalance" class="balanceTotal-number-hidden">
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
            <select name="sellOrReturn[]" class="form-control sellOrReturn-select">
                <option value="sell" selected>Sell</option>
                <option value="return">Return</option>
            </select>
        </td>
        <td class="price"></td>
        <td class="quantity form-row" style="margin:0">
            <input class="inputQty form-control col" id="inputQty" name="inputQty[]" type="number" value="1">
            <label class="availableQty-wrapper col-form-control col" id="inputQty">(<span class="availableQty"></span>)</label>
        </td>
        <td class="discount"><input type="number" value="0" class="form-control discount-input"></td>
        <td class="total">0</td>
        <td class="text-center"><button type="button" class="deleteRow"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button></td>
    </tr>
</table>
@endsection

@push('scripts')
<script type="text/javascript">

// prevent enter for submit form
    $('#form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
        e.preventDefault();
        return false;
    }
    });
    $('.search').select2({
        placeholder: 'Select an item',
        width: '100%',
        allowClear: true,
  
    });


    $('.search').on('change', function(){
        var data = $(".search option:selected").val();
        if(data !=""){
            data = JSON.parse(data);
       
            var cartRow = $('#cartRowTemplate .cartRow').clone();
            $(cartRow).find('.book_id').val(data.id);
            $(cartRow).find('.title').html(data.title+' ['+data.status+']');
            $(cartRow).find('.price').html(data.price);
            $(cartRow).find('.availableQty').html(data.quantity);
            $(cartRow).find('.total').html(data.price);
            $('#cartTable').append(cartRow);
            var seen = {};
            $('#cartTable tr').each(function(){
                var txt = $(this).children(".title").text();
                if (seen[txt])
                    $(this).remove();
                else
                    seen[txt] = true;
            })
            subtotalCal();
        }
 
    });
    // Calculation of subtotal for new row, delete row, SellOrReturn and keyUp
    function subtotalCal(){
        var sum = 0;
        $(document).find('.total').each(function(){
            sum+= parseInt($(this).text())
        });
        $('.amountTotal').html(sum); 
    }
    $(document).on('change', '.sellOrReturn-select', function() {
        var parent = $(this).closest('tr');
        var sellOrReturn = parent.find('.sellOrReturn-select option:selected').val();
        var price = parseFloat($(parent).find('.price').html());

        if(sellOrReturn == "return"){
            $(parent).find('.total').html(price*-1);
            $(parent).find('.availableQty-wrapper').hide();
            $(parent).find('.discount-input').hide();
        }
        else{
            $(parent).find('.total').html(price);
            $(parent).find('.availableQty-wrapper').show();
            $(parent).find('.discount-input').show();
        }
        subtotalCal();
    });
    // Delete Row clicking on button cross
    $('.table tbody').on('click', '.deleteRow', function(){
        $(this).closest('tr').remove();
        subtotalCal();
    });

    // Key up for input quantity
    
    $(document).on('keyup', '.inputQty', function(){
        var parent = $(this).closest('tr');
        var inputQty = parseInt(parent.find('.inputQty').val());
        var availableQty = parseInt(parent.find('.availableQty').text());
        var sellOrReturn = parent.find('.sellOrReturn-select option:selected').val();
        if(sellOrReturn == "sell"){
            if(inputQty > availableQty){
                $(parent).find('.inputQty').val(availableQty);
                inputQty = availableQty;
                $(parent).find('.total').html(parseFloat(parent.find('.price').text())*inputQty);
            }            
            else if(inputQty<1 || isNaN(inputQty)){
                $(parent).find('.inputQty').val(1);
                $(parent).find('.total').html(parseFloat(parent.find('.price').text()));
            }
            else{
                $(parent).find('.total').html(parseFloat(parent.find('.price').text())*inputQty);
            }

            
        }
        else{
            $(parent).find('.total').html(parseFloat(parent.find('.price').text())*inputQty*-1);
            if(inputQty<1 || isNaN(inputQty)){
                $(parent).find('.inputQty').val(1);
                $(parent).find('.total').html(parseFloat(parent.find('.price').text()));
            }

        }

        subtotalCal();
    })
    // Keyup for discount
    $(document).on('keyup', '.discount', function(){
        var parent = $(this).closest('tr');
        var discount = parseInt(parent.find('.discount-input').val());
        var inputQty = parseInt(parent.find('.inputQty').val());
        var total = parseFloat(parent.find('.price').text())*inputQty;
        var currentTotal = total - total*discount/100;
        var sellOrReturn = parent.find('.sellOrReturn-select option:selected').val();
        if(sellOrReturn == "sell"){
            if(discount< 0 || isNaN(discount)){
                $(parent).find('.discount-input').val(0);
                $(parent).find('.total').html(total);
            }
            else if(discount> 100){
                $(parent).find('.discount-input').val(100);
                $(parent).find('.total').html(0);
            }
            else{
                $(parent).find('.total').html(currentTotal);
            }

        }
        else{
            $(parent).find('.discount-input').val('');
            
        }
        subtotalCal();
    });

    // Update Total and balance from subtotal

    $('.amountTotal').bind("DOMSubtreeModified", function(){
        var subTotal = parseFloat($(this).text());
        var balance = parseFloat($('.customer-balance').text());
        balanceUpdate();
    });
    function balanceUpdate(){
        var subTotal = parseFloat($('.amountTotal').text());
        var balance = parseFloat($('.customer-balance').text());
        if(isNaN(subTotal)){
            $('.balanceTotal-number').text(balance);
        }
        if(isNaN(balance)){
            $('.amountTotal-number').text(0);
            $('.balanceTotal-number').text(0);
        }
        if(!isNaN(balance) && !isNaN(subTotal)){
            balance = balance - subTotal;
            if(balance<0){
                $('.amountTotal-number').text(balance*-1);
                $('.balanceTotal-number').text("0");
            }
            else{
                $('.amountTotal-number').text(0);
                $('.balanceTotal-number').text(balance);
            }
        }
    }


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
                /* update balance from customer */
                balanceUpdate();

                // $('.balanceTotal-number').text(customer['balance']);
                // edit
                $(".customer-edit").attr("href", '/customers/'+customer["id"]+'/edit');
                // detach
                $('.customer-detach').click(function(){
                    $("#customer-detail").hide();
                    $('.customer-balance').text('');
                    balanceUpdate();
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
<html lang="en">
<head>
    <title></title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{!! asset('assets/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/styles.css') !!}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>


<body>


<div class="container">
    <form action="">
        <div class="col-md-7">
            <select class="search form-control">
                <option value=""><i class="fa fa-search"></i></option>
                @foreach($books as $book)
                    <option value="{{ $book }}">{{ $book->title.' - '.$book->author }}</option>
                @endforeach
            </select>
            <table id="orderList">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="cartTable">  
                </tbody>
            </table>
            <div class="calculation">
                <p><span class="subtotal">Subtotal</span><span class="amountTotal"></span></p>
            </div>    
        </div>
        <div class="col-md-5">
            <input type="text" name="phone" id="phone" placeholder="Enter phone number">
            <button id="searchByPhone" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
            <div id="customer-detail" style="display:none">
                <input type="text" name="name">
                <input type="number" name="balance">
                <input type="text" name="university">
            </div>
        </div>
        <br/>
        <button type="submit">Complete Sales</button>
    </form>
</div>

<table id="cartRowTemplate" style="display: none">
    <input type="text" name="book_id" class="book_id" hidden>
    <tr class="cartRow">
        <td class="title"></td>
        <td class="price"></td>
        <td class="quantity"><input class="inputQty" type="number">(<span class="availableQty"></span>)</td>
        <td class="total"></td>
    </tr>
</table>

<script type="text/javascript">

    $('.search').select2({
        placeholder: 'Select an item',
    });
    $('.search').on('change', function(){
        var data = JSON.parse($(".search option:selected").val());
        var cartRow = $('#cartRowTemplate .cartRow').clone();
        $(cartRow).find('.book_id').val(data.id);
        $(cartRow).find('.title').html(data.title);
        $(cartRow).find('.price').html(data.price);
        $(cartRow).find('.availableQty').html(data.quantity);
        $('#cartTable').append(cartRow);

    })
    $(document).on('keyup', '.inputQty', function(){
        var parent = $(this).closest('tr');
        var inputQty = parseInt(parent.find('.inputQty').val());
        var availableQty = parseInt(parent.find('.availableQty').text());
        if(inputQty > availableQty){
            $(parent).find('.inputQty').val(availableQty);
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
            if(customer){
                debugger;
                for (key in customer) {
                    $('input[name='+key+']').val(customer[key]);
                }
            }
            else{
                $("#customer-detail").find('input').val('');
            }
            $("#customer-detail").show();
            
        });
    }


</script>


</body>
</html>
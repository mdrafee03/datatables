<html lang="en">
<head>
    <title></title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>


<body>


<div class="container">
    <input type="text" name="phone" placeholder="Enter phone number">


    <br/>
    <select class="search form-control" style="width:500px;" name="itemName"></select>
    <input type="text" id="test">


</div>


<script type="text/javascript">


    $('.search').select2({
        placeholder: 'Select an item',
        ajax: {
            url: '/select2-ajax',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    $('search').on('change', function(){
        var data = $(".search option:selected").text();
        $("#test").val(data);
    })


</script>


</body>
</html>
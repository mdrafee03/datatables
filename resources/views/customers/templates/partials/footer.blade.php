
<script src="{!! asset('assets/js/jquery-3.2.1.min.js') !!}"></script>
<script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('assets/js/script.js') !!}"></script>
<script src="{!! asset('assets/js/datatables.min.js') !!}"></script>
</body>
<script>
$(document).ready( function () {
$('#cusTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('dataProcessing') !!}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'mobile', name: 'mobile' },
        { data: 'balance', name: 'balance' },
        { data: 'university', name: 'university' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});
} );
</script>
</html>
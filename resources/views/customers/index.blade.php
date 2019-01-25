@extends('templates.master')

@section('content')
    <h2>Customer List</h2>
    <hr/>
    <a class="btn btn-success" href="customers/create" style="margin-bottom: 15px;">Create New</a>
    @if(Session::has('message'))
    <div class="alert-custom">
        <p>{{ Session::get('message') }}</p>
    </div>
    @endif
    <table class="table table-bordered dt-center" id="cusTable" style="width:100%">
        <thead>
            <tr>
                <th style="padding-left: 15px;">#</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Balance</th>
                <th>University</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

@endsection()
@push('scripts')

<script>
$(document).ready( function () {
$('#cusTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('customers.data') !!}',
    'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "dt-center",
 }],
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
@endpush

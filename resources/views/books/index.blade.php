@extends('templates.master')

@section('content')

    <h2>Books list</h2>
    <hr/>
    <a class="btn btn-success" href="books/create" style="margin-bottom: 15px;">Entry Book</a>
    @if(Session::has('message'))
    <div class="alert-custom">
        <p>{{ Session::get('message') }}</p>
    </div>
    @endif
    <table class="table table-bordered" id="BookTable">
        <thead>
            <tr>
                <th style="padding-left: 15px;">#</th>
                <th>Book Code</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price Code</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th width="110">Action</th>
            </tr>
        </thead>
    </table>

@endsection()
@push('scripts')

<script>
$(document).ready( function () {
$('#BookTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('books.data') !!}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'book_code', name: 'book_code' },
        { data: 'title', name: 'title' },
        { data: 'author', name: 'author' },
        { data: 'price_code', name: 'price_code' },
        { data: 'price', name: 'price' },
        { data: 'quantity', name: 'quantity' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});
} );
</script>
@endpush

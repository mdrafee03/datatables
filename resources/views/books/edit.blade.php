@extends('templates.master')

@section('content')

    <h2>Update Book</h2>
    <hr>
    <a href="/books" class="btn btn-primary" style="margin-bottom: 15px">Books list</a>

    <form method="POST" action="/books/{{ $book->id }}" id="dataForm">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label for="book_code">Book Code</label>
            <input type="text" class="form-control {{$errors->has('book_code') ? 'border-danger' : '' }}" id ="book_code" name="book_code" placeholder="Enter book code" value="{{ $book->book_code }}">
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control {{$errors->has('title') ? 'border-danger' : '' }}" id ="title" name="title" placeholder="Enter Title" value="{{ $book->title }}">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id ="author" name="author" placeholder="Enter Author" value="{{ $book->author }}">
        </div>
        <div class="form-group">
            <label for="price_code">Price Code</label>
            <input type="text" class="form-control {{$errors->has('price_code') ? 'border-danger' : '' }}" id ="price_code" name="price_code" placeholder="Enter Price Code" value="{{ $book->price_code }}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control {{$errors->has('price') ? 'border-danger' : '' }}" id ="price" name="price" placeholder="Enter Price" value="{{ $book->price }}">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control {{$errors->has('quantity') ? 'border-danger' : '' }}" id ="quantity" name="quantity" placeholder="Enter Quantity" value="{{ $book->quantity }}">
        </div>
        <div class="form-group">
            <label for="status">status</label>
            <input type="text" class="form-control {{$errors->has('status') ? 'border-danger' : '' }}" id ="status" name="status" placeholder="Enter status" value="{{ $book->status }}">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection
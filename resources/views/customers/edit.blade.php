@extends('templates.master')

@section('content')

    <h2>Update Data</h2>
    <hr>
    <a href="/customers" class="btn btn-primary" style="margin-bottom: 15px">Read Data</a>

    <form method="POST" action="/customers/{{ $customer->id }}" id="dataForm">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text"class="form-control" id ="name" name="name" placeholder="Enter name" value="{{ $customer->name }}">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text"class="form-control" id ="mobile" name="mobile" placeholder="Enter Mobile Number" value="{{ $customer->mobile }}">
        </div>
        <div class="form-group">
            <label for="balance">Balance</label>
            <input type="number"class="form-control" id ="balance" name="balance" placeholder="Enter Balance" value="{{ $customer->balance }}">
        </div>
        <div class="form-group">
            <label for="">University</label>
            <input type="text"class="form-control" id ="university" name="university" placeholder="Enter University" value="{{ $customer->university }}">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection
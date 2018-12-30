@extends('templates.master')

@section('content')

    <h2>Create Data</h2>
    <hr>
    <a href="/customers" class="btn btn-primary" style="margin-bottom: 15px">Read Data</a>

    <form method="POST" action="/customers" id="dataForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id ="name" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control {{$errors->has('mobile') ? 'border-danger' : '' }}" id ="mobile" name="mobile" placeholder="Enter Mobile Number">
            <small class="error">{{ $errors->first('mobile') }}</small>
        </div>
        <div class="form-group">
            <label for="balance">Balance</label>
            <input type="number" class="form-control" id ="balance" name="balance" placeholder="Enter Balance">
        </div>
        <div class="form-group">
            <label for="">University</label>
            <input type="text" class="form-control" id ="university" name="university" placeholder="Enter University">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection
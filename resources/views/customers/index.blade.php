@extends('customers.templates.master')

@section('content')

    <h2>Read Data</h2>
    <hr/>
    <a class="btn btn-success" href="customers/create" style="margin-bottom: 15px;">Create New</a>
    @if(Session::has('message'))
    <div class="alert-custom">
        <p>{{ Session::get('message') }}</p>
    </div>
    @endif
    <table class="table table-bordered" id="cusTable">
        <thead>
            <tr>
                <th style="padding-left: 15px;">#</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Balance</th>
                <th>University</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>




        </tbody>
    </table>

@endsection()
@extends('customers.templates.master')

@section('content')

    <h2>Read Data</h2>
    <hr/>
    <a class="btn btn-primary" href="customers/create" style="margin-bottom: 15px;">Create New</a>
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

        @foreach($customers as $customer)
            <tr>
                <td style="padding-left: 15px">{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->mobile}}</td>
                <td>{{$customer->balance}}</td>
                <td>{{$customer->university}}</td>
                <td>
                    <a href="{{ route('customers.edit', ['$id' => $customer->id]) }}" class="btn btn-success btn-sm">Edit</a>
                    <form action="/customers/{{ $customer->id }}" method="post" id="deleteForm">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection()
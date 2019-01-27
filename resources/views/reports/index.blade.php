@extends('templates.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="list-group report-category box">  
                <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-shopping-cart"></i>Sales</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-tags"></i>Discount</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user"></i>Customer</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-book"></i>Books</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="report-subcategory box">
                <h3 class="text-info"><i class="icon ti-shopping-cart"></i>	Sales</h3>
                <div class="list-group report-sales">  
                    <a href="/reports/generate" class="list-group-item list-group-item-action"><i class="fas fa-receipt"></i>Summary Report</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-calendar"></i>Details Report</a>
                </div>
            </div>
    </div>
</div>
  @endsection()
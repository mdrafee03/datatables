@include('customers.templates.partials.header')

<!-- container -->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @yield('content')

        </div>
    </div>
</div><!-- container -->

@include('customers.templates.partials.footer')
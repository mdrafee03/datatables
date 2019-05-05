@extends('templates.master')

@section('content')
<script src="{!! asset('assets/js/moment.min.js') !!}"></script>
<script src="{!! asset('assets/js/daterangepicker.js') !!}"></script>
    <div class="box generate">
        <h3 class="text-info"><i class="icon ti-shopping-cart"></i>Report Option</h3>
        <hr>
		<div class="row justify-content-md-center date-range">
			<label for="range-option" class="col-md-1">Date Range: </label>
			<div id="date-range-select">
    			<i class="fa fa-calendar"></i>&nbsp;
    			<span></span> <i class="fa fa-caret-down"></i>
			</div>
    </div>
<div class="box">
  <table class="table table-hover datatables ">
      <thead>
        <tr>
          <th></th>
          <th>Sale Id</th>
          <th>Date</th>
          <th>Subtotal</th>
          <th>Total</th>
          <th>Balance</th>
          <!-- <th>Invoice</th> -->
        </tr>
      </thead>
      <tbody></tbody>
    </table>
</div>

@endsection()
@push('scripts')
<script type="text/javascript">
  $(function(){
		var start = moment().subtract(29, 'days');
    var end = moment();

		function cb(start, end) {
			$('#date-range-select span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		}

		$('#date-range-select').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);

		cb(start, end);
    var startDate = moment().subtract(29, 'days');
    var endDate = moment();
	  // Table
    var table = $('.datatables').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '{!! route('sales.data') !!}',
        data: function(d){
          d.start_date = startDate ? startDate.format('YYYY-MM-DD 00:00:00'): '';
          d.end_date = endDate ? endDate.format('YYYY-MM-DD 23:59:59') : '';
        }
      },
      columns : [
        {
          className      : 'details-control',
          defaultContent : '',
          data           : null,
          orderable      : false
        },
        {data : 'id', name: 'id'},
        {data : 'created_at', name: 'created_at'},
        {data : 'subtotal', name: 'subtotal'},
        {data: 'total', name: 'total'},
        {data: 'balance', name: 'balance'},
        // {data: 'invoice', name: 'invoice'},
      ],
      "columnDefs": [ { "defaultContent": "-", "targets": "_all" } ],

      "order": [[ 2, "desc" ]],
      pagingType : 'full_numbers',
    });

    $('.datatables tbody').on('click', 'td.details-control', function () {
      var tr  = $(this).closest('tr'),
          row = table.row(tr);

      if (row.child.isShown()) {
        tr.next('tr').removeClass('details-row');
        row.child.hide();
        tr.removeClass('shown');
      }
      else {
        $.get('/reports/sales/show-child/' + row.data().id).then(function(response){
          row.child(response).show();
          tr.next('tr').addClass('details-row');
          tr.addClass('shown');
        });
      }
    });
    
  $("#date-range-select").on('apply.daterangepicker', function(e, picker)
    {
      startDate = picker.startDate;
      endDate = picker.endDate;
      table.draw(false);
    })
    $('#date-range-select').on('cancel.daterangepicker', function(ev, picker)
    {
      //do something, like clearing an input
      startDate = undefined;
      endDate = undefined;
      $('#date-range-select span').html('');
      table.draw(false);
    });
  });
	</script>
@endpush
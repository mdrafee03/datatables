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
	</div>
	<div class="box">
		<table class="table table-hover datatables ">
        <thead>
          <tr>
            <th></th>
				<th>Sale Id</th>
				<th>Date</th>
				<th>Books Purchased</th>
				<th>Books Return</th>
				<th>Subtotal</th>
				<th>Discount</th>
				<th>Total</th>
				<th>Balance</th>
				<th>Comment</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
	</div>




      
    </div>
  </div>
</div>

<script type="text/javascript">
 	$(function() {

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

	});
	// Table
	$(document).ready( function () {
$('#ReportTable').DataTable({

});
} );
$(document).ready(function() {
  
  var data = [
    {"id":1,"first_name":"Charles","last_name":"Daniels","email":"cdaniels0@java.com","country":"China","ip_address":"27.159.97.60"},                 
    {"id":2,"first_name":"Stephen","last_name":"Martinez","email":"smartinez1@hhs.gov","country":"Brazil","ip_address":"67.135.55.135"},
    {"id":3,"first_name":"Ronald","last_name":"Cox","email":"rcox2@hatena.ne.jp","country":"Ukraine","ip_address":"74.193.127.5"},
    {"id":4,"first_name":"Shawn","last_name":"Knight","email":"sknight3@smh.com.au","country":"Peru","ip_address":"4.104.253.210"},
    {"id":5,"first_name":"Ann","last_name":"Brooks","email":"abrooks4@surveymonkey.com","country":"Albania","ip_address":"158.232.103.250"},
    {"id":6,"first_name":"Louis","last_name":"Burton","email":"lburton5@blogtalkradio.com","country":"Canada","ip_address":"113.223.12.183"},
    {"id":7,"first_name":"Heather","last_name":"Reyes","email":"hreyes6@linkedin.com","country":"Philippines","ip_address":"51.127.238.217"},
    {"id":8,"first_name":"Teresa","last_name":"Cook","email":"tcook7@goo.gl","country":"Indonesia","ip_address":"234.162.161.124"},
    {"id":9,"first_name":"Pamela","last_name":"Baker","email":"pbaker8@ustream.tv","country":"Indonesia","ip_address":"34.222.52.129"},
    {"id":10,"first_name":"Jimmy","last_name":"Ryan","email":"jryan9@census.gov","country":"Colombia","ip_address":"199.218.254.19"},
    {"id":11,"first_name":"Frank","last_name":"Garza","email":"fgarzaa@mapy.cz","country":"Poland","ip_address":"229.39.4.198"},
    {"id":12,"first_name":"Lisa","last_name":"Rice","email":"lriceb@globo.com","country":"China","ip_address":"27.60.99.34"},
    {"id":13,"first_name":"Terry","last_name":"Scott","email":"tscottc@symantec.com","country":"China","ip_address":"75.195.58.0"},
    {"id":14,"first_name":"Katherine","last_name":"Peterson","email":"kpetersond@shutterfly.com","country":"Palestinian","ip_address":"27.6.67.11"},
    {"id":15,"first_name":"Paula","last_name":"Howell","email":"phowelle@github.io","country":"Russia","ip_address":"16.99.84.99"},
    {"id":16,"first_name":"Robin","last_name":"Jordan","email":"rjordanf@guardian.co.uk","country":"Portugal","ip_address":"154.11.121.130"},
    {"id":17,"first_name":"Wayne","last_name":"Banks","email":"wbanksg@google.com.au","country":"Philippines","ip_address":"120.253.110.14"},
    {"id":18,"first_name":"Phillip","last_name":"Garcia","email":"pgarciah@barnesandnoble.com","country":"Japan","ip_address":"255.45.169.17"},
    {"id":19,"first_name":"Philip","last_name":"Reynolds","email":"preynoldsi@xinhuanet.com","country":"China","ip_address":"189.53.111.219"},
    {"id":20,"first_name":"Maria","last_name":"Elliott","email":"melliottj@google.com.au","country":"Togo","ip_address":"134.68.23.162"},
    {"id":21,"first_name":"Sean","last_name":"Tucker","email":"stuckerk@artisteer.com","country":"Russia","ip_address":"154.93.215.125"},
    {"id":22,"first_name":"Bobby","last_name":"Hughes","email":"bhughesl@princeton.edu","country":"Portugal","ip_address":"88.137.250.16"},
    {"id":23,"first_name":"Thomas","last_name":"Nelson","email":"tnelsonm@plala.or.jp","country":"Azerbaijan","ip_address":"168.165.156.80"},
    {"id":24,"first_name":"Eric","last_name":"Oliver","email":"eolivern@jigsy.com","country":"Brazil","ip_address":"174.232.233.168"},
    {"id":25,"first_name":"Johnny","last_name":"Foster","email":"jfostero@zdnet.com","country":"China","ip_address":"23.87.64.167"},
    {"id":26,"first_name":"Annie","last_name":"Mendoza","email":"amendozap@tamu.edu","country":"Philippines","ip_address":"200.130.230.106"},
    {"id":27,"first_name":"Joan","last_name":"Banks","email":"jbanksq@guardian.co.uk","country":"Indonesia","ip_address":"174.24.66.105"},
    {"id":28,"first_name":"Jimmy","last_name":"Adams","email":"jadamsr@blogger.com","country":"Vietnam","ip_address":"139.39.215.169"},
    {"id":29,"first_name":"Lisa","last_name":"Burke","email":"lburkes@pinterest.com","country":"Brazil","ip_address":"31.140.200.136"},
    {"id":30,"first_name":"Julie","last_name":"Edwards","email":"jedwardst@deliciousdays.com","country":"Sweden","ip_address":"32.126.238.213"},
    {"id":31,"first_name":"Gerald","last_name":"Gibson","email":"ggibsonu@list-manage.com","country":"China","ip_address":"133.112.226.39"},
    {"id":32,"first_name":"Thomas","last_name":"Gutierrez","email":"tgutierrezv@virginia.edu","country":"Czech","ip_address":"230.48.6.201"},
    {"id":33,"first_name":"Joseph","last_name":"Hernandez","email":"jhernandezw@usda.gov","country":"Indonesia","ip_address":"224.226.137.15"},
    {"id":34,"first_name":"Heather","last_name":"Ward","email":"hwardx@people.com.cn","country":"Indonesia","ip_address":"113.182.3.93"},
    {"id":35,"first_name":"Lisa","last_name":"Wallace","email":"lwallacey@hexun.com","country":"Thailand","ip_address":"189.246.197.32"},
    {"id":36,"first_name":"Teresa","last_name":"Green","email":"tgreenz@sbwire.com","country":"China","ip_address":"194.7.170.239"},
    {"id":37,"first_name":"Scott","last_name":"Peterson","email":"speterson10@netscape.com","country":"Finland","ip_address":"90.75.186.0"},
    {"id":38,"first_name":"Gloria","last_name":"Warren","email":"gwarren11@technorati.com","country":"Poland","ip_address":"17.98.95.245"},
    {"id":39,"first_name":"Julia","last_name":"Cruz","email":"jcruz12@netscape.com","country":"Peru","ip_address":"172.138.28.168"},
    {"id":40,"first_name":"Louis","last_name":"Porter","email":"lporter13@cbc.ca","country":"United Kingdom","ip_address":"116.65.222.105"},
    {"id":41,"first_name":"Kathryn","last_name":"Harvey","email":"kharvey14@buzzfeed.com","country":"Indonesia","ip_address":"234.34.204.190"},
    {"id":42,"first_name":"Samuel","last_name":"Reed","email":"sreed15@wikipedia.org","country":"China","ip_address":"158.13.5.183"},
    {"id":43,"first_name":"Adam","last_name":"Lane","email":"alane16@blogger.com","country":"Poland","ip_address":"227.8.133.83"},
    {"id":44,"first_name":"Jeremy","last_name":"Jordan","email":"jjordan17@jalbum.net","country":"China","ip_address":"61.193.128.79"},
    {"id":45,"first_name":"Martha","last_name":"Johnston","email":"mjohnston18@tripod.com","country":"South Africa","ip_address":"234.157.197.203"},
    {"id":46,"first_name":"Phillip","last_name":"Sanchez","email":"psanchez19@shinystat.com","country":"Finland","ip_address":"149.150.67.243"},
    {"id":47,"first_name":"Henry","last_name":"Rodriguez","email":"hrodriguez1a@craigslist.org","country":"Uganda","ip_address":"34.196.32.21"},
    {"id":48,"first_name":"Lawrence","last_name":"Mccoy","email":"lmccoy1b@freewebs.com","country":"United States","ip_address":"243.46.197.247"},
    {"id":49,"first_name":"Henry","last_name":"Henderson","email":"hhenderson1c@columbia.edu","country":"Armenia","ip_address":"77.98.159.133"},
    {"id":50,"first_name":"Phyllis","last_name":"Warren","email":"pwarren1d@sbwire.com","country":"United States","ip_address":"116.46.30.32"},
    {"id":51,"first_name":"Jimmy","last_name":"Webb","email":"jwebb1e@mac.com","country":"China","ip_address":"188.242.6.217"},
    {"id":52,"first_name":"Susan","last_name":"Rose","email":"srose1f@redcross.org","country":"Poland","ip_address":"109.31.171.27"},
    {"id":53,"first_name":"Victor","last_name":"Burke","email":"vburke1g@nba.com","country":"Mexico","ip_address":"88.195.190.76"},
    {"id":54,"first_name":"Helen","last_name":"Oliver","email":"holiver1h@mapy.cz","country":"Brazil","ip_address":"181.33.94.232"},
    {"id":55,"first_name":"Jerry","last_name":"Robinson","email":"jrobinson1i@usnews.com","country":"Bulgaria","ip_address":"74.15.180.63"},
    {"id":56,"first_name":"Donald","last_name":"Vasquez","email":"dvasquez1j@dmoz.org","country":"Sweden","ip_address":"110.144.121.168"},
    {"id":57,"first_name":"Craig","last_name":"Carr","email":"ccarr1k@mozilla.org","country":"China","ip_address":"31.216.84.139"},
    {"id":58,"first_name":"Steve","last_name":"Myers","email":"smyers1l@deviantart.com","country":"Poland","ip_address":"77.125.144.221"},
    {"id":59,"first_name":"Jason","last_name":"Ramirez","email":"jramirez1m@nature.com","country":"China","ip_address":"224.35.146.154"},
    {"id":60,"first_name":"Harold","last_name":"Moore","email":"hmoore1n@ft.com","country":"Sri Lanka","ip_address":"205.115.217.125"}
  ];
  
  
  function format (data) {
      return '<div class="details-container">'+
          '<table class="details-table">'+
				'<thead>'+
				'<tr>'+
					'<th>Book_name</td>'+
					'<th>Sell or Return</td>'+
					'<th>price</td>'+
					'<th>Qty</td>'+
					'<th>Total</td>'+
				'</tr>'+
				'</thead>'+
				'<tbody>'+
				'<tr>'+
					'<td>'+data.ip_address+'</td>'+
					'<td>'+data.first_name + '</td>'+
					'<td>'+data.last_name+'</td>'+
					'<td>'+data.email+'</td>'+
					'<td>'+data.id+'</td>'+
				'</tr>'+
				'<tr>'+
					'<td>'+data.ip_address+'</td>'+
					'<td>'+data.first_name + '</td>'+
					'<td>'+data.last_name+'</td>'+
					'<td>'+data.email+'</td>'+
					'<td>'+data.id+'</td>'+
				'</tr>'+
          '</table>'+
        '</div>';
  };
  
  var table = $('.datatables').DataTable({
    // Column definitions
    columns : [
      {
        className      : 'details-control',
        defaultContent : '',
        data           : null,
        orderable      : false
      },
      {data : 'first_name'},
      {data : 'last_name'},
      {data : 'email'},
	  {data: 'first_name'},
	  {data: 'last_name'},
      {data : 'email'},
	  {data: 'first_name'},
	  {data: 'last_name'},
      {data : 'email'},


    ],
    
    data : data,
    
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
       row.child(format(row.data())).show();
       tr.next('tr').addClass('details-row');
       tr.addClass('shown');
     }
  });
 
});
	</script>

@endsection()
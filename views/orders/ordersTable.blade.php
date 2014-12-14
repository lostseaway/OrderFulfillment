<script>
    $("body").delegate(".fulfill", "click", function(e) {

     e.preventDefault();

     $.post("/dntk/orders/fulfill" , 
        { order_id:$(this).attr("id")},
        function(res,status) {
         if( res.fail ) {
            // window.location.replace("http://128.199.132.197/dntk/");
          alert(res);
         }
         else{
         	alert("Fulfilled!");
         	location.reload();
         }
      });

    });

    $("body").delegate(".grap", "click", function(e) {

     e.preventDefault();

     $.post("/dntk/orders/grap" , 
        { order_id:$(this).attr("id")},
        function(res,status) {
         if( res.fail ) {
            window.location.replace("http://128.199.132.197/dntk/");
         }
         else{
         	alert("graped!");
         	location.reload();
         }
      });

        $('.wishlist a').css( 'color' , '#ffbe56' );
        setTimeout( function() {
          $('.wishlist a').css( 'color' , '#444' );
        },1000);

    });
</script>

		<table align="center" class="table table-hover" style="background-color:white;">
			<div class="buttons btn-group">
  			<button class="btn">Update Status</button>
  			<button class="btn">Cancle Sale</button>
  			<button class="btn">Merge Invoice</button>
  			<button class="btn">Print Invoice</button>
  			<button class="btn">Send Email</button>
  			<button class="btn">Upload Shipping</button>
		</div>
<div>
			<tr>
				<th>OrderID</th>
				<th>Site</th>
				<th>TransactionID</th>
				<th>Customer</th>
				<th>Customer Email</th>
				<th>Invoice Date</th>
				<th>Payment Type</th>
				<th>Order Total</th>
				<th>Order Status</th>
				<th>Payment Status</th>
				<th>Shipping Status</th>
				<th></th>
			</tr>
			@foreach( $orders as $order )
			<tr>
				<td>{{$order->id}}</td>
				<td>{{$order->site}}</td>
				<td>{{$order->transcation_id}}</td>
				<td>{{$order->customer_id}}</td>
				<td>{{$order->customer_email}}</td>
				<td>{{$order->invoice_date}}</td>
				<td>{{$order->payment_type}}</td>
				<td>{{$order->total_price}}</td>
				<td>{{$order->order_status}}</td>
				<td>{{$order->payment_status}}</td>
				<td>{{$order->shipping_status}}</td>
				<td><input type="button" class="btn btn-info btn-xs" value="Detail" onClick="window.open('/dntk/orders/{{$order->id}}')";></td>
				<td>
					@if ($order->order_status == 'OnProcess' and $order->payment_status == 'Paid')
					<input id="{{$order->id}}" type="button" class="btn btn-success btn-xs fulfill" value="Fulfill";>
					@elseif ($order->order_status == 'Waiting' and $order->payment_status == 'Paid')
					<input id="{{$order->id}}" type="button" class="btn btn-success btn-xs grap" value="Grap";>
					@elseif ($order->order_status == 'Waiting' and $order->payment_status == 'Waiting')
					<input id="{{$order->id}}"type="button" class="btn btn-default btn-xs" value="Grap" disabled="disabled";>
					@else
					<input id="{{$order->id}}"type="button" class="btn btn-default btn-xs" value="Fulfill" disabled="disabled";>
					@endif
				</td>
			
			</tr>
			@endforeach
		</table>
		<!-- <div >
  			<ul class="page pagination">
    		<li><a href="#">Prev</a></li>
    		<li><a href="#">1</a></li>
    		<li><a href="#">2</a></li>
    		<li><a href="#">3</a></li>
    		<li><a href="#">4</a></li>
    		<li><a href="#">5</a></li>
    		<li><a href="#">Next</a></li>
  			</ul>
		</div> -->
	</div>
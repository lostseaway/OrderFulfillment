@include('layout.header')
<head>
	<title>DNTk : Order - {{$order->id}}</title>
</head>

@section('content')
@include('layout.navbar')
<body id="page-top">
		<!-- Section: order-detail -->
		<section id="order-detail" class="color-dark bg-white">
			<div class="container" style="margin-top: 20px; margin-bottom: 10px;">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="section-heading text-center">
							<h1 class="h-bold">DNTk Order Detials</h1>
							<div class="divider-header"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
					<!-- <div class="panel-body">
				        <div id="performance1" style="height: 5px;"></div>
				    </div> -->
		            <div class="col-md-12" style="margin-bottom: 5px;">
						<h3>Order ID: {{$order->id}}</h3>
					</div>
					<table class="table table-hover" style="margin-bottom: 10px;">
	               	<tr class="info">
		               <thead>
		                  <th>Product Id</th>
		                  <th>Name</th>
		                  <th>Unit Price</th>
		                  <th>Quantity</th>
		                  <th>Weight</th>
		                  <th>Total Price</th>
		               </thead>
	               	</tr>
	               	@foreach($products as $product)
	               	<tbody>
	                  <tr>
	                     <td><p>{{$product->product_id}}</p></td>
	                     <td><h5>{{$product->product_name}}</h5></td>
	                     <td>{{$product->price}}<h> baht<h></td>
	                     <td>{{$product->quantity}}</td>
	                     <td>{{$product->weight}}</td>
	                     <td>{{(float)$product->price*(float)$product->quantity}}<h> baht<h> </td>
	                  </tr>
               		</tbody>
               		@endforeach
	            </table>

	            <div class="col-md-12 text-right" style="margin-bottom: 10px; padding-right: 100px;">
					<h3>Total Price: {{$order->total_price}} Baht</h3>
				</div>

				<div class="col-md-12" style="margin-bottom: 5px;">
					<h3>Customer ID: {{$order->customer_id}}</h3>
				</div>
				<table class="table table-hover" style="margin-bottom: 50px;">
	               	<tr class="info">
		               <thead>
		                  <th>Name</th>
		                  <th>Email</th>
		                  <th>Phone Number</th>
		                  <th>Address</th>
		                  <th>Payment Type</th>
		               </thead>
	               	</tr>
	               	<tbody>
	                  <tr>
	                     <td><h5> {{$order->customer_name}} </h5></td>
	                     <td><p> {{$order->customer_email}} </p></td>
	                     <td><p> {{$order->customer_phone}} </p></td>
	                     <td>
	                     	<p> {{$order->customer_address}}
	                     	</p>
	                     </td>
	                     <td>
	                     	<p> {{$order->payment_type}} </p>
	                     </td>
	                  </tr>
               		</tbody>
               	</table>

               	<div class="col-lg-12 col-md-12">
	               	<table  align="right" border="1" cellpadding="0" cellspacing="5" id="balanceDetails" class="table table-hover" >
					    <thead>
					        <tr>
					            <th class="text-left">Shipment ID:</th>
					            <th class="text-left">{{$order->ship_id}}</th>
					        </tr>
					    </thead>
					    <tbody>
					        <tr>
					            <td scope="row">Invoice Date</td>
					            <td class="text-left">{{$order->invoice_date}}</td>
					        </tr>
					        <tr>
					            <td scope="row">Created Date</td>
								<td class="text-left">{{$order->created_at}}</td>
							</tr>
							<tr>
					            <td scope="row">Update Date</td>
								<td class="text-left">{{$order->updated_at}}</td>
							</tr>
							<tr>
					            <td scope="row">Payment Status</td>
								<td class="text-left">{{$order->payment_status}}</td>
							</tr>
							<tr>
					            <td scope="row">Order Status</td>
								<td class="text-left">{{$order->order_status}}</td>
							</tr>
						</tbody>

					</table>
				</div>

               	<!-- <div class="col-md-12" style="margin-bottom: 10px;">
					<h4>Shipment ID: 1</h4>
				</div> -->

				<div class="panel-body">
				        <div id="performance1" style="height: 50px;"></div>
				</div>
			</div>

		</section>
	</body>
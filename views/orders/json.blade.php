@include('layout.header')
<head>
	<title>DNTk : JSON Post Order Template</title>
</head>
<style type="text/css">

a.ex{
	color: red;
}
</style>
@section('content')

<body style="background-color: #2c3338;">
	<div class='container'>
		<h1 style="color:white"> JSON Post Order Format!</h1>
		<pre>
			<code>
				NOTE : <a class='ex'>RED</a> Expect!</a>
				*in product if have products should have all attibuit!
	{
		<a>"error"</a>: false,
		<a class='ex'>"order"</a>: 
		{
			<a class='ex'>"site"</a>: "DNTk-site",
			<a>"products"</a>: [
				{
					<a class='ex'>"product_id"</a>: "0001",
					<a class='ex'>"product_name"</a>: "product_test1",
					<a class='ex'>"price"</a>: "199",
					<a class='ex'>"quantity"</a>: "1",
					<a class='ex'>"weight"</a>: "1.2"
				},
				{
					<a class='ex'>"product_id"</a>: "0002",
					<a class='ex'>"product_name"</a>: "product_test2",
					<a class='ex'>"price"</a>: "99",
					<a class='ex'>"quantity"</a>: "1",
					<a class='ex'>"weight"</a>: "1.2"
				}
			],
			<a class='ex'>"totalprice"</a>: "298",
			<a class='ex'>"customer_id"</a>: "1",
			<a class='ex'>"customer_name"</a>: "person1",
			<a class='ex'>"email"</a>: "person1@test.com",
			<a class='ex'>"phone_number"</a>: "021231234",
			<a class='ex'>"address"</a>: "adress1",
			<a class='ex'>"payment_type"</a>: "credit",
			<a>"shipment_id"</a>: "1",
			<a>"invoice_date"</a>: "2014-11-29 14:59:00",
			<a>"created_date"</a>: "2014-11-29 14:59:00",
			<a>"updated_date"</a>: "2014-11-29 14:59:00",
			<a>"payment_status"</a>: "0",
			<a>"order_status"</a>: "1"
		}
	}
			</code>
		</pre>
	</div>
</body>
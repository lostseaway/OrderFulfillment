@include('layout.header')
<head>
	<title>DNTk : All Orders</title>
</head>

@section('content')
@include('layout.navbar')
<body style="background-color: #2c3338;">
	@if(Session::has('fail'))
      <div id="notice" class="notice notice-fail">
        <div class="alert alert-danger" role="alert">{{ Session::get('fail') }}</div>
      </div>
      @endif
      @if(Session::has('success'))
      <div id="notice" class="notice notice-fail">
        <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
      </div>
      @endif
    <div class="container">
	@include('orders.ordersTable')
	</div>
</body>
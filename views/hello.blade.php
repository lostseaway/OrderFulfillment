<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login - DNTk Order Fulfillment</title>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>
<body>
	<div class="container">

      @if(Session::has('fail'))
      <div id="notice" class="notice notice-fail">
        <div class="alert alert-danger" role="alert">{{ Session::get('fail') }}</div>
          
      </div>
      @endif
      <div id="login">
      	<h2 style="text-align:center;color:white;font-size:20px">DNTk Order Fulfillment</h2>
      	<br>
        <form action="{{URL::route('sign-in-post')}}" method="post">

          <fieldset class="clearfix">

            <p><span class="fontawesome-user"></span><input name = "email" type="text" value="E-mail" onBlur="if(this.value == '') this.value = 'E-mail'" onFocus="if(this.value == 'E-mail') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fontawesome-lock"></span><input name = "password" type="password"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            <p><input type="submit" value="Sign In"></p>

          </fieldset>
          {{ Form::token() }}
        </form>

        <!-- <p>Not a member? <a href="#">Sign up now</a><span class="fontawesome-arrow-right"></span></p> -->

      </div> <!-- end login -->

    </div>
</body>
</html>

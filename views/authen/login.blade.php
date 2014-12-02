<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login - DNTk Order Fulfillment</title>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>
<body>
	<div class="container">

      <div id="login">
      	<h2 style="text-align:center;color:white;font-size:20px">DNTk Order Fulfillment</h2>
      	<br>
        <form action="{{URL::route('sign-in-post')}}" method="post">

          <fieldset class="clearfix">

            <p><span class="fontawesome-user"></span><input type="text" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fontawesome-lock"></span><input type="password"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            <p><input type="submit" value="Sign In"></p>

          </fieldset>
          {{ Form::token() }}
        </form>

        <!-- <p>Not a member? <a href="#">Sign up now</a><span class="fontawesome-arrow-right"></span></p> -->

      </div> <!-- end login -->

    </div>
</body>
</html>

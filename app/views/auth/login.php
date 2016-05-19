<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SDMatehuala Login</title>
	<link href="/css/app.css" type="text/css" rel="stylesheet" />
    <script src="/js/modernizr.js"></script>	
</head>
<body>
	
	<div class="container">

	<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off" class="form-signin">
        <h2 class="form-signin-heading">Iniciar</h2>
        <label for="identifier">Username/email</label>
			<input type="text" class="form-control" name="identifier" id="identifier">
			{% if errors.has('identifier') %} {{ errors.first('identifier')}} {% endif %}
			<label for="password">Password</label>
			<input type="password" class="form-control" name="password" id="password">
			{% if errors.has('password') %} {{ errors.first('password')}} {% endif %}
		<div class="checkbox">
          <label>
			<input type='checkbox' name='remember' id='remember'> <label for="remember">Remember me</label>
          </label>
        </div>
        <input type='hidden' name='{{ csrf_key }}' value='{{ csrf_token }}'>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->
    <div class="text-center">
    	<a href="{{ urlFor('password.recover')}}">Olvidaste tu password?</a>
    </div>
</body>
</html>

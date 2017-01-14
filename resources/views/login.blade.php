<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
	@if (Session::has('message'))
		{{ Session::get('message') }}
	@endif
  <form method="POST" action="/login">
    {{ csrf_field() }}
  	<label for=""> Email <input type="email" name="email"> </label>
  	<label for=""> Password <input type="password" name="password"> </label>
  	<button type="submit">Login</button>
  </form>
</body>
</html>

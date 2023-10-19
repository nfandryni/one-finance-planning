<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
	<title>Login</title>
</head>
<body class='bg-success'>
<div class="card m-auto my-5" style="width: 20rem;">
	<h4 class="card-title text-center m-4">Login</h4>	
	<img src="login.png" class="card-img-top m-auto p-3" width='20px'  style="width: 150px;" alt="...">
	<div class="card-body m-2">
	<form method='POST' action='login'>
		<input type='text' name='username' class="form-control p-2" placeholder='Username...' required><p></p>
		<input type='password' name='password' class='form-control p-2' placeholder="Password..." required>
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<br/>
		<div class="d-grid gap-2 col-6 mx-auto">

			<input type='submit' class='btn btn-primary m-auto w-block' value='Login'>
		</div>
	</form>
  </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body class='bg-success'>
<div class="card m-auto my-5" style="width: 22rem;">
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

@vite(['resources/sass/app.scss','resources/js/app.js'])
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

			  <form method='POST' action='login'>


                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
				  <input type='text' name='username' id='username' class="form-control form-control-lg" placeholder='Username...' required>
                    <label class="form-label" for="username">Username</label>
                  </div>

                  <div class="form-outline mb-4">
					<input type='password' name='password' id="password" class='form-control form-control-lg' placeholder="Password..." required>
                    <label class="form-label" for="password">Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-success btn-lg btn-block" type="button">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                      style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
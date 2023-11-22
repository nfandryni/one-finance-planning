<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Login</title>
</head>

<body>
    <section class="vh-100" style="background-color: #adb5bd;">
        <div class="container  h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ url('../bglogin.png') }}" width="330"
                                    style='margin-top:50px; margin-left:60px;' />

                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method='POST' action='login'>
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x" style="color: #ff6219;"></i>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                            <span class="h1 fw-bold mb-0">One Finance Planning</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                            account</h5>

                                        <div class="form-outline mb-4">
                                            <input type='text' name='username' id='username'
                                                class="form-control form-control-lg" placeholder='Username' required>
                                            {{-- <label class="form-label" for="username">Username</label> --}}
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type='password' name='password' id="password"
                                                class='form-control form-control-lg' placeholder="Password" required>
                                            {{-- <label class="form-label" for="password">Password</label> --}}
                                        </div>

                                        <div class="pt-1 mb-4 d-grid gap-2">
                                            <button class="btn btn-success btn-lg btn-block"
                                                type="submit">Login</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

{{-- @section('footer')
<script type="module">
    $('form').submit(async function (e) {
        e.preventDefault();
        let username = $('#username').val();
        let password = $('#password').val();
				await axios({
					method: 'post',
					url: '/login',
					data: {
						username,
						password
					}
				}).then(async () => {
					await swal.fire({
						title : "Login berhasil!",
						icon: 'success',
						timer: 1000,
						showCancelButton: false
					})
					window.location = '/dashboard-superadmin'
        }).catch(({response}) => {
					if(!$('.error').text()) {
						$('.error').append(document.createTextNode(response.data.errors.message))
					}
				})
    });
</script>

@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

    <!-- CSS only Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Forget Password Link</title>
</head>


<body>

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid " alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST"  action="{{ route('reset.password.post') }}">

                        @csrf

                        <div class="my-4">
                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Reset Your Password</p>
                        </div>

                        @if(\Session::has('message'))
                            <div class="alert alert-danger">

                                {{\Session::get('message')}}
                            </div>
                        @endif

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" />
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Password</label>
                            <input type="password" name="password" id="form3Example4c"
                            class="form-control form-control-lg" @error('password') is-invalid @enderror" placeholder="password" />


                            @error('password')
                            <span class="text-danger" role="alert">
                                {{ $errors->first('password') }}
                            </span>
                            @enderror
                        </div>


                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Confirmation Password</label>
                            <input type="password" name="password_confirmation" id="form3Example4c"
                            class="form-control form-control-lg" placeholder="repeat your password" @error('password') is-invalid @enderror" />

                        </div>


                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Reset Your Password</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>



    <!-- JavaScript Bundle with Popper Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @foreach ($data as $d)
        <title>{{ $d->nama }}</title>
        <link rel="shortcut icon" type="image/jpg" href="{{ url('uploads') . '/' . $d->logo }}" />
    @endforeach
    <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet" />
    {{-- Font Awesaome --}}
    <script src="{{ url('assets/js/all.min.js') }}" crossorigin="anonymous"></script>
</head>

<body style="background: linear-gradient(129deg, rgba(0,184,108,1) 0%, rgba(4,126,244,1) 50%, rgba(89,0,198,1) 100%);">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg" style="margin-top: 30%">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-3">Silahkan Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/auth') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" name="username" type="text"
                                                placeholder="Username" autofocus autocomplete="off" />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password"
                                                type="password" placeholder="Password" autocomplete="off" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        {{-- <div class="form-check mb-1"> --}}
                                        {{-- <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                                value="" /> --}}
                                        {{-- <label class="form-check-label" for="inputRememberPassword"></label> --}}
                                        {{-- </div> --}}
                                        <div class="d-flex align-items-center justify-content-between mb-0">
                                            <a class="small" href="#"></a>
                                            <button type="submit" class="btn btn-primary login">Login</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="card-footer text-center py-3">
                                    <div class="small"><a href="#"></a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        {{-- <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div> --}}
    </div>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous">
    </script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>

</body>

</html>

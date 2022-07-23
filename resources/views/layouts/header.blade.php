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

    <link href="{{ url('assets/css/simple-datatables.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/bootstrap-icons.css') }}" rel="stylesheet" />
    {{-- Font Awesaome --}}
    <script src="{{ url('assets/js/all.min.js') }}" crossorigin="anonymous"></script>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        @foreach ($data as $d)
            <a class="navbar-brand ps-3" href="{{ route('dashboard.index') }}">{{ $d->nama }}</a>
        @endforeach
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                    {{ $user->name }} </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                            href="{{ url('/dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Master</div>
                        <a class="nav-link {{ Request::is('category') ? 'active' : '' }}"
                            href="{{ route('category.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-th-large"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link {{ Request::is('product') ? 'active' : '' }}"
                            href="{{ route('product.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Barang
                        </a>
                        <a class="nav-link {{ Request::is('transaction.*') ? 'active' : '' }}" href="{{ route('transaction.index') }}">
                            <div class="sb-nav-link-icon" onclick="navtoggled()"><i class="fas fa-cart-plus"></i></div>
                            Transaksi
                        </a>
                        @if (Auth::user()->status == 1)
                            <div class="sb-sidenav-menu-heading">Pengaturan</div>
                            <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}"
                                href="{{ route('setting.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                Pengaturan
                            </a>
                            <a class="nav-link {{ Request::is('laporan') ? 'active' : '' }}"
                                href="{{ route('laporan.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-medical-alt"></i></div>
                                Laporan
                            </a>
                        @else
                            <div class="sb-sidenav-menu-heading"></div>
                        @endif
                    </div>
                </div>
                {{-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> --}}
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <a href="https://github.com/AhmadMuzayyin">UNIRA
                                INFORMATICT</a> {{ date('Y') }}
                        </div>
                        <div>
                            <a href="#"></a>
                            {{-- &middot; --}}
                            <a href="#"></a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/scripts.js') }}"></script>
    <script src="{{ url('assets/js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ url('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ url('assets/js/simple-datatables@latest.js') }}"></script>
    <script src="{{ url('assets/js/datatables-simple-demo.js') }}"></script>
    <script src="{{ url('assets/js/sweetalert2.all.min.js') }}"></script>

    <script>
        /* Fungsi */
        function formatRupiah(angka)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
    </script>

    @stack('script')
</body>

</html>

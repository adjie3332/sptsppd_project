<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="/">
                <img src="{{ url('images/Boyolali.png') }}" alt="logo" />
                SPT-SPPD
            </a>
            <a class="navbar-brand brand-logo-mini" href="/">
                <img src="{{ url('images/Boyolali.png') }}" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0 mt-2">
                @guest()
                @else
                    <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">{{ Auth::user()->name }}</span>
                    </h1>
                @endguest
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            @guest
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('login') }}">
                        <button type="button" class="btn btn-success">
                            MASUK
                        </button>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        <button type="button" class="btn btn-outline-secondary">
                            DAFTAR
                        </button>
                    </a>
                </li>
            @else
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle" src="{{ url('images/faces/face8.jpg') }}" alt="Profile image">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="{{ url('images/faces/face8.jpg') }}" alt="Profile image">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('logout') }}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Keluar</a>
                    @endguest
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

@stack('prepend-style')
@include('includes.style')
@stack('addon-style')
<title>Register</title>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="text-center">
                            <div class="brand-logo">
                                <img src="{{ 'images/Boyolali.png' }}" alt="logo">
                            </div>
                            <h4>Selamat Datang di Aplikasi SPPD</h4>
                            <h6 class="fw-light">Daftar untuk lanjut</h6>
                        </div>
                        <form action="{{ route('register.post') }}" method="POST" class="pt-3">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="name" id="name_address" class="form-control form-control-lg" name="name" required autofocus placeholder="Username">
                                <label for="name">Nama</label>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" id="email_address" class="form-control form-control-lg" name="email" required autofocus placeholder="Email">
                                <label for="email">Alamat Email</label>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="Password">
                                <label for="password">Password</label>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mt-3 text-center d-grid">
                                <button class="btn btn-block btn-primary btn-md" type="submit">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@stack('prepend-script')
@include('includes.script')
@stack('addon-script')

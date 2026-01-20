<x-layout bodyClass="bg-gray-200">

        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
                    <x-navbars.navs.guest signin='login' signup='register'></x-navbars.navs.guest>
                    <!-- End Navbar -->
                </div>
            </div>
        </div>
        <main class="main-content  mt-0">
            <div class="page-header align-items-start min-vh-100"
                style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container mt-5">
                    <div class="row signin-margin">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div style="display: flex; justify-content: center; align-items: center;">
    <img src="{{ asset('assets') }}/img/4ps-logo.png" class="navbar-brand-img h-100" alt="main_logo" style="width: 50%;">
</div>


                                <!-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                                        <div class="row mt-3">
                                            <h6 class='text-white text-center'>
                                                <span class="font-weight-normal">Email:</span> admin@material.com
                                                <br>
                                                <span class="font-weight-normal">Password:</span> secret</h6>
                                            <div class="col-2 text-center ms-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                    <i class="fa fa-facebook text-white text-lg"></i>
                                                </a>
                                            </div>
                                            <div class="col-2 text-center px-1">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                    <i class="fa fa-github text-white text-lg"></i>
                                                </a>
                                            </div>
                                            <div class="col-2 text-center me-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                    <i class="fa fa-google text-white text-lg"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                <form role="form" method="POST" action="{{ route('login') }}" class="text-start">
                                    @csrf

                                    @if (session('otp_sent'))
                                        <input type="hidden" name="email" value="{{ session('otp_email') }}">
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Enter OTP</label>
                                            <input type="text" class="form-control" name="otp" required>
                                        </div>
                                        @error('otp')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Verify OTP</button>
                                        </div>
                                    @else
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Sign In</button>
                                        </div>
                                        <p class="mt-4 text-sm text-center">
                                            Don't have an account?
                                            <a href="{{ route('register') }}"
                                                class="text-success text-gradient font-weight-bold">Sign up</a>
                                        </p>
                                        <p class="text-sm text-center">
                                            Forgot your password? Reset your password
                                            <a href="{{ route('verify') }}"
                                                class="text-success text-gradient font-weight-bold">here</a>
                                        </p>
                                    @endif
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <x-footers.guest></x-footers.guest> -->
            </div>
        </main>
        @push('js')
<script src="{{ asset('assets') }}/js/jquery.min.js"></script>
<script>
    $(function() {

    var text_val = $(".input-group input").val();
    if (text_val === "") {
      $(".input-group").removeClass('is-filled');
    } else {
      $(".input-group").addClass('is-filled');
    }
});
</script>
@endpush
</x-layout>

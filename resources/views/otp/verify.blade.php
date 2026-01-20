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
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                            @if (session('status'))
                                                <h3 class="text-center">{{ session('status') }}</h3>
                                                @endif
                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('otp.verify') }}">
                                                        @csrf
                                                        <div class="form-group mb-3">
                                                            <input
                                                                type="text"
                                                                name="otp"
                                                                id="otp"
                                                                class="form-control text-center"
                                                                required
                                                                placeholder="Enter OTP here"
                                                                maxlength="6"
                                                                minlength="6"
                                                                inputmode="numeric"
                                                                pattern="\d{6}"
                                                                style="border: 1px solid #ccc; font-size:50px; text-align: center;"
                                                            >
                                                            @error('otp')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-success w-100">Verify</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <x-footers.guest></x-footers.guest> -->
            </div>
        </main>
</x-layout>

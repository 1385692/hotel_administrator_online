<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="uploads/favicon.png">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    @include('admin.layout.styles')

    @include('admin.layout.scripts')
    
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        {{-- <section class="section">
            <div class="container container-login">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary border-box">
                            <div class="card-header card-header-auth">
                                <h4 class="text-center">Reset Password</h4>
                            </div>
                            <div class="card-body card-body-auth">
                                <form method="POST" action="{{ route('admin_forget_password_submit') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="" autofocus>
                                        @error('email')
                                            <div class="alert alert-danger">
                                            {{ $message }}
                                            </div>
                                        @enderror
                                        @if (session()->get('error'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('error') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <a href="{{ route('admin_login') }}">
                                                Back to login page
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <section class="section">
            <div class="container container-login">
                <div class="row">
                    <div class="col-md-11 mt-60 mx-md-auto">
                        <div class="login-box bg-white pl-lg-5 pl-0">
                            <div class="row no-gutters align-items-center">
                                <div class="col-md-6">
                                    <div class="form-wrap bg-white">
                                        <h4 class="btm-sep pb-3 mb-5">Reset Password</h4>
                                        <form method="POST" action="{{ route('admin_forget_password_submit') }}">
                                            @csrf
                                            <div class="row form">
                                                <div class="col-12 form">
                                                    <div class="inputBox form-group position-relative">
                                                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="" required>
                                                        <span class="label">Email Address</span>
                                                        @error('email')
                                                        <div class="alert alert-danger">
                                                        {{ $message }}
                                                        </div>
                                                        @enderror
                                                        @if (session()->get('error'))
                                                            <div class="alert alert-danger">
                                                                {{ session()->get('error') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-12 mt-30">
                                                        <button type="submit" id="submit" class="btn btn-lg btn-custom btn-dark btn-block">Send Password Reset Link
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-12 text-lg-right">
                                                        <a href="{{ route('admin_login') }}" class="c-black">Back to login page</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="content text-center">
                                        <div class="border-bottom pb-5 mb-5">
                                            <h3 class="c-black">Send an email and</h3>
                                            <h6>RESET</h6>
                                        </div>
                                        <h1 class="c-black mb-4 mt-n1">The Hotel</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

@include('admin.layout.scripts_footer')


</body>
</html>
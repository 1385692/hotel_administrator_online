@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->forget_password_heading }}</h2>
                <div class="h-line bg-dark"></div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">

                <form action="{{ route('customer_forget_password_submit') }}" method="post">
                    @csrf
                    <div class="inputBox form-group position-relative">
                        <div class="mb-3">
                            <input type="text" class="" name="email" required>
                            <span class="label">Email Address</span>
                            @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website">Submit</button>
                            <a href="{{ route('customer_login') }}" class="primary-color">Back to Login Page</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->reset_password_heading }}</h2>
                <div class="h-line bg-dark"></div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">

                <form action="{{ route('customer_reset_password_submit') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="inputBox form-group position-relative">
                        <div class="mb-3">
                            <input type="password" class="" name="password" required>
                            <span class="label">Password</span>
                            @if ($errors->has('password'))
                            <div class="alert alert-danger">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="inputBox form-group position-relative">
                        <div class="mb-3">
                            <input type="password" class="" name="retype_password" required>
                            <span class="label">Retype Pass</span>
                            @if ($errors->has('retype_password'))
                            <div class="alert alert-danger">
                                {{ $errors->first('retype_password') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="inputBox form-group position-relative">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website">Update</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
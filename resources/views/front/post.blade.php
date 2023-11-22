@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $single_post_data->heading }}</h2>
                <div class="h-line bg-dark"></div>
            </div>
        </div>
    </div>
</div>


<script async src="https://static.addtoany.com/menu/page.js"></script>

<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-lg-8 col-md-12">
                <div class="featured-photo">
                    <img src="{{ asset('uploads/'.$single_post_data->photo) }}" alt="">
                </div>
                <div class="sub">
                    <div class="item">
                        <b><i class="fa fa-clock-o"></i></b>
                        {{ date('d M, Y', strtotime($single_post_data->updated_at)) }}
                    </div>
                    <div class="item">
                        <b><i class="fa fa-eye"></i></b>
                        {{ $single_post_data->total_view }}
                    </div>
                </div>
                <div class="main-text">
                    {!! $single_post_data->content !!}
                </div>
                <div class="share-content">
                    <h2>Share</h2>
                    {{-- <div class="addthis_inline_share_toolbox"></div> --}}
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_x"></a>
                            <a class="a2a_button_whatsapp"></a>
                            <a class="a2a_dd"></a>
                        </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
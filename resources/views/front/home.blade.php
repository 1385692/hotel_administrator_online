@extends('front.layout.app')

@section('main_content')

<div class="slider">
    <div class="slide-carousel owl-carousel">
        @foreach ($slide_all as $item)
        <div class="item" style="background-image: linear-gradient( to right, rgba(29, 35, 48, 0.9), rgba(40, 40, 63, 0.1) ), url({{ asset('uploads/'.$item->photo) }});">
            {{-- <div class="bg"></div> --}}
            <div class="text">
                <h2>{{ $item->heading }}</h2>
                <p>
                    {!! $item->text !!}
                </p>
                @if ($item->button_text != '')
                <div class="button">
                    <a href="{{ $item->button_url }}">{{ $item->button_text }}</a>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
     
 
<div class="search-section">
    <div class="container">
        <form action="{{ route('cart_submit') }}" method="post">
            @csrf
            <div class="inner">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <select name="room_id" class="form-select">
                                <option value="">Seleccionar Habitación</option>
                                @foreach ($room_all as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" name="checkin_checkout" class="form-control daterange1" placeholder="Checkin & Checkout">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="number" name="adult" class="form-control" min="0" max="10" placeholder="Adultos">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input type="number" name="children" class="form-control" min="0" max="10" placeholder="Niños">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



{{-- Features --}}
@if ($global_setting_data->home_feature_status == 'Show')
<div class="home-feature">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-header">Nuestros Servicios</h2>
            </div>
            
            @foreach ($feature_all as $item)
            <div class="col-md-4">
                <div class="inner">
                    <div class="icon"><i class="{{ $item->icon }}"></i></div>
                    <div class="text">
                        <h2>{{ $item->heading }}</h2>
                        <p>
                            {!! $item->text !!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endif



{{-- Rooms --}}
@if ($global_setting_data->home_room_status == 'Show')
<div class="home-rooms">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-header">Nuestras Habitaciones</h2>
            </div>
        </div>
        <div class="row">

            @foreach ($room_all as $item)
            @if ($loop->iteration>$global_setting_data->home_room_total) 
            @break
            @endif
            <div class="col-md-3">
                <div class="inner">
                    <div class="photo">
                        <img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="">
                    </div>
                    <div class="text">
                        <h2><a class="name" href="{{ route('room_detail', $item->id) }}">{{ $item->name }}</a></h2>
                        <div class="price">
                            S/{{ $item->price }} por noche
                        </div>
                        <div class="button">
                            <a href="{{ route('room_detail', $item->id) }}" class="btn btn-primary">Más Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        <div class="row">
            <div class="col-md-12">
                <div class="big-button d-flex justify-content-end">
                    <a href="{{ route('room') }}" class="btn btn-primary">Ver Todo <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif




<!-- Testimonials -->
@if ($global_setting_data->home_testimonial_status == 'Show')
<div class="testimonial" style="background-image: url(uploads/font.jpg)">
    <div class="bg"></div>
    <div class="container">
        <h2 class="main-header text-center fw-bold h-font">Nuestros Clientes Satisfechos</h2>

        <div class="container mt-5">
            <!-- Swiper -->
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper">

            @foreach ($testimonial_all as $item)
            <div class="swiper-slide bg-white">
                <div class="photo d-flex align-items-center">
                    <img src="{{ asset('uploads/'.$item->photo) }}" width="30px">
                </div>
                <div class="information">
                    <h4>{{ $item->name }}</h4>
                    <p>{{ $item->designation }}</p>
                </div>
                <p>
                    {!! $item->comment !!} 
                </p>
            </div>
            @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
        </div>
    </div>
</div>
@endif


{{-- Si desea solo ver los comentarios (finitamente) --}}
<!-- Swiper JS -->
   {{-- <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script> --}}

<!-- Initialize Swiper -->
   <script>
     var swiper = new Swiper(".swiper-container", {
       spaceBetween: 30,
       effect: "fade",
       loop: true,
       autoplay: {
           delay: 3500,
           disableOnInteraction: false,
       }
     });

     var swiper = new Swiper(".swiper-testimonials", {
       effect: "coverflow",
       grabCursor: true,
       centeredSlides: true,
       slidesPerView: "auto",
       slidesPerView: "3",
       loop: true,
       coverflowEffect: {
         rotate: 50,
         stretch: 0,
         depth: 100,
         modifier: 1,
         slideShadows: false,
       },
       pagination: {
         el: ".swiper-pagination",
       },
       breakpoints: {
           320: {
               slidesPerView: 1,
           },
           640: {
               slidesPerView: 1,
           },
           768: {
               slidesPerView: 2,
           },
           1024: {
               slidesPerView: 3,
           },
       }
     });
   </script>




@if ($global_setting_data->home_latest_post_status == 'Show')
<div class="blog-item">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-header">Últimos Posts</h2>
            </div>
        </div>
        <div class="row">

            @foreach ($post_all as $item)
            @if ($loop->iteration>$global_setting_data->home_latest_post_total) 
            @break
            @endif
            <div class="col-md-4">
                <div class="inner">
                    <div class="photo">
                        <img src="{{ asset('uploads/'.$item->photo) }}" alt="">
                    </div>
                    <div class="text">
                        <h2><a class="post-title" href="{{ route('post', $item->id) }}">{{ $item->heading }}</a></h2>
                        <div class="short-des">
                            <p>
                                {!! $item->short_content !!} 
                            </p>
                        </div>
                        <div class="button">
                            <a href="{{ route('post', $item->id) }}" class="btn btn-primary">Leer Más</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            </div>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: '{{ $error }}',
                });
        </script>
    @endforeach
@endif
@endsection
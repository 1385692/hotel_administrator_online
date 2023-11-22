@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->cart_heading }}</h2>
                <div class="h-line bg-dark"></div>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="row cart">
            <div class="col-md-12">



                @if(session()->has('cart_room_id'))
                
                <div class="table-responsive">
                    <table class="table table-bordered table-cart">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Serie</th>
                                <th>Foto</th>
                                <th>Información de habitación</th>
                                <th>Precio/Noche</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Personas</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @php
                            $arr_cart_room_id = array();
                            $i = 0;
                            foreach(session()->get('cart_room_id') as $value){
                                $arr_cart_room_id[$i] = $value;
                                $i++;
                            }

                            $arr_cart_checkin_date = array();
                            $i = 0;
                            foreach(session()->get('cart_checkin_date') as $value){
                                $arr_cart_checkin_date[$i] = $value;
                                $i++;
                            }

                            $arr_cart_checkout_date = array();
                            $i = 0;
                            foreach(session()->get('cart_checkout_date') as $value){
                                $arr_cart_checkout_date[$i] = $value;
                                $i++;
                            }

                            $arr_cart_adult = array();
                            $i = 0;
                            foreach(session()->get('cart_adult') as $value){
                                $arr_cart_adult[$i] = $value;
                                $i++;
                            }
                            
                            $arr_cart_children = array();
                            $i = 0;
                            foreach(session()->get('cart_children') as $value)
                            {
                                $arr_cart_children[$i] = $value;
                                $i++;
                            }

                            //DEFINIMOS UNA VARIABLE QUE NOS SERVIRÁ PRA CALCULAR EL MONTO TOTAL 
                            $total_price = 0;
                            for ($i=0; $i < count($arr_cart_room_id); $i++) 
                            { 
                                $room_data = DB::table('rooms')->where('id', $arr_cart_room_id[$i])->first()

                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('cart_delete', $arr_cart_room_id[$i]) }}" class="cart-delete-link" onclick="return confirm('Are you sure?');"><i class="fa fa-times"></i></a>
                                    </td>
                                    <td>{{ $i+1 }}</td>
                                    <td><img src="{{ asset('uploads/'.$room_data->featured_photo) }}"></td>
                                    <td>
                                        <a href="{{ route('room_detail', $room_data->id) }}" class="room-name">{{ $room_data->name }}</a>
                                    </td>
                                    <td>S/{{ $room_data->price }}</td>
                                    <td>{{ $arr_cart_checkin_date[$i] }}</td>
                                    <td>{{ $arr_cart_checkout_date[$i] }}</td>
                                    <td>
                                        Adult: {{ $arr_cart_adult[$i] }}<br>
                                        Children: {{ $arr_cart_children[$i] }}
                                    </td>
                                    <td>
                                    @php
                                        $d1 = explode('/', $arr_cart_checkin_date[$i]);
                                        $d2 = explode('/', $arr_cart_checkout_date[$i]);
                                        $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                                        $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                                        $t1 = strtotime($d1_new);
                                        $t2 = strtotime($d2_new);
                                        $diff = ($t2 - $t1)/60/60/24;
                                        echo 'S/'.$diff * $room_data->price;
                                    @endphp    
                                    </td>
                                    
                                </tr>
                                @php
                                $total_price = $total_price + ($diff * $room_data->price);
                            }
                            @endphp

                            {{-- Calcular IGV --}}
                            {{-- @php
                                $igv = $total_price * 0.18; // Calculamos el IGV como el 18% del subtotal
                            @endphp
                            <tr>
                                <td colspan="8" class="tar">Total IGV:</td>
                                <td>${{ $igv }}</td>
                            </tr>
                            <tr>
                                <td colspan="8" class="tar">Total:</td>
                                <td>${{ $total_price + $igv }}</td>
                            </tr> --}}

                            <tr>
                                <td colspan="8" class="tar">Total:</td>
                                <td>S/{{ $total_price }}</td>
                            </tr>
                            
                            
                        </tbody>
                    </table>
                </div>                       

                <div class="checkout mb_20">
                    <a href="{{ route('checkout') }}" class="btn btn-primary bg-website">Checkout</a>
                </div>

                @else

                <div class="text-danger mb_30">
                    Cart is empty!
                </div>

                @endif



            </div>
        </div>
    </div>
</div>
@endsection
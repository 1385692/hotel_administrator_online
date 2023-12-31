@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->checkout_heading }}</h2>
                <div class="h-line bg-dark"></div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 checkout-left">

                <form action="{{ route('payment') }}" method="post" class="frm_checkout">
                    @csrf
                    <div class="billing-info">
                        <h4 class="mb_30">Información de usuario</h4>
                        @php
                            if (session()->has('billing_name')) {
                                $billing_name = session()->get('billing_name');
                            } else {
                                $billing_name = Auth::guard('customer')->user()->name;
                            }
                            
                            if (session()->has('billing_email')) {
                                $billing_email = session()->get('billing_email');
                            } else {
                                $billing_email = Auth::guard('customer')->user()->email;
                            }

                            if (session()->has('billing_phone')) {
                                $billing_phone = session()->get('billing_phone');
                            } else {
                                $billing_phone = Auth::guard('customer')->user()->phone;
                            }

                            if (session()->has('billing_country')) {
                                $billing_country = session()->get('billing_country');
                            } else {
                                $billing_country = Auth::guard('customer')->user()->country;
                            }

                            if (session()->has('billing_address')) {
                                $billing_address = session()->get('billing_address');
                            } else {
                                $billing_address = Auth::guard('customer')->user()->address;
                            }

                            if (session()->has('billing_state')) {
                                $billing_state = session()->get('billing_state');
                            } else {
                                $billing_state = Auth::guard('customer')->user()->state;
                            }

                            if (session()->has('billing_city')) {
                                $billing_city = session()->get('billing_city');
                            } else {
                                $billing_city = Auth::guard('customer')->user()->city;
                            }

                            if (session()->has('billing_zip')) {
                                $billing_zip = session()->get('billing_zip');
                            } else {
                                $billing_zip = Auth::guard('customer')->user()->zip;
                            }
                        @endphp
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Nombre: *</label>
                                <input type="text" class="form-control mb_15" name="billing_name" value="{{ $billing_name }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Correo Electrónico: *</label>
                                <input type="text" class="form-control mb_15" name="billing_email" value="{{ $billing_email }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Número de teléfono: *</label>
                                <input type="text" class="form-control mb_15" name="billing_phone" value="{{ $billing_phone }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="">País: *</label>
                                <input type="text" class="form-control mb_15" name="billing_country" value="{{ $billing_country }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Dirección: *</label>
                                <input type="text" class="form-control mb_15" name="billing_address" value="{{ $billing_address }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Estado/Distrito: *</label>
                                <input type="text" class="form-control mb_15" name="billing_state" value="{{ $billing_state }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Ciudad: *</label>
                                <input type="text" class="form-control mb_15" name="billing_city" value="{{ $billing_city }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Código Postal: *</label>
                                <input type="text" class="form-control mb_15" name="billing_zip" value="{{ $billing_zip }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary bg-website mb_30">Continuar con el pago</button>
                </form>
            </div>
            <div class="col-lg-4 col-md-6 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Detalles de reserva</h4>
                    <div class="table-responsive">
                        <table class="table">
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
                                            {{ $room_data->name }}
                                            <br>
                                            ({{ $arr_cart_checkin_date[$i] }} - {{ $arr_cart_checkout_date[$i] }})
                                            <br>
                                            Adultos: {{ $arr_cart_adult[$i] }}, Niños: {{ $arr_cart_children[$i] }}
                                        </td>
                                        <td class="p_price">
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
                                    <td><b>Total IGV:</b></td>
                                    <td class="p_price"><b>${{ $igv }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total:</b></td>
                                    <td class="p_price"><b>${{ $total_price + $igv }}</b></td>
                                </tr> --}}

                                <tr>
                                    <td><b>Total:</b></td>
                                    <td class="p_price"><b>S/{{ $total_price }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
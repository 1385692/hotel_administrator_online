@extends('front.layout.app')

@section('main_content')

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>


<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->payment_heading }}</h2>
                <div class="h-line bg-dark"></div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Detalles de usuario</h4>
                    <div>
                        Nombre: {{ session()->get('billing_name') }}
                    </div>
                    <div>
                        Email: {{ session()->get('billing_email') }}
                    </div>
                    <div>
                        Teléfono: {{ session()->get('billing_phone') }}
                    </div>
                    <div>
                        País: {{ session()->get('billing_country') }}
                    </div>
                    <div>
                        Dirección: {{ session()->get('billing_address') }}
                    </div>
                    <div>
                        Distrito/Estado: {{ session()->get('billing_state') }}
                    </div>
                    <div>
                        Ciudad: {{ session()->get('billing_city') }}
                    </div>
                    <div>
                        Código Postal: {{ session()->get('billing_zip') }}
                    </div>
                </div>
            </div>
    </form>


            <div class="col-lg-4 col-md-4 checkout-right">
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
                                            Adult: {{ $arr_cart_adult[$i] }}, Children: {{ $arr_cart_children[$i] }}
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
                                    $total_price = $igv + $total_price;
                                @endphp
                                <tr>
                                    <td><b>Total IGV:</b></td>
                                    <td class="p_price"><b>${{ $igv }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total:</b></td>
                                    <td class="p_price"><b>${{ $total_price }}</b></td>
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

            <div class="col-lg-4 col-md-4 checkout-left mb_30">
                <h4>Realizar Pago</h4>
                <select name="payment_method" class="form-control select2" id="paymentMethodChange" autocomplete="off">
                    <option value="">Seleccionar método de pago</option>
                    <option value="PayPal">PayPal</option>
                    {{-- <option value="Stripe">Stripe</option> --}}
                </select>

                <div class="paypal mt_20">
                    <h4>Pay with PayPal</h4>
                    <form action="{{ route('paypal') }}" method="post">
                        @csrf
                        <input type="hidden" name="price" value="{{ $total_price }}">
                        <button class="paypal-button" type="submit">
                            <img src="{{ asset('uploads/paypal_blanco1.png') }}" alt="PayPal Logo" class="paypal-logo">
                        </button>
                    </form>
                </div>

                {{-- <div class="stripe mt_20">
                    <h4>Pay with Stripe</h4>
                    @php
                        $cents = $total_price*100;
                        $customer_email = Auth::guard('customer')->user()->email;
                        $stripe_publishable_key = '';
                    @endphp
                    <form action="{{ route('stripe', $total_price) }}" method="post">
                        @csrf
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ $stripe_publishable_key }}"
                            data-amount="{{ $cents }}"
                            data-name="{{ env('APP_NAME') }}"
                            data-description=""
                            data-image="{{ asset('stripe.png') }}"
                            data-currency="usd"
                            data-email="{{ $customer_email }}"
                        >
                        </script>
                    </form>
                </div> --}}

            </div>
        </div>
    </div>
</div>

@php
    $client = 'AS5hPf7uY9R44uiDeRDmhtKng-i3uUIrYouKjGXYgyrT7QM3QiOUQPWKbz7vLpnFJnd6vaZsBcqQWfaQ';
@endphp























{{-- <script>
	paypal.Button.render({
		env: 'sandbox',
		client: {
			sandbox: '{{ $client }}',
			production: '{{ $client }}'
		},
		locale: 'en_US',
		style: {
			size: 'medium',
			color: 'blue',
			shape: 'rect',
		},
		// Set up a payment
		payment: function (data, actions) {
			return actions.payment.create({
				redirect_urls:{
					return_url: '{{ url("payment/paypal/$total_price") }}'
				},
				transactions: [{
					amount: {
						total: '{{ $total_price }}',
						currency: 'USD'
					}
				}]
			});
		},
		// Execute the payment
		onAuthorize: function (data, actions) {
			return actions.redirect();
		}
	}, '#paypal-button');
</script> --}}
@endsection
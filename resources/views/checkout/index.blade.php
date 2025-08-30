<x-app-layout>

    <div class="-mb-16 text-gray-700" x-data="{
        pago: 1
        }">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                     
                    <h1 class="text-2xl font-semibold mb-2">
                        Pago
                    </h1>

                    <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                        <ul class="divide-y divide-gray-400">
                            <li>
                                <label class="p-4 flex items-center">

                                    <input type="radio" x-model="pago" value="1">

                                    <span class="ml-2">
                                        Tarjeta de Debito / Credito
                                    </span>
                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png" alt="">
                                </label>

                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400"
                                x-show="pago == 1">
                                    <i class="fa-regular fa-credit-card text-9xl"></i>
                                    <p class="mt-2">
                                        Luego de hacer click en 'Pagar ahora', se abrira el checkout de PayPal, donde podras pagar con tu tarjeta de credito o debito.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <label class="p-4 flex items-center">

                                    <input type="radio" x-model="pago" value="2">

                                    <span class="ml-2">
                                        Deposito Bancario o Pago Movil
                                    </span>

                                </label>
                                <div class="p-4 bg-gray-100 flex justify-center border-t border-gray-400"
                                x-cloak
                                x-show="pago == 2">
                                    <div>
                                        <p>1. Pago Por Deposito o Transferencia Bancaria</p>
                                        <p>- BCP soles: 197-55484-5854</p>
                                        <p>- CCI: 002 - 197-55484-5854</p>
                                        <p>- Razon social: Ecommerce</p>
                                        <p>- RIF: 487546478</p>
                                        <p>2. Pago Binance</p>
                                        <p>- Binance I.D.</p>
                                        <p>Enviar el comprobante</p>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-span-1 bg-gray-400">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                  
                    <ul class="space-y-4 mb-4">
                        @foreach ($content as $item)
                            
                        <li class="flex item-center space-x-4">

                            <div class="flex-shrink-0 relative">
                                <img class="h-16 aspect-square" src="{{ $item->options->image }}" alt="">

                                <div class="flex justify-center items-center h-6 w-6 bg-gray-900 bg-opacity-70 rounded-full absolute -right-2 -top-2">
                                    <span class="text-white font-semibold text-sm">
                                        {{ $item->qty }}

                                    </span>

                                </div>
                            </div>

                            <div class="flex-1">
                                <p>
                                    {{ $item->name }}
                                </p>
                            </div>

                            <div class="flex-shrink-0">
                                <p>
                                    ${{ $item->price }}
                                </p>
                            </div>
                        </li>

                        @endforeach
                    </ul>

                    <div class="flex justify-between ">
                        <p>
                            Subtotal
                        </p>

                        <p>
                            ${{ $subtotal }}
                        </p>

                    </div>

                    <hr class="my-3">

                    <div class="flex justify-between mb-4">
                        <p class="text-lg font-semibold">
                            Total
                        </p>
                        <p>
                            ${{ Cart::instance('shopping')->subtotal() }}
                        </p>
                    </div>

                    <form action="{{ route('checkout.paid') }}" method="POST">
                        @csrf
                        <!-- Otros campos si los necesitas -->
                        <button class="btn btn-blue w-full" type="submit">Finalizar compra</button>
                    </form>

                </div>
            </div>

        </div>

    </div>

    {{-- @push('js')

    <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}" >
    </script>
        <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function() {

            let purchasenumber = Math.floor(Math.random() * 1000000000);
            let amount = {{ Cart::instance('shopping')->subtotal() }};

            VisanetCheckout.configure({
            sessiontoken:'{{ $session_token }}',
            channel:'web',
            merchantid:"{{ config('services.niubiz.merchant_id') }}",
            purchasenumber: purchasenumber,
            amount: amount,
            expirationminutes:'20',
            timeouturl:'about:blank',
            merchantlogo:'img/comercio.png',
            formbuttoncolor:'#000000',
            action:"{{ route('checkout.paid') }}?amount=" + amount + "&purchasenumber=" + purchasenumber,
            complete: function(params) {
            alert(JSON.stringify(params));
                }
            });

        }); 

        </script>
        
    @endpush --}}

</x-app-layout>
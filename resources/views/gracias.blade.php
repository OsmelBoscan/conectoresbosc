<!-- filepath: resources/views/gracias.blade.php -->
<x-app-layout>

    <div class=" bg-white rounded-lg shadow ml-20 mr-20">
    <div class="max-w-3xl mx-auto pt-12 mt-2">
        <h1 class="text-2xl font-bold mb-4">¡Gracias por tu compra!</h1>
        <p class="mb-4">Tu pedido ha sido registrado. Se ha enviado una copia con el resumen del pedido a su correo. Por favor, realiza el pago usando uno de los siguientes métodos y envía el comprobante al <b>Whatsapp 04127626855</b></p>
        
        <ul class="mb-4">
            <li><b>Transferencia bancaria:</b> Banco Banesco, Cuenta: 123456789</li>
            <li><b>Pago Movil:</b> 987654321</li>
            <li><b>Binance:</b> 987654321, osmelboscan@gmail.com</li>
            <li><b>Zelle:</b> zelle@gmail.com</li>
            <!-- Agrega más métodos si lo deseas -->
        </ul>

        <h2 class="text-xl font-semibold mb-4">Resumen de tu pedido</h2>
        <ul class="mb-4">
           @foreach($order->content as $item)
                <li>{{ $item['name'] }} x {{ $item['qty'] }} - S/ {{ $item['price'] * $item['qty'] }}</li>
            @endforeach
        </ul>
        <p class="mb-4"><b class="mb-4">Total:</b> S/ {{ $order->total }}</p>
    </div>
</div>
</x-app-layout>
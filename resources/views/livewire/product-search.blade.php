<div class="relative">
    <input type="text"
           wire:model="query"
           placeholder="Buscar productos..."
           class="w-full border rounded px-3 py-2"
           autocomplete="on">

@if($query && count($suggestions))
    <ul class="absolute bg-white border w-full mt-1 rounded shadow z-10">
        @foreach($suggestions as $product)
            <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer">
                <a href="{{ route('products.show', $product) }}">
                    {{ $product->name }}
                </a>
            </li>
        @endforeach
    </ul>
@elseif($query)
    <ul class="absolute bg-white border w-full mt-1 rounded shadow z-10">
        <li class="px-3 py-2 text-gray-500">No hay resultados</li>
    </ul>
@endif
</div>
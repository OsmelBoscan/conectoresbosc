<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $query = '';
    public $suggestions = [];

public function updatedQuery()
{
    if (strlen($this->query) < 2) {
        $this->suggestions = [];
        return;
    }
    $this->suggestions = Product::where('name', 'like', '%' . $this->query . '%')
        ->where('stock', '>', 0)
        ->orderBy('name')
        ->limit(5)
        ->get();
}



    public function render()
    {
        return view('livewire.product-search');
    }
}
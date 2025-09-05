<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class CategorySection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        // Mengambil hanya 4 kategori teratas dari database
        $categories = Category::take(4)->get();
        return view('components.category-section', compact('categories'));
    }
}

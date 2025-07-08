<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ProductFilter extends Component
{
  
   use WithPagination;
   use WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public $categories;
    public $selectedCategories = [];
    public $minPrice;
    public $maxPrice;

    public function mount()
    {
        $this->categories = Category::all();
        $this->minPrice = Article::min('price') ?? 0;
        $this->maxPrice = Article::max('price') ?? 1000;
    }

    public function updating($name, $value)
    {
        // Quando cambia un filtro, resetta la pagina
        $this->resetPage();
    }

    public function render()
    {
        $query = Article::query()->where('is_accepted', true);

        

        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        if (!is_null($this->minPrice)) {
            $query->where('price', '>=', $this->minPrice);
        }

        if (!is_null($this->maxPrice)) {
            $query->where('price', '<=', $this->maxPrice);
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('livewire.product-filter', compact('articles'));
    }
}

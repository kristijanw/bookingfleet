<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Excursion;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class CategoryPage extends Component
{
    public $categories = [];

    #[Url]
    public $catId;

    public $location;

    public $rangePrice = 500;

    public function mount()
    {
        $excursions = Excursion::all();
        $grouped = $excursions->groupBy('departure')->toArray();
        $this->categories = array_keys($grouped);
    }

    public function resetFilters()
    {
        $this->reset(['location', 'rangePrice']);
    }

    public function increasePrice()
    {
        $this->rangePrice = min(1000, $this->rangePrice + 5);
    }

    public function decreasePrice()
    {
        $this->rangePrice = max(0, $this->rangePrice - 5);
    }

    public function setLocation($location)
    {
        if ($this->location === $location) {
            $this->location = null;
        } else {
            $this->location = $location;
        }
    }

    protected function applyCat($query)
    {
        if (!empty($this->catId)) {
            $category = Category::where('id', $this->catId)->first();

            if (strtolower($category->title) != 'show all' && $this->catId) {
                return $query->whereHas('category', function ($q) {
                    $q->where('id', $this->catId);
                });
            }
        }

        return $query;
    }

    protected function applyLocation($query)
    {
        if ($this->location) {
            $query->where('departure', $this->location);
        }

        return $query;
    }

    protected function applyPriceFilter($query)
    {
        return $query->where('price', '<=', $this->rangePrice);
    }

    #[Title('Booking Fleet')]
    public function render()
    {
        $query = Excursion::query();

        $query = $this->applyCat($query);
        $query = $this->applyPriceFilter($query);
        $query = $this->applyLocation($query);

        $excursions = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.category-page', [
            'excursions' => $excursions,
            'categories' => $this->categories
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\Excursion;
use Livewire\Attributes\Url;
use Livewire\Component;

class CategoryPage extends Component
{
    #[Url]
    public $catId;

    public $rangePrice = 500;

    protected function applyCat($query)
    {
        if ($this->catId) {
            return $query->whereHas('category', function ($q) {
                $q->where('id', $this->catId);
            });
        }

        return $query;
    }

    protected function applyPriceFilter($query)
    {
        return $query->where('price', '<=', $this->rangePrice);
    }

    public function render()
    {
        $query = Excursion::query();

        $query = $this->applyCat($query);
        $query = $this->applyPriceFilter($query);

        $excursions = $query->paginate(10);

        return view('livewire.category-page', [
            'excursions' => $excursions,
        ])->layout('components.layouts.app', [
            'title' => 'Booking Fleet',
            'headerImg' => '/img/bgheader.jpg'
        ]);
    }
}

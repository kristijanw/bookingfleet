<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Home\Index::class)->name('home');
Route::get('/excursion/{id}', App\Livewire\Excursion\Single::class)->name('excursion');

Route::get('/category-page', App\Livewire\CategoryPage::class)->name('categoryPage');

Route::get('/cart', App\Livewire\CartComponent::class)->name('cart');

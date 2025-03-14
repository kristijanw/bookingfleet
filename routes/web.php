<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Home\Index::class)->name('home');
Route::get('/excursion/{id}', App\Livewire\Excursion\Single::class)->name('excursion');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

// Route::post('/optimize-image', function (Request $request) {
//     // Validacija podataka
//     $request->validate([
//         'image' => 'required|string',
//     ]);

//     // Decode Base64 slike
//     $imageData = $request->input('image');
//     $imageData = str_replace('data:image/png;base64,', '', $imageData);
//     $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
//     $imageData = str_replace(' ', '+', $imageData);
//     $imageDecoded = base64_decode($imageData);

//     // Kreiranje slike s Intervention Image
//     $image = Image::make($imageDecoded);

//     // **OPTIMIZACIJA**: Promjena veličine i kompresija kvalitete
//     $image->resize(800, null, function ($constraint) {
//         $constraint->aspectRatio();
//     })->encode('jpg', 75); // JPEG format s 75% kvalitete (manja veličina)

//     // **Spremanje u storage**
//     $fileName = '/optimized/' . time() . '.jpg';
//     Storage::disk('public')->put($fileName, (string) $image);

//     return response()->json([
//         'message' => 'Image uploaded successfully',
//         'image_url' => asset('storage/' . $fileName)
//     ]);
// });

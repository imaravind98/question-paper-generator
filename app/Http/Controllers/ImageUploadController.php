<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    /**
     * Show the form for uploading an image.
     *
     * @return \Illuminate\View\View
     */
    public function showUploadForm()
    {
        return view('upload');
    }

    /**
     * Handle the image upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the uploaded file
        if ($request->file('image')) {
            $imagePath = Storage::disk('public')->put('images', $request->file('image'));
            return $imagePath;
        }

        return response('image upload failed', 500);
    }
}
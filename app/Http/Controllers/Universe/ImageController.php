<?php

namespace App\Http\Controllers\Universe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => Storage::url($path)
                ]
            ]);
        }

        return response()->json(['success' => 0, 'error' => 'No file uploaded.']);
    }

    public function fetchUrl(Request $request)
    {
        $url = $request->input('url');
        $contents = file_get_contents($url);
        $name = basename($url);
        $path = 'images/' . $name;

        Storage::disk('public')->put($path, $contents);

        return response()->json([
            'success' => 1,
            'file' => [
                'url' => Storage::url($path)
            ]
        ]);
    }
}

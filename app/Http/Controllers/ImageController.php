<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
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

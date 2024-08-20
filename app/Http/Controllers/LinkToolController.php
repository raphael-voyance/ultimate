<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LinkToolController extends Controller
{
    public function fetchUrlData(Request $request)
    {
        $url = $request->query('url');

        if (!$url) {
            return response()->json([
                'success' => false,
                'error' => 'No URL provided'
            ], 400);
        }

        try {
            // $url = $request->query('url');
            dd(Http::get($url));

            // Effectuer une requête HTTP GET vers l'URL spécifiée
            $response = Http::withoutVerifying($url);

            // Vérifiez le code de statut HTTP
            if ($response->serverError()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to fetch the URL. Status Code: ' . $response->status()
                ], 500);
            }

            // Extraire les métadonnées de la réponse HTML
            $html = $response->body();

            // Analyse du titre
            preg_match('/<title>(.*?)<\/title>/', $html, $titleMatches);
            $title = $titleMatches[1] ?? '';

            // Analyse de la description
            preg_match('/<meta name="description" content="(.*?)"/', $html, $descriptionMatches);
            $description = $descriptionMatches[1] ?? '';

            // Analyse de l'image (open graph image)
            preg_match('/<meta property="og:image" content="(.*?)"/', $html, $imageMatches);
            $imageUrl = $imageMatches[1] ?? '';

            return response()->json([
                'success' => true,
                'meta' => [
                    'title' => $title,
                    'description' => $description,
                    'image' => [
                        'url' => $imageUrl
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch the URL, error : ' . $e 
            ], 500);
        }
    }
}


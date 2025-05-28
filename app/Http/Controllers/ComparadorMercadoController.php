<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ComparadorMercadoController extends Controller
{
    public function comparar(Request $request)
    {
        $producto = $request->input('producto');
        $apiKey = 'AIzaSyDg7YtEE40ZrFUaOUKabuqPxTFzWwfxogk';
        $cx = '6254d5794c2634cf1';

        $response = Http::get('https://www.googleapis.com/customsearch/v1', [
            'key' => $apiKey,
            'cx' => $cx,
            'q' => $producto,
        ]);

        $resultados = $response->json()['items'] ?? [];

        return view('comparar.resultados', compact('resultados', 'producto'));
    }
}

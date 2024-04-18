<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoticiasController extends Controller
{
    private $NEWS_API_KEY;
    private $RANDOMUSER_API_URL;
    private $NEWS_API_URL;

    public function __construct()
    {
        $this->NEWS_API_KEY = env('NEWS_API_KEY');
        $this->RANDOMUSER_API_URL = env('RANDOMUSER_API_URL');
        $this->NEWS_API_URL = env('NEWS_API_URL');
    }
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        
        // Obtener noticias de NewsAPI
        $newsResponse = Http::get($this->NEWS_API_URL, [
            'country' => 'us',  // puedes cambiar el país según tus preferencias
            'apiKey' => $this->NEWS_API_KEY,
            'pageSize' => 10,
            'page' => $page
        ]);
        $newsData = $newsResponse->json();
        // Obtener autores de Random User API
        $authors = [];
        for ($i = 0; $i < 10; $i++) {
            $userResponse = Http::get($this->RANDOMUSER_API_URL);
            $userData = $userResponse->json();
            $author = [
                'name' => $userData['results'][0]['name']['first'],
                'last_name' => $userData['results'][0]['name']['last'],
                'picture' => $userData['results'][0]['picture']['medium']
            ];
            $authors[] = $author;
        }
        
        $totalPages = ceil($newsData['totalResults'] / 10);
        
        return view('welcome', [
            'news' => $newsData['articles'],
            'authors' => $authors,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;


class NewsController extends Controller
{

    function index(Request $request){


        if($request->search == null){
            $collection = HTTP::get('https://newsapi.org/v2/top-headlines?category=technology&from=2022-12-12&sortBy=popularity&apiKey=076f20cee97a4b9f8dc189a388e43b6a&pageSize=100&language=en');

            $articlesRaw = $collection['articles'];

           $articles = $this->paginate($articlesRaw, 6);

            return view('dashboard.news.index', compact('articles'));
        }else{

            $search = $request->search;

            $collection = HTTP::get('https://newsapi.org/v2/everything?q='. $search . '&from=2022-12-12&sortBy=popularity&apiKey=076f20cee97a4b9f8dc189a388e43b6a&pageSize=100&language=en');

            if($collection['totalResults'] == 0){
                return view('dashboard.news.notFound');
            }

            else {
                $articlesRaw = $collection['articles'];

                $articles = $this->paginate($articlesRaw, 6);

                return view('dashboard.news.index', ['articles' => $articles]);
            }
        }
    }

    public function paginate($items, $perPage = 4, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total ,$perPage);
    }
}

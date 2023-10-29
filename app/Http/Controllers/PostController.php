<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StorepostRequest;
use App\Services\PostService\StorePostService;
use App\Models\Post;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquant\Builder;


class PostController extends Controller
{
     
      
    public function store(StorepostRequest $request){
  
        return (new StorePostService())->store($request);
 

    }
      
    public function index(){
       $posts =   Post::all();
       return response()->json([
         "posts" => $posts
       ]);
    }


    public function approved(){

    $posts = QueryBuilder::for(Post::class)
    ->allowedFilters([
      'price',
        AllowedFilter::callback('item', function (Builder $query, $value) {
            // $query->whereHas('posts');
            $query->where('price','like',"%{$value}%");
        }),
    ]);

        return response()->json([
          "posts" => $posts
        ]);

    }
     
}

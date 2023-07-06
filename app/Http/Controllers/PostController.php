<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StorepostRequest;
use App\Services\PostService\StorePostService;
use App\Model\Post;



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

        $posts =   Post::where('status' , 'approved')->get();
        return response()->json([
          "posts" => $posts
        ]);

    }
     
}

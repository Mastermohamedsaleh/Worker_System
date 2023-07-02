<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StorepostRequest;
use App\Services\PostService\StorePostService;

class PostController extends Controller
{
     
      
    public function store(StorepostRequest $request){
  
        return (new StorePostService())->store($request);
 

    }
      
     
}

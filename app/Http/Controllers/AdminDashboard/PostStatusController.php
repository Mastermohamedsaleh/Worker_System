<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostStatusRequest;


class PostStatusController extends Controller
{
      
    public function changStatusPost(PostStatusRequest $request){
        
          $post = Post::find($request->post_id)->update([
          'status'=>$request->status,
          'rejected_reason'=>$request->rejected_reason
          ]);

          return response()->json([
           'posts'=>$post
          ]);
    
    }      
     
}

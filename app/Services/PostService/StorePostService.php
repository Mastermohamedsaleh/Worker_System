<?php

namespace App\Services\PostService;


use App\Models\Post;
use Validator;



class StorePostService {


     
   protected  $model;
    
   function __construct()
   {
      $this->model = new Post;
   }

   function validation($request)
   {
    $validator = Validator::make($request->all() , $request->rules());

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    return $validator;

   }

   function storePost($data)
   {
      $data = $data->except('photo');
      $data['worker_id'] = auth()->guard('worker')->id();
      $post = Post::create($data);
      return $post->id;
   }



   function storePostPhotos($request , $postid){

    foreach($request->file('photo') as $pho){
        $postphotos = new PostPhoto();
        $postphotos->post_id = $postid; 
        $postphotos->photo = $pho->store('posts');
        $postphotos->save();
    }



   }




}
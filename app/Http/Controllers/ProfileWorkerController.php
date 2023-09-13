<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\WorkerReview;
use App\Models\Worker;

class ProfileWorkerController extends Controller
{
    public function workerprofile()
    {

        $workerId = auth()->guard('worker')->id();
        $worker = Worker::with('posts')->find($workerId);
        $reviews = WorkerReview::whereIn('post_id' , $worker->pluck('id'))->get();

        return response()->json([

             'data' => $worker,
             'worker'=>auth()->guard('worker')->user(),
             'reviews'=>$reviews->sum('rate')/$reviews->count()
          
      
        ]);

        // return response()->json(auth()->guard('worker')->user());
    }
}

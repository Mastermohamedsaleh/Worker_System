<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests\Client\ClientOrderRequest;

use App\Repository\Orders\OrderRepositoryinterface;

use App\Models\ClientOrder;

class ClientServicesController extends Controller
{
         
    protected $Order;

    public function __construct(OrderRepositoryinterface $Order){
       $this->Order = $Order;  
    }
    
    public function addorder(ClientOrderRequest $request)
    { 
        return $this->Order->store($request);
    }

    public function showorder()
    {
        $orders = ClientOrder::with('post','client')->whereStatus('pending')->whereHas('post', function ($query){
           $query->where('worker_id',auth()->guard('worker')->id());
        })->get();

        return response()->json([
            'orders'=>$orders
        ]);
    }

}

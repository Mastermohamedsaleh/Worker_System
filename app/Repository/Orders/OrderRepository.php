<?php
namespace App\Repository\Orders;
 
use App\Models\ClientOrder;

class OrderRepository implements OrderRepositoryinterface{


    public function store($request){


        if(ClientOrder::where('client_id' , auth()->guard('client')->id())->where('post_id',$request->post_id)->exists()){
         
            return response()->json([
                'message'=> 'This Order Already found' 
            ],406);
            
        }
    
        $data = $request->all();
        $data['client_id'] = auth()->guard('client')->id();
        $order = ClientOrder::create($data);
       return response()->json([
          'message'=> 'success' 
        ]); 
    


    }

  


}
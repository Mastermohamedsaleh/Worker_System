<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Client;
use App\Models\Worker_cashe;
use Stripe;
use Stripe\Checkout\Session;


class PaymentController extends Controller
{

    public function handlePayment($id , Request $request) 
    {

  try{
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $post = Post::where( 'id',$id)->get();
    $lineItems = [];
    $totalPrice = 0;
    foreach ($post as $p) {
        $totalPrice += $p->price;
        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
            
                'unit_amount' => $p->price * 100,
            ],
        ];
// table workercashes
        $workercash = Worker_cashe::create([
            'post_id'=> $p->id, 
            'client_id'=> auth()->guard('client')->id(),
            'total'=>$p->price
        ]);
// end table workercashes

    }


    $session =  Stripe\Checkout\Session::create([
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => route('checkout.success', [], true) ,
        'cancel_url' => route('checkout.cancel', [], true),
    ]);
    return redirect($session->url);
  }catch(\Exception $e){
     return "Please check Enternet";
  }

//   'product_data' => [
//     'name' => "mohamed",
// ],
    }


    public function success(){
        return "payment Success";
    }
    public function cancel(){
        return "payment cancel";
    }

}

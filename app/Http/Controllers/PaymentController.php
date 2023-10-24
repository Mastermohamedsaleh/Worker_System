<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Models\Post;
// use App\Models\Client;
// use App\Models\Worker_cashe;
// use Stripe;
// use Stripe\Checkout\Session;


use App\Payment\PaymentInterface;

class PaymentController extends Controller
{

protected $payment;

public function __construct(PaymentInterface  $payment){

   $this->payment = $payment;

} 
public function index( $id ,Request $request){
       
    return $this->payment->index( $id ,$request); 

  }


}

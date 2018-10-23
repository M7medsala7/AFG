<?php

namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Carbon\Carbon;
use Session;
use URL;
use DB;
use App\PackagesUser;
use App\Packages;
use App\packagecount;
use App\packageattribute;
class PaymentController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
      
    }
    public function CheckCountattribute($id,$attribute)
    {
       
    }
    public function Checkpaymentauth($id,$type)
    {
    try
        {
            if(\Auth::user()==null)
                {
                    
                    Session::put('payment',1);
                    $View="/candidate/".$id;
                    Session::put('Profile',$View);
                    return false;
                }
                else
                {
                 
    //Case Exsist
    $Exsits=DB::table('packagecount')
    ->where('attribute_id',$type)
    ->where('candidate_id',$id)->first();
  
    if( $Exsits != null || $Exsits !=[] )
    {
        if($type==1 || $type==2)
        return 1;
        else
        return 3;
    }
    else
    {
  
    $DueDate=Carbon::now()->toDateString();
    //check user if has Valid Date
    $Packagevalid=PackagesUser::where('users_id',\Auth::user()->id)
                    ->where('EndDate','!=' ,$DueDate)
                    ->first();
                  
        if( $Packagevalid != null || $Packagevalid !=[])  
        {
            $packagecount=DB::table('packagecount')
            ->where('attribute_id',$type)
            ->where('candidate_id',$id)
            ->select(DB::raw('count(packagecount.candidate_id)  as total'))
            ->first();
            if($packagecount->total == null)
            {
                //save Profile
                $packagecount= New packagecount;
                $packagecount->user_id=\Auth::user()->id;
                $packagecount->attribute_id=$type;
                $packagecount->candidate_id=$id;
                $packagecount->save();
                if($type==1 || $type==2)
        return 1;
        else
        return 3;
            }
            else
            {
               // اجيب فاضل له قد ايد
        $Packageattr=packageattribute::where('packages_id',$Packagevalid->packages_id)
        ->where('attribute_id',$type)
        ->first();
        //if monthly
        if($Packagevalid->PackType==$type)
        {
           if($Packageattr->Value >= $packagecount->total)
           {
                //save Profile
                $packagecount= New packagecount;
                $packagecount->user_id=\Auth::user()->id;
                $packagecount->attribute_id=$type;
                $packagecount->candidate_id=$id;
                $packagecount->save();

                if($type==1 || $type==2)
        return 1;
        else
        return 3;
           }
           else
           {
            return 2; 
           }
        }
        else
        {
            if($Packageattr->Valueyear >= $packagecount->total)
            {
                 //save Profile
                 $packagecount= New packagecount;
                 $packagecount->user_id=\Auth::user()->id;
                 $packagecount->attribute_id=$type;
                 $packagecount->candidate_id=$id;
                 $packagecount->save();
                 if($type==1 || $type==2)
        return 1;
        else
        return 3;
            }
            else
            {
             return 2; 
            }

        }
       

            }
           
        }


    }
                }
        }
    catch(Exception $e) 
        {
         return redirect('/');
        }    

}
public function PayMethod($id,$type)
{
    try
    {
        if(\Auth::user()==null)
        {
            return redirect('/loginEmployer');
        }
        else
        {
        //Record of Package 
        $DueDate=Carbon::now()->toDateString();
    //check user if has Valid Date
    $Packagevalid=PackagesUser::where('users_id',\Auth::user()->id)
                    ->where('EndDate','!=' ,$DueDate)
                    ->first();
                
                if( $Packagevalid != null || $Packagevalid !=[])  
                 {
                    Session::flash('flash', "you already have payment dosenot finish yet");
                    return redirect('/Payment');   
                 }   
                else
                 {
                    $PackageData= New PackagesUser;
                    $PackageData->packages_id=$id;
                    $PackageData->users_id=\Auth::user()->id;
                   
                    $Start=Carbon::now();
                   // $End=$Start->addDays(30);
                    $PackageData->StartDate=$Start->toDateString();
                  
                    if($type==1)
                    $End=$Start->addDays(30);
                    else
                    $End=$Start->addDays(365);
                    
                    $PackageData->EndDate=$End->toDateString();
                    $PackageData->PackType=$type;
                   
                    $PackageData->save();
                   
                    return redirect(Session::get('Profile'));
                 } 
                 
                }
    }
    catch(Exception $e) 
    {
     return redirect('/');
    } 
}
    public function index()
    {
        try
        {

          $Packages=Packages::all();
          
          return view('Payment.Payment',compact('Packages'));
        }
        catch(Exception $e) 
        {
          return redirect('/');
        }
    }
    public function checkPayvalid()
    {
        
        try
        {
            if(\Auth::user()==null)
            {
          
                //return response()->json(false);
               return "false";
            }
            else
            {
                $Packagevalid=PackagesUser::where('users_id',\Auth::user()->id)
                    ->where('EndDate','!=' ,$DueDate)
                    ->first();
                  
        if( $Packagevalid != null || $Packagevalid !=[])  
        {
            return "true";


        }
        else
        {
            $Packages=Packages::all();
            return view('Payment.Payment',compact('Packages'));
        }
                
            }
        }
        catch(Exception $e) 
        {
          return redirect('/');
        }

    }
    public function payPremium()
    {
    	return view('payPremium');
    }


    public function getCheckout(Request $request)
	{
        
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
    
            $item_1 = new Item();
    
            $item_1->setName('Item 1') /** item name **/
                ->setCurrency('INR')
                ->setQuantity(1)
                ->setPrice(10); /** unit price **/
    
            $item_list = new ItemList();
            $item_list->setItems(array($item_1));
    
            // $details = new Details();
            // $details->setShipping(1.2)
            //     ->setTax(1.3)
            //     ->setSubtotal(17.50);

                $details = new Details();
                $details->setSubtotal(10)
                ->setTax(10);


                $amount = new Amount();
                $amount->setCurrency("INR")
                    ->setTotal(20)
                    ->setDetails($details);


                    // $refund = new Refund();
                    // $refund->setAmount($amount);
                    // $sale = new Sale();
                    // $sale->setId("0KH341752J2209342");

    
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');
    
            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::to('/status')) /** Specify return URL **/
                ->setCancelUrl(URL::to('status'));
    
            $payment = new Payment();

            $payment->setIntent('Sale')
                ->setPayer('dodo')
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));

            try {
 
                $payment->create($this->_api_context);
    dd("ss0");
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                
                if (\Config::get('app.debug')) {
    
                    \Session::put('error', 'Connection timeout');
                    return Redirect::to('/');
    
                } else {
    
                    \Session::put('error', 'Some error occur, sorry for inconvenient');
                    return Redirect::to('/');
    
                }
    
            }
    
            foreach ($payment->getLinks() as $link) {
    
                if ($link->getRel() == 'approval_url') {
    
                    $redirect_url = $link->getHref();
                    break;
    
                }
    
            }
    
            /** add payment ID to session **/
            Session::put('paypal_payment_id', $payment->getId());
    
            if (isset($redirect_url)) {
    
                /** redirect to paypal **/
                return Redirect::away($redirect_url);
    
            }
    
            \Session::put('error', 'Unknown error occurred');
            return Redirect::to('/');




	}


    public function getPaymentStatus()
    {
      
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('/');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');
            return Redirect::to('/');

        }

        \Session::put('error', 'Payment failed');
        return Redirect::to('/');

    }
	public function getDone(Request $request)
	{
	    $id = $request->get('paymentId');
	    $token = $request->get('token');
	    $payer_id = $request->get('PayerID');


	    $payment = PayPal::getById($id, $this->_apiContext);


	    $paymentExecution = PayPal::PaymentExecution();


	    $paymentExecution->setPayerId($payer_id);
	    $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

	    
	    print_r($executePayment);
	}


	public function getCancel()
	{
	    return redirect()->route('payPremium');
	}
}

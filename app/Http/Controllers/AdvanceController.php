<?php

namespace App\Http\Controllers;

//use Mail;
use session;
use App\Advancer;
use Carbon\Carbon;
use App\Department;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use GuzzleHttp\Client;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use App\Jobs\SendEmailJob;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use App\Mail\SendEmailMailable;
use App\Mail\WelcomeNewUserMail;
use Facades\App\Repro\Advancers;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\FormValidation;
use Illuminate\Support\Facades\Redis;
use App\Events\NewHolahasRegisteredEvant;
use GuzzleHttp\Exception\GuzzleException;



class AdvanceController extends Controller
{
    //view
    public function view(){
        $id = new Advancer();
        return view("regis",compact("id"));
    }

    public function ad_regis(FormValidation $re){
        
        $advancer = new Advancer();
        $advancer->name = $re->a_name;
        $advancer->phone = $re->a_phone;
        $advancer->dept = 1;
         //    $hola = array(
          // 'p'     =>  $re->a_name,
       //    'q'     =>  $re->a_phone,

     //  );
    // $re->session()->put("datakey",$re->input());
     //  event(new NewHolahasRegisteredEvant($re->a_phone, $re->a_name));
       
      //   dispatch (new SendEmailJob($advancer->phone));
         dispatch (new SendEmailJob($re->a_phone));
       
      //  SendEmailJob::dispatch($advancer->phone)
        //    ->delay(Carbon::now()->addSeconds(5));
      
       // Mail::send('mail_send', $hola, function ($message) use ($hola) {
            //$this->hola=$hola;
         //   $message->to($hola['q']);
         //   $message->subject('Verify your Email!');
       // });
        $advancer->save();
       return "done";
//return $re->all();
    }

    public function show_data(Request $re){
      if($re->session()->exists('datakey')){
            dump(session()->get("datakey"));
      }
      //  session()->forget('datakey');
       // $advancer = Advancers::all_data('id');
        $advancer = Advancer::with("getdept")->get();
       // dd($advancer);
       // $department = Department::all();
        return view("show_data", compact("advancer"));
      // return response()->json($advancer,200);
    }
    public function show_data1(){
        
       // $advancer = Advancers::all_data('id');
        $advancer = Advancer::with("getdept")->get();
       // $department = Department::all();
      if(!is_null($advancer)){
        return response()->json($advancer, 200);
      }
      else{
        //session()->flash('success', 'Donate date successfully added!');
       // return redirect()->back();
      }
       // return view("show_data", compact("advancer"));
       
    }
    public function show_redis_data(){
        //$redis = Redis::connection();
        DB::connection()->enableQueryLog();
        $advancer = Advancers::fetchAll();
        $log = DB::getQueryLog();
        print_r($log);
        return view("show_redis_data", compact("advancer")); 
    }

    ////////////////////
    public function api_add_reg(Request $request)
    {
        if ($request->a_name == "") {
            return response()->json('Name is empty');
        } elseif ($request->a_phone == "") {
            return response()->json('Phone can not be empty');
        } else {
            $advancer = new Advancer();
            $advancer->name = $request->a_name;
            $advancer->phone = $request->a_phone;
            $advancer->dept = 1;
            $advancer->save();
            return response()->json("Advancer Registered Successfully");
        }
    }
    ///////////
    public function get_data_by_id($id){
        $advancer = Advancer::find($id);
        return response()->json($advancer,200);
    }
    public function edit(Advancer $id){
        return view("edit_view",compact("id"));
    }
    public function update(Request $re , $id){
        $advancer = Advancer::find($id);
        $advancer->name=$re->a_name;
        $advancer->phone=$re->a_phone;
        $advancer->save();
        return response()->json("edit successful");
    }
    public function holaview(){
        return view("paypal");
    }
    public function ex_payments(){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARZDkZ2X4iIUrEa_SATmJO9Dh2EQadCS0mTCJ-QB-g5O4OeXqAiM-QhpMIZ4w9jjX37q2Kdr10P66sE5',     // ClientID
                'EOC-zPDfrqT9eZxCZLiXXWDVykTsQxRtwvcnQpVntX6nCEjPiHgep6ajl_4JNH95sPge9rafDe3Jctq6'    
            )
        );
        $paymentId = request("paymentId");
        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(request("payerID"));
        // $transaction = new Transaction();
        // $amount = new Amount();
        // $details = new Details();
        // $details->setShipping(2.2)
        //     ->setTax(1.3)
        //     ->setSubtotal(17.50);
        // $amount->setCurrency('USD');
        // $amount->setTotal(21);
        // $amount->setDetails($details);
        // $transaction->setAmount($amount);
        // $execution->addTransaction($transaction);
        try {
            $result = $payment->execute($execution, $apiContext);
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
        return "come on";
        
    }
    public function make_payment()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARZDkZ2X4iIUrEa_SATmJO9Dh2EQadCS0mTCJ-QB-g5O4OeXqAiM-QhpMIZ4w9jjX37q2Kdr10P66sE5',     // ClientID
                'EOC-zPDfrqT9eZxCZLiXXWDVykTsQxRtwvcnQpVntX6nCEjPiHgep6ajl_4JNH95sPge9rafDe3Jctq6'      // ClientSecret
            )
        );
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(7.5);
        $item2 = new Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1, $item2));

        $details = new Details();
        $details->setShipping(1.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

       
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost/advance_lara/public/execute-holas")
            ->setCancelUrl("http://localhost/advance_lara/public/execute-holas");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($apiContext);
        return $payment->getApprovalLink();

    }

    public function getGuzzleRequest()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('localhost/advance_lara/public/api/regis1');
        dd($request);
        $result = $request->getBody();

       return response()->json($result);
       
    }

    public function destroy($id){
        $advancer = Advancer::find($id);
        $advancer->delete();
        return response()->json("delete successful");
    }
}



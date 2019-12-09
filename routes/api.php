<?php

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('create-payment', function () {
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'ARZDkZ2X4iIUrEa_SATmJO9Dh2EQadCS0mTCJ-QB-g5O4OeXqAiM-QhpMIZ4w9jjX37q2Kdr10P66sE5',     // ClientID
            'EOC-zPDfrqT9eZxCZLiXXWDVykTsQxRtwvcnQpVntX6nCEjPiHgep6ajl_4JNH95sPge9rafDe3Jctq6'     // ClientSecret
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
        ->setInvoiceNumber(12345);
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl("http://localhost/advance_lara/public/execute-payment")
        ->setCancelUrl("http://localhost/advance_lara/public/");
    // Add NO SHIPPING OPTION
    $inputFields = new InputFields();
    $inputFields->setNoShipping(1);
    $webProfile = new WebProfile();
    $webProfile->setName('test' . uniqid())->setInputFields($inputFields);
    $webProfileId = $webProfile->create($apiContext)->getId();
    $payment = new Payment();
    $payment->setExperienceProfileId($webProfileId); // no shipping


    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));
    try {
        $payment->create($apiContext);
    } catch (Exception $ex) {
        echo $ex;
        exit(1);
    }
    return $payment;
});


Route::get('execute-payment', function (Request $request) {
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'ARZDkZ2X4iIUrEa_SATmJO9Dh2EQadCS0mTCJ-QB-g5O4OeXqAiM-QhpMIZ4w9jjX37q2Kdr10P66sE5',     // ClientID
            'EOC-zPDfrqT9eZxCZLiXXWDVykTsQxRtwvcnQpVntX6nCEjPiHgep6ajl_4JNH95sPge9rafDe3Jctq6'       // ClientSecret
        )
    );
    $paymentId = $request->paymentID;
    $payment = Payment::get($paymentId, $apiContext);
    $execution = new PaymentExecution();
    $execution->setPayerId($request->payerID);
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
    return $result;
});

Route::get("/getdata", "AdvanceController@getGuzzleRequest");
Route::get("/regis1", "AdvanceController@show_data1")->name("show_data");
Route::post("/api_add", "AdvanceController@api_add_reg");
Route::get("/data/{id}", "AdvanceController@get_data_by_id");
Route::put("/edit_data/{id}", "AdvanceController@update");
Route::delete("/delete_data/{id}", "AdvanceController@destroy");

//
Route::apiResource('products', 'ProductController');
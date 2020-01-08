<?php

namespace App\Http\Controllers;

use App\traits\ReservationTrait;
use Illuminate\Http\Request;
use App\Reservation;
use App\Contact;
use App\Json;
use App\Reservation_list;

use Opis\JsonSchema\Validator;
use Opis\JsonSchema\ValidationResult;
use Opis\JsonSchema\ValidationError;
use Opis\JsonSchema\Schema;

class reservationController extends Controller
{
    public function get_data(){
        $reservation= Reservation::all();
       // dd($reservation);
        return view("reservation" , ['reservation' => json_decode($reservation)]);
    }
    use ReservationTrait;

    public function show_create(){
        return view("json_take");

    }
    public function json_store(Request $re){
        $json = new Json();
       $code = '{
    "mm":"'.$re->name.'",
    "Coords": [{
        "precision":"'.$re->name.'",
        "Accuracy": "30",
        "Latitude": "53.2778273",
        "Longitude": "-9.0121648",
        "Timestamp": "Fri Jun 28 2013 11:43:57 GMT+0100 (IST)"
    }]
}';



$json5 = json_decode($code, true);


        $data = $re->only('name', 'phone', 'email','r1','r2');
       // dd(gettype(json_encode($data)));
        $json->data = json_encode($json5);
        dd(gettype(json_encode($json5)));

        $json->save();
        session()->flash('success', "data added");
        return json_encode($json5);



    }
       //create flight page
    public function create_flight(Request $request)
    {
        if (isset($request->trip_type) && isset($request->pnr_type)) {
            $r = Reservation::where('trip_type', $request->trip_type)->where('pnr_type', $request->pnr_type)->first();
           
            // echo("<pre>".$r->toJson()); die;
           // echo $r;
            return view("flight", [
                "json_schema" => json_decode($r->json_schema, true),
                "cabin_class" => $request->cabin_class,
            ]);
        } else {
            return view("flight");
        }

    }

       
    //////
    public function flight_reservation(Request $request)
    {
        if ($request->trip_type === "roundtrip" and $request->pnr_type === "multiple") {
            $all_data = json_decode(json_encode($request->json()->all()));
            $cabin_class = $request->cabin_class;

            if ($cabin_class == "business") {
                if(!empty($all_data->data->price_itinerary)){
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "C";
                    $all_data->data->price_itinerary->departing_itinerary->$cabin_class->cabin_code = "C";
                    $all_data->data->price_itinerary->returning_itinerary->$cabin_class->cabin_code = "C";
                }
                if(!empty($all_data->total_price)){
                    $all_data->total_price->$cabin_class->cabin_code = "C";
                    $all_data->total_price->departing_itinerary->$cabin_class->cabin_code = "C";
                    $all_data->total_price->returning_itinerary->$cabin_class->cabin_code = "C";
                }
            } elseif ($cabin_class == "economy") {
                if(!empty($all_data->data->price_itinerary)){
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "Y";
                    $all_data->data->price_itinerary->departing_itinerary->$cabin_class->cabin_code = "Y";
                    $all_data->data->price_itinerary->returning_itinerary->$cabin_class->cabin_code = "Y";
                }
                if(!empty($all_data->total_price)){
                    $all_data->total_price->$cabin_class->cabin_code = "Y";
                    $all_data->total_price->departing_itinerary->$cabin_class->cabin_code = "Y";
                    $all_data->total_price->returning_itinerary->$cabin_class->cabin_code = "Y";
                }

            } elseif ($cabin_class == "premium_economy") {
                if(!empty($all_data->data->price_itinerary)){
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "X";
                    $all_data->data->price_itinerary->departing_itinerary->$cabin_class->cabin_code = "X";
                    $all_data->data->price_itinerary->returning_itinerary->$cabin_class->cabin_code = "X";
                }
                if(!empty($all_data->total_price)){
                    $all_data->total_price->$cabin_class->cabin_code = "X";
                    $all_data->total_price->departing_itinerary->$cabin_class->cabin_code = "X";
                    $all_data->total_price->returning_itinerary->$cabin_class->cabin_code = "X";
                }
            } elseif ($cabin_class == "first") {
                if(!empty($all_data->data->price_itinerary)){
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "F";
                    $all_data->data->price_itinerary->departing_itinerary->$cabin_class->cabin_code = "F";
                    $all_data->data->price_itinerary->returning_itinerary->$cabin_class->cabin_code = "F";
                }
                if(!empty($all_data->total_price)){
                    $all_data->total_price->$cabin_class->cabin_code = "F";
                    $all_data->total_price->departing_itinerary->$cabin_class->cabin_code = "F";
                    $all_data->total_price->returning_itinerary->$cabin_class->cabin_code = "F";
                }
            }
            else{
                return die();
            }
            if(!empty($all_data->total_price)){
                $all_data->total_price->$cabin_class->fare_breakdown->adult->tax_breakdown = 0;
            $all_data->total_price->departing_itinerary->$cabin_class->fare_breakdown->adult->tax_breakdown = 0;
            $all_data->total_price->departing_itinerary->$cabin_class->fare_breakdown->child = 0;
            $all_data->total_price->returning_itinerary->$cabin_class->fare_breakdown->child = 0;
            $all_data->total_price->returning_itinerary->$cabin_class->fare_breakdown->infant = 0;
            $all_data->total_price->returning_itinerary->$cabin_class->fare_breakdown->adult->tax_breakdown = 0;
            $all_data->total_price->$cabin_class->fare_breakdown->child = 0;
            $all_data->total_price->$cabin_class->fare_breakdown->infant = 0;

            $all_data->total_price->departing_itinerary->$cabin_class->fare_breakdown->child = 0;
            $all_data->total_price->departing_itinerary->$cabin_class->fare_breakdown->infant = 0;
            }
            if(!empty($all_data->data->price_itinerary)){
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->adult->tax_breakdown = 0;
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->child = 0;
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->infant = 0;
                $all_data->data->price_itinerary->departing_itinerary->$cabin_class->fare_breakdown->child = 0;
                $all_data->data->price_itinerary->departing_itinerary->$cabin_class->fare_breakdown->infant = 0;
    
                $all_data->data->price_itinerary->returning_itinerary->$cabin_class->fare_breakdown->child = 0;
                $all_data->data->price_itinerary->returning_itinerary->$cabin_class->fare_breakdown->infant = 0;
    
                $all_data->data->price_itinerary->departing_itinerary->$cabin_class->fare_breakdown->adult->tax_breakdown = 0;
                $all_data->data->price_itinerary->returning_itinerary->$cabin_class->fare_breakdown->adult->tax_breakdown = 0;
            }
          
            if(!empty($all_data->data->baggage_allowance)){
                $all_data->data->baggage_allowance->$cabin_class->returning->pieces = 0;
                $all_data->data->baggage_allowance->$cabin_class->departing->pieces = 0;
                $all_data->data->baggage_allowance->breakdowns->infant = 0;    
            }

            $sample_reservation_json_schema = Reservation::where('trip_type', $request->trip_type)->where('pnr_type', $request->pnr_type)->first();

            $json_schema = $sample_reservation_json_schema->json_schema;
            $json_schema = str_replace("business", $cabin_class, $json_schema);
            $schema = Schema::fromJsonString($json_schema);
            $validator = new Validator();
            $result = $validator->schemaValidation($all_data, $schema);

            if ($result->isValid()) {
                $r_list = new Reservation_list();
                $r_list->booking_key = $all_data->booking_key;
                $r_list->data = json_encode($all_data->data);
                $r_list->query = json_encode($all_data->query);
                $r_list->total_price = json_encode($all_data->total_price);
                $r_list->adult_price = $all_data->adult_price;
                $r_list->adult_price = $all_data->adult_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->infant_price = $all_data->infant_price;
                $r_list->adult_tax = $all_data->adult_tax;
                $r_list->child_tax = $all_data->child_tax;
                $r_list->infant_tax = $all_data->infant_tax;
                $r_list->total_fare = $all_data->total_fare;
                $r_list->passengers = json_encode($all_data->passengers);
                $r_list->special_message = json_encode($all_data->special_message);
                $r_list->save();
            } else {
                $error = $result->getFirstError();
                echo '$data is invalid', PHP_EOL;
                echo "Error: ", $error->keyword(), PHP_EOL;
                echo json_encode($error->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;
            }

        } elseif ($request->trip_type === "oneway" and $request->pnr_type === "single") {
            $all_data = json_decode(json_encode($request->json()->all()));
            $cabin_class = $request->cabin_class;

            if ($cabin_class == "business") {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "C";
                }
                if (!empty($all_data->total_price)) {
                    $all_data->total_price->$cabin_class->cabin_code = "C";
                }
              
               

            } elseif ($cabin_class == "economy") {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "Y";
                }
                if (!empty($all_data->total_price)) {
                    $all_data->total_price->$cabin_class->cabin_code = "Y";
                }
            } elseif ($cabin_class == "premium_economy") {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "X";
                }
                if (!empty($all_data->total_price)) {
                    $all_data->total_price->$cabin_class->cabin_code = "X";
                }
            } else {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "F";
                }
                if (!empty($all_data->total_price)) {
                    $all_data->total_price->$cabin_class->cabin_code = "F";
                }
            }
            $sample_reservation_json_schema = Reservation::where('trip_type', $request->trip_type)->where('pnr_type', $request->pnr_type)->first();

            $json_schema = $sample_reservation_json_schema->json_schema;
            $json_schema = str_replace("business", $cabin_class, $json_schema);
            $schema = Schema::fromJsonString($json_schema);
            $validator = new Validator();
            $result = $validator->schemaValidation($all_data, $schema);

            if ($result->isValid()) {
                $r_list = new Reservation_list();
                $r_list->booking_key = $all_data->booking_key;
                $r_list->data = json_encode($all_data->data);
                $r_list->query = json_encode($all_data->query);
                $r_list->total_price = json_encode($all_data->total_price);
                $r_list->adult_price = $all_data->adult_price;
                $r_list->adult_price = $all_data->adult_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->infant_price = $all_data->infant_price;
                $r_list->adult_tax = $all_data->adult_tax;
                $r_list->child_tax = $all_data->child_tax;
                $r_list->infant_tax = $all_data->infant_tax;
                $r_list->total_fare = $all_data->total_fare;
                $r_list->passengers = json_encode($all_data->passengers);
                $r_list->special_message = json_encode($all_data->special_message);
                $r_list->save();
            } else {
                $error = $result->getFirstError();
                echo '$data is invalid', PHP_EOL;
                echo "Error: ", $error->keyword(), PHP_EOL;
                echo json_encode($error->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;
            }

        } elseif ($request->trip_type === "roundtrip" and $request->pnr_type === "single") {
            $all_data = json_decode(json_encode($request->json()->all()));
            $cabin_class = $request->cabin_class;

            if ($cabin_class == "business") {
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->child = 0;
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->infant = 0;
                if (!empty($all_data->data->baggage_allowance->business->returning)) {
                    $all_data->data->baggage_allowance->$cabin_class->returning->pieces = 0;
                }
                if (!empty($all_data->data->baggage_allowance->business->departing)) {
                    $all_data->data->baggage_allowance->$cabin_class->departing->pieces = 0;
                }
                $all_data->total_price->$cabin_class->fare_breakdown->child = 0;
                $all_data->total_price->$cabin_class->fare_breakdown->infant = 0;

            } elseif ($cabin_class == "economy") {
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->child = "X";
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->infant = 0;
                if (!empty($all_data->data->baggage_allowance->economy->returning)) {
                    $all_data->data->baggage_allowance->$cabin_class->returning->pieces = 0;
                }
                if (!empty($all_data->data->baggage_allowance->economy->departing)) {
                    $all_data->data->baggage_allowance->$cabin_class->departing->pieces = 0;
                }

                $all_data->total_price->$cabin_class->fare_breakdown->child = 0;
                $all_data->total_price->$cabin_class->fare_breakdown->infant = 0;
            } elseif ($cabin_class == "premium_economy") {
                if (!empty($all_data->data->baggage_allowance->premium_economy->returning)) {
                    $all_data->data->baggage_allowance->$cabin_class->returning->pieces = 0;
                }
                if (!empty($all_data->data->baggage_allowance->premium_economy->departing)) {
                    $all_data->data->baggage_allowance->$cabin_class->departing->pieces = 0;
                }
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->child = 0;
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->infant = 0;
                $all_data->total_price->$cabin_class->fare_breakdown->child = 0;
                $all_data->total_price->$cabin_class->fare_breakdown->infant = 0;
            } else {
                if (!empty($all_data->data->baggage_allowance->first->returning)) {
                    $all_data->data->baggage_allowance->$cabin_class->returning->pieces = 0;
                }
                if (!empty($all_data->data->baggage_allowance->first->departing)) {
                    $all_data->data->baggage_allowance->$cabin_class->departing->pieces = 0;
                }
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->child = 0;
                $all_data->data->price_itinerary->$cabin_class->fare_breakdown->infant = 0;
                $all_data->total_price->$cabin_class->fare_breakdown->child = 0;
                $all_data->total_price->$cabin_class->fare_breakdown->infant = 0;

            }

            $sample_reservation_json_schema = Reservation::where('trip_type', $request->trip_type)->where('pnr_type', $request->pnr_type)->first();

            $json_schema = $sample_reservation_json_schema->json_schema;
            $json_schema = str_replace("business", $cabin_class, $json_schema);
            $schema = Schema::fromJsonString($json_schema);
            $validator = new Validator();
            $result = $validator->schemaValidation($all_data, $schema);

            if ($result->isValid()) {
                $r_list = new Reservation_list();
                $r_list->booking_key = $all_data->booking_key;
                $r_list->data = json_encode($all_data->data);
                $r_list->query = json_encode($all_data->query);
                $r_list->total_price = json_encode($all_data->total_price);
                $r_list->adult_price = $all_data->adult_price;
                $r_list->adult_price = $all_data->adult_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->infant_price = $all_data->infant_price;
                $r_list->adult_tax = $all_data->adult_tax;
                $r_list->child_tax = $all_data->child_tax;
                $r_list->infant_tax = $all_data->infant_tax;
                $r_list->total_fare = $all_data->total_fare;
                $r_list->passengers = json_encode($all_data->passengers);
                $r_list->special_message = json_encode($all_data->special_message);
                $r_list->save();
            } else {
                $error = $result->getFirstError();
                echo '$data is invalid', PHP_EOL;
                echo "Error: ", $error->keyword(), PHP_EOL;
                echo json_encode($error->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;
            }

        } elseif ($request->trip_type === "multicity" and $request->pnr_type === "multiple") {
            $all_data = json_decode(json_encode($request->json()->all()));
            $cabin_class = $request->cabin_class;

            if ($cabin_class == "business") {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "C";
                }
                if (!empty($all_data->data->price_itinerary->prices)) {
                    $all_data->data->price_itinerary->prices[0]->$cabin_class->cabin_code = "C";
                }
                if (!empty($all_data->total_price->$cabin_class)) {
                    $all_data->total_price->$cabin_class->cabin_code = "C";
                }
                if (!empty($all_data->total_price->prices)) {
                    $all_data->total_price->prices[0]->$cabin_class->cabin_code = "C";
                }

            } elseif ($cabin_class == "economy") {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "Y";
                }
                if (!empty($all_data->data->price_itinerary->prices)) {
                    $all_data->data->price_itinerary->prices[0]->$cabin_class->cabin_code = "Y";
                }
                if (!empty($all_data->total_price->$cabin_class)) {
                    $all_data->total_price->$cabin_class->cabin_code = "Y";
                }
                if (!empty($all_data->total_price->prices)) {
                    $all_data->total_price->prices[0]->$cabin_class->cabin_code = "Y";
                }

            } elseif ($cabin_class == "premium_economy") {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "S";
                }
                if (!empty($all_data->data->price_itinerary->prices)) {
                    $all_data->data->price_itinerary->prices[0]->$cabin_class->cabin_code = "S";
                }
                if (!empty($all_data->total_price->$cabin_class)) {
                    $all_data->total_price->$cabin_class->cabin_code = "S";
                }
                if (!empty($all_data->total_price->prices)) {
                    $all_data->total_price->prices[0]->$cabin_class->cabin_code = "S";
                }

            } else {
                if (!empty($all_data->data->price_itinerary)) {
                    $all_data->data->price_itinerary->$cabin_class->cabin_code = "F";
                }
                if (!empty($all_data->data->price_itinerary->prices)) {
                    $all_data->data->price_itinerary->prices[0]->$cabin_class->cabin_code = "F";
                }
                if (!empty($all_data->total_price->$cabin_class)) {
                    $all_data->total_price->$cabin_class->cabin_code = "F";
                }
                if (!empty($all_data->total_price->prices)) {
                    $all_data->total_price->prices[0]->$cabin_class->cabin_code = "F";
                }

            }
            if (!empty($all_data->data->baggage_allowance->breakdowns)) {
                $all_data->data->baggage_allowance->breakdowns->child = 0;
                $all_data->data->baggage_allowance->breakdowns->infant = 0;
            }

            $sample_reservation_json_schema = Reservation::where('trip_type', $request->trip_type)->where('pnr_type', $request->pnr_type)->first();

            $json_schema = $sample_reservation_json_schema->json_schema;
            $json_schema = str_replace("business", $cabin_class, $json_schema);
            $schema = Schema::fromJsonString($json_schema);
            $validator = new Validator();
            $result = $validator->schemaValidation($all_data, $schema);

            if ($result->isValid()) {
                $r_list = new Reservation_list();
                $r_list->booking_key = $all_data->booking_key;
                $r_list->data = json_encode($all_data->data);
                $r_list->query = json_encode($all_data->query);
                $r_list->total_price = json_encode($all_data->total_price);
                $r_list->adult_price = $all_data->adult_price;
                $r_list->adult_price = $all_data->adult_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->child_price = $all_data->child_price;
                $r_list->infant_price = $all_data->infant_price;
                $r_list->adult_tax = $all_data->adult_tax;
                $r_list->child_tax = $all_data->child_tax;
                $r_list->infant_tax = $all_data->infant_tax;
                $r_list->total_fare = $all_data->total_fare;
                $r_list->passengers = json_encode($all_data->passengers);
                $r_list->special_message = json_encode($all_data->special_message);
                $r_list->save();
            } else {
                $error = $result->getFirstError();
                echo '$data is invalid', PHP_EOL;
                echo "Error: ", $error->keyword(), PHP_EOL;
                echo json_encode($error->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;
            }

        }

    }
    /////




public function postdata(Request $request)
{
  

  
    
  $contacts = new Contact([
    'name' => $request->get('name'),
    'age' => $request->get('age'),
]);
$contacts->save();

          //  $success_output = '<div class="alert alert-success">Data Inserted</div>';
        

}

}

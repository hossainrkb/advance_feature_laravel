<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpParser\Node\Stmt\Global_;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function sum_of_departing_flight_segment_count_and_returning_flight_segment_count()
    {
        // $black_list = env("BLACK_LIST_USERID_FOR_SEGMENT_COUNT");
        //$black_list = explode(',', $black_list);
        // print_r($this->get_user_idd()[x]);
        $ids = $this->get_user_idd();
       // dd ($ids['y']);
        // $get_dummy_data = file_get_contents(storage_path() . '/app/dummy_reservations.json');
        //$all_reservation = json_decode($get_dummy_data);
        $all_reservation =  \App\Traits\ReservationTrait::getAllData();
        $response1 = \App\Traits\ReservationTrait::getFlightSegmentCount($all_reservation, $ids['x']);
        $response2 = \App\Traits\ReservationTrait::getFlightSegmentCount($all_reservation, $ids['y']);
        dd($response2);
        if (gettype($response2) === "integer") {
            if ($response1 > 0) {
                dd($response1);
                $this->assertTrue(true);
            } else {
                dd($response1);
                $this->assertTrue(false);
            }
        } else {
            $this->assertTrue(false);
        }
    }

    /** @test */
    public function get_user_idd()
    {
        //$get_dummy_data = file_get_contents(storage_path() . '/app/dummy_reservations.json');
        //$all_reservation = json_decode($get_dummy_data);
        $userids = [4,2,1];
        // foreach ($all_reservation as $item) {
        //     $userids[] = $item->user_id;
        // }
      //  $user_unique_ids = array_unique($userids);
        $new_array = array_values($userids);
       
       $i = 0;
        //$bro2 =[];
        // $bro1 =[];

        //dd ($bro2);
       // $y = array();
        //dd($i);
        
        for($i=0;$i<=2;$i++){
            if($i==0){
                unset($new_array[$i]);
                $y1 = $new_array;
                //return $x;
               // return array('y' => $y1);
            }
            else{
                unset($new_array[$i]);
                $x = $new_array;
                return array('x' => $x , 'y'=>$y1);
               //dd($x);
            }


           // dd($y1);
           
            
        }
       
       
      
    }
}

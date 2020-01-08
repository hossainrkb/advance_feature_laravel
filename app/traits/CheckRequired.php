<?php
namespace App\traits;

use App\SampleReservation;

trait CheckRequired
{
    public static function getData()
    {

$lines = array();
// foreach (file('app/Traits/demo.json') as $line) {
//     array_push($lines, $line);
//  //"type": "string"\r\n"
//  //$t1 = '"type"';
//  //$t1 = ":";
//     if ( '"            "type": "string"\r\n"' === $line) {
       
//         array_push($lines, 'test');
//     }
   
// }
// file_put_contents('app/Traits/demo.json', $lines);

// dd($lines);

        $data = file_get_contents('app/Traits/demo.json');
        // $data = file_get_contents('demo.json');

        $data = json_decode($data);
        // $data = json_encode($data);
        // dd($data);
        // dd($data);
        // dd(gettype($data));
        //dd($data->properties);
        $count = 0;
        $lines = [];
        foreach ($data->properties as $getdata) {
            $lines[] = $getdata;
          // print_r($getdata);
           // print_r($getdata->type . " ");
             if($getdata->type =="string"){
                 $txt1 = "'required'";
                 $txt2 = "true";
               //  array_push($lines, 'test');
            //   $myfile = fopen("app/Traits/demo.json", "a") or die("Unable to open file!");
             //   $txt = "user id date";
              //  fwrite($myfile, "\n" . $txt1.":".$txt2);
              //  fclose($myfile);

               // $lines[] = "come on";
                 file_put_contents('app/Traits/demo.json', $txt1.":".$txt2. PHP_EOL, FILE_APPEND);
             break;
               // echo $txt;
            //   print_r("required:true");
            $count = $count + 1;
               };
        }
      //  $object = (object) $lines;

     //  $lines =json_encode($lines);
      // file_put_contents('app/Traits/demo.json', json_decode($lines));
        
       // dd($count);
        //foreach ($data as $item) {
        //dd($item);
        //foreach($item[1] as $item2){
        //print_r ($item2);
        //}
        //}
        //echo("<pre>".$r->toJson()); die;
        // return self::getFlightSegmentCount($all_reservation);
    }

}

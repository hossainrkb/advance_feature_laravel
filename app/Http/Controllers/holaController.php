<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advancer;
use App\Events\vaiEvent;
use App\Events\NewHolahasRegisteredEvant;
use SebastianBergmann\Diff\Chunk;

class holaController extends Controller
{
    public function check_collection()
    {
        $collection = collect(['a' => 2, 'b' => 3, 'c' => 4, 'd' => 5]);
        return $collection->chunk(2);
    }

    public function take($collection, $limit)
    {
      // return array_slice($collection->toArray(),2);
       // $array = [];
      //  foreach ($collection as $key => $item) {
      //      $array[$key] = $item;
      //  }
      //  return $array;
    }
    public function advancers()
    {
      $ad = Advancer::first();
        //  return $ad->firstWhere('dept', 1);
        // return $ad->sortByDesc("name")->values();
        // $ad->each(function($ad){
        //    print_r ($ad->name." ");
        // });
      // return $ad->map(function ($ad) {
           // return (["Full name" => $ad->name, "UserID" => $ad->id]);
        //   if($ad->dept == 1){
         //       $ad->delete();
        //   }
        //   return $ad;
       // });

       $merged=  collect($ad)->merge(['price' => 200, 'discount' => false]);
       return $merged->all();
    }
}

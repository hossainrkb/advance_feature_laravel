@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
               
                    <table class="table">
                        <tr>
                            <td>user ID</td>
                            <td>data</td>
                            <td>count</td>
                           
                        </tr>
                
                        Total Data:
                         @foreach ($reservation as $reser)
                         
                         <tr>
                            <td>{{ $reser->user_id }}</td>
                            <td>{{ $reser->data }}</td>
                            @php
                               $bro= json_decode($reser->data,true);                                
                            @endphp
                              
                           
                                  <td>
                             {{ count($bro["departing_flight_segments"][0]) }} 
                                  </td>
                         
                             
                           
                       
                           
                        </tr>
                        @endforeach
                    </table>
               @php

             $code =   '{
    "mm":"bbb",
    "Coords": [{
        "precision":"40",
        "Accuracy": "30",
        "Latitude": "53.2778273",
        "Longitude": "-9.0121648",
        "Timestamp": "Fri Jun 28 2013 11:43:57 GMT+0100 (IST)"
    }]
}';

               $json = '{"countryId":"84","productId":"1","status":"0","opId":"134"}';

$json = json_decode($json, true);
$json5 = json_decode($code, true);
 
   
               @endphp
              
               {{ count($json5['Coords'][0]) }}
            </div>
        </div>

@endsection
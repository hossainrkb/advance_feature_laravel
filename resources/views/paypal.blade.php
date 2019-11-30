@php
 

 
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://localhost/advance_lara/public/api/regis1');
       // $response = $request->getBody();
  $request->getBody();
  
    //   $hola= json_decode($request->getBody(),true);
  // echo $hola
  if(Illuminate\Support\Facades\Input::get('a_name')){
  //dd(Illuminate\Support\Facades\Input::get('a_name'));
   $request1 = $client->post('http://localhost/advance_lara/public/api/api_add',  [
      'name'=>Illuminate\Support\Facades\Input::get('a_name'),
      'phone'=>Illuminate\Support\Facades\Input::get('a_phone'),
      ]);
      $request1->getBody();
  }



   // $response = $request1->send();
   
   
    
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="{{ route("ex_payment") }}" method="POST">
        @csrf
        <input type="submit" class="btn btn-outline-danger m-lg-4" value="pay now" />
    </form>
    <form action="" method="get">
        @csrf
         <input type="text"  name="a_name" placeholder="Enter name" class="form-control" />
                    <br/>
                    <input type="text" name="a_phone" placeholder="Enter mail" class="form-control" />
                    <br/>
                    <input type="submit" class="btn btn-sm btn-danger" />
    </form>
      <div class="row">
          
            <div class="col-md-12">
               
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>name</td>
                            <td>phone</td>
                            <td>dept</td>
                          
                        </tr>
                        Total Data: 
                         @foreach (json_decode($request->getBody()) as $ad)
                         <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->name }}</td>
                            <td>{{ $ad->phone }}</td>
                            <td> {{$ad->getdept->d_name}} </td>
                           
                           
                        </tr>
                          @endforeach
                    </table>
               
            </div>
        </div>
</body>
</html>
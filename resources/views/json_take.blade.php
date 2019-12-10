<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
  <div class="container">
   @if(Session :: has('success'))
  <p class="text-center">{{Session :: get('success') }}</p>
@endif
@if(Session :: has('error'))
<p class="text-center">{{Session :: get('error') }}</p>
@endif
      <div class="row">
            <div class="col-md-12">
                    <form action="{{ route("json_store") }}" method="POST">
                         @csrf
                    <input type="text" value="" name="name" placeholder="Enter name" class="form-control" />
                    <br/>
                    <input type="text" name="phone" placeholder="Enter phone" class="form-control" />
                    <br/>
                    <input type="text" name="email" placeholder="Enter mail" class="form-control" />
                    <br/>
                     <select class="form-control" name="trip" id="trip" required=""  >
                        <option value="">Select trip!</option>
                        <option value="1">One Way</option>
                        <option value="2">Round Trip</option>
                        <option value="3">Mulcity</option>
                </select>
                 <p id="get"  >
                           
                    </p>
                <br/>
                    <input type="submit" class="btn btn-sm btn-info" />
                    </form>
               
            </div>
        </div>
  </div>
  <script>
  
   $("#trip").change(function(){
       console.log( $("#trip").val());
        var trip = $("#trip").val();
        // Send an ajax request to server with this division
        $("#get").html("");
        var option = "";
        var option1 = "";

    if(trip == 1){
        //console.log("1 bro")
option +=`<input type='text' name='r1' placeholder='Enter phone' class='form-control' /> 
<input type='text' name='r2' placeholder='Enter phone1' class='form-control' />`;

    }
             
              
            

          $("#get").html(option);

       
    })


</script>

</body>
</html>
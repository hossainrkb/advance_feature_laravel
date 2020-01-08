<!DOCTYPE html>
@php
use Illuminate\Support\Facades\Request;
$get_search = "";
$trip_type = "";
$pnr_type = "";
$bro = "";
@endphp
<html lang="en">
    <head>
   <link rel="stylesheet" style="text/css" href ="{{ asset("/deps/opt/bootstrap.css")}}" /> 
    <script type="text/javascript" src="{{ asset("/deps/jquery.min.js")}}"></script>
    <script type="text/javascript" src="{{ asset("/deps/underscore.js")}}" ></script>
    <script type="text/javascript" src="{{ asset("/deps/opt/jsv.js")}}"></script>
    <script type="text/javascript" src="{{ asset("/deps/lib/jsonform.js")}}"></script> 
    </head>
    <body>
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-6">
                    <div id="res" class="alert"></div>
                @php
                $trip_type = Request::get('trip_type');
                $pnr_type = Request::get('pnr_type');
                $cabin_class = Request::get('cabin_class');
                @endphp
                @if($trip_type and $pnr_type)
                @php $get_search = App\Reservation::Where('trip_type', $trip_type)
                ->Where('pnr_type', $pnr_type)
                ->first();
                @endphp
                @if($get_search !== NULL)
                @if($get_search->trip_type === "roundtrip" and $get_search->pnr_type === "multiple" )
     <form></form>
    <script type="text/javascript">
      $('form').jsonForm({
        schema: JSON.parse(`@json($json_schema)`.replace(/\"business\"\:/gi, `"{{ $cabin_class }}":`)),
        onSubmit: function (errors, values) {
          var form_data = JSON.stringify(values);
          var cabin_class = "{{ $cabin_class }}";
          var trip_type = "{{ $trip_type }}";
          var pnr_type = "{{ $pnr_type }}";
          console.log("form data", cabin_class);
      $.ajax({
        type: "post",
         url:"{{ route('flight_reservation') }}"  + `?trip_type=${trip_type}&pnr_type=${pnr_type}&cabin_class=${cabin_class}`,
         data: form_data,
         processData:false,
        success: function( msg ) {
            console.log("done");
        }
    });
        }
      });
    </script>

                @elseif($get_search->trip_type === "oneway" and $get_search->pnr_type === "single")
            <form></form>
    <script type="text/javascript">
      $('form').jsonForm({
        schema: JSON.parse(`@json($json_schema)`.replace(/\"business\"\:/gi, `"{{ $cabin_class }}":`)),
        onSubmit: function (errors, values) {
          var form_data = JSON.stringify(values);
          var cabin_class = "{{ $cabin_class }}";
          var trip_type = "{{ $trip_type }}";
          var pnr_type = "{{ $pnr_type }}";
          console.log("form data", cabin_class);
      $.ajax({
        type: "post",
         url:"{{ route('flight_reservation') }}"  + `?trip_type=${trip_type}&pnr_type=${pnr_type}&cabin_class=${cabin_class}`,
         data: form_data,
         processData:false,
        success: function( msg ) {
            console.log("done");
        }
    });
        }
      });
    </script>
                @elseif($get_search->trip_type === "roundtrip" and $get_search->pnr_type === "single")
               <form></form>
    <script type="text/javascript">
      $('form').jsonForm({
        schema: JSON.parse(`@json($json_schema)`.replace(/\"business\"\:/gi, `"{{ $cabin_class }}":`)),
        onSubmit: function (errors, values) {
          var form_data = JSON.stringify(values);
          var cabin_class = "{{ $cabin_class }}";
          var trip_type = "{{ $trip_type }}";
          var pnr_type = "{{ $pnr_type }}";
          console.log("form data", cabin_class);
      $.ajax({
        type: "post",
         url:"{{ route('flight_reservation') }}"  + `?trip_type=${trip_type}&pnr_type=${pnr_type}&cabin_class=${cabin_class}`,
         data: form_data,
         processData:false,
        success: function( msg ) {
            console.log("done");
        }
    });
        }
      });
    </script>
                @elseif($get_search->trip_type === "multicity" and $get_search->pnr_type === "multiple")
                <form></form>
                <script type="text/javascript">
                  $('form').jsonForm({
                    schema: JSON.parse(`@json($json_schema)`.replace(/\"business\"\:/gi, `"{{ $cabin_class }}":`)),
                    onSubmit: function (errors, values) {
                      if (errors) {
                        $('#res').html('<p>I beg your pardon?</p>');
                      }
                      else {
                        $('#res').html('<p>Hello ' + values.name + '.' +
                          (values.age ? '<br/>You are ' + values.age + '.' : '') +
                          '</p>');
                      }
                    }
                  });
                </script>
                @endif
                    @else 
                    {{"Not Found"}}
                    @endif
                    
                  @else
                  <form action="" method="get">
                        <select class="form-control" name="trip_type" required=""  >
                            <option value="">Trip Type</option>
                            <option value="oneway">OneWay</option>
                            <option value="roundtrip">Round Trip</option>
                            <option value="multicity">Multicity</option>
                        </select><br/>
                        <select class="form-control" name="pnr_type" required=""  >
                            <option value="">PNR Type</option>
                            <option value="single">Single</option>
                            <option value="multiple">Multiple</option>
                        </select><br/>
                        <select class="form-control" name="cabin_class" required=""  >
                            <option value="">Cabin Class</option>
                            <option value="business">Business</option>
                            <option value="economy">Economy</option>
                            <option value="premium_economy">Premium Economy</option>
                            <option value="first">First</option>
                        </select> <br/>
                        <input type="submit" class="btn btn-sm btn-info" value = "Search" />
                    </form>
                  @endif
                </div>
            </div>
        </div>
    </body>
</html>
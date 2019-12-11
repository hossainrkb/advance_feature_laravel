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
                @endphp
                @if($trip_type and $pnr_type)
                @php $get_search = App\Reservation::Where('trip_type', $trip_type)
                ->Where('pnr_type', $pnr_type)
                ->first();
                @endphp
                @if($get_search !== NULL)
                @if($get_search->trip_type === "roundtrip" and $get_search->pnr_type === "multiple" )
                {{"bbbb"}}
                   <form></form>
             <script type="text/javascript">
      $('form').jsonForm({
        schema: {
          name: {
            type: 'string',
            title: 'Name',
            required: true
          },
          age: {
            type: 'number',
            title: 'Age'
          }
        },
        onSubmit: function (errors, values) {
        var name = values.name;
        var age = values.age;
        var form_data = $('form').serialize();
        console.log(form_data);
 $.ajax({
        type: "get",
         url:"{{ route('contact.postdata') }}",
        data: { $('form').serialize(), _token: "{{ csrf_token() }}"}, 
        dataType:"json",
        success: function( msg ) {
            alert( "done" );
        }
    });
        }



      });
    </script>
                @elseif($get_search->trip_type === "oneway" and $get_search->pnr_type === "single")
               
                @elseif($get_search->trip_type === "roundtrip" and $get_search->pnr_type === "single")
                
                @elseif($get_search->trip_type === "multicity" and $get_search->pnr_type === "multiple")
               
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
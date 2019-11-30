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
      <div class="row">
            <div class="col-md-12">
                   @if(Session :: has('success'))

  <p class="text-center">{{Session :: get('success') }}</p>


@endif
@if(Session :: has('error'))
<p class="text-center">{{Session :: get('error') }}</p>

@endif
<a href="{{ route("add_create") }}">Add data</a>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>name</td>
                            <td>phone</td>
                            <td>dept</td>
                            <td>edit</td>
                            <td>delete</td>
                          
                        </tr>
                        Total Data: {{ count($all_data) }}
                         @foreach ($all_data as $ad)
                         <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->name }}</td>
                            <td>{{ $ad->phone }}</td>
                            <td> {{$ad->getdept->d_name}} </td>
                            <td><a href="{{ route("guzzle_edit",$ad->id) }}">edit</a></td>
                            <td>
                                 <form action="{{ route("delete_guzzle",$ad->id) }}" method="POST">
                         @csrf
                          @method("DELETE")
                          <input type="submit" class="btn btn-sm btn-danger" value="Delete" />
                                 </form>
                            </td>
                           
                        </tr>
                          @endforeach
                    </table>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>d name</td>
                        </tr>
                        Total Data: {{ count($department) }}
                         @foreach ($department as $ad)
                         <tr>
                            <td>{{ $ad->d_id }}</td>
                            <td>{{ $ad->d_name }}</td>   
                        </tr>
                          @endforeach
                    </table>
               
            </div>
        </div>
</body>
</html>
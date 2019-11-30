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
   @if(Session :: has('success'))

  <p class="text-center">{{Session :: get('success') }}</p>


@endif
@if(Session :: has('error'))
<p class="text-center">{{Session :: get('error') }}</p>

@endif
<a href="{{ route("gData") }}">all data</a>
      <div class="row">
            <div class="col-md-12">
                    <form action="{{ route("add_guzzle") }}" method="POST">
                         @csrf
                    <input type="text" value="" name="a_name" placeholder="Enter name" class="form-control" />
                    <br/>
                    <input type="text" name="a_phone" placeholder="Enter mail" class="form-control" />
                    <br/>
                    <input type="submit" class="btn btn-sm btn-danger" />
                    </form>
               
            </div>
        </div>
</body>
</html>
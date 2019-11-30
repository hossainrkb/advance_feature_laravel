@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
               
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>phone</td>
                            <td>user</td>
                           
                            
                        </tr>
                        Total Data: {{ count($phoneall) }}
                         @foreach ($phoneall as $phone)
                         <tr>
                            <td>{{ $phone->id }}</td>
                            <td>{{ $phone->cell }}</td>
                            <td>{{ $phone->getuser }}</td>
                           
                        
                            
                           
                        </tr>
                          @endforeach
                    </table>
               
            </div>
        </div>
  
@endsection
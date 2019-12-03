@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
               
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>name</td>
                            <td>phone</td>
                          
                        </tr>
                        Total Data: {{ count($advancer) }}
                         @foreach ($advancer as $ad)
                         <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->name }}</td>
                            <td>{{ $ad->phone }}</td>
                           
                        </tr>
                          @endforeach
                    </table>
               
            </div>
        </div>
  
@endsection
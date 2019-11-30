@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
               
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>name</td>
                            <td>phone</td>
                            <td>status</td>
                            <td>dept</td>
                            <td>edit</td>
                        </tr>
                        Total Data: {{ count($advancer) }}
                         @foreach ($advancer as $ad)
                         <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->name }}</td>
                            <td>{{ $ad->phone }}</td>
                            <td>{{ $ad->status ? 'Active':"not Active" }}</td>
                            <td><b>
                               
                           {{$ad->getdept->d_name}} 
                            </b>
                            </td>
                            <td><a href="{{ route("edit",$ad->id) }}">edit</a></td>
                        </tr>
                          @endforeach
                    </table>
               
            </div>
        </div>
  
@endsection
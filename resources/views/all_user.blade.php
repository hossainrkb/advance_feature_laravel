@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
               
                    <table class="table table-bordered">
                        <tr>
                            <td>ID</td>
                            <td>name</td>
                            <td>email</td>
                            <td>phone</td>
                            <td>post</td>
                            <td>role</td>
                            
                        </tr>
                        Total Data: {{ count($userall) }}
                         @foreach ($userall as $user)
                         <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getPHone }}</td>
                            <td>
                                @foreach ($user->getPost as $item)
                                    {{ $item->post }} <hr class="text-primary">
                                @endforeach
                            </td>
                            <td class="">
                                
                                @foreach ($user->getRole as $item)
                                    {{ $item->role_name }} <hr class="text-primary">
                                @endforeach
                            </td>
                        
                            
                           
                        </tr>
                          @endforeach
                    </table>
               
            </div>
        </div>
  
@endsection
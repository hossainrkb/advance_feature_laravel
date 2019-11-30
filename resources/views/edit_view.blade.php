@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-6">
                <h1>EDIT</h1>
                @if (count($errors)>0)
                    @foreach ($errors->all() as $item)
                        <p>{{ $item }}</p>
                    @endforeach

                @endif
                <form action="{{ route("update",$id->id) }}" method="POST" id="hola">
                   @include('form')
                   @method("PATCH")

                </form>
               
                   
               
            </div>
        </div>
@endsection
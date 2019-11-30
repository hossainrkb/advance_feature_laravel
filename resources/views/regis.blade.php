@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-6">
                @if (count($errors)>0)
                    @foreach ($errors->all() as $item)
                        <p>{{ $item }}</p>
                    @endforeach

                @endif
                <form action="{{ route("ad_regis") }}" method="POST" id="hola">
                  @include('form')

                </form>
               
                  {{ now()->format("Y-m-d") }} 
               
            </div>
        </div>
@endsection
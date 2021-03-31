@extends('layouts.main')

@section('content')
<link rel = "stylesheet" type = "text/css" href = "{{ asset('css/bootstrap-3.3.7/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div id="container">   
<div id="header" class="mb-3"> Pilih Forum Mata kuliah</div>

    <div>
        <ul class="ml-0 pl-0">
            @foreach($data as $key => $row)
                <li class="link1">
                    <a href="{{ url('/choseWeek/'.$row->id) }}">
                        <div class="row">
                                <div class="col-10">                        
                                    <div>
                                        {{$row->name}}
                                    </div>
                                    <small>{{substr($row->deskripsi,0,100)}}...</small>

                                </div>
                                <div class="col-2 pt-3">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                        </div>
                        
                        

                    </a>
                </li>
            @endforeach
        </ul>
    </div> 
</div>
@endsection
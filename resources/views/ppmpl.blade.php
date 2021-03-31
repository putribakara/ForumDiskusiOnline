@extends('layouts.main')

@section('content')
<link rel = "stylesheet" type = "text/css" href = "{{ asset('css/bootstrap-3.3.7/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

		<div id="container">
         <button type="button" class="btn btn-primary" onclick="history.back();"> << Back</button>
         <div id="header" class="mb-3 "> Pilih Week untuk Mata Kuliah {{$matakuliah->name}}</div>

		<div class="box1">
            <ul class="m-0 p-0">
                @foreach($data as $key => $row)
                    <li class="link1">
                        <i class="fas fa-comment"></i>&nbsp
                        <a href="{{url('/chat/'.$matakuliah->id.'/'.$row->id)}} ">WEEK {{$row->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
         
        </div>
        @endsection

 
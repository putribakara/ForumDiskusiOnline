@extends('layouts.main')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Forum Diskusi') }} Matakuliah {{@$matakuliah->name}} untuk Week {{@$week->name}}</div>
                <div class="card-body" style="height:500px;">
                    @foreach($chat as $key => $row)
                        <div class="chat-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>

                            @endif
                            <div class="header">
                                <strong style="width: 100px;">{{@$row->name}}</strong>
                                <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>{{$row->create_at}}</small>
                                @if($row->userId == $user->id)
                                    <a href="{{ url('chat/delete') }}/{{$row->id}}/{{$matakuliah->id}}/{{$week->id}}" class="text-white" onclick="return confirm('Apakah Anda Yakin akan menghapusnya?')">
                                        <small><i class="fa fa-trash"></i></small>
                                    </a>
                                @endif


                            </div>
                        </div>
                        <div class="{{ $row->userId == $user->id ? 'chatcolor' : 'chatcolor2' }}">
                            {{ $row->chat }}
                            @if($row->attacment)
                                <a href="{{ url('data_file/'.$row->attacment) }}" target="blank"><i class="fa fa-paperclip" style="padding: 10px;"></i> {{$row->attacment}}</a>
                            @endif
                        </div>
                        
                    @endforeach
                </div>
            </div>
                <form method="post" action="{{ url('chat/submit') }}" enctype="multipart/form-data">
                    <div class="panel-footer">
                        <div class="input-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_mat" value="{{ $matakuliah->id }}">
                                <input type="hidden" name="id_week" value="{{ $week->id }}">
                                <input type="file" name="attacment" id="attacment" style="display:none">


                                <input type="" class="form-control" placeholder="Ketik disini....." name="chat">
                                <i class="fa fa-paperclip" style="padding: 10px;" onclick="choseFile()"></i>
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" type="submit">Kirim</button>
                                </span>
                        </div>
                    </div>
                </form>

            </div>
            <script>
                function choseFile(){
                    $('#attacment').click();
                }
            </script>
@endsection


<style type="text/css">
    .chatcolor{
        width:500px;
        background-color: #264f18;
        padding: 10px;
        border-bottom-left-radius: 20px;
        border-top-right-radius: 20px;
        margin-top: 8;
       margin-bottom: 10px;
    }


    .chatcolor1{
        width:500px;
        background-color: #32ed3b;
        padding: 10px;
        border-bottom-left-radius: 20px;
        border-top-right-radius: 20px;
        margin-top: 8;
        margin-bottom: 10px;
    }

    .chatcolor2{
        width:500px;
        background-color: #408243;
        padding: 10px;
        border-bottom-left-radius: 20px;
        border-top-right-radius: 20px;
        margin-top: 8;
        margin-bottom: 10px;
    }

</style>
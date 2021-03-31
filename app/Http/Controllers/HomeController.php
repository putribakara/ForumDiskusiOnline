<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function submit(Request $request)
    {
        $input = $request->input();
        $userRole = Auth::user();
		$file = $request->file('attacment');
        $nameFile = rand();
        $data = [
            'chat' => trim($input['chat']),
            'id_mat' => @$input['id_mat'],
            'id_week' => @$input['id_week'],
            'id_user' =>  $userRole->id,
            'attacment' => ''
        ];

        if($file){
            $data['attacment'] = $nameFile.$file->getClientOriginalName();
            $tujuan_upload = 'data_file';
            $file->move($tujuan_upload,$nameFile.$file->getClientOriginalName());            
        }
        DB::table('chat')->insert($data);
        return Redirect::to('/chat/'.$input['id_mat'].'/'.$input['id_week'])->with('info',"submited");

    }
    
    public function deleteChat($id,$id_mat,$idweek)
    {
        $delete = "DELETE FROM  chat WHERE `id`='" . $id . "' LIMIT 1";
        DB::delete($delete);
        return Redirect::to('/chat/'.$id_mat.'/'.$idweek)->with('info',"Chat Sudah terhapus");

    }

    public function chat($idMat,$idWeek)
    {
        $matakuliah = DB::table('mata_kuliah')
        ->where('id',$idMat)
        ->first();
        $week = DB::table('week')
        ->where('id',$idWeek)
        ->first();
        $user = Auth::user();


        $chat = DB::table('chat')
        ->select('chat.*','users.name','users.id as userId')
        ->where('id_mat',$idMat)
        ->where('id_week',$idWeek)
        ->join('users', 'users.id', '=', 'chat.id_user')
        ->get();

        
        $data = DB::table('week')->get();
        return view('chat')->with(['chat'=>$chat,'week' => $week,'user'=>$user,'matakuliah'=>$matakuliah ]);
    }

    public function choseweek($id)
    {
        $matakuliah = DB::table('mata_kuliah')
        ->where('id',$id)
        ->first();

        $data = DB::table('week')->get();
        return view('ppmpl')->with(['data' => $data,'matakuliah'=>$matakuliah ]);
    }

    public function index()
    {
        $user = Auth::user();
        if(!$user){
            return Redirect::to('/login');
        }
            
        $data = DB::table('mata_kuliah')->get();
        return view('Dashboard')->with(['data' => $data]);
    }
}

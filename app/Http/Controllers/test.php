<?php

namespace App\Http\Controllers;

use App\Models\Invited;
use App\Models\Registered;
use App\Models\season;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class test extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inviteds = User::get();
        if(request()->ajax()){
            return datatables()
                ->of($inviteds)
                   ->addColumn('sent_at', function($data){
                    return $data->created_at;
                })   ->editColumn('season', function($data){
                    return season::findorfail( $data->season)->name;
                })
                ->addColumn('action', function($data){
                     $button = '<i data="'.$data->id.'" title="تعديل" class="btn btn-primary icons_added edit bx bxs-edit font-size-20 align-middle mr-1">gg</i>';
                    $button .= '&nbsp; &nbsp;';
                    $button .= '<i data="'.$data->id.'" title="استعراض" class="icons_added view bx bx-search-alt-2 font-size-20 align-middle mr-1">gggg</i>';
                    $button .= '&nbsp; &nbsp;';
                    $button .= '<i data="'.$data->id.'" title="حذف" class="icons_added delete bx bx-x font-size-20 align-middle mr-1">ddd</i>';
                    $button .= '&nbsp; &nbsp;';
                    $button .= '<i data="'.$data->id.'" title="طباعة بدون خلفية" class="icons_added print bx bx-printer font-size-20 align-middle mr-1">dfadg</i>';
                    $button .= '&nbsp; &nbsp;';
                    $button .= '<i data="'.$data->id.'" title="طباعة مع خلفية" class="icons_added print_back bx bxs-printer font-size-20 align-middle mr-1" style="color:#66c">dfdg</i>';
                    return $button;
                })
                ->rawColumns(['action', 'sent_at','season'])
                ->make(true);
        }
        return view('test',['seasons'=>season::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function p($id){
    $user= User::findorfail($id);
    return view('test3',['user'=>$user]);
}
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {if(request()->hidden_id !=null )
    {
        $t=User::findorfail(request()->hidden_id);
    $t->name= request()->name;
$t->save();
return response()->json(['success'=>'done']);
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $data=User::findorfail($id);
        return response()->json(['data' => $data]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

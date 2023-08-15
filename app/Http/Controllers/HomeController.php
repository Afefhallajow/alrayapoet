<?php

namespace App\Http\Controllers;
use App\Models\adminseason;
use App\Models\settings;
use App\Models\temp;

use Illuminate\Support\Facades\Date;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Registered;
use App\Models\EvulatorUser;
use App\Models\RefreeUser;
use App\Models\FinalResult;
use App\Models\season;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Auth;
use DataTables;
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
    public function index()
    {       $setting=settings::all();
        $rate =       $setting[0]->therate;
if(\Illuminate\Support\Facades\Auth::user()->type==5) {
    $season = \Illuminate\Support\Facades\Auth::user()->season;
}else {
    $season = settings::findorfail(1)->activeseason;
}
$needEv = 0;
        $doneEv = 0;
        $counteva=settings::findorfail(1);
        $refarray=User::where('season',$season)->where('type',4)->get();
        $evarray=User::where('season',$season)->where('type',2)->get();
        $counteva->countev=count($evarray);
        $counteva->save();
        if(Auth::user()->id == 2){
            $needEv =  Registered::whereNull('ev1_percent')->count();
            $doneEv =  Registered::whereNotNull('ev1_percent')->count();
        }
        else   if(Auth::user()->id == 3){
            $needEv =  Registered::whereNull('ev2_percent')->count();
            $doneEv =  Registered::whereNotNull('ev2_percent')->count();
        }
        else if(Auth::user()->id == 4){
            $needEv =  Registered::whereNull('ev3_percent')->count();
            $doneEv =  Registered::whereNotNull('ev3_percent')->count();
        }
        else{
            if(\Illuminate\Support\Facades\Auth::user()->type==2) {
                $rr = Registered::where('season', \Illuminate\Support\Facades\Auth::user()->season)->get();
                $ss = EvulatorUser::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->get();

                $doneEv = count($ss);
                $needEv = count($rr) - count($ss);
            }
            if(\Illuminate\Support\Facades\Auth::user()->type==4) {
                $rr = Registered::where('season', \Illuminate\Support\Facades\Auth::user()->season)->get();
                $ss = RefreeUser::where('ref_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
                if($season != 1) {
                    $dataa = Registered::where('season', \Illuminate\Support\Facades\Auth::user()->season )->get();
                    $Evalator = User::where('season',  \Illuminate\Support\Facades\Auth::user()->season)->where('type', 2)->get();
                    $numberofEvalator = count($Evalator);
                    $avg = array();
                    $topMembersId = array();
//////
//                    $temp= EvulatorUser::where('registered_id',485)->where('user_id',29)->get();
                    // echo $temp[0]->percent;
                    foreach ($dataa as $d) {
                        $memberavg = 0;
                        for ($i = 0; $i < $numberofEvalator; $i++) {
                            $temp = EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first();
                            if ($temp != null) {
                                $memberavg += EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first()->percent;
                            }

                        }
                        $v = ((float)$memberavg / $numberofEvalator);
                        $vv = number_format((float)$v, 2, '.', '');


                        if ($vv > $rate)
                            $avg[$d->id] = $vv;

                    }
                    arsort($avg);
///////////////////////////////////////

                    $needEv = count($avg)-count($ss);

                }

                $doneEv = count($ss);
            }

        }

        $refreeReggg = RefreeUser::select('registered_id')->whereNotNull('ref3')->get();

        if($season != 1) {
            $dataa = Registered::where('season', $season)->get();
            $Evalator = User::where('season', $season)->where('type', 2)->get();
            $numberofEvalator = count($Evalator);
            $avg = array();
            $topMembersId = array();
//////
//                    $temp= EvulatorUser::where('registered_id',485)->where('user_id',29)->get();
            // echo $temp[0]->percent;
            foreach ($dataa as $d) {
                $memberavg = 0;
                for ($i = 0; $i < $numberofEvalator; $i++) {
                    $temp = EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first();
                    if ($temp != null) {
                        $memberavg += EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first()->percent;
                    }

                }
                $v = ((float)$memberavg / $numberofEvalator);
                $vv = number_format((float)$v, 2, '.', '');
                $reg = Registered::findorfail($d->id);
                $reg->ev1_percent = $vv;
                $reg->save();


                if ($vv > $rate)
                    $avg[$d->id] = $vv;

            }
            arsort($avg);
///////////////////////////////////////
            foreach ($avg as $a => $value) {
                $iiii = 0;

                array_push($topMembersId, $a);
                $iiii++;
            }

        }
        else {
            $dataa = Registered::where('season', $season)->get();
            $avg = array();
            $topMembersId = array();
            foreach ($dataa as $d) {
                $first = ($d->ev1_percent != null) ? $d->ev1_percent : 0;
                $second = ($d->ev2_percent != null) ? $d->ev2_percent : 0;
                $third = ($d->ev3_percent != null) ? $d->ev3_percent : 0;

                $v = ((float)$first + (float)$second + (float)$third) / 3;
                $vv = number_format((float)$v, 2, '.', '');
                if ($vv > 59)
                    $avg[$d->id] = $vv;

            }

            arsort($avg);
            $iiii = 0;
            foreach ($avg as $a => $value) {
                if ($iiii == 92) {
                    break;
                }
                array_push($topMembersId, $a);
                $iiii++;
            }

            array_push($topMembersId, 160);
            array_push($topMembersId, 217);
            array_push($topMembersId, 310);
            array_push($topMembersId, 452);
            array_push($topMembersId, 455);
            array_push($topMembersId, 471);

        }

        if(Auth::user()->id == 6){
            $refreeReggg = RefreeUser::select('registered_id')->whereNotNull('ref1')->get();
            $needEv =  Registered::whereIn('id',$topMembersId)->whereNotIn('id',$refreeReggg)->count();
            $doneEv =  Registered::whereIn('id',$topMembersId)->whereIn('id',$refreeReggg)->count();
        }
        elseif(Auth::user()->id == 7){
            $refreeReggg = RefreeUser::select('registered_id')->whereNotNull('ref2')->get();
            $needEv =  Registered::whereIn('id',$topMembersId)->whereNotIn('id',$refreeReggg)->count();
            $doneEv =  Registered::whereIn('id',$topMembersId)->whereIn('id',$refreeReggg)->count();
        }
        elseif(Auth::user()->id == 8){
            $refreeReggg = RefreeUser::select('registered_id')->whereNotNull('ref3')->get();
            $needEv =  Registered::whereIn('id',$topMembersId)->whereNotIn('id',$refreeReggg)->count();
            $doneEv =  Registered::whereIn('id',$topMembersId)->whereIn('id',$refreeReggg)->count();
        }
        else{
            if (\Illuminate\Support\Facades\Auth::user()->tybe==4)
            {
                $rr=Registered::where('season',\Illuminate\Support\Facades\Auth::user()->season)->get();
                $ss=RefreeUser::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();

                $doneEv =  count($ss);
                $needEv =  count($rr)-count($ss);

            }}


        $all = Registered::where('season',$season)-> count();
        $accept = count($avg);
        $refuse = Registered::where('season',$season)->where('status',2)->count();
        $users = User::where('season',$season)->count();

        $data['bshaer_need'] = Registered::whereNull('ev1_percent')->count();
        $data['bshaer_done'] = Registered::whereNotNull('ev1_percent')->count();
        $data['bshaer'] = [$data['bshaer_need'],$data['bshaer_done']];

        $data['mmdoh_need'] = Registered::whereNull('ev2_percent')->count();
        $data['mmdoh_done'] = Registered::whereNotNull('ev2_percent')->count();
        $data['mmdoh'] = [$data['mmdoh_need'],$data['mmdoh_done']];

        $data['mshael_need'] = Registered::whereNull('ev3_percent')->count();
        $data['mshael_done'] = Registered::whereNotNull('ev3_percent')->count();
        $data['mshael'] = [$data['mshael_need'],$data['mshael_done']];


        $khalid_refree_regg = RefreeUser::select('registered_id')->whereNotNull('ref1')->get();
        $data['khaild_need'] =  Registered::whereIn('id',$topMembersId)->whereNotIn('id',$khalid_refree_regg)->count();
        $data['khaild_done'] =  Registered::whereIn('id',$topMembersId)->whereIn('id',$khalid_refree_regg)->count();
        $data['khalid'] = [$data['khaild_need'],$data['khaild_done']];


        $nasser_refree_regg = RefreeUser::select('registered_id')->whereNotNull('ref2')->get();
        $data['nasser_need'] =  Registered::whereIn('id',$topMembersId)->whereNotIn('id',$nasser_refree_regg)->count();
        $data['nasser_done'] =  Registered::whereIn('id',$topMembersId)->whereIn('id',$nasser_refree_regg)->count();
        $data['nasser'] = [$data['nasser_need'],$data['nasser_done']];


        $naif_refree_regg = RefreeUser::select('registered_id')->whereNotNull('ref3')->get();
        $data['naif_need'] =  Registered::whereIn('id',$topMembersId)->whereNotIn('id',$naif_refree_regg)->count();
        $data['naif_done'] =  Registered::whereIn('id',$topMembersId)->whereIn('id',$naif_refree_regg)->count();
        $data['naif'] = [$data['naif_need'],$data['naif_done']];


        $data['saudia'] = Registered::where('season',$season)->where('nationality','سعودي')->count();
        $data['syria'] = Registered::where('season',$season)->where('nationality','سوري')->count();
        $data['egypt'] = Registered::where('season',$season)->where('nationality','egyptian')->count();
        $data['kwait'] = Registered::where('season',$season)->where('nationality','كويتي')->count();
        $data['qatar'] = Registered::where('season',$season)->where('nationality','قطري')->count();
        $data['oman'] = Registered::where('season',$season)->where('nationality','عماني')->count();
        $data['bahreen'] = Registered::where('season',$season)->where('nationality','بحريني')->count();
        $data['jordan'] = Registered::where('season',$season)->where('nationality','أردني')->count();
        $data['iraq'] = Registered::where('season',$season)->where('nationality','عراقي')->count();
        $data['lebia'] = Registered::where('season',$season)->where('nationality','ليبي')->count();
        $data['jazaier'] = Registered::where('season',$season)->where('nationality','جزائري')->count();
        $data['paletine'] = Registered::where('season',$season)->where('nationality','فلسطيني')->count();
        $data['countries'] = [$data['saudia'],$data['syria'],$data['egypt'],$data['kwait'],$data['qatar'],$data['oman'],$data['bahreen'],
            $data['jordan'],$data['iraq'],$data['lebia'],$data['jazaier'],$data['paletine']
        ];


        $data['male'] = Registered::where('season',$season)->where('gender','ذكر')->count();
        $data['female'] = Registered::where('season',$season)->where('gender','!=','ذكر')->count();
        $data['gender'] = [$data['male'],$data['female']];











        $agereg = Registered::where('season', $season)->get();

        $data['lesstwenty'] =0;
        $data['abovetwenty'] =0;
        $data['abovethirty'] =0;
        $data['abovefourty'] =0;
        $data['otherage'] =0;

        foreach ($agereg as $died)
        {
            $now=Date::now();

            $age = $died->age;
            $time = strtotime($age);
            $newformat = date('Y', $time);

            if($newformat < 1400)
            {
                $Year = floor( $newformat * 0.97 + 622);


            }else{
                $Year =$newformat;
            }
            $died->age=($now->year)-$Year;


            if($died->age <20)
            {  $data['lesstwenty']++;

            }
            elseif($died->age >=20 && $died->age <30)
            {    $data['abovetwenty']++;
            }
            elseif($died->age >=30 && $died->age <40)
            {  $data['abovethirty']++;
            }
            elseif($died->age >=40 && $died->age <50)
            {        $data['abovefourty']++;
            }
            else{
                $data['otherage']++;

            }

        }
        $data['age']=[$data['lesstwenty'], $data['abovetwenty'],$data['abovethirty'],  $data['abovefourty'], $data['otherage']];
















        $data['FinalResult'] = FinalResult::where('season',$season)->count();
        foreach ($refarray as $ref) {
            $rr = Registered::where('season', \Illuminate\Support\Facades\Auth::user()->season)->get();
            $ss = RefreeUser::where('ref_id', $ref->id)->get();
            if ($season != 1) {
                $dataa = Registered::where('season', $season)->get();
                $Evalator = User::where('season', $season)->where('type', 2)->get();
                $numberofEvalator = count($Evalator);
                $avg = array();
                $topMembersId = array();
//////
//                    $temp= EvulatorUser::where('registered_id',485)->where('user_id',29)->get();
                // echo $temp[0]->percent;
                foreach ($dataa as $d) {
                    $memberavg = 0;
                    for ($i = 0; $i < $numberofEvalator; $i++) {
                        $temp = EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first();
                        if ($temp != null) {
                            $memberavg += EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first()->percent;
                        }

                    }
                    $v = ((float)$memberavg / $numberofEvalator);
                    $vv = number_format((float)$v, 2, '.', '');


                    if ($vv > $rate)
                        $avg[$d->id] = $vv;

                }
                arsort($avg);
///////////////////////////////////////

                $needref = count($avg)-count($ss);

            }else
                $needref =0;

            if (count($ss) != 0)
                $doneref = count($ss) ;
            else
                $doneref = count($ss) ;
            $data[$ref->name.'need'] = $needref;
            $data[$ref->name."done"] = $doneref;
            $data[$ref->name] = [$data[$ref->name.'need'], $data[$ref->name.'done']];
        }
        foreach ($evarray as $ev){
            $aa=Registered::where('season',$season)->get();
            $ss=EvulatorUser::where('user_id',$ev->id)->get();
            $need=count($aa)-count($ss);
            $done=count($ss);
            $data[$ev->name.'need'] = $need;
            $data[$ev->name.'done'] = $done;
            $data[$ev->name] = [$data[$ev->name.'need'],$data[$ev->name.'done']];

        }
        $seasons=season::all();
        return view('home',compact('all','evarray','refarray','accept','refuse','users','needEv','doneEv','data','seasons'));
    }
    public function add_new_user(){
        $seasons=season::all();
        $users=User::all();

        if(Auth::user()->can('view user'))
            return view('admin.add_new_user',compact('seasons','users'));
        else
            return redirect()->back();
    }

    public function getAllUsers(Request $request){

        if(\Illuminate\Support\Facades\Auth::user()->type==1)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;


        if ($request->ajax()) {
            $data = User::get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('type', function($row){
                    if($row->type == 1)
                        return 'Admin';
                    if($row->type == 2)
                        return 'Evaluator';
                    if($row->type == 3)
                        return 'View Only';
                    if($row->type == 4)
                        return 'Referee';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function save_add_new_user(Request $request)
    {$user=User::where('email',$request->email)->first();
        if($user == null)
        {        if ($request->active  == 1 ) {
            $status = 1;
            $validetime = null;

        } elseif ($request->active ==0 ) {
            $status = 0;
            $validetime = null;
        } else{
            $status = 1;

            $validetime = $request->validetime;
        }
            $new_user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type,
                'season' => $request->sea,
                'status'=>$status,
                'validetime'=>$validetime

            ]);
if($new_user->type ==1)
{
    $new_user->givePermissionTo('view register');
    $new_user->givePermissionTo('update register');
    $new_user->givePermissionTo('delete register');
    $new_user->givePermissionTo('add user');
    $new_user->givePermissionTo('view user');
    $new_user->givePermissionTo('update user');
    $new_user->givePermissionTo('delete user');
    $new_user->givePermissionTo('delete final');
    $new_user->givePermissionTo('delete season');
    $new_user->givePermissionTo('view final');
    $new_user->givePermissionTo('view setting');
    $new_user->givePermissionTo('view refree');
    $new_user->givePermissionTo('add final');
    $new_user->givePermissionTo('add season');
    $new_user->givePermissionTo('update setting');

}
            if( $new_user->type ==3)
            {
                $new_user->givePermissionTo('view register');
                $new_user->givePermissionTo('view user');
                $new_user->givePermissionTo('view final');
                $new_user->givePermissionTo('view setting');
                $new_user->givePermissionTo('view refree');



            }
                if( $new_user->type ==5)
            {
                $addse =new adminseason();
                $addse->user_id=$new_user->id;
                $addse->season_id=$request->sea;
                $addse->save();

                $new_user->givePermissionTo('view register');
                $new_user->givePermissionTo('update register');
                $new_user->givePermissionTo('view user');
                $new_user->givePermissionTo('view final');
                $new_user->givePermissionTo('view setting');
                $new_user->givePermissionTo('view refree');





            }

            toastr()->success('تمت العملية بنجاح');
            try {
                $data = array('memberEmail' => $request->email,'id'=>$new_user->id,'pass'=>$request->password);
                Mail::send('email.createuser', $data, function ($m) use ($data) {
                    $m->to($data['memberEmail'])->subject('تم انشاء الحساب بنجاح!');
                });
            }catch (\Exception $e) {

            }
                return redirect()->to(route('add_new_user'));
        }
        else
        {
            return redirect()->to(route('add_new_user'))->with('error', 'عنوان البريد الالكتروني موجود مسبقاً.');;
        }}
    public function save_edit_user(Request $request,$id){
        $user=User::where('id',$id)->first();
        if($user->status ==1) {
            if ($request->password) {
if($user->type==2)
{if($request->type != $user->type)
if(    EvulatorUser::where('user_id',$user->id)->get())
    {
        flash()->addError('لا يمكنك تعديل نوع المستخدم.', 'خطأ!');
        return redirect()->to(route('add_new_user'));
    }
}
                if($user->type==4)
                {if($request->type != $user->type)
                    if(    RefreeUser::where('ref_id',$user->id)->get())
                    {
                        flash()->addError('لا يمكنك تعديل نوع المستخدم.', 'خطأ!');
                        return redirect()->to(route('add_new_user'));
                    }
                }

                $data = array('memberEmail' => $user->email, 'pass' => $request->password);
                Mail::send('email.resetpass', $data, function ($m) use ($data) {
                    $m->to($data['memberEmail'])->subject(' تعديل كلمة السر !');
                });
                $updateRecord = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'type' => $request->type,
                    'season' => $request->sea,

                ]);
            } else {
                if($user->type==2)
                {if($request->type != $user->type)
                    if(EvulatorUser::where('user_id',$user->id)->first())
                    {
                        flash()->addError('  لا يمكنك تعديل نوع المستخدم فقد قام بتقييم بعض المشتركين.', 'خطأ!');
                        return redirect()->to(route('add_new_user'));
                    }
                }
                if($user->type==4)
                {if($request->type != $user->type)
                    if(    RefreeUser::where('ref_id',$user->id)->first())
                    {
                        flash()->addError(' لا يمكنك تعديل نوع المستخدم فقد قام بتأهيل بعض المشتركين.', 'خطأ!');
                        return redirect()->to(route('add_new_user'));
                    }
                }





                $updateRecord = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'type' => $request->type,
                    'season' => $request->sea,

                ]);

            }
            if($request-> addseason != 0)
            {
                $addse =new adminseason();
                $addse->user_id=$user->id;
                $addse->season_id=$request->addseason;
                $addse->save();
            }

            toastr()->success('تمت العملية بنجاح');
            return redirect()->to(route('add_new_user'));
        }   else{
            toastr()->error('يجب تفعيل الحساب');

            return redirect()->to(route('add_new_user'));

        }
    }
public function resetpass($id){
$user=User::findorfail($id);
        return view('resetuserpass',['user'=>$user]);
}
    public function resetpass1(Request $request){
        $user=User::findorfail($request->id);
        $user->password=Hash::make($request->password);

        $user->save();
toastr()->success('تمت');
        return view('resetuserpass',['user'=>$user]);
    }

    public function delete_user($id)
    {


$temp =       User::where('id',$id)->first();
        EvulatorUser::where('user_id',$id)->delete();
        RefreeUser::where('ref_id',$id)->delete();
       $temp->delete();
        toastr()->success('تمت العملية بنجاح');
        return redirect()->to(route('add_new_user'));
    }
}


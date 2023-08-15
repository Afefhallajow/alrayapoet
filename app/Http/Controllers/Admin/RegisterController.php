<?php

namespace App\Http\Controllers\Admin;

use App\Exports\reg;
use App\Models\user_rigester_show;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Gif\Image;
use UltraMsg\WhatsAppApi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\settings;
use Illuminate\Support\Facades\Date;

use App\Models\Registered;
use App\Models\EvulatorUser;
use App\Models\RefreeUser;
use App\Models\season;
use App\Models\temp;

use App\Models\FinalResult;
use DB;
use Auth;
use Session;
use Storage;
use DataTables;
use function PHPUnit\Framework\isEmpty;

class RegisterController extends Controller
{
    public function __construct()
    {

        $this->season=0;}

    /**
     * RegisterController constructor.
     */


    public function newgenerate_link_view($id)
    {
        return view('newgenerate_link_view',['seasons'=>season::all()]);
    }

    public function newgenerate_link(Request $request,$id)
    {
        $token = Str::random(40);
        $member = Registered::where('id',$id)->update([
            'random_token' => $token,
            'reupload'=>1
        ]);

        $m = Registered::where('id',$id)->first();

        $link = url('/evalution'.'/'.$token);
        $data = array('memberEmail' => $m->email,'link' => $link,'note' => $request->note);

        Mail::send('email.reUpload',$data,function($m) use($data){
            $m->to($data['memberEmail'])->subject('تعديل المعلومات!');
        });
        toastr()->success('تمت بنجاح');

        return redirect()->to(route('get_registered','all'));

    }


    public function newall_participants(Request $request){
// if ($request->ajax()) {
        if(\Illuminate\Support\Facades\Auth::user()->type==1 || \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;

        $data = FinalResult::where('season',$season)->where('update',1)->get();
        $ids = array();
        foreach($data as $d)
        {
            array_push($ids,$d->registered_id);
        }

        $dataa = Registered::whereIn('id',$ids)->get();
        $evas=User::where('season',$season)->where('type',2)->get();

        if($evas != null )
            for ($i=0;$i<count($evas);$i++)
            {for ($j=0;$j<count($dataa);$j++)
            {$bool =0;
                foreach ($dataa[$j]->evas as $ev )
                {if($ev->user_id==$evas[$i]->id)
                {$bool=1;
                    $dataa[$j][$i]=$ev->percent;
                }}
                if($bool ==0)
                {
                    $dataa[$j][$i]='-';
                }
            }

            }
        $now=Date::now();
        foreach ($dataa as $d) {

            $age = $d->age;
            $time = strtotime($age);
            $newformat = date('Y', $time);

            if($newformat < 1400)
            {
                $Year = floor( $newformat * 0.97 + 622);


            }else{
                $Year =$newformat;
            }
            $d->age=($now->year)-$Year;
        }


        return Datatables::of($dataa)
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
// }
    }


    public function newparticipants(){

        if(\Illuminate\Support\Facades\Auth::user()->type==1 || Auth::user()->type == 5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;


        $seasons=season::all();
        $evas=User::where('season',$season)->where('type',2)->get();
        return view('admin.participants.new',compact('seasons','evas'));
    }




    public function showevalution($token)
{
    $member = Registered::where('random_token',$token)->first();
    if($member)
        return view('evalution.form',['token'=>$token]);
    else
        return abort(403);
}




     function showvideo($id)
     {$temp=new user_rigester_show();

     $temp->user_id=\Illuminate\Support\Facades\Auth::user()->id;
         $temp->register_id =$id;
         if(!user_rigester_show::where('user_id',$temp->user_id)->where('register_id',$temp->register_id)->first())
             $temp->save();
         return redirect()->to('/storage/videos/'.Registered::findorfail($id)->video);
     }
    protected function customWordCount($content_text)
    {
        $resultArray = explode(' ',trim($content_text));
        foreach ($resultArray as $key => $item)
        {
            if (in_array($item,["|",";",".","-","=",":","{","}","[","]","(",")"]))
            {
                $resultArray[$key] = '';
            }
        }

        $resultArray = array_filter($resultArray);
        return count($resultArray);
    }


    public function test(Request $request )
    {$Arabic = new \I18N_Arabic('Glyphs');
        $img = Image::make(public_path('srfcertificate.jpg'));

        $text  = $Arabic->utf8Glyphs('عفيف fsdgsdgsgs');
        if($this->customWordCount($text) >= 5) $namePositionX = 900;
        else if($this->customWordCount($text) == 4) $namePositionX = 900;
        else if($this->customWordCount($text) == 3) $namePositionX = 900;
        else $namePositionX = 1000;

        $img->text($text, 750, 750, function($font) {
            $font->file(public_path('NotoSansArabic-Bold.ttf'));

            $font->size(75);
            $font->color('#014a97');
            $font->align(1500);
            $font->valign(1500);
        });

        $data = [
            'imageLink' => '2134.jpeg',
            'url' => ''
        ];

        $img->save(\public_path('2134'.'.jpeg'));
        $pdf = PDF::loadView('test1', $data
            );

       return $pdf->download('afef.pdf');
//   return view('test1');
//        return view('test1');
return $request;
        //return new reg();
    }
public function export()
{
    return Excel::download( new reg(),'شاعر الراية.xlsx');
}

    public function addnewseason(Request $request)
    {   $temp=settings::all();
        $temp=settings::all();
        $season=new season();
        $season->name=$request->name;
        $season->save();
        return redirect()->route('home');
    }
    public function deleteseason(Request $request)
    {
        $season=season::findorfail($request->name);
User::where('season',$season->id)->delete();
$reg=Registered::where('season',$season->id)->get();
foreach ($reg as $re)
{$id=$re->id;
    EvulatorUser::where('registered_id',$id)->delete();
    RefreeUser::where('registered_id',$id)->delete();
    FinalResult::where('registered_id',$id)->delete();

    $temp=Registered::findorfail($id);

    Storage::disk('public')->delete('images/'.$temp->image);
    Storage::disk('public')->delete('videos/'.$temp->video);
    Storage::disk('public')->delete('poems/'.$temp->image);

}
        $season->delete();
toastr()->success('');
        return redirect()->route('settings');
    }


    public function settings()
    {   $temp=settings::all();
        return view('admin.settings',['user'=>$temp[0],'seasons'=>season::all()]);
    }
    public function updatsettings(Request $request)
    {
        $setting=settings::findorfail($request->id);


        if($request->rate==null)
        {
            $setting->activeseason=$request->active;
            $evarray=User::where('season',$setting->activeseason)->where('type',2)->get();
            $setting->countev=count($evarray);

            $setting->save();
        }else{
            $setting->therate=$request->rate;
            $evarray=User::where('season',$setting->activeseason)->where('type',2)->get();
            $setting->countev=count($evarray);
$ref= RefreeUser::where('season',$setting->activeseason)->get();
$data =array();
foreach ($ref as $r)
{$sum=0;
    $Reg=Registered::findorfail($r->registered_id);
foreach ($Reg->evas as $e)
{$sum+= $e->percent;}
$sum=$sum/count($evarray);
if($sum < $request->rate)
    array_push($data,$Reg);
}
            foreach ($data as $d)
            {
                RefreeUser::where('registered_id',$d->id)->delete();
            }

          $setting->save();

        }
        toastr()->success('تمت العملية بنجاح');
        return redirect()->to(route('settings'));
    }

    public function updatsettings1(Request $request)
    {
        $setting=settings::findorfail($request->id);
        if($request->refreemax !=null)
        {
            $setting->refreemax=$request->refreemax;
            $setting->save();
        }
        toastr()->success('تمت العملية بنجاح');
        return redirect()->to(route('settings'));
    }

    public function updatwhatsapp(Request $request)
    {
        $setting=settings::findorfail($request->id);
$setting->raw1=$request->raw1;
        $setting->raw2=$request->raw2;
        $setting->instance=$request->instance;
        $setting->token=$request->token;

        if($request->has('image'))
        {   $file1 = $request->file('image');

            $name=$file1->getClientOriginalName();
            \Illuminate\Support\Facades\Storage::disk('public')->put('back/'.$name,file_get_contents($file1));

            $setting->image=$name;
        }
        $setting->save();

        echo 111;
        toastr()->success('تمت العملية بنجاح');
        return redirect()->to(route('settings'));
    }


    public function checkseason1($id)
    {         DB::table('temps')->delete();
        $temp1=new temp();

        if (\Illuminate\Support\Facades\Auth::user()->type==1||\Illuminate\Support\Facades\Auth::user()->type==5)
            $temp1->season_id= $id;
        else{
            return   $temp1->season_id =\Illuminate\Support\Facades\Auth::user()->season;
        }
        $temp1->save();
        $temp2=temp::all();
        return $temp2[0]->season_id;
    } public function checkseason(Request $request)
{
    if (\Illuminate\Support\Facades\Auth::user()->type==1)
        return   $season=$request->season;
    else{
        return    $season=\Illuminate\Support\Facades\Auth::user()->season;
    }
}


    public function get_registered($regStatus,Request $request){

        if(\Illuminate\Support\Facades\Auth::user()->type==1 || Auth::user()->type == 5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;



        $seasons=season::all();
$evas=User::where('season',$season)->where('type',2)->get();
        if($regStatus == 'all'){
            if(Auth::user()->can('view register'))
                return view('admin.registered.index',compact('seasons','evas'));
        }

        if($regStatus == 'accept'){
            if(Auth::user()->type == 1 || Auth::user()->type == 3|| Auth::user()->type == 5)
                return view('admin.registered.index_accept',compact('seasons','evas'));
        }

        if($regStatus == 'refuse'){
            if(Auth::user()->type == 1 || Auth::user()->type == 3|| Auth::user()->type == 5)
                return view('admin.registered.index_refuse',compact('seasons'));
        }

        return '404';

    }


    public function getAllRegistereds(Request $request,$regStatus){
        if(\Illuminate\Support\Facades\Auth::user()->type==1 || Auth::user()->type == 5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;
        if (1) {
            $rate=settings::findorfail(1)->therate;


            if($regStatus == 'all'){
                $data = Registered::where('season',$season)->get();

                $now=Date::now();
                foreach ($data as $d) {

                    $age = $d->age;
                    $time = strtotime($age);
                    $newformat = date('Y', $time);

                    if($newformat < 1400)
                    {
                        $Year = floor( $newformat * 0.97 + 622);


                    }else{
                        $Year =$newformat;
                    }
                    $d->age=($now->year)-$Year;
                }

            }

            if($regStatus == 'accept'){
                if($season==1) {

                    $dataa = Registered::where('season', $season)->get();
                    $avg = array();
                    $topMembersId = array();
                    foreach ($dataa as $d) {
                        $first = ($d->ev1_percent != null) ? $d->ev1_percent : 0;
                        $second = ($d->ev2_percent != null) ? $d->ev2_percent : 0;
                        $third = ($d->ev3_percent != null) ? $d->ev3_percent : 0;

                        $v = ((float)$first + (float)$second + (float)$third) / 3;
                        $vv = number_format((float)$v, 2, '.', '');
                        if ($vv > $rate)
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

                    $data = Registered::where('season', $season)->whereIn('id', $topMembersId)->get();
                }else{
                    $dataa = Registered::where('season',$season)->get();
                    $Evalator=User::where('season',$season)->where('type',2)->get();
                    $numberofEvalator = count($Evalator);
                    $avg = array();
                    $topMembersId = array();
//////
                    $temp= EvulatorUser::where('registered_id',485)->where('user_id',29)->get();
                    // echo $temp[0]->percent;
                    foreach($dataa as $d){
                        $memberavg=0;
                        for($i=0;$i<$numberofEvalator;$i++)
                        {$temp= EvulatorUser::where('registered_id',$d->id)->where('user_id',$Evalator[$i]->id)->first();
                            if($temp != null)
                            {
                                $memberavg += EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first()->percent;
                            }

                        }
                        $v =((float) $memberavg /$numberofEvalator);
                        $vv = number_format((float)$v, 2, '.', '');
                        $reg=Registered::findorfail($d->id);
                        $reg->ev1_percent=$vv;
                        $reg->save();


                        if($vv > $rate)
                            $avg[$d->id] = $vv;

                    }
                    arsort($avg);
///////////////////////////////////////
                    foreach($avg as $a => $value){
                        $iiii=0;

                        array_push($topMembersId,$a);
                        $iiii++;
                    }


                    $data = Registered::where('season',$season)->whereIn('id',$topMembersId)->orderBy('id', 'asc')->get();

                    $now=Date::now();
                    foreach ($data as $d) {

                        $age = $d->age;
                        $time = strtotime($age);
                        $newformat = date('Y', $time);

                        if($newformat < 1400)
                        {
                            $Year = floor( $newformat * 0.97 + 622);


                        }else{
                            $Year =$newformat;
                        }
                        $d->age=($now->year)-$Year;
                    }
                    $data = $data->sortBy('id');

                }

            }
            $evas=User::where('season',$season)->where('type',2)->get();
if($evas != null )
            for ($i=0;$i<count($evas);$i++)
{for ($j=0;$j<count($data);$j++)
{$bool =0;
foreach ($data[$j]->evas as $ev )
{if($ev->user_id==$evas[$i]->id)
    {$bool=1;
        $data[$j][$i]=$ev->percent;
    }}
if($bool ==0)
{
    $data[$j][$i]='-';
}
}

}
            return Datatables::of($data)

                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->editColumn('status', function($row){
                    if(\Illuminate\Support\Facades\Auth::user()->type==1 || \Illuminate\Support\Facades\Auth::user()->type==5)
                    {$temp=temp::all();
                        $season=$temp[0]->season_id;

                    }else
                        $season=\Illuminate\Support\Facades\Auth::user()->season;

                    if($season==1){
                        if($row->ev1_percent == null || $row->ev2_percent == null || $row->ev3_percent == null)
                            return 'تحت التقييم';
                        else
                            return 'تم التقييم';}else{
                        $evas=EvulatorUser::where('registered_id',$row->id)->get();
                        $eva=User::where('season',$season)->where('type',2)->get();
                        if(count($evas)==count($eva))
                            return 'تم التقييم';
                        else
                            return 'تحت التقييم';

return redirect()->to();



                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroyRegister($id){
        EvulatorUser::where('registered_id',$id)->get();
        RefreeUser::where('registered_id',$id)->delete();
        FinalResult::where('registered_id',$id)->delete();

        $temp=Registered::findorfail($id);
        Storage::disk('public')->delete('videos/'.$temp->video);

        Storage::disk('public')->delete('images/'.$temp->image);
        Storage::disk('public')->delete('videos/'.$temp->video);
        Storage::disk('public')->delete('poems/'.$temp->image);




        $remove_record = Registered::where('id',$id)->delete();

        if($remove_record)
            return true;
        else
            return false;
    }

    public function change_status($uid,$status){
        $reg = Registered::where('id',$uid)->first();
        if($status == $reg->status){
            return true;
        }else{
            Registered::where('id',$uid)->update([
                'status' => $status
            ]);

            if($status == 1){

                $usersEV = EvulatorUser::select('user_id')->get();
                $user = User::select('id')->where('type',2)->whereNotIn('id',$usersEV)->first();

                if($user){
                    EvulatorUser::create([
                        'registered_id' => $uid,
                        'user_id' => $user->id,
                        'status' => 0
                    ]);

                }else{

                    $orderNowEV =  EvulatorUser::select('user_id',DB::raw('count(*) as total'))->groupBy('user_id')->orderBy('total', 'asc')->first();
                    EvulatorUser::create([
                        'registered_id' => $uid,
                        'user_id' => $orderNowEV->user_id,
                        'status' => 0
                    ]);

                }


            }



            if($status == 2){
                EvulatorUser::where('registered_id',$uid)->delete();
            }

            return true;
        }

    }


// Evulator
    public function get_ev_reg($regStatus){
        $season=\Illuminate\Support\Facades\Auth::user()->season;

        if($regStatus == 'all'){
            if(Auth::user()->type == 2)
                return view('admin.evulator.index');
        }

        if($regStatus == 'done'){
            if(Auth::user()->type == 2)
                if($season != 1){
                    $register = Registered::where('season',$season)->get();
                    $data=array();

                    $ev= EvulatorUser::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();
                    foreach ($register as $d) {
                        foreach ($ev as $e) {
                            ;

                            if ($e->registered_id==$d->id) {
                                array_push($data, Registered::where('id', $d->id)->first());
                            }
                        }
                    }

                    return view('admin.evulator.new_index_done',['regs'=>$data]);

                }else{
                    return view('admin.evulator.index_done');
                }

        }


        if($regStatus == 'needEvulator'){
            if(Auth::user()->type == 2)
                return view('admin.evulator.index_need');
        }

        return '404';
    }


    public function getAllEvulatorRegistereds(Request $request,$regStatus){

        $season=\Illuminate\Support\Facades\Auth::user()->season;

        if (1) {
            if($regStatus == 'all')
                $evUsers = EvulatorUser::select('registered_id')->where('user_id',Auth::user()->id)->get();


            if($regStatus == 'done'){



                $register = Registered::where('season',$season)->get();
                $data=array();

                $ev= EvulatorUser::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();
                foreach ($register as $d) {
                    foreach ($ev as $e) {
                        ;

                        if ($e->registered_id==$d->id) {
                            array_push($data, Registered::where('id', $d->id)->first());
                        }
                    }
                }

                if(Auth::user()->id == 2){
                    $data = Registered::where('season',1)->whereNotNull('ev1_percent')->get();
                }
                if(Auth::user()->id == 3){
                    $data = Registered::where('season',1)->whereNotNull('ev2_percent')->get();
                }
                if(Auth::user()->id == 4){
                    $data = Registered::where('season',1)->whereNotNull('ev3_percent')->get();
                }
                /*
                    if(Auth::user()->id == 29){
                        $data = Registered::where('season','2')->whereNotNull('ev1_percent')->get();
                    }
                    if(Auth::user()->id == 30){
                        $data = Registered::where('season',2)->whereNotNull('ev2_percent')->get();
                    }
                    if(Auth::user()->id == 31){
                        $data = Registered::where('season',2)->whereNotNull('ev3_percent')->get();
                    }
                **/


            }

            if($regStatus == 'need'){
                $register = Registered::where('season',$season)->get();
                $data=array();
                $ev= EvulatorUser::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();
                $aa=array();
                for($i=0;$i<count($ev);$i++)
                {array_push($aa,$ev[$i]->registered_id );
                }
                $data=Registered::where('season',$season)->whereNotIn('id',$aa)->get();

                if(Auth::user()->id == 2){
                    $data = Registered::where('season',$season)->whereNull('ev1_percent')->get();
                }
                if(Auth::user()->id == 3){
                    $data = Registered::where('season',$season)->whereNull('ev2_percent')->get();
                }
                if(Auth::user()->id == 4){
                    $data = Registered::where('season',$season)->whereNull('ev3_percent')->get();
                }

                /**
                if(Auth::user()->id == 29){
                $data = Registered::where('season',2)->whereNull('ev1_percent')->get();
                }
                if(Auth::user()->id == 30){
                $data = Registered::where('season',2)->whereNull('ev2_percent')->get();
                }
                if(Auth::user()->id == 31){
                $data = Registered::where('season',2)->whereNull('ev3_percent')->get();
                }

                 */
            }
//return error_log("sadasdas");


            return Datatables::of($data)
                               ->addColumn('isshown', function($row){
                    $done=0;

                    if($row->usershow)
    foreach ($row->usershow as $q)
    {
        if($q->user_id == \Illuminate\Support\Facades\Auth::user()->id)
    $done=1;
    }
                    if($done==1)
                        return '<span class="fa fa-check" > </span>'

                            ;
                    else
                    return '';
                }) ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })

                ->rawColumns(['isshown','action'])
                ->make(true);
        }
    }

    public function saveEvulateUser(Request $request)
    {
        /**
         * if(Auth::user()->id == 2){
         * $update = Registered::where('id',$request->reg_id)->update([
         * 'ev1_percent' => $request->percent,
         * 'ev1_notes' => $request->notes,
         * ]);
         * }
         *
         * if(Auth::user()->id == 3){
         * $update = Registered::where('id',$request->reg_id)->update([
         * 'ev2_percent' => $request->percent,
         * 'ev2_notes' => $request->notes,
         * ]
         * );
         * }
         *
         * if(Auth::user()->id == 4){
         * $update = Registered::where('id',$request->reg_id)->update([
         * 'ev3_percent' => $request->percent,
         * 'ev3_notes' => $request->notes,
         * ]);
         * }
         *
         * if(Auth::user()->id == 29){
         * $update = Registered::where('id',$request->reg_id)->update([
         * 'ev1_percent' => $request->percent,
         * 'ev1_notes' => $request->notes,
         * ]);
         * }
         *
         * if(Auth::user()->id == 30){
         * $update = Registered::where('id',$request->reg_id)->update([
         * 'ev2_percent' => $request->percent,
         * 'ev2_notes' => $request->notes,
         * ]
         * );
         * }
         *
         * if(Auth::user()->id == 31){
         * $update = Registered::where('id',$request->reg_id)->update([
         * 'ev3_percent' => $request->percent,
         * 'ev3_notes' => $request->notes,
         * ]);
         * }
         **/
        $temp = EvulatorUser::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('registered_id', $request->reg_id)->first();
        if ($temp == null) {
            $evulateuser = new EvulatorUser();
            $evulateuser->registered_id = $request->reg_id;
            $evulateuser->user_id = \Illuminate\Support\Facades\Auth::user()->id;
            $evulateuser->notes =  $request->notes;
            $t1 = $request->percent1;
            $t2 = $request->percent2;
            $t3 = $request->percent3;
            $t4 = $request->percent4;
            $t5 = $request->percent5;
            $evulateuser->build = $t1;

            $evulateuser->creative = $t2;
            $evulateuser->sound = $t5;
            $evulateuser->word = $t3;
            $evulateuser->view = $t4;

            $evulateuser->percent = ($t1 * 50 / 100) + ($t2 * 10 / 100) + ($t5 * 10 / 100) + ($t3 * 10 / 100) + ($t4 * 20 / 100);

            return     $evulateuser->save();
        }else
        {
            $temp->notes = $request->notes;

            $t1=       $request->percent1;
            $t2=       $request->percent2;
            $t3=       $request->percent3;
            $t4=       $request->percent4;
            $t5=       $request->percent5;
            $temp->build =$t1;

            $temp->creative =$t2;
            $temp->sound	 =$t5;
            $temp->word =$t3;
            $temp->view =$t4;

            $temp->percent =($t1*50/100)+($t2*10/100)+($t5*10/100)+($t3*10/100)+($t4*20/100);
            $temp->save();
            return  redirect()->to(route('get_ev_reg','done'));

        }

    }
    public function review_evaluations(){
        $seasons=season::all();
        if(\Illuminate\Support\Facades\Auth::user()->type==1|| \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;
        if($season==1)
            return view('admin.reviewEvaluations.index',compact('seasons'));
        else
        {
            $evas=User::where('season',$season)->where('type',2)->get();
            $data=Registered::where('season',$season)->get();
            $regs=array();
            foreach ($data as $reg)
            {$temp=array();
                $temp=EvulatorUser::where('registered_id',$reg->id)->first();

                if( $temp == Null ){}    else                {      array_push($regs, $reg);}


            }

            return view('admin.reviewEvaluations.newEval',compact('seasons','evas','regs'));

        }
    }

    public function get_review_evaluations(Request $request){
        if(\Illuminate\Support\Facades\Auth::user()->type==1|| \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;


        if ($request->ajax()) {
            if(Auth::user()->type == 2)
                $data = EvulatorUser::where('season',$season)->where('ev_status',1)->where('user_id',Auth::user()->id)->get();
            else
                $data = Registered::where('season',$season)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

// Evulator
    public function get_ref_reg($regStatus){
        if($regStatus == 'all'){
            if(Auth::user()->type == 4)
                return view('admin.referee.index');
        }

        if($regStatus == 'done'){
            if(Auth::user()->type == 4)
                return view('admin.referee.index_done');
        }

        if($regStatus == 'needEvulator'){
            if(Auth::user()->type == 4)
                return view('admin.referee.index_need');
        }

        return '404';
    }


    public function getAllRefereeRegistereds(Request $request,$regStatus){
        $season=\Illuminate\Support\Facades\Auth::user()->season;

        if(Auth::user()->id == 6){
            $refreeReggg = RefreeUser::where('season',$season)->select('registered_id')->whereNotNull('ref1')->get();
        }
        elseif(Auth::user()->id == 7){
            $refreeReggg = RefreeUser::where('season',$season)->select('registered_id')->whereNotNull('ref2')->get();
        }
        elseif(Auth::user()->id == 8){
            $refreeReggg = RefreeUser::where('season',$season)->select('registered_id')->whereNotNull('ref3')->get();
        }
        else {
            $refreeReggg = RefreeUser::where('season', $season)->select('registered_id')->where('ref_id', \Illuminate\Support\Facades\Auth::user()->id)->get();
        }

        /*
    if(Auth::user()->id == 26){
    $refreeReggg = RefreeUser::where('season',$season)->select('registered_id')->whereNotNull('ref1')->get();
    }
    if(Auth::user()->id == 27){
    $refreeReggg = RefreeUser::where('season',$season)->select('registered_id')->whereNotNull('ref2')->get();
    }
    if(Auth::user()->id == 28){
    $refreeReggg = RefreeUser::where('season',$season)->select('registered_id')->whereNotNull('ref3')->get();
    }
    */
        $rate=settings::findorfail(1)->therate;

        if (1) {
            if($regStatus == 'needEvulator')
            {$dataa = Registered::where('season',$season)->get();
                $Evalator=User::where('season',$season)->where('type',2)->get();
                $numberofEvalator = count($Evalator);
                $avg = array();
                $topMembersId = array();
//////
                $temp= EvulatorUser::where('registered_id',485)->where('user_id',29)->get();
                // echo $temp[0]->percent;
                foreach($dataa as $d){
                    $memberavg=0;
                    for($i=0;$i<$numberofEvalator;$i++)
                    {$temp= EvulatorUser::where('registered_id',$d->id)->where('user_id',$Evalator[$i]->id)->first();
                        if($temp != null)
                        {
                            $memberavg += EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first()->percent;
                        }

                    }
                    $v =((float) $memberavg /$numberofEvalator);
                    $vv = number_format((float)$v, 2, '.', '');
                    if($vv > $rate)
                        $avg[$d->id] = $vv;

                }
                arsort($avg);
///////////////////////////////////////
                foreach($avg as $a => $value){
                    $iiii=0;

                    array_push($topMembersId,$a);
                    $iiii++;
                }



                $data = Registered::where('season',$season)->whereIn('id',$topMembersId)->whereNotIn('id',$refreeReggg)->get();
            }

            if($regStatus == 'done'){


                if($season ==1 )
                { $dataa = Registered::where('season',$season)->get();
                    $avg = array();
                    $topMembersId = array();
                    foreach($dataa as $d){
                        $first = ($d->ev1_percent != null) ? $d->ev1_percent : 0;
                        $second = ($d->ev2_percent != null) ? $d->ev2_percent : 0;
                        $third = ($d->ev3_percent != null) ? $d->ev3_percent : 0;

                        $v = ((float)$first+(float)$second+(float)$third)/3;
                        $vv = number_format((float)$v, 2, '.', '');
                        if($vv > $rate)
                            $avg[$d->id] = $vv;
                    }
                    arsort($avg);
                    $iiii = 0;
                    foreach($avg as $a => $value) {
                        if ($iiii == 92) {
                            break;
                        }
                        array_push($topMembersId, $a);
                        $iiii++;
                    }   }
                else{
                    $dataa = Registered::where('season',$season)->get();
                    $Evalator=User::where('season',$season)->where('type',2)->get();
                    $numberofEvalator = count($Evalator);
                    $avg = array();
                    $topMembersId = array();
//////
                    $temp= EvulatorUser::where('registered_id',485)->where('user_id',29)->get();
                    // echo $temp[0]->percent;
                    foreach($dataa as $d){
                        $memberavg=0;
                        for($i=0;$i<$numberofEvalator;$i++)
                        {$temp= EvulatorUser::where('registered_id',$d->id)->where('user_id',$Evalator[$i]->id)->first();
                            if($temp != null)
                            {
                                $memberavg += EvulatorUser::where('registered_id', $d->id)->where('user_id', $Evalator[$i]->id)->first()->percent;
                            }

                        }
                        $v =((float) $memberavg /$numberofEvalator);
                        $vv = number_format((float)$v, 2, '.', '');
                        if($vv > $rate)
                            $avg[$d->id] = $vv;

                    }
                    arsort($avg);
///////////////////////////////////////
                    foreach($avg as $a => $value){
                        $iiii=0;

                        array_push($topMembersId,$a);
                        $iiii++;
                    }


                }


                $data = Registered::where('season',$season)->whereIn('id',$topMembersId)->whereIn('id',$refreeReggg)->get();









            }

            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function saveRefereeUser(Request $request,$id){
        if(\Illuminate\Support\Facades\Auth::user()->type==1 || \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;


        $check = RefreeUser::where('registered_id',$id)->first();
        $refreemax=settings::findorfail(1)->refreemax;
        if($check){
            if(Auth::user()->id == 6){
                $check = RefreeUser::where('season',1)->whereNotNull('ref1')->count();
                if($check < $refreemax){
                    RefreeUser::where('registered_id',$id)->update([
                        'ref1' => 'done',
                        'season'=>1,
                    ]);
                }

            }

            elseif(Auth::user()->id == 7){
                $check = RefreeUser::where('season',1)->whereNotNull('ref2')->count();
                if($check < $refreemax){
                    RefreeUser::where('registered_id',$id)->update([
                        'ref2' => 'done',
                        'season'=>1,
                    ]);
                }
            }
            elseif(Auth::user()->id == 8){
                $check = RefreeUser::where('season',1)->whereNotNull('ref3')->count();
                if($check < $refreemax){
                    RefreeUser::where('registered_id',$id)->update([
                        'ref3' => 'done',
                        'season'=>1,

                    ]);
                }
            }




            else{
                $check = RefreeUser::where('season',$season)->where("ref_id",\Illuminate\Support\Facades\Auth::user()->id)->count();
                if($check < $refreemax){

                    RefreeUser::create([
                        'registered_id' => $id,
                        'ref_id' =>\Illuminate\Support\Facades\Auth::user()->id,
                        'season'=>$season

                    ]);

                }


            }

        }else{
            if(Auth::user()->id == 6){
                $check = RefreeUser::where('season',1)->whereNotNull('ref1')->count();
                if($check < $refreemax){
                    RefreeUser::create([
                        'registered_id' => $id,
                        'ref1' => 'done',
                        'season'=>1

                    ]);
                }
            }

            elseif(Auth::user()->id == 7){
                $check = RefreeUser::where('season',1)->whereNotNull('ref2')->count();
                if($check < $refreemax){
                    RefreeUser::create([
                        'registered_id' => $id,
                        'ref2' => 'done',
                        'season'=>1

                    ]);
                }
            }
            elseif(Auth::user()->id == 8){
                $check = RefreeUser::where('season',1)->whereNotNull('ref3')->count();
                if($check < $refreemax){
                    RefreeUser::create([
                        'registered_id' => $id,
                        'ref3' => 'done',
                        'season'=>1

                    ]);
                }
            }

            else {
                $check = RefreeUser::where('season', $season)->where("ref_id", \Illuminate\Support\Facades\Auth::user()->id)->count();
                if ($check < $refreemax) {

                    RefreeUser::create([
                        'registered_id' => $id,
                        'ref_id' => \Illuminate\Support\Facades\Auth::user()->id,
                        'season' => $season

                    ]);

                }else{
                    toastr()->error('max value');
                    return false;
                }



            }


        }



        return true;

    }

    public function saveRefereeUserDelete(Request $request,$id)
    {
        if(Auth::user()->id == 6){
            RefreeUser::where('registered_id',$id)->update([
                'ref1' => null
            ]);
        }

        elseif(Auth::user()->id == 7){
            RefreeUser::where('registered_id',$id)->update([
                'ref2' => null
            ]);
        }
        elseif(Auth::user()->id == 8){
            RefreeUser::where('registered_id',$id)->update([
                'ref3' => null
            ]);
        }
        else {
            RefreeUser::where('registered_id', $id)->where('ref_id', \Illuminate\Support\Facades\Auth::user()->id)->delete();
        }
        return true;

    }

    public function review_ref_evaluations(){
        $seasons=season::all();

        if(\Illuminate\Support\Facades\Auth::user()->type==1|| \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;
        $refs = User::where('season',$season)->where('type',4)->get();

        if($season==1)
            return view('admin.reviewRefEvaluations.index',compact('refs','seasons'));
        else{
            $evas=User::where('season',$season)->where('type',4)->get();
            $data=Registered::where('season',$season)->get();
            $regs=array();
            foreach ($data as $reg)
            {   $temp=array();
                $temp=RefreeUser::where('registered_id',$reg->id)->first();

                if( $temp == Null ){}
                else                {      array_push($regs, $reg);}
            }
            return view('admin.reviewRefEvaluations.newEva',compact('regs','evas','seasons'));

        }
    }

    public function get_review_ref_evaluations(Request $request){
        if(\Illuminate\Support\Facades\Auth::user()->type==1|| \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;


        if ($request->ajax()) {

            $data = RefreeUser::where('season',$season)->whereIN('registered_id','!=',null)->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('name', function($row){
                    $reg = Registered::where('id',$row->registered_id)->first();
                    return $reg->name;
                })
                ->addColumn('email', function($row){
                    $reg = Registered::where('id',$row->registered_id)->first();
                    return $reg->email;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function participants(){

        if(\Illuminate\Support\Facades\Auth::user()->type==1 || Auth::user()->type == 5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;


        $seasons=season::all();
        $evas=User::where('season',$season)->where('type',2)->get();
        return view('admin.participants.index',compact('seasons','evas'));
    }

    public function all_participants(Request $request){
// if ($request->ajax()) {
        if(\Illuminate\Support\Facades\Auth::user()->type==1 || \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;

        $data = FinalResult::where('season',$season)->get();
        $ids = array();
        foreach($data as $d)
        {
            array_push($ids,$d->registered_id);
        }

        $dataa = Registered::whereIn('id',$ids)->get();
        $evas=User::where('season',$season)->where('type',2)->get();

        if($evas != null )
            for ($i=0;$i<count($evas);$i++)
            {for ($j=0;$j<count($dataa);$j++)
            {$bool =0;
                foreach ($dataa[$j]->evas as $ev )
                {if($ev->user_id==$evas[$i]->id)
                {$bool=1;
                    $dataa[$j][$i]=$ev->percent;
                }}
                if($bool ==0)
                {
                    $dataa[$j][$i]='-';
                }
            }

            }


        return Datatables::of($dataa)
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
// }
    }

    public function generate_link_view($id)
    {
        return view('generate_link_view',['seasons'=>season::all()]);
    }

    public function generate_link(Request $request,$id)
    {
        $token = Str::random(70);
        $member = Registered::where('id',$id)->update([
            'random_token' => $token,
            'reupload'=>1
        ]);

        $m = Registered::where('id',$id)->first();

        $link = url('/re-upload'.'/'.$token);
        $data = array('memberEmail' => $m->email,'link' => $link,'note' => $request->note);

        Mail::send('email.reUpload',$data,function($m) use($data){
            $m->to($data['memberEmail'])->subject('تعديل المعلومات!');
        });
        toastr()->success('تمت بنجاح');

        return redirect()->to(route('get_registered','all'));

    }

    public function reUploadView($token)
    {
        $member = Registered::where('random_token',$token)->first();
        if($member)
            return view('reupload.form',['token'=>$token]);
        else
            return abort(403);
    }

    public function saveReUpload(Request $request,$token)
    {

        $temp=Registered::where('random_token',$token)->first();
        Storage::disk('public')->delete('videos/'.$temp->video);


        $update = Registered::where('random_token',$token)->update([
            'video' => $request->video,
            'random_token' => null,
            'reupload'=>2


        ]);

        if($update)
            return true;
        else
            return false;
    }

    public function qualifiedView($type){
        $seasons=season::all();
        if($type == 'khaild'){
            $refree = 'خالد المريخي';
            return view('admin.qualified',compact('refree','seasons'));
        }

        if($type == 'nasser'){
            $refree = 'ناصر السبيعي';
            return view('admin.qualified',compact('refree','seasons'));
        }


        if($type == 'naif'){
            $refree = 'نايف صقر';
            return view('admin.qualified',compact('refree','seasons'));
        }

        if($type == 'all'){
            $refree = 'المستركين بين جميع الحكام';
            return view('admin.qualified',compact('refree','seasons'));
        }
        $refree = User::where("id",$type)->first()->name;
        return view('admin.qualified',compact('refree','seasons'));


    }

    public function qualifiedData($type)
    { $data =array();
        if(\Illuminate\Support\Facades\Auth::user()->type==1 || \Illuminate\Support\Facades\Auth::user()->type==5)
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;

        if($type == '6'){
            $data = RefreeUser::where('season',$season)->where('ref1','!=',NULL)->get();
        }

        elseif($type == '7'){
            $data = RefreeUser::where('season',$season)->whereNotNull('ref2')->get();
        }


        elseif($type == '8'){
            $data = RefreeUser::where('season',$season)->whereNotNull('ref3')->get();
        }

        elseif($type == 'all'){
            $data = RefreeUser::where('season',$season)->whereNotNull('ref1')->whereNotNull('ref2')->whereNotNull('ref3')->get();
        }
        else{

            $data = RefreeUser::where('season',$season)->where('ref_id',$type)->get();



        }

        $ids = array();
        foreach($data as $d){
            array_push($ids,$d->registered_id);
        }

        $dataa  = Registered::whereIn('id',$ids)->get();
//return $dataa;
        return Datatables::of($dataa)
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }


    public function saveFinal(Request $request,$id)
    {
        if(\Illuminate\Support\Facades\Auth::user()->type==1 )
        {$temp=temp::all();
            $season=$temp[0]->season_id;

        }else
            $season=\Illuminate\Support\Facades\Auth::user()->season;


        $all=FinalResult::where('season',$season)->get();
        if(count($all)<48) {
            $reg=Registered::findorfail($id);

            $token1 = Str::random(70);


            $link = url('/re-upload'.'/'.$token1);

            try {
                $data = array('memberEmail' => $reg->email,'link'=>$link);
                Mail::send('email.evalution', $data, function ($m) use ($data) {
                    $m->to($data['memberEmail'])->subject('المتأهلين!');
                });
            } catch (\Exception $e) {
//            return false;

            }

            $check = FinalResult::where('registered_id', $id)->first();
            if (!$check) {
                FinalResult::create([
                    "registered_id" => $id,
                    "season" => $season
                ]);

                $set=settings::findorfail(1);
                $token=$set->token; // Ultramsg.com token
                $instance_id=$set->instance; // Ultramsg.com instance id
                $client = new WhatsAppApi($token,$instance_id);
                try {

                    $to = $reg->mobile;
                    $name=$reg->name;

                    $name1=' عزيزي المتأهل'.': '.$name;
                    $row1='تهانينا لك ترشيحك من قائمة المتأهلين للمرحلة النهائية في برنامج شاعر الراية
"الموسم الثاني"، نرجو من سعادتكم تعبئة الرابط أدناه بالمعلومات الشخصية الصحيحة:';
                    $row2='شكرا لاهتمامك بالمشاركة معنا ، تمنياتنا لك بالتوفيق';
                    $row3=$link;
                    $row4='* ملاحظة:';
                    $row6="جميع المعلومات لابد أن تكون صحيحة وخاصة بالمشارك.";
                    $row7='كما نود التأ كيد على عدم إعلان التأهل لا بالتصريح و لا بالتلميح على اي وسيلة تواصل إعلامية او مواقع التواصل الاجتماعي حتى يتم الإعلان الرسمي من إدارة البرنامج.';
                    $body=$name1.PHP_EOL.$row1.PHP_EOL.$row3.PHP_EOL.$row4.PHP_EOL.$row6.PHP_EOL.$row7.PHP_EOL.PHP_EOL.$row2;
                    $image=url('storage/back/'.$set->image);
                    $caption=$body;
                    $priority=10;
                    $referenceId="SDK";
                    $nocache=false;
                    $api=$client->sendImageMessage($to,$image,$caption,$priority,$referenceId,$nocache);
                }catch (\Exception $e) {

                }







            }
            return true;
        }
        else{return false;}
    }

    public function saveFinalDel(Request $request,$id)
    {
        FinalResult::where('registered_id',$id)->delete();

        return true;
    }
}

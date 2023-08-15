<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\user_rigester_show;
use App\Rules\pass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\season;
use App\Models\temp;

use Illuminate\Http\Request;
use App\Models\Registered;
use App\Models\EvulatorUser;
use App\Models\countries;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Str;
use DB;
use Session;
use UltraMsg\WhatsAppApi;
use ZipArchive;

class RegisteredController extends Controller
{
    public function resetpass($id){
        $user=User::findorfail($id);
        return view('resetuserpass',['user'=>$user]);
    }
    public function resetpass1(Request $request){
//return $request->pass;

        $this->validate($request,['pass' => [
    'required',
    'string',
    'min:8',             // must be at least 10 characters in length
      new pass(),

    ],'confirm_pass'=>['required','same:pass'],]
, [
        'required' => 'مطلوب!',
        'same' => 'كلمة المرور غير متطابقة!'
  ,'min'=>'كلمة المرور على الأقل 8 محارف'
    ]
);
        $hasher = app('hash');

        $user=User::findorfail($request->id);
        if(($hasher->check($request->oldpass, $user->password))) {

    $user->password = Hash::make($request->pass);
}else
{toastr()->error("كلمة المرور خاطئة");
    return redirect()->back();

}
        $user->save();
        flash()->addSuccess('تمت تعديل كلمة المرور بنجاح','تمت');
        Auth::login($user, true);
        return redirect()->to('/home');
    }

    public function testsend(){
       return Registered::findorfail(141)->refrees;

    }
    public function downloadall($id,Request $request)
    {
        $temp=Registered::findorfail($id);
        try {

            $files = [
                0 => ('storage/images/' . $temp->image),
                1 => ('storage/videos/' . $temp->video),
                2 => ('storage/poems/' . $temp->poem)

            ];

            $zip = new ZipArchive();
            $zipFile = $temp->name . '.zip';

            if ($zip->open(public_path($zipFile), ZipArchive::CREATE) === TRUE) {
                foreach ($files as $file) {

                      $pathToFile = public_path($file);

                      $name = basename($pathToFile);
                      $zip->addFile($pathToFile, $name);


                }
                $zip->close();
            }
            return response()->download(public_path($zipFile));
        }catch (\Exception $e)
        {
            return $e;
        }

    }
    public function test33()
    {
        return view('email.reUpload');
    }


    public function index(){
        return view('register.index',['countries'=>countries::orderby('name_ar')->get()]);
    }



      public function video($id){
$reg=        Registered::findorfail($id);
        $extension = pathinfo("videos/".$reg->video, PATHINFO_EXTENSION);

        return response()->download('storage/videos/'.$reg->video,"$reg->name.".$extension);

    }
    public function image($id){
        $reg=        Registered::findorfail($id);
        $extension = pathinfo("images/".$reg->image, PATHINFO_EXTENSION);

        return response()->download('storage/images/'.$reg->image,"$reg->name.".$extension);

    }
    public function passport($id){
        $reg=        Registered::findorfail($id);
        $extension = pathinfo("passport/".$reg->passport, PATHINFO_EXTENSION);

        return response()->download('storage/passport/'.$reg->passport,"$reg->name.".$extension);
    }

    public function poem($id){
        $reg=        Registered::findorfail($id);
        $extension = pathinfo("poems/".$reg->poem, PATHINFO_EXTENSION);

        return response()->download('storage/poems/'.$reg->poem,"$reg->name.".$extension);
    }



    public function test1(Request $request)
    {        if(\Illuminate\Support\Facades\Auth::user()->type==1|| \Illuminate\Support\Facades\Auth::user()->type==5 )
    {$temp=temp::all();
        $season=$temp[0]->season_id;

    }else
        $season=\Illuminate\Support\Facades\Auth::user()->season;
$evas=User::where('season',$season)->where('type',2)->get();
        return view('registered.lajna',['evas'=>$evas,'Grades'=>Registered::where('season',$season)->get(),'seasons'=>season::all()]);
    }
public function test($id){
$register=Registered::findorfail($id);
    $temp=new user_rigester_show();

    $temp->user_id=\Illuminate\Support\Facades\Auth::user()->id;
    $temp->register_id =$id;
    if(!user_rigester_show::where('user_id',$temp->user_id)->where('register_id',$temp->register_id)->first())
        $temp->save();

    return view('registered.show',['member'=>$register,'seasons'=>season::all()]);

}
    public function uploadimage(Request $request)
    {
        if($request->file('myFile')){
            $file1 = $request->file('myFile');
            $imageName   = Str::random(7).'.'. $file1->getClientOriginalExtension();

            Storage::disk('public')->put('images/'.$imageName,file_get_contents($file1));
    //     \toastr()->success('hi');
            return response()->json(['data' => $imageName, 'status' => 'OK', 'timestamp' => Carbon::now()]);


        }
    }


    public function uploadpoem(Request $request)
    {
        if($request->file('myFile')){
            $file3 = $request->file('myFile');
            $poemName   = Str::random(7).'.'. $file3->getClientOriginalExtension();
            Storage::disk('public')->put('poems/'.$poemName,file_get_contents($file3));
            return response()->json(['data' => $poemName, 'status' => 'OK', 'timestamp' => Carbon::now()]);


        }

        }

    public function upload(Request $request){

 $getID3 = new \getID3;


        if($request->file('video')){
                $file2 = $request->file('video');
                $videoName   = Str::random(7).'.'. $file2->getClientOriginalExtension();
            $file = $getID3->analyze($file2);
//            $duration = date('H:i:s.v',);
            if($file['playtime_seconds']>120 || $file['playtime_seconds'] <30)
            {return 'fff';}
            else {
                Storage::disk('public')->put('videos/' . $videoName, file_get_contents($file2));

                return $videoName;
            }}

        return '';
    }
    public function checkEmail($email){
        $member = Registered::where('email',$email)->first();
        if($member)
            return false;
        return true;
    }

    public function store(Request $request){
$this->validate($request,[
    'email' => 'required|email|unique:registereds',
]);

  try {
        $data = array('memberEmail' => $request->email);
        Mail::send('email.welcome',$data,function($m) use($data){
            $m->from('registration@alrayapoet.com');
            $m->to($data['memberEmail'])->subject('شكرا لتسجيلك!');
        });
}
catch (\Exception $e) {
           // return false;

        }
if($request->anysharei != null) {
    $anyshare = $request->anysharei;
}else{$anyshare = $request->anyshare;}
        if($request->anytalenti != null) {
            $anytalent= $request->anytalenti;
        }else{$anytalent = $request->anytalent;}



        $imageName = $request->image;
        $videoName = null;
        $poemName = $request->poem;
$active=settings::all();
$active1=$active[0]->activeseason;
$newRecord = Registered::create([
            'name' => $request->name,
            'email' => $request->email,
                'age' => $request->birthdate_type,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'city' => $request->city,
              'city1' => $request->city1,
                'job'=>$request->job,
       'mobile' => $request->mobile,
            'hobbies' => $request->hobbies,
            'description' => $request->description,
    'study' => $request->study,
    'anytalent' => $anytalent,
  //  'anytalenti' => $request->anytalenti,
    'anyshare' => $anyshare,
//    'description' => $request->description,


    'image' => $imageName,
            'video' => $request->video,
            'poem' => $poemName,
            'facbook' => $request->facbook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
               'season'=>$active1,
       'area'=>$request->city1s
          ]);


        if($newRecord)
            return true;
        else
            return false;
    }

}

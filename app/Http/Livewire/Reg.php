<?php

namespace App\Http\Livewire;

use App\Models\countries;
use App\Models\Registered;
use App\Models\settings;
use App\Rules\temp;
use getID3;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;
use App\Rules\PhoneNumber;
use Str;
use UltraMsg\WhatsAppApi;

class Reg extends Component
{
    use WithFileUploads;

//protected  $rules=['video'=> 'file|max:1000000'];
    /**
     * @var mixed
     */
    public $mobile_code;
    public $real_mobile_code;

    public static function rules()
    {
        return ['video' => 'file|max:100000'];
    }

    public $name, $email, $gender, $nationality, $city, $mobile, $image, $image_name, $poem_name, $video, $poem, $description
    , $video_name, $is_share, $is_talent, $birthdate_type, $facbook, $instagram, $twitter, $job, $city1, $city1i, $area, $anyshare, $anytalent, $study, $anytalenti, $anysharei, $checkanytalent, $checkanyshare;

    public $videocheck, $check;
    public $done = 2;

    public $done1 = false, $done2 = false, $done3 = false;

    public $currentStep = 4;


    public $anyShareOther = false;
    public $anyTalentOther = false;


    public function updatedCheckanyshare()
    {


    }

    public function updatedCheckanytalent()
    {


    }

    public function updatedIsShare($v)
    {
        if ($v == 'no') {
            $this->anyshare = 'لا';
        }
        $this->dispatchBrowserEvent('first');

    }

    public function updatedIsTalent($v)
    {
        if ($v == 'yes') {
            $this->anytalent = '';
        }

        $this->dispatchBrowserEvent('first');

    }


    public function updatedAnyshare($value)
    {

        if (in_array('أخرى', $value)) {

            $this->anyShareOther = true;
        } else {
            $this->anyShareOther = false;
        }

    }

    public function updatedAnytalent($value)
    {

        if (in_array('أخرى', $value)) {

            $this->anyTalentOther = true;
        } else {
            $this->anyTalentOther = false;
        }

    }
    public function backtobase1()
    {
        $this->currentStep = 6;

    }

    public function backtobase()
{$this->check=1;
    $this->currentStep = 4;

}

    public function step1()
    {
        $this->currentStep = 1;
        $this->dispatchBrowserEvent('first');
    }

    public function step2()
    {
        $this->done1 ? $this->currentStep = 2 : null;
    }

    public function step3()
    {

        $this->done2 ? $this->currentStep = 3 : null;
    }

    public function submitForm()
    {
        $this->currentStep = 1;

        $this->dispatchBrowserEvent('first');
    }

    public function firstStepSubmit()
    {
        $this->validate([


            'email' => ['required', 'email', Rule::unique('registereds')->where(function ($query) {
                $active = settings::findorfail(1)->activeseason;

                $query->where('season', $active);
            }
            )],

            'name' => ['required',new temp()],
            'gender' => 'required',
            'nationality' => 'required',
            'city' => 'required',
            'mobile' => ['required', 'digits_between:9,10'],
            'city1' => ['required',new temp()],
            'job' => ['required',new temp()],
            'anytalent' => 'required',
            'anyshare' => 'required',
            'is_share'=> 'required',
            'is_talent'=> 'required',
            'study' => 'required',
            'birthdate_type' => 'required|before:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'anytalenti' =>    [Rule::when($this->anyTalentOther == 'true', 'required')],
            'anysharei' =>  [Rule::when($this->anyShareOther == 'true', 'required')],


        ], [
            'birthdate_type.before' => 'يجب ان يكون العمر اكبر من 18 سنة',
            'mobile.regex' => 'يجب ان يكون الرقم  بهذا الشكل 9665xxxxxxxx+',
            'mobile.digits_between' => 'رقم الهاتف يجب ان يكون 9 او 10 خانات',
            'email.email' => 'البريد الالكتروني غير صحيح',
            'email.unique' => 'البريد الالكتروني موجود سابقاً',
'regex'=>'أحرف فقط'
        ]);
        $this->real_mobile_code = $this->mobile_code;
        $this->currentStep = 2;
        $this->done1 = true;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'image' => 'required|image',
            'video' => 'required|mimes:mp4,mov,ogg|max:100000',
            'poem' => 'required|file:mimes:jpg,png,jpeg,pdf',

        ]);
        $getID3 = new getID3();
        $this->videocheck = 0;
        $file1 = $this->image;
        $this->image_name = Str::random(7) . '.' . $this->image->getClientOriginalExtension();
        $this->poem_name = Str::random(7) . '.' . $this->poem->getClientOriginalExtension();
        $this->video_name = Str::random(7) . '.' . $this->video->getClientOriginalExtension();
        $this->video->storeAs('videos', $this->video_name, $disk = 'public');
        $f = $getID3->analyze('storage/videos/' . $this->video_name);
        if ($f['playtime_seconds'] > 120 || $f['playtime_seconds'] < 60) {

            $this->videocheck = 1;
            Storage::disk('public')->delete($this->video_name);

        } else {
            $this->image->storeAs('images', $this->image_name, $disk = 'public');
            $this->poem->storeAs('poems', $this->poem_name, $disk = 'public');
            $this->currentStep = 3;
            $this->done2 = true;

        }


    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function thirdStepSubmit()
    {
        $done = 6;
        $this->validate([


            'email' => ['required', Rule::unique('registereds')->where(function ($query) {
                $active = settings::findorfail(1)->activeseason;
                $query->where('season', $active);
            }
            )],


        ]);


        try {
            $data = array('memberEmail' => $this->email);
            Mail::send('email.welcome', $data, function ($m) use ($data) {
                $m->from('registration@alrayapoet.com');
                $m->to($data['memberEmail'])->subject('Thanks For Registration!');
            });
        } catch (\Exception $e) {
//            return false;

        }

        if ($this->city == 'المملكة العربية السعودية') {
            $area = $this->area;
        } else {

            $area = null;
        }
        $active = settings::findorfail(1)->activeseason;
        //$active=settings::all();
        $register = new Registered();
        $register->name = $this->name;
        $register->email = $this->email;
        $register->age = $this->birthdate_type;
        $register->gender = $this->gender;
        $register->nationality = $this->nationality;
        $register->city = $this->city;
        $register->city1 = $this->city1;
        $register->job = $this->job;
        $register->mobile = $this->mobile_code . $this->mobile;
        // 'hobbies' => $this->hobbies,
        $register->description = $this->description;
        $register->study = $this->study;

        $register->anytalenti = $this->anytalenti;
        $register->anysharei = $this->anysharei;

        $register->anytalent = json_encode($this->anytalent, JSON_UNESCAPED_UNICODE);;
        //  'anytalenti' => $request->anytalenti,
        $register->anyshare = json_encode($this->anyshare, JSON_UNESCAPED_UNICODE);;
        $register->description = $this->description;


        $register->image = $this->image_name;
        $register->video = $this->video_name;
        $register->poem = $this->poem_name;
        $register->facbook = $this->facbook;
        $register->instagram = $this->instagram;
        $register->twitter = $this->twitter;
        $register->season = $active;
        $register->area = $area;
        $register->save();
$set=settings::findorfail(1);
        $token=$set->token; // Ultramsg.com token
        $instance_id=$set->instance; // Ultramsg.com instance id
        $client = new WhatsAppApi($token,$instance_id);
        try {

            $to = $register->mobile;
            $name=$this->name;

            $name1=' عزيزي المشترك'.': '.$name;
            $row1=$set->raw1;
            $row2=$set->raw2;

            $body=$name1.PHP_EOL.$row1.PHP_EOL.$row2;
            $image=url('storage/back/'.$set->image);
            $caption=$body;
            $priority=10;
            $referenceId="SDK";
            $nocache=false;
            $api=$client->sendImageMessage($to,$image,$caption,$priority,$referenceId,$nocache);
        }catch (\Exception $e) {

        }

        $this->currentStep = 5;


    }


    public function render()
    {
        return view('livewire.add-visa', ['countries' => countries::orderby('name_ar')->get()]);
    }
}

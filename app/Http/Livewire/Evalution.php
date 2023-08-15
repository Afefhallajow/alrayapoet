<?php

namespace App\Http\Livewire;

use App\Models\FinalResult;
use App\Models\Registered;
use App\Models\settings;
use App\Rules\temp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;
class Evalution extends Component
{   use WithFileUploads;
    public $name, $email, $gender, $nationality, $city, $mobile, $image, $image_name, $poem_name, $video, $poem, $description
,$newid, $video_name, $is_share, $is_talent, $birthdate_type, $facbook, $instagram, $twitter, $job, $city1, $city1i, $area, $anyshare, $anytalent, $study, $anytalenti, $anysharei, $checkanytalent, $checkanyshare;

    public $videocheck, $check;
    public $done = 2;

    public $done1 = false, $done2 = false, $done3 = false;

    public $currentStep = 1;

    public function mount($token)
    {
        $kegiatan =Registered::where('random_token',$token)->first();
        $this->newid = $kegiatan->id;
        $this->name = $kegiatan->name;
        $this->email = $kegiatan->email;
        $this->birthdate_type = $kegiatan->age;
        $this->gender = $kegiatan->gender;
        $this->nationality = $kegiatan->nationality;
        $this->city = $kegiatan->city;
        $this->city1 = $kegiatan->city1;
        $this->job = $kegiatan->job;
        $this->mobile =  $kegiatan->mobile;
        // 'hobbies' => $this->hobbies,
        $this->description = $kegiatan->description;
        $this->study = $kegiatan->study;

        $this->anytalenti = $kegiatan->anytalenti;
        $this->anysharei = $kegiatan->anysharei;

        $this->anytalent = $kegiatan->anytalent;
        //  'anytalenti' => $request->anytalenti,
        $this->anyshare = $kegiatan->anyshare;
        $this->description = $kegiatan->description;


        $this->image = $kegiatan->image_name;
        $this->video = $kegiatan->video_name;
        $this->poem = $kegiatan->poem_name;
        $this->facbook = $kegiatan->facbook;
        $this->instagram = $kegiatan->instagram;
        $this->twitter = $kegiatan->twitter;
        $this->season = $kegiatan->season;
        $this->area = $kegiatan->area;
    }
    public function firstStepSubmit()
    {
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'image' => 'required|image',
            'poem' => 'required|file:mimes:jpg,png,jpeg,pdf',

        ]);

        $this->image_name = Str::random(7) . '.' . $this->image->getClientOriginalExtension();
        $this->poem_name = Str::random(7) . '.' . $this->poem->getClientOriginalExtension();
            $this->image->storeAs('images', $this->image_name, $disk = 'public');
            $this->poem->storeAs('passport', $this->poem_name, $disk = 'public');
        $temp=Registered::where('id',$this->newid)->first();

        Storage::disk('public')->delete('images/'.$temp->image);
if($temp->reupload==1)
{   $update = Registered::where('id',$this->newid)->update([
            'image' => $this->image_name,
            'passport' => $this->poem_name,
            'random_token' => null,
    'reupload'=>2
        ]);
    }
else{
    $update = Registered::where('id',$this->newid)->update([
        'image' => $this->image_name,
        'passport' => $this->poem_name,
        'random_token' => null,
        'reupload'=>0
    ]);
}
$f= FinalResult::where('registered_id',$this->newid)->first();
$f->update=1;
$f->save();

            $this->currentStep = 3;



    }


    public function render()
    {
        return view('livewire.evalution');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Registered;
use getID3;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Reupload extends Component
{use WithFileUploads;
    public  $video, $heck
    , $video_name,
        $videocheck,$newid,
        $currentStep=1;
    public function mount($token)
    {
        $kegiatan =Registered::where('random_token',$token)->first();
        $this->newid = $kegiatan->id;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'video' => 'required|mimes:mp4,mov,ogg|max:100000',

        ]);


        $getID3 = new getID3();
        $this->videocheck = 0;
        $this->video_name = Str::random(7) . '.' . $this->video->getClientOriginalExtension();
        $this->video->storeAs('videos', $this->video_name, $disk = 'public');
        $f = $getID3->analyze('storage/videos/' . $this->video_name);
        if ($f['playtime_seconds'] > 120 || $f['playtime_seconds'] < 60) {

            $this->videocheck = 1;
            Storage::disk('public')->delete($this->video_name);

        } else {
            $temp=Registered::where('id',$this->newid)->first();
            Storage::disk('public')->delete('videos/'.$temp->video);

            $update = Registered::where('id',$this->newid)->update([
                'video' => $this->video_name,
                'random_token' => null,
                'reupload'=>2

            ]);            $this->currentStep = 2;

        }


    }



    public function render()
    {
        return view('livewire.reupload');
    }
}

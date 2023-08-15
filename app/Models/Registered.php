<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registered extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status','name','email','gender','age','nationality','city','mobile','hobbies','ev1_percent','ev1_notes','ev2_percent','ev2_notes','ev3_percent','ev3_notes','random_token',
        'image','video','poem','description','twitter','instagram','facbook'  ,'city1','job','season','area'
   ,'anyshare','anytalent','study',"reupload" ];

public function evas()
    {
        return $this->hasMany(EvulatorUser::class,'registered_id');

    }
    public function usershow()
    {
        return $this->hasMany(user_rigester_show::class,'register_id');

    }

    public function refrees()
    {
        return $this->hasMany(RefreeUser::class,'registered_id');

    }


}

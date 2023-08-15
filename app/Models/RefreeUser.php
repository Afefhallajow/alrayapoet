<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefreeUser extends Model
{
    use HasFactory;

    protected $table = 'referee_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'registered_id','ref1','ref2','ref3','avg','season',"ref_id"
    ];
}

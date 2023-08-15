<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvulatorUser extends Model
{
    use HasFactory;

    protected $table = 'evulators_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'registered_id','user_id','ev_status','percent','notes','word','view','sound','creative','build'
    ];
}

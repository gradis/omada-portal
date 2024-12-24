<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstName',
        'secondName',
        'middleName',
        'password',
        'number',
        'username',
        'grade',
        'group',
    ];

    public function macAddresses()
    {
        return $this->hasMany(MacAddresses::class, 'number', 'number');
    }

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }

    public function setFirstNameAttribute($value) {
        $this->attributes['firstName'] = strtolower($value);
    }

    public function getSecondNameAttribute($value){
        return ucfirst($value);
    }

    public function setSecondNameAttribute($value) {
        $this->attributes['secondName'] = strtolower($value);
    }

    public function getMiddleNameAttribute($value){
        return ucfirst($value);
    }

    public function setMiddleNameAttribute($value) {
        $this->attributes['middleName'] = strtolower($value);
    }
}

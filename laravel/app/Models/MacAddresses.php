<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MacAddresses extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'mac_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

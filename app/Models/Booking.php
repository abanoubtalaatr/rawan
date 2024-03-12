<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

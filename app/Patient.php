<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name', 'surname', 'dob','gender','occupation','address','business_tel','home_tel','allergy','notes'
    ];
}

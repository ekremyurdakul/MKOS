<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name', 'surname', 'dob','gender','occupation','address','business_tel','home_tel','allergy','notes','document_no','history','medicines'
    ];

    public function documents(){
        return $this->hasMany('App\Document');
    }

    public function examinations(){
        return $this->hasMany('App\Examination');
    }
}

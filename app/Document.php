<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['date','patient_id','name','document_type_id'];

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    public function document_type(){
        return $this->belongsTo('App\DocumentType');
    }
    public function tests(){
        return $this->hasMany('App\Test');
    }
    public function content(){
        return $this->hasMany('App\Content');
    }
}

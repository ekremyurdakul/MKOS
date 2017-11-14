<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    protected $fillable = ['location','document_id'];

    public function getImageData(){

        return 'data:image/' . 'jpeg' . ';base64,'
            . base64_encode(Storage::get($this->location));
    }
}

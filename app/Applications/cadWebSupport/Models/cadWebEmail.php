<?php

namespace App\Applications\cadWebSupport\Models;

use Illuminate\Database\Eloquent\Model;

class cadWebEmail extends Model
{
    //
    //
    protected $table = 'cadwebemails';
    protected $fillable = [
        'from', 'to', 'name', 'cc', 'subject', 'emailDate', 'bodyText', 'attachment'];

//    public function setEmailDateAttribute($value) {
//
//
//        $date = explode(' ',$value);
//        $date1 = explode('/',$date[0]);
//        $date3 = $date1[2]."-".$date1[1]."-".$date1[0]." ".$date[1];
//        //dd($date3);
//        $this->attributes['emailDate'] = date('Y-m-d H:i:s', strtotime($date3));
//    }
//
//    public function getEmailDateAttribute($value) {
//
//
//        $date = explode(' ',$value);
//        $date1 = explode('/',$date[0]);
//        $date3 = $date1[2]."-".$date1[1]."-".$date1[0]." ".$date[1];
//        //dd($date3);
//        $this->attributes['emailDate'] = date('Y-m-d H:i:s', strtotime($date3));
//    }

}


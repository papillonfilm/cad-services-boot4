<?php

namespace App\Applications\cadWebSupport\Models;

use Illuminate\Database\Eloquent\Model;

class cadEmailTemplate extends Model
{
    //
    protected $table = 'cademailtemplates';

    protected $fillable = [
        'title', 'emailTemplate'];
}

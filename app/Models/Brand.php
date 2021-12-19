<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Brand extends Model
{
    use HasFactory , SoftDeletes;

    //protected $gurded=[];
    protected $fillable = [
        'title_en',
        'title_fa',
        'info_fa',
        'image',
        'province_fa',
        'country_fa',
        'continent_fa',
        'rate',
        'year',
        'made_in_iran',
        'title_en',
        'info_en',
        'province_en',
        'country_en',
        'continent_en',
    ];

}

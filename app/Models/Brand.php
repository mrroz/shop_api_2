<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Brand extends Model
{
    use HasFactory , SoftDeletes;

    protected $gurded=[];
    //protected $fillable = ['title_en','title_fa','info','image',];

}

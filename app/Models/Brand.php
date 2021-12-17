<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

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




    public function updateBrand(Request $request){


    // $livro = Brand::findOrFail($request->id);

        $brandUnique = Brand::query()
             ->where('title_en',$request->title_en)
             ->where('title_fa',$request->title_fa)
             ->where('id','!=',$request->id)->exists();
        if($brandUnique){
            return $this->er(401,'already exists');
        }



       if($request->has('image')){
        $imagePath = Carbon::now()->microsecond . '.'. $request->image->extension();
        $request->image->storeAs('images/brands',$imagePath,'public');

       }




       $this->update([

        [
            'title_fa'=>$request->has('title_fa')? $request->title_fa :$this->title_fa,
            'info_fa'=>$request->has('info_fa')? $request->title_fa:$this->info_fa,
            'continent_fa'=>$request->has('continent_fa')? $request->continent_fa:$this->continent_fa,
            'country_fa'=>$request->has('country_fa')? $request->country_fa:$this->country_fa,
            'province_fa'=>$request->has('province_fa')? $request->province_fa:$this->province_fa,
            'made_in_iran'=>$request->has('made_in_iran')? $request->made_in_iran:$this->made_in_iran,
            'rate'=>$request->has('rate')? $request->rate:$this->rate,
            'year'=>$request->has('year')? $request->year:$this->year,
            'image'=>$request->has('image')? $imagePath:$this->image,
           // 'English'=>'********************* English',
            'title_en'=>$request->has('title_en')? $request->title_en:$this->title_en,
            'info_en'=>$request->has('info_en')? $request->info_en:$this->info_en,
            'continent_en'=>$request->has('continent_en')? $request->continent_en:$this->continent_en,
            'province_en'=>$request->has('province_en')? $request->province_en:$this->province_en,
            'country_en'=>$request->has('country_en')? $request->country_en:$this->country_en,
        ]

       ]);





    }

}




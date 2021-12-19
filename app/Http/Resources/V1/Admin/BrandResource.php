<?php

namespace App\Http\Resources\V1\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $created_at= $this->created_at;
        $updated_at= $this->updated_at;
        $now = Carbon::now();


        $deleted =$this->deleted_at?'yes' : 'No' ;

        $test= $this->updated_at->toDateTimeString();
        $updateTime = $this->updated_at ==$now?0 :$this->updated_at;
        $lastDays =$now->diffInDays($updateTime);
        $lastHours=$now->diffInHours($updateTime) ;
        $lastMin  =$now->diffInMinutes($updateTime) ;
        $lastSec  =$now->diffInSeconds($updateTime) ;
        $isUpdated = $created_at->diffInSeconds($updated_at)==0? 'no' : 'yes';

        return [


            'id'=> strval($this->id),
            'title_fa'=> $this->title_fa,
            'info_fa'=> $this->info_fa,
            'rate'=> $this->rate,
            'province_fa'=> $this->province_fa,
            'country_fa'=> $this->country_fa,
            'continent_fa'=> $this->continent_fa,
            'isUpdated'=> $isUpdated,
            'made_in_iran'=> strval(1),
            'image'=> $this->image,
            'English'=> '**************** to English',
            'title_en'=> $this->title_en,
            'info_en'=> $this->info_en,
            'province_en'=> $this->province_en,
            'country_en'=> $this->country_en,
            'continent_en'=> $this->continent_en,
            'created_at'=> $this->created_at->toDateTimeString(),
            'updated_at'=>$this->updated_at->toDateTimeString(),
            'lastUpdate_to_days'=>  strval($lastDays ) ,
            'lastUpdate_to_Hours'=> strval($lastHours ) ,
            'lastUpdate_to_Minutes'=>  strval($lastMin) ,
            'lastUpdate_to_Seconds'=>  strval($lastSec)  ,
            'LayotResponse'=>'BrandResource',

        ];
    }
}

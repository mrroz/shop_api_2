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
        //return parent::toArray($request);


        // $now = Carbon::now();
        // $updateTime = $this->updated_at;
        // $lastDays =$now->diffInDays($updateTime)<=1?null:$now->diffInDays($updateTime). ' days ' ;
        // $lastHours=$now->diffInDays($updateTime)>=1?null:$now->diffInHours($updateTime). ' Hours ' ;
        // $lastMin  =$now->diffInDays($updateTime)>=2?null:$now->diffInMinutes($updateTime).' min ' ;
        // $lastSec  =$now->diffInDays($updateTime)>=2?null:$now->diffInSeconds($updateTime) .' Seconds ';
        // $lastUpdate = $lastDays  . $lastHours  . $lastMin .$lastSec . 'ago' ;


        $created_at= $this->created_at;
        $updated_at= $this->updated_at;
        $now = Carbon::now();

        $test= $this->updated_at->toDateTimeString();
        $updateTime = $this->updated_at ==$now?null :$this->updated_at;
        $lastDays =$now->diffInDays($updateTime);
        $lastHours=$now->diffInHours($updateTime) ;
        $lastMin  =$now->diffInMinutes($updateTime) ;
        $lastSec  =$now->diffInSeconds($updateTime) ;
        $lastMilSec  =$now->diffInMilliseconds($updateTime);
        $lastMicSec  =$now->diffInMicroseconds($updateTime);
        $lastUpdate = $lastDays  . $lastHours  . $lastMin .$lastSec . 'ago' ;
        $isUpdated = $created_at->diffInMicroseconds($updated_at)==0?false : true;

        return [

            'id'=>  strval($this->id),
            'title_fa'=> $this->title_fa,
            'title_en'=> $this->title_en,
            'image'=> $this->image,
            'made_in_iran'=> strval(1),
            'info_fa'=> $this->info,
            'rate'=> '5.5',
            'ostan_fa'=> 'تهران',
            'country_fa'=> 'ايران',
            'continent_fa'=> 'آسيا',
            'info_en'=> 'A motorcycle company is owned by one of the children',
            'ostan_en'=> 'tehran',
            'country_en'=> 'Iran',
            'continent_en'=> 'Asia',
            'isUpdated'=> $isUpdated,
            'created_at'=> $this->created_at->toDateTimeString(),
            'updated_at'=>$this->updated_at->toDateTimeString(),
            'lastUpdate_to_days'=>  strval($lastDays ) ,
            'lastUpdate_to_Hours'=> strval($lastHours ) ,
            'lastUpdate_to_Minutes'=>  strval($lastMin) ,
            'lastUpdate_to_Seconds'=>  strval($lastSec)  ,
            'lastUpdate_to_Milliseconds'=> strval($lastMilSec )  ,
            'lastUpdate_to_Microseconds'=> strval($lastMicSec )  ,
            'LayotResponse'=>'BrandResource',

        ];
    }
}






// public function ok ($code,$data,$msg=null,$msg_en=null,$status_fa='موفقیت آمیز',$status_en='successful'){

//     return response()->json([
//         'code'=>$code,
//         'total'=>count($data),
//         'lang_fa' =>'******************* فارسي',
//         'from_fa' =>$msg,
//         'status_fa' =>$status_fa,
//         'lang_en' =>'****************** English',
//         'from_en' =>$msg_en,
//         'status_en' =>$status_en,
//         'date' =>'********************* Date',

//         'time' =>Carbon::now()->toDateTimeString(),
//         'time_yer' =>Carbon::now()->format('Y'),
//         'time_month' =>Carbon::now()->format('m'),
//         'time_day' =>Carbon::now()->format('d'),
//         'time_hour' =>Carbon::now()->format('H'),
//         'time_minutes' =>Carbon::now()->format('i'),
//         'time_seconds' =>Carbon::now()->format('s'),
//         'result'=>$data,

//     ]);
// }

<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Admin\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;
use Hekmatinasser\Verta\Verta;

class BrandController extends Controller
{

    public function index()
    {
        $n = Verta::now();
        $brands =Brand::all();
        return $this->ok(200, BrandResource::collection($brands),'برندها','brands',);




        // $now = Carbon::now();

        // $updateTime = $livro->updated_at;
        // $lastDays =$now->diffInDays($updateTime)<=1?null:$now->diffInDays($updateTime). ' days ' ;
        // $lastHours=$now->diffInHours($updateTime)>=2?null:$now->diffInHours($updateTime). ' Hours ' ;
        // $lastMin  =$now->diffInMinutes($updateTime)>=2?null:$now->diffInMinutes($updateTime).' min ' ;
        // $lastSec  =$now->diffInSeconds($updateTime)>=2?null:$now->diffInSeconds($updateTime) .' Seconds ';


        //   $lastUpdate = $lastDays  . $lastHours  . $lastMin .$lastSec . 'ago' ;

    }




    public function store(Request $request){


        $validated = $request->validate([
            'title_fa'=>'required |unique:brands,title_fa',
            'title_en'=>'required |string |unique:brands,title_en',
            'info'=>'string',
            'image'=>'image',
        ]);

        if($validated){

           $imagePath = Carbon::now()->microsecond . '.'. $request->image->extension();
           $request->image->storeAs('images/brands',$imagePath,'public');

            $addModel= Brand::create([
                'title_fa'=>$request->title_fa,
                'title_en'=>$request->title_en,
                'info'=>$request->info,
                'image'=>$imagePath,
            ]);

            return $this->ok(201,$addModel,'brands');
           // $brand->addItemBrand($request);

            $this->ok(201,$validated,'AddModel');

        }


    }




    public function update(Request $request,Brand $brand){


        $livro = Brand::findOrFail($brand->id);
        $validated = $request->validate([
            'title_fa'=>'string |unique:brands,title_fa',
            'title_en'=>'string|unique:brands,title_en',
            'info'=>'string',
            'image'=>'',
        ]);

       if($validated){


       // $imagePath = Carbon::now()->microsecond . '.'. $request->image->extension();
      // {{\Carbon\Carbon::createFromFormat('H:i:s',$time)->format('h:i')}}



          $livro->update($request->all());

       //   $now = Carbon::now();
        //$createTime = $livro->created_at;
       // $createTime = '2021-12-13T09:13:34.000000Z';




           return $this->ok(200,$livro ,'updateBrand','updated');

       }
    }



    public function show($id){}




    public function destroy($id){}






    public function ok($code,$data,$msg_fa=null,$msg_en=null,$status_en='successful',$status_fa='موفقیت آمیز'){

        return response()->json([
            'code'=>$code,
            'total'=>count($data),
            'lang_fa' =>'************************* فارسي fa',
            'from_fa' =>$msg_fa,
            'status_fa' =>$status_fa,
            'time_year_fa'=> Verta::now()->format('Y'),
            'time_month_fa'=> Verta::now()->format('m'),
            'time_day_fa'=> Verta::now()->format('d'),
            'time_hour_fa'=> Verta::now()->format('H'),
            'time_minute_fa'=> Verta::now()->format('i'),
            'time_second_fa'=> Verta::now()->format('s'),
            'time_timezone_fa'=> Verta::now()->format('Y m d H:i:s'),
            'lang_en' =>'************************ English en',
            'from_en' =>$msg_en,
            'status_en' =>$status_en,
            'time_yer_en' =>Carbon::now()->format('Y'),
            'time_month_en' =>Carbon::now()->format('m'),
            'time_day_en' =>Carbon::now()->format('d'),
            'time_hour_en' =>Carbon::now()->format('H'),
            'time_minutes_en' =>Carbon::now()->format('i'),
            'time_seconds_en' =>Carbon::now()->format('s'),
            'time_timezone_en' =>Carbon::now()->toDateTimeString(),
            'result'=>$data,




        ]);
    }


    public function er($code,$data,$msg=null){

        return response()->json([
            'code'=>$code,
            'Error_from' =>$msg,
            'result'=>$data,

        ]);
    }
}

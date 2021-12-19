<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Admin\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;
use Hekmatinasser\Verta\Verta;

class BrandController extends Controller
{


    public function index() {

        $brands = Brand::all();
        return $this->ok(200, BrandResource::collection($brands), 'برندها', 'brands',);
    }





    public function store(Request $request){


        $validated = $request->validate([
            'title_fa' => 'required |string |unique:brands,title_fa',
            'info_fa' => 'string |required',
            'continent_fa' => 'string |required',
            'country_fa' => 'string |required',
            'province_fa' => 'required|string',

            'made_in_iran' => 'required|integer',
            'image' => 'image',
            'rate' => 'integer',
            'year' => 'integer',

            // English input optional except title_en

            'title_en' => ' required|string|unique:brands,title_en',
            'info_en' => 'string',
            'continent_en' => 'string',
            'country_en' => 'string',
            'province_en' => 'string',
            'delete' => 'string',


        ]);

        if ($validated) {

            $imagePath = Carbon::now()->microsecond . '.' . $request->image->extension();
            $request->image->storeAs('images/brands', $imagePath, 'public');

            $addModel = Brand::create([
                'title_fa' => $request->title_fa,
                'info_fa' => $request->info_fa,
                'continent_fa' => $request->continent_fa,
                'country_fa' => $request->country_fa,
                'province_fa' => $request->province_fa,
                'made_in_iran' => $request->made_in_iran,
                'rate' => $request->rate,
                'year' => $request->year,
                'image' => $imagePath,
                // 'English'=>'********************* English',
                'title_en' => $request->title_en,
                'info_en' => $request->info_en,
                'continent_en' => $request->continent_en,
                'province_en' => $request->province_en,
                'country_en' => $request->country_en,


            ]);

            return $this->ok(201, new BrandResource($addModel), 'افزودن برند', 'add_brand');
        }
    }





    public function update(Request $request, Brand $brand){


        $hasData = $request->has('rate') ? 'yes' : 'no';

      // echo 'تا  تابع رسيد';


        $validator = validator::make($request->all(),
            [
                'title_fa' => 'string|unique:brands,title_fa',
                'info_fa' => 'string',
                'continent_fa' => 'string',
                'country_fa' => 'string',
                'province_fa' => 'string',
                'made_in_iran' => 'integer',
                'image' => 'image',
                'rate' => 'integer',
                'year' => 'integer',
                // English input optional except title_en
                'title_en' => 'string|unique:brands,title_en',
                'info_en' => 'string',
                'continent_en' => 'string',
                'country_en' => 'string',
                'province_en' => 'string',
            ]
        );



        if ($validator->fails()) {
            return $this->er(400, 'خطاي ورودي', $validator->getMessageBag());
        }


        else {

            $brandUnique = Brand::query()
                ->where('title_en', $request->title_en)
                ->where('title_fa', $request->title_fa)
                ->where('id', '!=', $request->id)->exists();

            if ($brandUnique) {
                return $this->er(401, 'already exists');
            }


            if ($request->has('image')) {
                $imagePath = Carbon::now()->microsecond . '.' . $request->image->extension();
                $request->image->storeAs('images/brands', $imagePath, 'public');
            }

            $brand->update($request->all());


            return $this->ok(200,$brand,'اپديت شد','updated');

        }
    }





    public function destroy($id) {

        $brand = Brand::findOrFail($id);

        if($brand){


         $brand->delete = 'deleted';
         $brand->save();


         $brand->delete();
         return $this->ok(200,$brand->title_fa,'پاك شد','deleted');

        }
 

        else {

         return $this->ok(200,'  not found...',' پاك شده قبلا','deleted');

        }

     }




    public function show($id){
    }














    public function ok($code, $data, $msg_fa = null, $msg_en = null, $status_en = 'successful', $status_fa = 'موفقیت آمیز')
    {

        return response()->json([
            'code' => $code,
            // 'total'=>count($data),
            'lang_fa' => '************************* فارسي fa',
            'from_fa' => $msg_fa,
            'status_fa' => $status_fa,
            'time_year_fa' => Verta::now()->format('Y'),
            'time_month_fa' => Verta::now()->format('m'),
            'time_day_fa' => Verta::now()->format('d'),
            'time_hour_fa' => Verta::now()->format('H'),
            'time_minute_fa' => Verta::now()->format('i'),
            'time_second_fa' => Verta::now()->format('s'),
            'time_timezone_fa' => Verta::now()->format('Y m d H:i:s'),
            'lang_en' => '************************ English en',
            'from_en' => $msg_en,
            'status_en' => $status_en,
            'time_yer_en' => Carbon::now()->format('Y'),
            'time_month_en' => Carbon::now()->format('m'),
            'time_day_en' => Carbon::now()->format('d'),
            'time_hour_en' => Carbon::now()->format('H'),
            'time_minutes_en' => Carbon::now()->format('i'),
            'time_seconds_en' => Carbon::now()->format('s'),
            'time_timezone_en' => Carbon::now()->toDateTimeString(),
            // 'local'=>setlocale(LC_ALL,1),
            'result' => $data,




        ]);
    }




    public function er($code, $data, $msg = 'error')
    {

        return response()->json([
            'code' => $code,
            'Error_from' => $msg,
            'result' => $data,

        ]);
    }
}

















    //     return $this->ok(200,$upBrand,'اپديت برند','update_brand');
   // $brand = Brand::findOrFail($request->id);




                // $upBrand = $brand->update([

            //     [
            //         'title_fa' => $request->title_fa == null ? $brand->title_fa : $request->title_fa,
            //         'info_fa' => $request->title_fa == null ? $brand->title_fa : $request->info_fa,
            //         'continent_fa' => $request->continent_fa == null ? $brand->continent_fa : $request->continent_fa,
            //         'country_fa' => $request->country_fa == null ? $brand->country_fa : $request->country_fa,
            //         'province_fa' => $request->province_fa == null ? $brand->province_fa : $request->province_fa,
            //         'made_in_iran' => $request->made_in_iran == null ? $brand->made_in_iran : $request->made_in_iran,
            //         'rate' =>  $request->rate ==null?    $brand->rate : $request->rate,
            //         'year' => $request->year == null ? $brand->year : $request->year,
            //         'image' => $request->image == null ? $brand->image : $imagePath,
            //         // 'English'=>'********************* English',
            //         'title_en' => $request->title_en == null ? $brand->title_en : $request->title_en,
            //         'info_en' => $request->info_en == null ? $brand->info_en : $request->info_en,
            //         'continent_en' => $request->continent_en == null ? $brand->continent_en : $request->continent_en,
            //         'province_en' => $request->province_en == null ? $brand->province_en : $request->province_en,
            //         'country_en' => $request->country_en == null ? $brand->country_en : $request->country_en,
            //     ]


            // ]);

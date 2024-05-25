<?php

namespace App\Http\Controllers\Api;

use App\Classes\HomePageBuilder\HomePageBuilder;
use App\Http\Controllers\Controller;
use App\Models\Content;

class HomePageController extends Controller
{
    public function index()
    {
        $model = Content::all();
        return response()->json([
            "data" => HomePageBuilder::build($model),
            "res_code" => 200,
            "res_msg" => "successful find"
        ]);
        //     return   HomePageCollection::collection(HomePageBuilder::build($model));
//        return  new HomePageResource($model);
        //   return  new HomePageCollection($model);
        // return HomePageResource::collection($model);
        // return ($model);
    }
}

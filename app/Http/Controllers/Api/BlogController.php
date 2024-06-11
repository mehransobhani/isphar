<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getByCatId(Request $request)
    {
        $catId=$request->cat_id;
        if ($request->page == -1)
            $response=Post::whereHas("cat",function ($query) use ($catId){
                $query->where("id",$catId);
            })->with("cat")->get();
        else
            $response=Post::whereHas("cat",function ($query) use ($catId){
            $query->where("id",$catId);
        })->with("cat")->paginate(24);
        return $this->apiResponse($response);
    }

    public function view($id)
    {
        $response=Post::with("cat")->where("id",$id)->orWhere("alias",$id)->first();
        return $this->apiResponse($response);
    }
}

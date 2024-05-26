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
        $response=Post::whereHas("cat",function ($query) use ($catId){
            $query->where("id",$catId);
        })->paginate(24);
        return $this->apiResponse($response);
    }

    public function view($id)
    {
        $response=Post::find($id);
        return $this->apiResponse($response);
    }
}

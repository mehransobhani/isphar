<?php

namespace App\Http\Controllers\Api;

use App\Classes\HomePageBuilder\HomePageBuilder;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Post;

class HomePageController extends Controller
{
    public function index()
    {
        $model = Content::all();
        $response = HomePageBuilder::build($model);
        $lastPost = Post::select(
            "alias",
            "created_at as date",
            "image",
            "content",
            "title"
        )->latest('id')->limit(5)->get();
        $response->last_posts = $lastPost;
        return $this->apiResponse($response);
    }
}

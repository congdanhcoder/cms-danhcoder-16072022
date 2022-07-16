<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Contracts\Service\Attribute\Required;

use App\Helper\File;
use Illuminate\Http\Request;
use App\Models\CatPost;
use App\Models\Post;
use App\Models\Gallery;
use App\Helper\Recusive;

class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //
    function index()
    {
        $posts = Post::orderBy('id', 'DESC')->get();
        return view('admin.pages.Dashboard', compact('posts'));
    }
}

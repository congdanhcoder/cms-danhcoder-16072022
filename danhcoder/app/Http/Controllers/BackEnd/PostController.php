<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
/* import model */
use App\Models\CatPost;
use App\Models\Post;
use App\Models\Posts_and_cats;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/* import function helper */
use App\Helper\Recusive;
use App\Helper\FomatSlug;
use App\Helper\File;

/* ------- */

class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //

    function __construct()
    {
        /* chạy lệnh này để khắc phục thanh phân trang bị bể */
        Paginator::useBootstrap();
    }
    /* 
    **
    STAR CONTROLLER CATEGORY POSTS
    **
    */
    public function numPostCat($id)
    {
        $cat =  CatPost::find($id);
        return $cat->posts;
    }
    function listCatPost()
    {
        $cats = CatPost::all();
        $numAllData = count($cats);
        $call = new PostController;
        for ($index = 0; $index < $numAllData; $index++) {
            $cats[$index]['numberProdct'] = count($call->numPostCat($cats[$index]['id']));
        }
        if ($cats->count() > 0) {
            $recusive = new Recusive;
            $echoCats = $recusive->RecusiveCat($cats, 0, 'post');
        } else {
            $echoCats = null;
        }
        return view('admin.pages.posts.CatPosts', compact('echoCats'));
    }

    function addCatPost(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255|unique:cat_posts',
            ],
            [
                'title.required' => 'Tiêu đề không được trống',
                'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                'title.unique' => 'Tiêu đề đã tồn tại',
            ]
        );

        $formatSlug = new FomatSlug;
        $slug = 'category/' . $formatSlug->slug($request->title) . '.html';
        $tableCat = new CatPost;
        CatPost::create(
            [
                'title' => $request->title,
                'slug' => $slug,
                'parent_id' => $request->parent_id,
            ]
        );

        $request->session()->flash('sessionStatus', "Thêm dữ liệu thành công");
        $cats = CatPost::all();
        $recusive = new Recusive;
        $echoCats = $recusive->RecusiveCat($cats, 0, 'post');
        return redirect()->route('listCatPost');
    }

    function editCatPost($id)
    {
        $cat = CatPost::find($id);
        if ($cat->parent_id <> 0) {
            $catParent = CatPost::find($cat->parent_id);
        } else {
            $catParent = null;
        }
        $cats = CatPost::all();
        $recusive = new Recusive;
        $echoCats = $recusive->RecusiveCat($cats, 0, 'post');
        return view('admin.pages.posts.EditCatPosts', compact('echoCats', 'cat',  'catParent'));
    }

    function updateCatPost(Request $request)
    {
        $id = $request->id;
        $cat = CatPost::find($id);

        /* Title Update */
        if ($request->title <> $cat->title) {
            $request->validate(
                [
                    'title' => 'required|max:255|unique:cat_posts',
                ],
                [
                    'title.required' => 'Tiêu đề không được trống',
                    'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                    'title.unique' => 'Tiêu đề đã tồn tại',
                ]
            );
            $formatSlug = new FomatSlug;
            $slug = 'category/' . $formatSlug->slug($request->title) . '.html';
        } else {
            $slug = $cat->slug;
        }

        /* upload avatar */
        if ($request->inputGallery <> null) {
            $slugAvatar = $request->inputGallery;
        } elseif ($_FILES['avatarFile']['name'] <> "") {
            $file = new File;
            $slugAvatar = $file->uploadImgs($_FILES['avatarFile']['name'], $_FILES['avatarFile']['tmp_name'], $_FILES['avatarFile']['size']);
            Gallery::create(
                [
                    'slug' => $slugAvatar,
                ]
            );
        } else {
            $slugAvatar = null;
        }
        CatPost::where('id', $id)->update(
            [
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'content' => $request->content,
                'avatar' => $slugAvatar,
                'parent_id' => $request->parent_id,
            ]
        );

        $request->session()->flash('sessionStatus', "Cập nhập thành công");
        return redirect()->route('listCatPost');
    }

    function deleteCatPost(Request $request, $id)
    {
        $catDelete = CatPost::find($id)->parent_id;

        if ($catDelete <> 0) {
            posts_and_cats::where('id_cat', $id)->update(
                ['id_cat' => $catDelete]
            );
        } else {
            posts_and_cats::where('id_cat', $id)->update(
                ['id_cat' => 1]
            );
        }
        CatPost::where('parent_id', $id)->update(
            ['parent_id' => 0]
        );
        CatPost::where('id', $id)->delete();
        $request->session()->flash('sessionStatus', "Đã xoá danh mục thành công");
        return redirect()->route('listCatPost');
    }
    /* 
    **
    END CONTROLLER CATEGORY POSTS
    **
    */


    /* 
    **
        ------ STAR CONTROLLER POST
    **
    */
    function listPost()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(1);
        return view('admin.pages.posts.ListPosts', compact('posts'));
    }

    function addPost()
    {
        $cats = CatPost::all();
        if ($cats->count() > 0) {
            $recusive = new Recusive;
            $echoCats = $recusive->RecusiveCat($cats, 0, 'post');
        } else {
            $echoCats = null;
        }
        return view('admin.pages.posts.AddPost', compact('echoCats'));
    }
    function insertPost(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|max:255|unique:posts',
            ],
            [
                'title.required' => 'Tiêu đề không được trống',
                'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                'title.unique' => 'Tiêu đề đã tồn tại',
            ]
        );
        /* format slug post */
        $formatSlug = new FomatSlug;
        $slug = 'posts/' . $formatSlug->slug($request->title) . '.html';

        /* upload avatar */
        if ($request->inputGallery <> null) {
            $slugAvatar = $request->inputGallery;
        } else {
            $slugAvatar = null;
        }

        if (!isset($request->catId)) {
            $request->catId = 1;
        }

        /* add post */
        $postInsert = Post::create(
            [
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'content' => $request->content,
                'avatar' => $slugAvatar,
                'status' => $request->status,
                'index' => $request->index,
                'user_id' => $request->user_id,
            ]
        );
        /* get id insert */
        $idPost = $postInsert->id;
        $postIs = Post::find($idPost);

        /* add all post Id in table Posts_and_cats */
        $postIs->cats()->attach($request->catId);
        $request->session()->flash('sessionStatus', "Thêm bài viết thành công");
        return redirect()->route('listPost');
    }

    function editPost($id)
    {
        $post = Post::find($id);
        $userPost = $post->user;
        $idGetUser = $post['user_id'];
        $users = User::where('id', '<>', $idGetUser)->get();
        $cats = CatPost::all();
        $recusive = new Recusive;
        $echoCats = $recusive->RecusiveCat($cats, 0, 1);

        $getCats = $post->cats;
        return view('admin.pages.posts.EditPost', compact('post', 'echoCats', 'getCats', 'users', 'userPost'));
    }

    function updatePost(Request $request)
    {

        /* get id insert */
        $id = $request->id;

        if (isset($request->catId)) {
            /* UPDATE CAT PRODUCT */
            $pots = Post::find($id);
            $pots->cats()->sync($request->catId);
        }


        /* Title Update */
        $post = Post::find($id);
        if ($request->title <> $post->title) {
            $request->validate(
                [
                    'title' => 'required|max:255|unique:cat_posts',
                ],
                [
                    'title.required' => 'Tiêu đề không được trống',
                    'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                    'title.unique' => 'Tiêu đề đã tồn tại',
                ]
            );
            $formatSlug = new FomatSlug;
            $slug = 'posts/' . $formatSlug->slug($request->title) . '.html';
        } else {
            $slug = $post->slug;
        }
        /* upload avatar */
        if ($request->inputGallery <> null) {
            $slugAvatar = $request->inputGallery;
        } else {
            $slugAvatar = null;
        }
        Post::where('id', $id)->update(
            [
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'content' => $request->content,
                'avatar' => $slugAvatar,
                'status' => $request->status,
                'index' => $request->index,
                'user_id' => $request->user_id,
            ]
        );

        $request->session()->flash('sessionStatus', "Cập nhập thành công");
        return redirect()->route('listPost');
    }

    function deletePost(Request $request, $id)
    {
        $postId = Post::find($id);
        /* Delete All Post Id in Table Posts_and_cats */
        $postId->cats()->detach($request->catId);
        Post::where('id', $id)->delete();
        $request->session()->flash('sessionStatus', "Đã xoá bài viết");
        return redirect()->route('listPost');
    }

    function seachPost(Request $request)
    {
        $valueSeach = $_POST['valueSeach'];
        $posts = Post::where('title', 'like', '%' . $valueSeach . '%')->orderBy('id', 'DESC')->get();
        $outputPa = '';
        $stt = 0;
        foreach ($posts as $post) {
            $stt++;
            if ($post->status == 0) {
                $status = '<p class="btn-draft btn-su btn">Bản nháp</p>';
            } else {
                $status = '<p class="btn-sold btn-se btn">Đăng</p>';
            };
            $outputPa .= '<tr class="item-post">
                    <th scope="row"><p>' . $stt . '</p></th>
                    <td><p>' . $post->title . '</p></td>
                    <td class="stratus">' . $status . '</td>
                    <td>
                        <div class="box-action dl-flex">
                            <a href="edit-post/' . $post->id . '">
                                <p class="btn btn-edit btn-pr">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </a>
                            <a href="delete-post/' . $post->id . '">
                                <p class="btn btn-delete btn-se">
                                    <i class="fa-solid fa-trash-can"></i>
                                </p>
                            </a>
                            <a href="' . asset($post->slug) . '" target="_blank">
                                <p class="btn btn-eye btn-su">
                                    <i class="fa-solid fa-eye"></i>
                                </p>
                            </a>
                        </div>
                    </td>
                </tr>';
        };
        $outSeach = '<p class="btn-more btn btn-se">Huỷ tìm kiếm</p>';
        return Response()->json([
            "success" => true,
            "outputPa" => $outputPa,
            "outSeach" => $outSeach
        ]);
    }
}

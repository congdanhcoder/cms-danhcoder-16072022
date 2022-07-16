<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
/* import model */
use App\Models\CatProduct;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Models\products_and_cats;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/* import function helper */
use App\Helper\Recusive;
use App\Helper\FomatSlug;
use App\Helper\File;

/* ------- */

class ProductController extends BaseController
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
    STAR CONTROLLER CATEGORY products
    **
    */
    public function numProductCat($id)
    {
        $cat =  CatProduct::find($id);
        return $cat->products;
    }
    function listCatProduct()
    {
        $cats = CatProduct::all();
        $numAllData = count($cats);
        $call = new ProductController;
        for ($index = 0; $index < $numAllData; $index++) {
            $cats[$index]['numberProdct'] = count($call->numProductCat($cats[$index]['id']));
        }
        /* return $cats; */

        if ($cats->count() > 0) {
            $recusive = new Recusive;
            $echoCats = $recusive->RecusiveCat($cats, 0, 'product');
        } else {
            $echoCats = null;
        }

        return view('admin.pages.products.CatProducts', compact('echoCats'));
    }

    function addCatProduct(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255|unique:cat_products',
            ],
            [
                'title.required' => 'Tiêu đề không được trống',
                'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                'title.unique' => 'Tiêu đề đã tồn tại',
            ]
        );

        $formatSlug = new FomatSlug;
        $slug = 'category/' . $formatSlug->slug($request->title) . '.html';
        $tableCat = new CatProduct;
        CatProduct::create(
            [
                'title' => $request->title,
                'slug' => $slug,
                'parent_id' => $request->parent_id,
            ]
        );

        $request->session()->flash('sessionStatus', "Thêm dữ liệu thành công");
        $cats = CatProduct::all();
        $recusive = new Recusive;
        $echoCats = $recusive->RecusiveCat($cats, 0, 'product');
        return redirect()->route('listCatProduct');
    }

    function editCatProduct($id)
    {
        $cat = CatProduct::find($id);
        if ($cat->parent_id <> 0) {
            $catParent = CatProduct::find($cat->parent_id);
        } else {
            $catParent = null;
        }
        $cats = CatProduct::all();
        $recusive = new Recusive;
        $echoCats = $recusive->RecusiveCat($cats, 0, 'product');
        return view('admin.pages.products.EditCatProducts', compact('echoCats', 'cat',  'catParent'));
    }

    function updateCatProduct(Request $request)
    {
        $id = $request->id;
        $cat = CatProduct::find($id);

        /* Title Update */
        if ($request->title <> $cat->title) {
            $request->validate(
                [
                    'title' => 'required|max:255|unique:cat_products',
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

        CatProduct::where('id', $id)->update(
            [
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'content' => $request->content,
                'avatar' => $request->inputGalleryAvatar,
                'parent_id' => $request->parent_id,
            ]
        );

        $request->session()->flash('sessionStatus', "Cập nhập thành công");
        return redirect()->route('listCatProduct');
    }

    function deleteCatProduct(Request $request, $id)
    {

        $catDelete = CatProduct::find($id)->parent_id;

        if ($catDelete <> 0) {
            products_and_cats::where('id_cat', $id)->update(
                ['id_cat' => $catDelete]
            );
        } else {
            products_and_cats::where('id_cat', $id)->update(
                ['id_cat' => 1]
            );
        }

        CatProduct::where('parent_id', $id)->update(
            ['parent_id' => 0]
        );

        CatProduct::where('id', $id)->delete();
        $request->session()->flash('sessionStatus', "Đã xoá danh mục thành công");
        return redirect()->route('listCatProduct');
    }
    /* 
    **
    END CONTROLLER CATEGORY PRODUCTS
    **
    */


    /* 
    **
        ------ STAR CONTROLLER PRODUCTS
    **
    */
    function listProduct()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(1);
        return view('admin.pages.products.ListProduct', compact('products'));
    }
    function addProduct()
    {
        $cats = CatProduct::all();
        if ($cats->count() > 0) {
            $recusive = new Recusive;
            $echoCats = $recusive->RecusiveCat($cats, 0, 'product');
        } else {
            $echoCats = null;
        }
        /*  return $echoCats; */
        return view('admin.pages.products.AddProduct', compact('echoCats'));
    }

    function  insertProduct(Request $request)
    {
        if ($request->priceSale <> null) {
            $price = $request->price;
            $request->validate(
                [
                    'title' => 'required|max:255|unique:products',
                    'priceSale' => "lt:{$price}",

                ],
                [
                    'title.required' => 'Tiêu đề không được trống',
                    'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                    'title.unique' => 'Tiêu đề đã tồn tại',

                    'priceSale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá bán'
                ]
            );
        } else {
            $request->validate(
                [
                    'title' => 'required|max:255|unique:products',
                ],
                [
                    'title.required' => 'Tiêu đề không được trống',
                    'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                    'title.unique' => 'Tiêu đề đã tồn tại',
                ]
            );
        }

        /* format slug post */
        $formatSlug = new FomatSlug;
        $slug = 'products/' . $formatSlug->slug($request->title) . '.html';

        /* add product */
        $productInsert = Product::create(
            [
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'content' => $request->content,
                'avatar' => $request->inputGalleryAvatar,
                'price' => $request->price,
                'price_sale'  => $request->priceSale,
                'amount' => $request->amount,
                'star_rating' => $request->starRating,
                'share_code' => $request->shareCode,
                'status' => $request->status,
                'index' => $request->index,
                'user_id' => $request->user_id,
            ]
        );
        /* get id insert */
        $idProduct = $productInsert->id;
        if (!empty($request->catId)) {
            foreach ($request->catId as $iteamCatId) {
                Products_and_cats::create(
                    [
                        'id_product' => $idProduct,
                        'id_cat' => $iteamCatId,
                    ]
                );
            }
        } else {
            Products_and_cats::create(
                [
                    'id_product' => $idProduct,
                    'id_cat' => 1,
                ]
            );
        }
        /* upload Thumb Product image_products  $idProduct*/
        if (isset($request->inputThumbGallery)) {
            foreach ($request->inputThumbGallery as $thumbGallerry) {
                ImageProduct::create(
                    [
                        'slug' => $thumbGallerry,
                        'product_id' => $idProduct,
                    ]
                );
            }
        }
        $request->session()->flash('sessionStatus', "Thêm sản phẩm thành công");
        return redirect()->route('listProduct');
    }
    function editProduct($id)
    {
        $product = Product::find($id);
        $userProduct = $product->user;
        $imgThumbs = $product->imgProducts;
        $getCats = $product->cats;
        $cats = CatProduct::all();
        $recusive = new Recusive;
        $idGetUser = $product['user_id'];
        $users = User::where('id', '<>', $idGetUser)->get();
        $echoCats = $recusive->RecusiveCat($cats, 0, 'product');
        return view('admin.pages.products.EditProduct', compact('echoCats', 'getCats', 'product', 'imgThumbs', 'users', 'userProduct'));
    }
    function updateProduct(Request $request)
    {

        $id = $request->id;

        $products = Product::find($id);

        $products->avatar;

        $vali = array();
        if ($request->title == $products['title']) {
            $erro['name'] = "Tên không đổi";
            $slug = $products['slug'];
        } else {
            $formatSlug = new FomatSlug;
            $slug = 'products/' . $formatSlug->slug($request->title) . '.html';
            $vali['title'] = 'required|max:255|unique:products';
        }
        if ($request->priceSale == $products['price_sale']) {
            $erro['priceSale'] = "Giá khuyến mãi không đổi";
        } else {
            $price = $request->price;
            $vali['priceSale'] = "lt:{$price}";
        }

        $request->validate(
            $vali,
            [
                'title.required' => 'Tiêu đề không được trống',
                'title.max' => 'Tiêu đề khốt vượt quá 255 ký tự không được trống',
                'title.unique' => 'Tiêu đề đã tồn tại',

                'priceSale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá bán'
            ]
        );

        /* format slug post */

        $productInsert = Product::where('id', $id)->update(
            [
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'content' => $request->content,
                'avatar' => $request->inputGalleryAvatar,
                'price' => $request->price,
                'price_sale'  => $request->priceSale,
                'amount' => $request->amount,
                'star_rating' => $request->starRating,
                'share_code' => $request->shareCode,
                'status' => $request->status,
                'index' => $request->index,
                'user_id' => $request->user_id,
            ]
        );

        if (isset($request->catId)) {
            /* UPDATE CAT PRODUCT */
            $product = Product::find($id);
            $product->cats()->sync($request->catId);
        }

        /* upload Thumb Product image_products  $idProduct*/
        if (isset($request->imgDelete)) {
            foreach ($request->imgDelete as $thumbDelete) {
                ImageProduct::where('id', $thumbDelete)->delete();
            }
        }
        if (isset($request->inputThumbGallery)) {
            foreach ($request->inputThumbGallery as $thumbGallerry) {
                ImageProduct::create(
                    [
                        'slug' => $thumbGallerry,
                        'product_id' => $id,
                    ]
                );
            }
        }
        $request->session()->flash('sessionStatus', "Cập nhập sản phẩm thành công");
        return redirect()->route('listProduct');
    }
    function deleteProduct(Request $request, $id)
    {
        ImageProduct::where('product_id', $id)->delete();
        Products_and_cats::where('id_product', $id)->delete();
        Product::where('id', $id)->delete();
        $request->session()->flash('sessionStatus', "Xoá sản phẩm thành công!");
        return redirect()->route('listProduct');
    }


    function seachProduct(Request $request)
    {
        $valueSeach = $_POST['valueSeach'];
        $products = Product::where('title', 'like', '%' . $valueSeach . '%')->orderBy('id', 'DESC')->get();
        $outputPa = '';
        $stt = 0;
        foreach ($products as $product) {
            $stt++;
            if ($product->status == 0) {
                $status = '<p class="btn-draft btn-su btn">Bản nháp</p>';
            } elseif ($product->status == 1) {
                $status = '<p class="btn-sold btn-se btn">Đang bán</p>';
            } else {
                $status = '<p class="btn-sold btn-pr btn">Bán hết</p>';
            };
            $outputPa .= '<tr class="item-post">
                    <th scope="row"><p>' . $stt . '</p></th>
                    <td><p>' . $product->title . '</p></td>
                    <td class="stratus">' . $status . '</td>
                    <td>
                        <div class="box-action dl-flex">
                            <a href="edit-post/' . $product->id . '">
                                <p class="btn btn-edit btn-pr">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </a>
                            <a href="delete-post/' . $product->id . '">
                                <p class="btn btn-delete btn-se">
                                    <i class="fa-solid fa-trash-can"></i>
                                </p>
                            </a>
                            <a href="' . asset($product->slug) . '" target="_blank">
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

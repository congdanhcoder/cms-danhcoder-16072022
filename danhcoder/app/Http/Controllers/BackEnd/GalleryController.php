<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Helper\File;
/* import model */
use App\Models\Gallery;
use App\Helper\Recusive;

/* ------- */

use Illuminate\Pagination\Paginator;

class GalleryController extends BaseController
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
    function listGallery()
    {
        $gallerys = Gallery::orderBy('id', 'DESC')->paginate(10);
        $allGallery = count(Gallery::all());
        if ($allGallery <= 10) {
            $btnMore = "none";
        } else {
            $btnMore = "block";
        }
        return view('admin.pages.gallerys.Gallery', compact('gallerys', 'btnMore'));
    }

    public function uploadAjaxImg(Request $request)
    {
        if ($request->file('file')) {
            $file = new File;
            $numArr = count($_FILES['file']['name']);
            for ($index = 0; $index < $numArr; $index++) {
                $fileNote = $file->uploadImgs($_FILES['file']['name'][$index], $_FILES['file']['tmp_name'][$index], $_FILES['file']['size'][$index]);
                Gallery::create(
                    [
                        'slug' => $fileNote,
                    ]
                );
            }
            $galleryPas = Gallery::orderBy('id', 'DESC')->paginate(10);
            /* Use for gallery page */
            $outputScrip =  " <script>
                                $('.copy-content-ajax').click(function (e) {
                                    e.preventDefault();
                                    function copyToClipboard(text) {
                                        var sampleTextarea = document.createElement('textarea');
                                        document.body.appendChild(sampleTextarea);
                                        sampleTextarea.value = text;
                                        sampleTextarea.select(); 
                                        document.execCommand('copy');
                                        document.body.removeChild(sampleTextarea);
                                        alert('Đã Copy URL: ' + text)
                                    }
                                    var copyText = $(this).attr('data-url');;
                                    copyToClipboard(copyText);
                                });
                                $('.btn-delete-image-ajax').click(function (e) {
                                    var linkImage = $(this).attr('data-url');
                                    var idImage = $(this).attr('id-image');
                                    if (confirm('Bạn có chắc chắn muốn xoá!')) {
                                        $(this).parent('.box-img').hide();
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name=" . '"csrf-token"' . "]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            type: 'POST',
                                            data: { idImage: idImage, linkImage: linkImage },
                                            url: 'delete-ajax-gallery',
                                            success: (data) => {
                                                $('.box-gallery').html(data.outputPa);
                                                $('.box-gallery-add-avatar').html(data.outputAv);
                                                $('.box-gallery-add-thumb').html(data.outputThumb);
                                                $('.note-form').text(data.note);
                                                $('.box-more-img-ajax').css('display', data.btnMore);
                                                console.log(data);
                                            },
                                            error: function (data) {
                                                console.log(data);
                                            }
                                        });
                                    } else {
                                        return false;
                                    }
                                });
                            </script>";
            $outputPa = '';
            foreach ($galleryPas as $gallery) {
                $outputPa .=
                    ' <div class="box-cover-img"><div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '">
                        <i class="fa-solid fa-trash-can"></i>
                    </p>
                        <div class="btn-positon">
                            
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <p class="btn btn-eye btn-su"><a href="' . asset($gallery->slug) . '" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            </p>
                        </div>
                    </div></div>';
            }
            $outputPa .= $outputScrip;
            /* Use for add vartar */
            $outputAv = '';
            foreach ($galleryPas as $gallery) {
                $outputAv .=
                    '<div class="box-cover-img"> <div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '">
                        <i class="fa-solid fa-trash-can"></i>
                        </p>
                        <div class="btn-positon">
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <p class="btn btn-eye btn-su"><a href="' . asset($gallery->slug) . '" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            </p>
                        </div>
                        <div class="box-attr-img">
                        <input type="radio" name="radio-avatar" value="' . $gallery->slug . '">
                        </div>
                    </div></div>';
            }
            $outputAv .= $outputScrip;
            $outputThumb = '';
            foreach ($galleryPas as $gallery) {
                $outputThumb .=
                    '<div class="box-cover-img"> <div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '"><i class="fa-solid fa-trash-can"></i>
                        </p>
                        <div class="btn-positon">
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <p class="btn btn-eye btn-su"><a href="' . asset($gallery->slug) . '" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            </p>
                        </div>
                        <div class="box-attr-img">
                        <input type="checkbox" name="check-thumb[]" value="' . $gallery->slug . '">
                        </div>
                    </div></div>';
            }
            $outputThumb .= $outputScrip;

            $allGallery = count(Gallery::all());
            if ($allGallery <= 10) {
                $btnMore = "none";
            } else {
                $btnMore = "block";
            }
            return Response()->json([
                "success" => true,
                "outputPa" => $outputPa,
                "btnMore" => $btnMore,
                "outputAv" => $outputAv,
                "outputThumb" => $outputThumb,
                "note" => "Upload thành công!",
            ]);
        }

        return Response()->json([
            "success" => false,
            'note' => 'Có lỗi hãy kiểm tra lại',
            "file" => ''
        ]);
    }

    public function deleteAjaxImg(Request $request)
    {
        if (isset($_POST['linkImage'])) {
            $id = $_POST['idImage'];

            $url = array(
                $url = $_POST['linkImage']
            );

            Gallery::find($id = $_POST['idImage'])->delete();
            $file = new File;
            $file->deleteFile($url);
            $outputScrip =  " <script>$('.copy-content-ajax').click(function (e) {
                e.preventDefault();
                function copyToClipboard(text) {
                    var sampleTextarea = document.createElement('textarea');
                    document.body.appendChild(sampleTextarea);
                    sampleTextarea.value = text;
                    sampleTextarea.select(); 
                    document.execCommand('copy');
                    document.body.removeChild(sampleTextarea);
                    alert('Đã Copy URL: ' + text)
                }
                var copyText = $(this).attr('data-url');;
                copyToClipboard(copyText);
                });
                $('.btn-delete-image-ajax').click(function (e) {
                    var linkImage = $(this).attr('data-url');
                    var idImage = $(this).attr('id-image');
                    if (confirm('Bạn có chắc chắn muốn xoá!')) {
                        $(this).parent('.box-img').hide();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name=" . '"csrf-token"' . "]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            data: { idImage: idImage, linkImage: linkImage },
                            url: 'delete-ajax-gallery',
                            success: (data) => {
                                $('.box-gallery').html(data.outputPa);
                                $('.box-gallery-add-avatar').html(data.outputAv);
                                $('.box-gallery-add-thumb').html(data.outputThumb);
                                $('.note-form').text(data.note);
                                $('.box-more-img-ajax').css('display', data.btnMore);
                                console.log(data);
                            },
                            error: function (data) {
                                console.log(data);
                            }
                        });
                    } else {
                        return false;
                    }
                });
            </script>";
            $outputPa = '';
            $galleryPas = Gallery::orderBy('id', 'DESC')->paginate(10);
            foreach ($galleryPas as $gallery) {
                $outputPa .=
                    ' <div class="box-cover-img"><div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '">
                        <i class="fa-solid fa-trash-can"></i>
                    </p>
                        <div class="btn-positon">
                            
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <p class="btn btn-eye btn-su"><a href="' . asset($gallery->slug) . '" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            </p>
                        </div>
                    </div></div>';
            }
            $outputPa .= $outputScrip;
            /* Use for add vartar */
            $outputAv = '';
            foreach ($galleryPas as $gallery) {
                $outputAv .=
                    '<div class="box-cover-img"><div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '">
                        <i class="fa-solid fa-trash-can"></i>
                        </p>
                        <div class="btn-positon">
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <p class="btn btn-eye btn-su"><a href="' . asset($gallery->slug) . '" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            </p>
                        </div>
                        <div class="box-attr-img">
                        <input type="radio" name="radio-avatar" value="' . $gallery->slug . '">
                        </div>
                    </div></div>';
            }
            $outputAv .= $outputScrip;
            /* add thumb image */
            $outputThumb = '';
            foreach ($galleryPas as $gallery) {
                $outputThumb .=
                    '<div class="box-cover-img"> <div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '"><i class="fa-solid fa-trash-can"></i>
                        </p>
                        <div class="btn-positon">
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <p class="btn btn-eye btn-su"><a href="' . asset($gallery->slug) . '" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            </p>
                        </div>
                        <div class="box-attr-img">
                        <input type="checkbox" name="check-thumb[]" value="' . $gallery->slug . '">
                        </div>
                    </div></div>';
            }
            $outputThumb .= $outputScrip;
            $allGallery = count(Gallery::all());
            if ($allGallery <= 10) {
                $btnMore = "none";
            } else {
                $btnMore = "block";
            }
            return Response()->json([
                "success" => true,
                "outputPa" => $outputPa,
                "outputAv" => $outputAv,
                "btnMore" => $btnMore,
                "outputThumb" => $outputThumb,
                "note" => "Xoá thành công!",
            ]);
        }

        return Response()->json([
            "success" => false,
            'note' => 'Có lỗi hãy kiểm tra lại',
            "file" => ''
        ]);
    }
    public function loadAjaxImg(Request $request)
    {
        $numCurrent = 10;
        if (isset($_POST['numberLoad'])) {
            $numberOutput = $_POST['numberLoad'] + 5;

            if ($_POST['numberLoad'] >= 10) {
                $numCurrent +=  $_POST['numberLoad'] - 5;
            }
        }

        /*  $galleryPas = Gallery::orderBy('id', 'DESC')->paginate($numCurrent); */

        $allGallery = Gallery::all();
        $count = count($allGallery);
        $galleryPas = Gallery::orderBy('id', 'DESC')->skip($numCurrent)->take(5)->get();
        if ($numCurrent >= $count) {
            $btnMore = "none";
        } else {
            $btnMore = "block";
        }
        $outputScrip =  " <script>
            $('.copy-content-ajax').click(function (e) {
                e.preventDefault();
                function copyToClipboard(text) {
                    var sampleTextarea = document.createElement('textarea');
                    document.body.appendChild(sampleTextarea);
                    sampleTextarea.value = text;
                    sampleTextarea.select(); 
                    document.execCommand('copy');
                    document.body.removeChild(sampleTextarea);
                    alert('Đã Copy URL: ' + text)
                }
                var copyText = $(this).attr('data-url');;
                copyToClipboard(copyText);
            });
            $('.btn-delete-image-ajax').click(function (e) {
                var linkImage = $(this).attr('data-url');
                var idImage = $(this).attr('id-image');
                if (confirm('Bạn có chắc chắn muốn xoá!')) {
                    $(this).parent('.box-img').hide();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=" . '"csrf-token"' . "]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        data: { idImage: idImage, linkImage: linkImage },
                        url: 'delete-ajax-gallery',
                        success: (data) => {
                            $('.box-gallery').html(data.outputPa);
                            $('.box-gallery-add-avatar').html(data.outputAv);
                            $('.box-gallery-add-thumb').html(data.outputThumb);
                            $('.note-form').text(data.note);
                            $('.box-more-img-ajax').css('display', data.btnMore);
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                } else {
                    return false;
                }
            });
        </script>";
        $outputPa = '';
        foreach ($galleryPas as $gallery) {
            $outputPa .= '<div class="box-cover-img"> <div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '">
                        <i class="fa-solid fa-trash-can"></i>
                    </p>
                        <div class="btn-positon">
                            
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <a href="' . asset($gallery->slug) . '" target="_blank">
                                <p class="btn btn-eye btn-su">
                                    <i class="fa-solid fa-eye"></i>
                                </p>
                            </a>
                        </div>
                    </div></div>';
        }
        $outputPa .= $outputScrip;
        /* Use for add vartar */
        $outputAv = '';
        foreach ($galleryPas as $gallery) {
            $outputAv .=
                '<div class="box-cover-img"> <div class="box-img"> 
                     <img src="' . $gallery->slug . '">
                     <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '">
                     <i class="fa-solid fa-trash-can"></i>
                     </p>
                     <div class="btn-positon">
                         <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                             <i class="fa-solid fa-copy"></i>
                         </p>
                         <a href="' . asset($gallery->slug) . '" target="_blank">
                            <p class="btn btn-eye btn-su">
                                <i class="fa-solid fa-eye"></i>
                            </p>
                         </a>
                     </div>
                     <div class="box-attr-img">
                     <input type="radio" name="radio-avatar" value="' . $gallery->slug . '">
                     </div>
                 </div></div>';
        }
        $outputAv .= $outputScrip;
        /* add thumb img */
        $outputThumb = '';
        foreach ($galleryPas as $gallery) {
            $outputThumb .=
                '<div class="box-cover-img"> <div class="box-img"> 
                        <img src="' . $gallery->slug . '">
                        <p class="btn btn-delete btn-se btn-delete-image-ajax" data-url="' . $gallery->slug . '" id-image="' . $gallery->id . '"><i class="fa-solid fa-trash-can"></i>
                        </p>
                        <div class="btn-positon">
                            <p class="btn copy-content-ajax btn-pr" data-url="' . asset($gallery->slug) . '">
                                <i class="fa-solid fa-copy"></i>
                            </p>
                            <a href="' . asset($gallery->slug) . '" target="_blank">
                                <p class="btn btn-eye btn-su">
                                    <i class="fa-solid fa-eye"></i>
                                </p>
                            </a>
                        </div>
                        <div class="box-attr-img">
                        <input type="checkbox" name="check-thumb[]" value="' . $gallery->slug . '">
                        </div>
                    </div></div>';
        }
        $outputThumb .= $outputScrip;
        return Response()->json([
            "success" => true,
            "outputPa" => $outputPa,
            "outputAv" => $outputAv,
            "outputThumb" => $outputThumb,
            "numberOutput" => $numberOutput,
            "btnMore" => $btnMore,
            "count" => $count
        ]);
        /*   */
    }
}

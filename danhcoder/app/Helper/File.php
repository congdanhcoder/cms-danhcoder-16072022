<?php

namespace App\Helper;

class File
{
    public function uploadImgs($nameImg, $tmpImg, $size)
    {
        if (isset($nameImg)) {
            /*thư mục chứa file*/
            $uploadDir = "public/uploads/images/";

            /*đường dẫn chứa file*/
            $urlFile = $uploadDir . $nameImg;

            /*chuyển file từ máy lên sever*/
            $error = array();

            /*chuẩn hóa đuôi file*/
            $imgFormat = array('jpge', 'jpg', 'jps', 'gif', 'tiff', 'psd', 'eps', 'jpeg', 'png');

            /*lấy đuôi ảnh được up vào*/
            $tailImg = pathinfo($nameImg, PATHINFO_EXTENSION);

            if (!in_array(strtolower($tailImg), $imgFormat)) {
                $error['imgformat'] = "Hãy chọn file hình ảnh";
            } else {

                if (file_exists($urlFile)) {
                    /*xử lý đổi tên file*/
                    /*Lấy tên file*/
                    $fileName = pathinfo($nameImg, PATHINFO_FILENAME);
                    $newFileName = $fileName . "-copy";
                    /*tạo url mới*/
                    $newUrlFile = $uploadDir . $newFileName . "." . $tailImg;
                    $k = 1;
                    while (file_exists($newUrlFile)) {
                        $newFileName = $fileName . "-copy({$k})";
                        $k++;
                        $newUrlFile = $uploadDir . $newFileName . "." . $tailImg;
                    }
                    $urlFile = $newUrlFile;
                }
            }

            /*kiểm tra kích thước hình ảnh nhỏ hơn  20M*/
            if ($size < 20971520) {
            } else {
                $error['maxsize'] = "Ảnh vượt quá dung lượng 20M";
            }


            if (empty($error)) {
                if (move_uploaded_file($tmpImg, $urlFile)) {
                    return $urlFile;
                } else {
                    return $urlFile = 'Up File không thành công: File phải nhỏ hơn 20M, Hình ảnh thuộc các định dạng (jpge, jpg, jps, gif, tiff, psd, eps, jpeg)';
                }
            } else {
                return $error;
            }
        }
    }

    public function deleteFile($fileUrl)
    {
        $numArr = count($fileUrl);
        for ($index = 0; $index < $numArr; $index++) {
            $urlDelet = $fileUrl[$index];
            if (unlink("{$urlDelet}")) {
                return  "XÓA THÀNH CÔNG";
            } else {
                echo "XÓA THẤT BẠI";
            }
        }
    }
}

<?php
function get_file_type($file_name=null) {
    $arr = explode('.', $file_name);
    $len = count($arr)-1;
    $file_type = $arr[$len];
    return $file_type;
}

function get_file_name($file_name=null) {
    $arr = explode('.', $file_name);
    $file_type = $arr[0];
    return $file_type;
}

function upload_user_image($subdomain, $date, $image_no, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $image_no. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function no_upload_images($subdomain, $date, $image_no, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $image_no. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    // move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function upload_post_image($subdomain, $date, $image_no, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $image_no. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function upload_post_image_no_unlink($subdomain, $date, $image_no, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $image_no. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function upload_post_file($subdomain, $date, $file_no, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $file_no. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function upload_gallery_image($subdomain, $date, $image_no, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $image_no. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function upload_slideshow_image($subdomain, $date, $image_no, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $image_no. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function upload_document($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $title. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}

function upload_pemohon_foto($subdomain, $date, $title, $path_dir, $tmp_name, $fupload_name, $old_file=null) {
    if($old_file != "") {
        unlink($path_dir . $old_file);
    }
    //
    $file_type = get_file_type($fupload_name);
    $file_name = $subdomain . '.' . $date . '-' . $title. '.' . $file_type;
    $vfile_upload = $path_dir . $file_name;
    move_uploaded_file($tmp_name, $vfile_upload);
    //
    return @$file_name;
}


// ----------

function UploadFoto($fupload_name, $old_foto, $files=null)
{
    if($files == '') $files = "foto";

    $vdir_upload = "assets/images/photo/";
    if ($old_foto != "")
        unlink($vdir_upload . "kecil_" . $old_foto);

    $vfile_upload = $vdir_upload . $fupload_name;
    move_uploaded_file($_FILES[$files]["tmp_name"], $vfile_upload);
    $im_src = imagecreatefromjpeg($vfile_upload);
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);
    if ($src_width < $src_height)
    {
        $dst_width = 100;
        $dst_height = ($dst_width / $src_width) * $src_height;
        $cut_height = ($dst_height - 100) / 2;
        $im = imagecreatetruecolor(100, 100);
        imagecopyresampled($im, $im_src, 0, -($cut_height), 0, $cut_height, $dst_width, $dst_height, $src_width, $src_height);
    }
    else
    {
        $dst_height = 100;
        $dst_width = ($dst_height / $src_height) * $src_width;
        $cut_width = ($dst_width - 100) / 2;
        $im = imagecreatetruecolor(100, 100);
        imagecopyresampled($im, $im_src, -($cut_width), 0, $cut_width, 0, $dst_width, $dst_height, $src_width, $src_height);
    }
    imagejpeg($im, $vdir_upload . "kecil_" . $fupload_name);
    imagedestroy($im_src);
    imagedestroy($im);

    unlink($vfile_upload);
    return true;
}

/*
function UploadGambar($fupload_name, $old_gambar)
{
    $vdir_upload = "assets/front/slide/";
    if ($old_gambar != "")
        unlink($vdir_upload . "kecil_" . $old_gambar);

    $vfile_upload = $vdir_upload . $fupload_name;

    move_uploaded_file($_FILES["gambar"]["tmp_name"], $vfile_upload);

    $im_src = imagecreatefromjpeg($vfile_upload);
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);
    if (($src_width * 25) < ($src_height * 44))
    {
        $dst_width = 440;
        $dst_height = ($dst_width / $src_width) * $src_height;
        $cut_height = $dst_height - 250;

        $im = imagecreatetruecolor(440, 250);
        imagecopyresampled($im, $im_src, 0, 0, 0, $cut_height, $dst_width, $dst_height, $src_width, $src_height);
    }
    else
    {
        $dst_height = 250;
        $dst_width = ($dst_height / $src_height) * $src_width;
        $cut_width = $dst_width - 440;

        $im = imagecreatetruecolor(440, 250);
        imagecopyresampled($im, $im_src, 0, 0, $cut_width, 0, $dst_width, $dst_height, $src_width, $src_height);
    }
    imagejpeg($im, $vdir_upload . "kecil_" . $fupload_name);

    imagedestroy($im_src);
    imagedestroy($im);

    unlink($vfile_upload);
    return true;
}

function UploadGallery($fupload_name, $old_gambar)
{
    $vdir_upload = "assets/front/gallery/";
    if ($old_gambar != "")
    {
        unlink($vdir_upload . "kecil_" . $old_gambar);
        unlink($vdir_upload . $old_gambar);
    }
    $vfile_upload = $vdir_upload . $fupload_name;

    move_uploaded_file($_FILES["gambar"]["tmp_name"], $vfile_upload);

    $im_src = imagecreatefromjpeg($vfile_upload);
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);
    if (($src_width * 20) < ($src_height * 44))
    {
        $dst_width = 440;
        $dst_height = ($dst_width / $src_width) * $src_height;
        $cut_height = $dst_height - 300;

        $im = imagecreatetruecolor(440, 300);
        imagecopyresampled($im, $im_src, 0, 0, 0, $cut_height, $dst_width, $dst_height, $src_width, $src_height);
    }
    else
    {
        $dst_height = 300;
        $dst_width = ($dst_height / $src_height) * $src_width;
        $cut_width = $dst_width - 440;

        $im = imagecreatetruecolor(440, 300);
        imagecopyresampled($im, $im_src, 0, 0, $cut_width, 0, $dst_width, $dst_height, $src_width, $src_height);
    }
    imagejpeg($im, $vdir_upload . "kecil_" . $fupload_name);

    imagedestroy($im_src);
    imagedestroy($im);

    //unlink($vfile_upload); 
    return true;
}

function UploadSimbolx($fupload_name, $old_gambar)
{
    $vdir_upload = "assets/gis/simbol";
    if ($old_gambar != "")
    {
        unlink($vdir_upload . "kecil_" . $old_gambar);
        unlink($vdir_upload . $old_gambar);
    }
    $vfile_upload = $vdir_upload . $fupload_name;

    move_uploaded_file($_FILES["gambar"]["tmp_name"], $vfile_upload);

    $im_src = imagecreatefromjpeg($vfile_upload);
    $src_width = imageSX($im_src);
    $src_height = imageSY($im_src);
    if (($src_width * 20) < ($src_height * 44))
    {
        $dst_width = 440;
        $dst_height = ($dst_width / $src_width) * $src_height;
        $cut_height = $dst_height - 300;

        $im = imagecreatetruecolor(440, 300);
        imagecopyresampled($im, $im_src, 0, 0, 0, $cut_height, $dst_width, $dst_height, $src_width, $src_height);
    }
    else
    {
        $dst_height = 300;
        $dst_width = ($dst_height / $src_height) * $src_width;
        $cut_width = $dst_width - 440;

        $im = imagecreatetruecolor(440, 300);
        imagecopyresampled($im, $im_src, 0, 0, $cut_width, 0, $dst_width, $dst_height, $src_width, $src_height);
    }
    imagejpeg($im, $vdir_upload . "kecil_" . $fupload_name);

    imagedestroy($im_src);
    imagedestroy($im);

    //unlink($vfile_upload); 
    return true;
}

function UploadLogo($fupload_name, $old_foto, $tipe_file)
{
    $vdir_upload = "assets/images/logo/";
    unlink($vdir_upload . $old_foto);
    $vfile_upload = $vdir_upload . $fupload_name;

    if ($tipe_file == "image/jpeg" OR $tipe_file == "image/pjpeg")
    {

        move_uploaded_file($_FILES["logo"]["tmp_name"], $vfile_upload);
        $im_src = imagecreatefromjpeg($vfile_upload);
        $src_width = imageSX($im_src);
        $src_height = imageSY($im_src);
        if ($src_width < $src_height)
        {
            $dst_width = 100;
            $dst_height = ($dst_width / $src_width) * $src_height;
            $cut_height = $dst_height - 100;

            $im = imagecreatetruecolor(100, 100);
            imagecopyresampled($im, $im_src, 0, 0, 0, $cut_height, $dst_width, $dst_height, $src_width, $src_height);
        }
        else
        {
            $dst_height = 100;
            $dst_width = ($dst_height / $src_height) * $src_width;
            $cut_width = $dst_width - 100;

            $im = imagecreatetruecolor(100, 100);
            imagecopyresampled($im, $im_src, 0, 0, $cut_width, 0, $dst_width, $dst_height, $src_width, $src_height);
        }
        imagejpeg($im, $vdir_upload . $fupload_name);

        imagedestroy($im_src);
        imagedestroy($im);

        return true;
    }
    else
    {
        move_uploaded_file($_FILES["logo"]["tmp_name"], $vfile_upload);
    }
}


*/

?>

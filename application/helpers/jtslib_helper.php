<?php 
function themes() {
    $data = array('default','red','green');
    return $data;
}

function create_password($str) {
    if($str == "") $str = date('Y-m-d H:i:s');
    $result = md5(md5(md5($str)));
    return $result;
}

function get_polling_bar($n, $result) {
    $colors = array('1'=>'red','green','blue','yellow','brown');
    if($result == '') $result = 0;
    $html = '<div style="display:block; width:90%; border-radius:5px; moz-border-radius:5px; background-color:'.$colors[$n].'">&nbsp;</div>';
    echo $html;
}

function convert_base64($path=null) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

function clean_url($url=null) {
    $url = strtolower($url);
    $url = anti_injection($url);
    return $url;
}

function anti_injection($str=null) {
    $str = str_replace('"', " ", $str);
    $str = str_replace("'", ' ', $str);
    $str = str_replace("`", ' ', $str);
    $str = str_replace("?", '', $str);
    $str = str_replace(" ", '-', $str);
    $str = str_replace("/", '-', $str);
    $str = str_replace(",", '-', $str);
    $str = str_replace("&", '-', $str);
    $str = str_replace("(", '-', $str);
    $str = str_replace(")", '-', $str);
    $str = str_replace("[", '-', $str);
    $str = str_replace("]", '-', $str);
    $str = str_replace(".", '', $str);
    $str = strip_tags($str);
    $str = htmlentities($str);
    return $str;
}

function clear_injection($str=null) {
    $str = str_replace("+", " ", $str);
    return $str;
}

function get_file_ext($file_name) {
    $type = end((explode(".", $file_name)));
    return $type;
}

function split_text($data,$separator,$index) {
    $result = explode($separator, $data);
    return $result[$index];
}

function active_st_img($st=null) {
    if($st == '1') {
        echo "<img src='".base_url()."assets/images/icon/ok.png'>";
    } else if($st == '0') {
        echo "<img src='".base_url()."assets/images/icon/not-ok.png'>";
    }
}

function slice_text($text=null, $num=null) {
    if($num == '') $num = '300';
    $text = strip_tags($text);
    $result = substr($text, 0, $num);
    return $result;
}

function get_status_pemohon($st=null) {
    if($st == '2') $str = 'Diterima';
    elseif($st == '3') $str = 'Ditolak';
    else $str = 'Pending';
    return $str;
}

function get_url_youtube($url_youtube_source=null) {
    $arr_url_youtube = explode('src="', $url_youtube_source);
    if(isset($arr_url_youtube[1])){
        $arr_url_youtube = explode('" ', $arr_url_youtube[1]);
        $url_youtube = $arr_url_youtube[0];
    }            
    return @$url_youtube;
}

function list_post_st() {
    $arr = array(
        '1' => 'Publish',
        '2' => 'Draft',
        '3' => 'Not-Publish'
    );
    return $arr;
}

function get_post_st($id=null) {
    $arr = list_post_st();
    foreach($arr as $key => $val) {
        if($id == $key) {
            return $val;
        }
    }    
}

function isset_session($sess_name=null, $default_value=null) {
    if(isset($_SESSION[$sess_name])) {
        return $_SESSION[$sess_name];
    } else {
        if($default_value !='') {
            return $default_value;
        } else {
            return false;            
        }
    }
}

function unset_session($sess_name=null) {
    $arr_sess = explode(',', $sess_name);
    foreach($arr_sess as $ses) {
        unset($_SESSION[$ses]);        
    }
}

function outp_result($outp=null,$tp=null) {
    if ($outp) {
        if($tp == 'exist') {
            return $_SESSION['success'] = 3;
        } else if($tp == 'delete') {
            return $_SESSION['success'] = 2;
        } else {
            return $_SESSION['success'] = 1;
        }        
    } else {
        if($tp == 'exist') {
            return $_SESSION['success'] = -3;
        } else if($tp == 'delete') {
            return $_SESSION['success'] = -2;
        } else {
            return $_SESSION['success'] = -1;
        }        
    }
}

function outp_notification() {
    $outp = @$_SESSION['success'];
    if($outp != false) {
        // reguler
        if($outp == 1) $msg = 'Data berhasil disimpan.';
        elseif($outp == -1) $msg = 'Data gagal disimpan.';
        // delete
        elseif($outp == 2) $msg = 'Data berhasil dihapus.';
        elseif($outp == -2) $msg = 'Data gagal dihapus.';
        // exist
        elseif($outp == 3) $msg = 'Maaf, Anda sudah melakukan download file ini pada hari ini.';
        elseif($outp == -3) $msg = 'Data tidak ada.';
        //
        $html = '
        <div class="alert alert-green alert-dismissable" id="outp_notification" style="padding-top: 10px; padding-bottom: 10px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button><i class="fa fa-check"></i> '.$msg.'
        </div>
        <script>
        $(function() {
            $("#outp_notification").bind("click",function() {
                $(this).fadeOut("slow");
            }).css("cursor","pointer");
        });
        </script>
        ';
    } else {
        $html = false;
    }    
    //
    $_SESSION['success']=0;
    //
    return $html;
}

function digit($inp = 0) {
    return number_format($inp, 0, ',', '.');
}

function clear_numeric($id=null) {
    $result = str_replace('.', '', $id);
    return $result;
}

function list_bulan() {
    $data = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    return $data;
}

function convert_date($date=null,$sp=null,$tp=null) {
    if($tp == 'date') {
        $arr_date = explode(' ', $date);
        $date = $arr_date[0];
    } elseif($tp == 'full_date') {
        $arr_date = explode(' ', $date);
        $date = $arr_date[0];
        $time = $arr_date[1];
    }
    $arr = explode('-', $date);
    if($sp != '') {
        $result = $arr[2].$sp.$arr[1].$sp.$arr[0];
    } else {
        $result = $arr[2].'-'.$arr[1].'-'.$arr[0];
    }
    if($tp == 'full_date') {
        $result .= ' '.$time;
    }
    return $result;
}

function convert_date_indo($tgl) {
    $tanggal = substr($tgl, 8, 2);
    $jam = substr($tgl, 11, 8);
    $bulan = bulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    if($jam != '') {
        return $tanggal . ' ' . $bulan . ' ' . $tahun . ' ' . $jam . ' WIB';
    } else {
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }    
}

function bulan($bln) {
    switch ($bln)
    {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function bulan_romawi($id=null) {
    $id = ($id != '') ? $id : date('m');
    if($id == '01') $r = 'I';
    elseif($id == '02') $r = 'II';
    elseif($id == '03') $r = 'III';
    elseif($id == '04') $r = 'IV';
    elseif($id == '05') $r = 'V';
    elseif($id == '06') $r = 'VI';
    elseif($id == '07') $r = 'VII';
    elseif($id == '08') $r = 'VIII';
    elseif($id == '09') $r = 'IX';
    elseif($id == '10') $r = 'X';
    elseif($id == '11') $r = 'XI';
    elseif($id == '12') $r = 'XII';
    return $r;
}

function js_chosen() {    
    $html = '<script type="text/javascript"> ';
    $html .= "    var config = {  ";
    $html .= "      '.chosen-select'           : {}, ";
    $html .= "      '.chosen-select-deselect'  : {allow_single_deselect:true}, ";
    $html .= "      '.chosen-select-no-single' : {disable_search_threshold:10}, ";
    $html .= "      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'} ";
    $html .= "    }; ";
    $html .= "    for (var selector in config) { ";
    $html .= "      $(selector).chosen(config[selector]); ";
    $html .= "    } ";
    $html .= '</script> ';
    return $html;
}

function js_datepicker() {    
    $html = '<script type="text/javascript"> ';
    $html .= "$('.datepicker').datepicker({dateFormat:'yy-mm-dd'});";
    $html .= '</script> ';
    return $html;
}

function js_currency() {    
    $html = '<script type="text/javascript"> ';
    $html .= '$(".currency").autoNumeric({ aSep: ".", aDec: ",", vMax: "999999999999999", vMin: "0" });';
    $html .= '</script> ';
    return $html;
}

function convert_size_txt($size=null) {
    // bytes
    if($size < 1024) { $size_convert = $size." byte"; }
    // kilobytes
    if($size > 1024) { $size_convert = number_format(($size/1024), 2, '.', '')." Kb"; }
    // mega bytes
    if($size_convert > 1024) { $size_convert = number_format(($size_convert/1024), 2, '.', '')." Mb"; }
    // giga bytes
    if($size_convert > 1024) { $size_convert = number_format(($size_convert/1024), 2, '.', '')." Gb"; }

    return $size_convert;
}

function captcha($length = 6) {
    $characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function terbilang($x) {
        
    $x = abs((int) $x);
    
    if($x >= 0) {
                        
        $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam","Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if ($x < 12) {
            return " " . $abil[$x];
        } elseif ($x < 20) {
            return terbilang($x - 10) . "Belas";
        } elseif ($x < 100) {
            return terbilang($x / 10) . " Puluh" . terbilang($x % 10);
        } elseif ($x < 200) {
            return " Seratus" . terbilang($x - 100);
        } elseif ($x < 1000) {
            return terbilang($x / 100) . " Ratus" . terbilang($x % 100);
        } elseif ($x < 2000) {
            return " Seribu" . terbilang($x - 1000);
        } elseif ($x < 1000000) {
            return terbilang($x / 1000) . " Ribu" . terbilang($x % 1000);
        } elseif ($x < 1000000000) {
            return terbilang($x / 1000000) . " Juta" . terbilang($x % 1000000);       
        }else{
            return '';  
        }
    }   

}

function nbs($x) {
    for($i=0;$i<=$x;$i++) {
        echo '&nbsp;';
    }
}

function jecho($a, $b, $str) {
    if ($a == $b) {
        echo $str;
    }
}

function selected($a, $b, $opt = 0) {
    if ($a == $b) {
        if ($opt)
            echo "checked='checked'";
        else
            echo "selected='selected'";
    }
}

function date_dayname($id=null) {
    $arr = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu',
    );
    if($id != '') return $arr[$id];
    else return $arr;
}

function date_now($date=null) {
    if($date == '') $date = date('Y-m-d H:i:s');
    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    $dayindex = $datetime->format('D');
    $dayname  = @date_dayname($dayindex);
    //
    $result = $dayname.', '.convert_date_indo($date);
    return $result;
}

function word_wrap($txt=null,$len=null) {
    $str_1  = substr($txt, 0, 30);
    $str_2  = substr($txt, 31, 30);
    $str_3  = substr($txt, 61, 30);
    $str_4  = substr($txt, 91, 30);
    $str_5  = substr($txt, 121, 30);
    $str_6  = substr($txt, 151, 30);
    $str_7  = substr($txt, 181, 30);
    $str_8  = substr($txt, 211, 30);
    $str_9  = substr($txt, 241, 30);
    $str_10 = substr($txt, 271, 30);
    //
    if($str_1 != '') $str_1 = $str_1.'<br>';
    if($str_2 != '') $str_2 = $str_2.'<br>';
    if($str_3 != '') $str_3 = $str_3.'<br>';
    if($str_4 != '') $str_4 = $str_4.'<br>';
    if($str_5 != '') $str_5 = $str_5.'<br>';
    if($str_6 != '') $str_6 = $str_6.'<br>';
    if($str_7 != '') $str_7 = $str_7.'<br>';
    if($str_8 != '') $str_8 = $str_8.'<br>';
    if($str_9 != '') $str_9 = $str_9.'<br>';
    if($str_10 != '') $str_10 = $str_10.'<br>';
    //
    $result = $str_1.$str_2.$str_3.$str_4.$str_5.$str_6.$str_7.$str_8.$str_9.$str_10;
    return $result;
}


// Tambahan Cart
function cart_total($cart=null) {
    $grand_total = 0;
    foreach ($cart as $item):
        $grand_total+=$item['subtotal'];                            
    endforeach;
    $result = digit($grand_total);
    return $result;
}

function count_cart($cart=null) {
    $result = count($cart);
    return $result;
}
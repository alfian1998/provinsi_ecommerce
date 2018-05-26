<?php

function Terbilang($str=0){
	$satuan	= array(""," satu"," dua"," tiga"," empat"," lima"," enam"," tujuh"," delapan"," sembilan");
	$belas	= array(""," sebelas"," duabelas"," tigabelas"," empatbelas"," limabelas"," enambelas"," tujuhbelas"," delapanbelas"," sembilanbelas");
	$lipatan= array("","","puluh","ratus");
	$i 		= 0;
	$str = $str.".00";
	$len	= strlen($str)-3;
	$outp	= "";
	// < 1000
	if($len - $i >= 13){
		$isi = 0;
		while($i < $len-12){
			if($str[$i] == 1 AND $len - $i == 14 AND $str[$i+1] != 0){
				$outp	= $outp.$belas[$str[$i+1]];
				$i++;
				$isi = 1;
			}
			elseif($str[$i] == 1 AND ($i+1 != $len) AND ($len - $i != 13)){
				$outp	= $outp." se".$lipatan[$len-($i+12)];
				$isi = 1;
			}elseif($str[$i] > 0){
				$outp	= $outp.$satuan[$str[$i]]." ".$lipatan[$len-($i+12)];
				$isi = 1;
			}
			$i++;
		}
		if($isi == 1)$outp = $outp." triliyun";
	}

	if($len - $i >= 10){
		$isi = 0;
		while($i < $len-9){
			if($str[$i] == 1 AND $len - $i == 11 AND $str[$i+1] != 0){
				$outp	= $outp.$belas[$str[$i+1]];
				$isi = 1;
				$i++;
			}
			elseif($str[$i] == 1 AND ($i+1 != $len) AND ($len - $i != 10)){
				$outp	= $outp." se".$lipatan[$len-($i+9)];
				$isi = 1;
			}elseif($str[$i] > 0){
				$outp	= $outp.$satuan[$str[$i]]." ".$lipatan[$len-($i+9)];
				$isi = 1;
			}
			$i++;
		}
		if($isi == 1)$outp = $outp." miliyar";
	}

	if($len - $i >= 7){
		$isi = 0;
		while($i < $len-6){
			if($str[$i] == 1 AND $len - $i == 8 AND $str[$i+1] != 0){
				$outp	= $outp.$belas[$str[$i+1]];
				$i++;
				$isi = 1;
			}
			elseif($str[$i] == 1 AND ($i+1 != $len) AND ($len - $i != 7)){
				$outp	= $outp." se".$lipatan[$len-($i+6)];
				$isi = 1;
			}elseif($str[$i] > 0){
				$outp	= $outp.$satuan[$str[$i]]." ".$lipatan[$len-($i+6)];
				$isi = 1;
			}
			$i++;
		}
		if($isi == 1)$outp = $outp." juta";
	}

	if($len - $i >= 4){
		$isi = 0;
		while($i < $len-3){
			if($str[$i] == 1 AND $len - $i == 5 AND $str[$i+1] != 0){
				$outp	= $outp.$belas[$str[$i+1]];
				$i++;
				$isi = 1;
			}
			elseif($str[$i] == 1 AND ($i+1 != $len)){
				$outp	= $outp." se".$lipatan[$len-($i+3)];
				$isi = 1;
			}elseif($str[$i] > 0){
				$outp	= $outp.$satuan[$str[$i]]." ".$lipatan[$len-($i+3)];
				$isi = 1;
			}
			$i++;
		}
		if($isi == 1)$outp = $outp." ribu";
	}
		while($i < $len){
			if($str[$i] == 1 AND $len - $i == 2 AND $str[$i+1] != 0){
				$outp	= $outp.$belas[$str[$i+1]]." ";
				$i++;
			}
			elseif($str[$i] == 1 AND ($i+1 != $len)){
				$outp	= $outp." se".$lipatan[$len-$i]." ";
			}else{
				if($str[$i] > 0)$outp	= $outp.$satuan[$str[$i]]." ".$lipatan[$len-$i];
			}
			$i++;
		}
		$i++;
		$outp2="";
		$len = $len+3;
		while($i < ($len)){
			if($str[$i] == 1 AND $len - $i == 2 AND $str[$i+1] != 0){
				$outp2	= $outp2.$belas[$str[$i+1]]." ";
				$i++;
			}
			elseif($str[$i] == 1 AND ($i+1 != $len)){
				$outp2	= $outp2." se".$lipatan[$len-$i]." ";
			}else{
				if($str[$i] > 0)$outp2	= $outp2.$satuan[$str[$i]]." ".$lipatan[$len-$i];
			}
			$i++;
		}
	
	if($outp2 != "")
		$outp = $outp." komah ".$outp2;
	$outp 	= $outp." rupiah";
	$len 	= strlen($outp);
	$outp	= substr($outp,1,$len-1);
	$outp = "$outp";
	return $outp;
}

?>
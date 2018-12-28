<?php 
//生成盐字段的函数
function generateSalt($length = 6){
	return substr(str_shuffle(C('SALT')), 0,$length);
}


/**
 * 系统公共库文件
 * 主要定义系统公共函数库
 */


function http_post($url, $param, $timeout = 30)
{
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
    }
    if (is_string($param)) {
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach ($param as $key => $val) {
            $aPOST[] = $key . "=" . urlencode($val);
        }
        $strPOST = join("&", $aPOST);
    }

    //5秒超时
    curl_setopt($oCurl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($oCurl, CURLOPT_POST, true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);

    return $sContent;
}

 ?>

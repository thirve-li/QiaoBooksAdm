<?php
function getIP()
{
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else $ip = "Unknow";
    return $ip;
}

/**
 * curl发送 post请求
 * @param string $url 请求地址
 * @param array $para post键值对数据
 * @return string
 */
function fcPOST($url, $para, $header = false, $cookieStr = null, $input_charset = '')
{
    if (is_array($para)) $para = http_build_query($para);
    $curl = curl_init($url);
    if (!empty($cookieStr)) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookieStr);
    }
    if ($header) {
        curl_setopt($curl, CURLOPT_HEADER, 1); // 输出HTTP头
    } else {
        curl_setopt($curl, CURLOPT_HEADER, 0); // 过滤HTTP头
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
    curl_setopt($curl, CURLOPT_POST, true); // post传输数据
    curl_setopt($curl, CURLOPT_POSTFIELDS, $para);// post传输数据

    $responseText = curl_exec($curl);
    //var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
    curl_close($curl);
    return $responseText;
}

/**
 *
 * 产生随机字符串，不长于32位
 * @param int $length
 * @return 产生的随机字符串
 */
function getNonceStr($length = 6)
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

function getSex($str)
{
    if ($str == "女") {
        return 0;
    } else {
        return 1;
    }
}

/**
 * 计算2个日期相差
 * @param $loginTime
 * @param $logoutTime
 * @return string
 */
function calStayTime($loginTime, $logoutTime)
{

    if ($loginTime == null) {
        $loginTime = date("Y-m-d H:i:s");
    }

    if ($logoutTime == null) {
        $logoutTime = date("Y-m-d H:i:s");
    }

    $cle = strtotime($logoutTime) - strtotime($loginTime);

    $d = floor($cle / 3600 / 24);
    $h = floor(($cle % (3600 * 24)) / 3600);
    $m = floor(($cle % (3600 * 24)) % 3600 / 60);
    $s = floor(($cle % (3600 * 24)) % 60);
    $stayTime = "";
    if ($d != 0) {
        $stayTime = $stayTime . $d . "天";
    }
    if ($h != 0) {
        $stayTime = $stayTime . $h . "h";
    }
    if ($m != 0) {
        $stayTime = $stayTime . $m . "'";
    }
    if ($s != 0) {
        $stayTime = $stayTime . $s . "\"";
    }
    return $stayTime;
}

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
    if(function_exists("mb_substr")){
        if($suffix)
            return mb_substr($str, $start, $length, $charset)."...";
        else
            return mb_substr($str, $start, $length, $charset);
    }
    elseif(function_exists('iconv_substr')) {
        if($suffix)
            return iconv_substr($str,$start,$length,$charset)."...";
        else
            return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
                  [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
    $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
    $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}
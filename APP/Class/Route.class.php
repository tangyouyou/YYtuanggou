<?php
/**
 * URL处理类
 * @package     Core
 * @author      
 */
final class Route
{
    /**
     * 移除URL中的指定GET变量
     * 使用函数remove_url_param()调用
     * @param string $var 要移除的GET变量
     * @param null $url url地址
     * @return mixed|string 移除GET变量后的URL地址
     */
    static public function removeUrlParam($var, $url = null)
    {
        $pathinfo_dli = C("PATHINFO_DLI");
        if (!is_null($url)) {
            $url_format = strstr($url, "&") ? $url . '&' : $url . $pathinfo_dli;
            $url = str_replace($pathinfo_dli, "###", $url_format);
            $search = array(
                "/$var" . "###" . ".*?" . "###" . "/",
                "/$var=.*?&/i",
                "/\?&/",
                "/&&/"
            );
            $replace = array(
                "",
                "",
                "?",
                ""
            );
            $url_replace = preg_replace($search, $replace, $url);
            $url_rtrim = rtrim(rtrim($url_replace, "&"), "###");
            return str_replace("###", $pathinfo_dli, $url_rtrim);
        }
        $get = $_GET;
        unset($get[C("VAR_APP")]);
        unset($get[C("VAR_CONTROL")]);
        unset($get[C("VAR_METHOD")]);
        $url = '';
        $url_type = C("URL_TYPE");
        foreach ($get as $k => $v) {
            if ($k === $var)
                continue;
            if ($url_type == 1) {
                $url .= $pathinfo_dli . $k . $pathinfo_dli . $v;
            } else {
                $url .= "&" . $k . "=" . $v;
            }
        }
        $url_rtrim = trim(trim($url, $pathinfo_dli), '&');
        $url_str = empty($url_rtrim) ? "" : $pathinfo_dli . $url_rtrim;
        if ($url_type == 1) {
            return __SELF__ . $url_str;
        } else {
            return __SELF__ . "&" . trim($url_str, "&");
        }
    }
}

?>
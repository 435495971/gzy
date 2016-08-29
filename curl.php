<?php
/**
     * 模拟post进行url请求
     * @param string $url
     * @param string $param
     */
    function get_Web_Page($url,$cookie=''){
            $ip='\''.rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'\'';
            $header_ip = array(
              'CLIENT-IP:'.$ip,
              'X-FORWARDED-FOR:'.$ip,
            );
            $options= array(
            CURLOPT_RETURNTRANSFER => true,//return web page 返回网页
            CURLOPT_HEADER         => true,// 返回头信息
            CURLOPT_FOLLOWLOCATION => true,//follow redirects
            CURLOPT_ENCODING       => "",//handle all encodings
            CURLOPT_USERAGENT      =>"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 BIDUBrowser/8.4 Safari/537.36",//设置UserAgent
            CURLOPT_AUTOREFERER    =>true,//set referer on redirect
            CURLOPT_CONNECTTIMEOUT =>120,//timeout on connect
            CURLOPT_TIMEOUT        =>120,//timeout on response
            CURLOPT_MAXREDIRS      =>10,//stop after 10 redirects
            CURLOPT_COOKIESESSION  =>true,//设置获取cookie 
            CURLOPT_COOKIE         =>$cookie,
            CURLOPT_REFERER        =>$url,
            CURLOPT_HTTPHEADER     =>$header_ip,
            );
            $ch=curl_init($url);
            curl_setopt_array($ch, $options);
            $content=curl_exec($ch);
            $err=curl_errno($ch);
            $errmsg=curl_error($ch);
            $result=curl_getinfo($ch);
            curl_close($ch);
            $result['error']=$err;
            $result['errmsg']=$errmsg;
            $result['content']=$content;
            $result['header']=substr($result['content'],0,$result['header_size']);
            $result['content']=substr($result['content'],$result['header_size']);
            return $result;
    }

    function request_post($url = '', $param = '',$cookie='') {
        $ip='\''.rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'\'';
        $header_ip = array(
          'CLIENT-IP:'.$ip,
          'X-FORWARDED-FOR:'.$ip,
        );
        if (empty($url) || empty($param)) {
            return false;
        }
        $curlPost='';
        $postUrl = $url;
        foreach ( $param as $k => $v ) 
        { 
             $curlPost.= "$k=" . urlencode( $v ). "&" ;
        }
        $curlPost=substr($curlPost,0,-1);
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
            $options= array(
            CURLOPT_RETURNTRANSFER => true,//return web page 返回网页
            CURLOPT_HEADER         => true,// 返回头信息
            CURLOPT_FOLLOWLOCATION => true,//follow redirects
            CURLOPT_ENCODING       => "",//handle all encodings
            CURLOPT_USERAGENT      =>"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 BIDUBrowser/8.4 Safari/537.36",//设置UserAgent
            CURLOPT_AUTOREFERER    =>true,//set referer on redirect
            CURLOPT_CONNECTTIMEOUT =>120,//timeout on connect
            CURLOPT_TIMEOUT        =>120,//timeout on response
            CURLOPT_MAXREDIRS      =>10,//stop after 10 redirects
            CURLOPT_COOKIESESSION  =>true,//设置获取cookie 
            CURLOPT_POST           =>true,//设置post
            CURLOPT_POSTFIELDS     =>$curlPost,//设置表单
            CURLOPT_REFERER        =>$url,
            CURLOPT_COOKIE         =>$cookie,
            CURLOPT_HTTPHEADER     =>$header_ip,
            );
        curl_setopt_array($ch, $options);
        $content=curl_exec($ch);
        $err=curl_errno($ch);
        $errmsg=curl_error($ch);
        $result=curl_getinfo($ch);
        curl_close($ch);
        $result['error']=$err;
        $result['errmsg']=$errmsg;
        $result['content']=$content;
        $result['header']=substr($result['content'],0,$result['header_size']);
        $result['content']=substr($result['content'],$result['header_size']);
        return $result;
    }
    function get_img($url,$cookie=''){
            $options= array(
            CURLOPT_RETURNTRANSFER => true,//return web page 返回网页
            CURLOPT_HEADER         => true,// 返回头信息
            CURLOPT_FOLLOWLOCATION => true,//follow redirects
            CURLOPT_ENCODING       => "",//handle all encodings
            CURLOPT_USERAGENT      =>"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 BIDUBrowser/8.4 Safari/537.36",//设置UserAgent
            CURLOPT_AUTOREFERER    =>true,//set referer on redirect
            CURLOPT_CONNECTTIMEOUT =>120,//timeout on connect
            CURLOPT_TIMEOUT        =>120,//timeout on response
            CURLOPT_MAXREDIRS      =>10,//stop after 10 redirects
            CURLOPT_COOKIESESSION  =>true,//设置获取cookie 
            CURLOPT_COOKIE         =>$cookie,
            );
            $ch=curl_init($url);
            curl_setopt_array($ch, $options);
            $content=curl_exec($ch);
            $err=curl_errno($ch);
            $errmsg=curl_error($ch);
            $result=curl_getinfo($ch);
            curl_close($ch);
            $result['error']=$err;
            $result['errmsg']=$errmsg;
            $result['content']=$content;
            $result['header']=substr($result['content'],0,$result['header_size']);
            $result['content']=substr($result['content'],$result['header_size']);
            return $result;
    }
?>

<?php

class Alarmedot {

	public function curl($param,$headers,$url,$customreq,$post,$curlheader,$method)	{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

		if($post==true)

		{

			curl_setopt($ch, CURLOPT_POST, 1);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

		}

		curl_setopt($ch, CURLOPT_ENCODING, "GZIP");

		if($customreq==true)

		{

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		if($curlheader==true)

		{

			curl_setopt($ch, CURLOPT_HEADER, 1);

		}

		$result = curl_exec($ch);

		if (curl_errno($ch)) {

  		echo 'Error:' . curl_error($ch);

   	 }

		curl_close($ch);

		return $result;

	}

	public function getSso($device)

	{

		$url = "https://api-accounts.edot.id/api/token/get";

		$query = array(

			"name" => "web-sso",

			"secret_key" => "3e53440178c568c4f32c170f",

			"device_type" => "web",

			"device_id" => $device

			);

		$param = json_encode($query, true);

		$headers = array();

		$headers[] = 'Content-Length: '.strlen($param);

		$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2063 Build/RKQ1.201112.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/94.0.4606.85 Mobile Safari/537.36';

		$headers[] = 'Content-Type: application/json';

		$headers[] = 'Accept: */*';

		$headers[] = 'Accept-Encoding: gzip, deflate';

		$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';

		return $this->curl($param,$headers,$url,$customreq = null,$post = true,$curlheader = false,$method = null);

	}

	public function checkCode($kodereff,$ssotoken)

	{

		$url = "https://api-accounts.edot.id/api/user/check_referral_code?referral_code=$kodereff";

		$method = "GET";

		$headers = array();

		//$headers[] = 'Content-Length: '.strlen($param);

		$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; Redmi Note 8 Build/QQ3A.200905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/93.0.4577.82 Mobile Safari/537.36';

		$headers[] = 'Sso-token: '.$ssotoken;

		return $this->curl($param =null,$headers,$url,$customreq = true,$post = false,$curlheader = false,$method = "GET");

	}

}

function elegram($msg) {

        global $tokenalarm,$telegramchatid;

        $url='https://api.telegram.org/bot'.$tokenalarm.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);

        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);

        $context=stream_context_create($options);

        $result=file_get_contents($url,true,$context);

        return $result;

}

function telegram($msg) {

        global $telegrambot,$telegramchatid;

        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);

        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);

        $context=stream_context_create($options);

        $result=file_get_contents($url,true,$context);

        return $result;

}

function generateRandomString($length = 10) {

    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';

    $charactersLength = strlen($characters);

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];

    }

    return $randomString;

}

function input($text) {

    echo $text.": ";

    $a = trim(fgets(STDIN));

    return $a;

}

function getName() {

    $r = file_get_contents('https://www.random-name-generator.com/indonesia?gender=&n=1&s='.rand(111,999));

    $namenya = get_between($r,'<div class="col-sm-12 mb-3" id="','-');

    $nama_indo = preg_replace('/s+/', '', $namenya);

    return ucfirst($nama_indo);

}

function get_between($string, $start, $end) 

    {

        $string = " ".$string;

        $ini = strpos($string,$start);

        if ($ini == 0) return "";

        $ini += strlen($start);

        $len = strpos($string,$end,$ini) - $ini;

        return substr($string,$ini,$len);

    }

function nama() {

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://api.namefake.com/indonesian-indonesia");

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	$ex = curl_exec($ch);

	return $ex;

}

function fetch_value($str,$find_start,$find_end) {

    $start = @strpos($str,$find_start);

    if ($start === false) {

        return "";

    }

    $length = strlen($find_start);

    $end    = strpos(substr($str,$start +$length),$find_end);

    return trim(substr($str,$start +$length,$end));

}

function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        if($post){

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        }

        if($httpheader){

            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);

        }

        if($proxy){

            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);

            curl_setopt($ch, CURLOPT_PROXY, $proxy);

            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);

        }

        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch);

        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{

            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));

            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));

            curl_close($ch);

            return array($header, $body);

        }

    }

$rhversion = "2.0.0";

$white = "\e[97m";

$black = "\e[30m\e[1m";

$yellow = "\e[93m";

$orange = "\e[38;5;208m";

$blue   = "\e[34m";

$lblue  = "\e[36m";

$cln    = "\e[0m";

$green  = "\e[92m";

$fgreen = "\e[32m";

$red    = "\e[91m";

$magenta = "\e[35m";

$bluebg = "\e[44m";

$lbluebg = "\e[106m";

$greenbg = "\e[42m";

$lgreenbg = "\e[102m";

$yellowbg = "\e[43m";

$lyellowbg = "\e[103m";

$redbg = "\e[101m";

$grey = "\e[37m";

$cyan = "\e[36m";

$bold   = "\e[1m";

$banner = "

                                                      #@#.                      
                                                  *@@,        .##               
                                                /@@, ,%          .@.            
                                               @@@,  @,           .@(           
                                              @@@%  .@.            (@.          
                                             %@@@,   ,,            @@#          
                                            ,@@@@       .#&*.    %@@@/          
                                            #@@@.                *%@@           
                                            @@@               .   @&            
                                           @@#      .&&.         @&.            
                                          &@*            *.     @@              
                                         @@          #%        &@,              
                                        @#                    &@%               
                             ../(/,   .&&                    (@@                
                        .@@@@#.     &@@@                    ,@@.                
                   ,&@@/.            %@/                    @@&                 
               (@@@@@@@@#.           @@                   .&@%                  
           #@@&@@# .      /&@(      &@/                  (@@(                   
       .@&  ,@&               ,@@@@@@@                  .@@&                    
     #@,   @@. .              . &@@@@                   *@@@                    
   ,@/   ,@(                    %@@@.                   (@@@%                   
  .@,   ,@*                    ,@@@*                    *@@@@*                  
  .&   .@*                     @@@#         .#&.       .@@@@@@@@@(              
   @   @#                     *@@&                    .@@,       .@@@.          
   .@,%@                     .@@&                     @@/          .@@@@&.      
    #@@*                     @@@                     (@@*           .@@,.(@@.   
    *@&                     @@@                      @@(             &&    *@@  
    &@                    .@@@                      ,@&              &@.     @@ 
   (@*                   *@@@                     ..@@.            ..@@*      @&
  ,@(                   %@@%                      .@@               @@@,      ,@
  @&                   #@@*                      .@@               %@@@.      .@
 #@                   /@%                       (@#               /@@@/       .@
 @*                   #                        &@*               .@@@( .      ,@
(@                                            @@,               .@@&          (@
@&                                          .@@.               ,@@/           @%
&&                                          @@.               .@@            *@*
,@,                                        @@/               *@@             @@ 
 #@.                                      *@&               /@@.            @@( 
  ,@@(                                    #@(              (@@.            @@@  
     /@@%,                               ,@@,             %@@/           ,@@@.  
         .#@@@@@@@@&(.                   .@@/            &@@%          *@@@@,   
                 ,%@@@@%                  &@&           @@@@@@@@@@@@@@@@@@@.    
                     .@@@@@,             .@@@#        .@@@@@@@@@@@@@@@@@@,      
                        /@@@@@@@@@@@@@@@@@@@@@@@#,.,#@@@@@@&%&@@@@&#/.          
                           *%@@@@@@@@@@@@@@@@@@@@@@@@@/                         
                                                                                

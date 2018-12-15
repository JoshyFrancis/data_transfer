<?php
/* 			
Jesus Christ is the only savior, who will redeem you.
യേശുക്രിസ്തു മാത്രമാണ് രക്ഷകൻ , അവൻ നിങ്ങളെ വീണ്ടെടുക്കും.
ישוע המשיח היחיד שיגאל אותך.
	
 All honor and glory and thanks and praise and worship belong to him, my Lord Jesus Christ.
സകല മഹത്വവും ബഹുമാനവും സ്തോത്രവും സ്തുതിയും ആരാധനയും എന്റെ കർത്താവായ യേശുക്രിസ്തുവിന് എന്നേക്കും ഉണ്ടായിരിക്കട്ടെ.
כל הכבוד והתהילה והשבחים והשבחים שייכים לו, אדוננו ישוע המשיח.


*/
ini_set('max_execution_time', 0);
ini_set('html_errors', true);
ini_set('display_errors', 1);

 	
		function get_ip_address() {
				// check for shared internet/ISP IP
				if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
					return $_SERVER['HTTP_CLIENT_IP'];
				}

				// check for IPs passing through proxies
				if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					// check if multiple ips exist in var
					if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
						$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
						foreach ($iplist as $ip) {
							if (validate_ip($ip))
								return $ip;
						}
					} else {
						if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
							return $_SERVER['HTTP_X_FORWARDED_FOR'];
					}
				}
				if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
					return $_SERVER['HTTP_X_FORWARDED'];
				if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
					return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
				if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
					return $_SERVER['HTTP_FORWARDED_FOR'];
				if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
					return $_SERVER['HTTP_FORWARDED'];

				// return unreliable ip since all else failed
				return $_SERVER['REMOTE_ADDR'];
			}

			/**
			 * Ensures an ip address is both a valid IP and does not fall within
			 * a private network range.
			 */
			function validate_ip($ip) {
				if (strtolower($ip) === 'unknown')
					return false;

				// generate ipv4 network address
				$ip = ip2long($ip);

				// if the ip is set and not equivalent to 255.255.255.255
				if ($ip !== false && $ip !== -1) {
					// make sure to get unsigned long representation of ip
					// due to discrepancies between 32 and 64 bit OSes and
					// signed numbers (ints default to signed in PHP)
					$ip = sprintf('%u', $ip);
					// do private network range checking
					if ($ip >= 0 && $ip <= 50331647) return false;
					if ($ip >= 167772160 && $ip <= 184549375) return false;
					if ($ip >= 2130706432 && $ip <= 2147483647) return false;
					if ($ip >= 2851995648 && $ip <= 2852061183) return false;
					if ($ip >= 2886729728 && $ip <= 2887778303) return false;
					if ($ip >= 3221225984 && $ip <= 3221226239) return false;
					if ($ip >= 3232235520 && $ip <= 3232301055) return false;
					if ($ip >= 4294967040) return false;
				}
				return true;
			}
    
 	function isSSL() { return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443; }
	$url=(isSSL()?'https://': 'http://') . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url=str_replace('?'.$_SERVER['QUERY_STRING'],'',$url);
	$url=substr($url,0,strripos($url,'/')+1);
		$url_cur=$url;
	$url=substr($url,0,strripos($url,'/') );
	$url=substr($url,0,strripos($url,'/') +1);
			$url_public=$url;


	session_name("data_transfer");
	session_start();


	$response=[];
	$response['success']=false;
	$response['error']='Unknown error!';
if(isset($_REQUEST['action'])){	
	switch ($_REQUEST['action']) {
		case 'load':
			$response['url']=$url;
			$response['success']=true;
		break;
		case 'content':
			echo get_view('register.php',['url'=>$url ]);
			return;
		break;
		case 'page':
			$page=isset($_REQUEST['page'])?$_REQUEST['page']:'home';
				if($page==='home'){
					$page='register';
				}
			echo get_view($page.'.php',['url'=>$url ]);
			return;
		break;
	}
}
	function get_view($view,$data=[]){
		$obLevel = ob_get_level();
        ob_start();

		foreach($data as $key=>$value){
		    $$key = $value; 
		}
		
        try {
            include $view;
        } catch (Exception $e) {
			while (ob_get_level() > $obLevel) {
				ob_end_clean();
			}
        }
        //return ltrim(ob_get_clean());
        return ob_get_clean(); 
	}
 // alternative json_encode
	function _json_encode($val){
		if (is_string($val)) return '"'.addslashes($val).'"';
		if (is_numeric($val)) return $val;
		if ($val === null) return 'null';
		if ($val === true) return 'true';
		if ($val === false) return 'false';

		$assoc = false;
		$i = 0;
		foreach ($val as $k=>$v){
			if ($k !== $i++){
				$assoc = true;
				break;
			}
		}
		$res = array();
		foreach ($val as $k=>$v){
			$v = _json_encode($v);
			if ($assoc){
				$k = '"'.addslashes($k).'"';
				$v = $k.':'.$v;
			}
			$res[] = $v;
		}
		$res = implode(',', $res);
		return ($assoc)? '{'.$res.'}' : '['.$res.']';
	}
	
	
	
	//echo json_encode($response,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); 
	echo _json_encode($response);

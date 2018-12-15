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

	session_name("data_transfer");
	session_start();

	$response=[];
	$response['success']=false;
	$response['error']='Unknown error!';
if(isset($_REQUEST['action'])){	
	switch ($_REQUEST['action']) {
		case 'load':
			$response['success']=true;
		break;
		case 'content':
			echo get_view('register.php');
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

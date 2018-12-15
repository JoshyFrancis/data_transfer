<?php
/* 			
Jesus Christ is the only savior, who will redeem you.
യേശുക്രിസ്തു മാത്രമാണ് രക്ഷകൻ , അവൻ നിങ്ങളെ വീണ്ടെടുക്കും.
ישוע המשיח היחיד שיגאל אותך.
	
 All honor and glory and thanks and praise and worship belong to him, my Lord Jesus Christ.
സകല മഹത്വവും ബഹുമാനവും സ്തോത്രവും സ്തുതിയും ആരാധനയും എന്റെ കർത്താവായ യേശുക്രിസ്തുവിന് എന്നേക്കും ഉണ്ടായിരിക്കട്ടെ.
כל הכבוד והתהילה והשבחים והשבחים שייכים לו, אדוננו ישוע המשיח.


*/
ini_set('max_execution_time', 0); // for infinite time of execution
ini_set('html_errors', true);
ini_set('display_errors', 1);//very important in case of server

error_reporting(E_ALL);
		
		session_name("data_transfer");
	 session_start();
	 
 	
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
		
	//echo get_ip_address();
 
			$login=false;
		$userID = 0;
	   $username='';
			if(isset($_SESSION['userID'])){
				$userID = $_SESSION['userID'];
				$login=true;
					try{
	 
						$DBH = new \PDO( 'mysql:host=demo.cloudoux.com;dbname=demo.cloudoux.com' ,'remote_login_user'  ,'users@ClouDoux#7896'  );
						$DBH->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
							 
							 $STH = $DBH->prepare('select username from developers where ID=? ' );
							$STH->execute( [$userID ]);
							$rows = $STH->fetchAll(\PDO::FETCH_OBJ);
						if(count($rows)>0){
							 $username=$rows[0]->username ;
						}
					}catch(\PDOException $e) {
						//echo $e->getMessage()  ;
						//exit;
						 $error_message =$e->getMessage()  ;
					}
			}
	
		 
		$response=[];
		$response['success']=false;
		$response['error']='Unknown error!';
	if(isset($_REQUEST['head'])){	
		switch ($_REQUEST['head']) {
			case 'test':
				$response['success']=true;
			break;
			case 'convert_invoice':
				//$response['var']=isset($_REQUEST['test_data'])?$_REQUEST['test_data']:'ok';
				$domain=isset($_REQUEST['domain'])?$_REQUEST['domain']:'local';
				$userID=intval(isset($_REQUEST['userid'])?$_REQUEST['userid']:'0');
				$response['success']=false;
				$response['success_count']=0;
				
				$response['error']=''; 
				try{
					
					include 'app_loader.php';
					include(__DIR__ .'/../../app/Http/Controllers/Common/SQL_functions.php');

					
					$app_path=readlink($_SERVER['DOCUMENT_ROOT'].'/work') . '/HR/laravel-5.4.23/public';//'/var/www/base_path/public';
					//$app_index='index.php';
					$app_index='work/HR/laravel-5.4.23/public/index.php';//'index.php';
			
					//$DBH = new \PDO( 'mysql:host=demo.cloudoux.com;dbname=demo.cloudoux.com' ,'remote_login_user'  ,'users@ClouDoux#7896'  );
					$config=[];
					
					 
					switch ($domain){
						case 'local':
							$config['host']='localhost';
							$config['database']='prologin';
							$config['username']='root';
							$config['password']='mysql';
						break;
						case 'demo':
							$app_path='/var/www/demo.cloudoux.com/public';
							$config['host']='demo.cloudoux.com';
							$config['database']='demo.cloudoux.com';
							$config['username']='remote_login_user';
							$config['password']='users@ClouDoux#7896';
						break;
						case 'alqawee':
							$app_path='/var/www/alqawee.cloudoux.com/public';
							$config['host']='alqawee.cloudoux.com';
							$config['database']='alqawee.cloudoux.com';
							$config['username']='remote_login_user';
							$config['password']='users@cloudoux@net#1528954480889';
						break;
					}
					
						$DBH = new \PDO( 'mysql:host='.$config['host'].';dbname='.$config['database'] ,$config['username'] ,$config['password']);
						
						$DBH->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
						
						$STH = $DBH->prepare('select ID from users where ID='.$userID.' limit 1;
												select ID from users limit 1;' );
						$STH->execute();
						do {
							$rows =$STH->fetchAll(\PDO::FETCH_ASSOC);
							if($rows && count($rows)>0){
								if($userID===0){
									$userID=intval($rows[0]['ID']);
								}
							}
						} while ($STH->nextRowset());
						
						$BranchID=1;
						$STH = $DBH->prepare('select ID from fac_branch limit 1' );
						$STH->execute( );
						//$rows = $STH->fetchAll(\PDO::FETCH_OBJ);
						$rows = $STH->fetchAll(\PDO::FETCH_ASSOC);					 
						if(count($rows)>0){
							//$BranchID=$rows[0]->ID ;
							  $BranchID=$rows[0]['ID'];			 
						}			
						$FinYearID=null;
										 
						$STH = $DBH->prepare('select ID from fin_year where IFNULL(`Default`,1)=1  ' );
						$STH->execute( );
						$fin_year = $STH->fetchAll(\PDO::FETCH_OBJ);
						if($fin_year && count($fin_year)>0){
							$FinYearID=is_null($fin_year[0]->ID)?null:$fin_year[0]->ID;	
						}
					$DBH->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
					$STH = $DBH->prepare('select * from invoice_det' );
						$STH->execute();
					$invoice_det = $STH->fetchAll(\PDO::FETCH_OBJ);
					//var_dump($invoice_det);
					//exit;
					
					$app_class = 'App\\Http\\Controllers\\invoice_template\invoice_templateController';
					$app_uri='invoice_template_test1';		
					//$app_engine='laravel-5.4';
					$app_engine='laranopea';
					$app=new app_loader($app_engine,$app_path,$app_uri,$app_index,function($engine,$request,$app) 
										use($userID,$FinYearID,$BranchID){
						
						$user=Auth::loginUsingId($userID);
						 
							Auth::guard('user2')->login($user);
								$user = Auth::guard('user2')->user();
							Session::put('FinYearID',$FinYearID);
							Session::put('BranchID',$BranchID);
							
					},$config);

					 
							if (!function_exists('make_insert_query')) {
								function make_insert_query($cols){
									return ' ('.$cols.')' . ' values ('. implode(',', array_fill(0, count(explode(',',$cols) ), '?')) .')' ;//
								}
							}
					 					
					try { 
						
						 
						$STH = $DBH->prepare('select * from invoice' );
						$STH->execute();
						while($row = $STH->fetch(\PDO::FETCH_ASSOC)) {//FETCH_OBJ
							//unset($row['ID']);
							$row['main_table_det']=json_encode( DB::select('select * from invoice_det where invoiceID=?',[$row['ID']]));
														
							if(count(DB::select('select * from invoice_test1 where ID=?',[$row['ID']]))===0){
								DB::insert('insert into invoice_test1 (ID,Status,EmpId,Created_by,Created_on,UserID) values (?,?,?,?,?,?)'
									,[$row['ID'],$row['Status'],$row['EmpId'],$row['Created_on'], $row['Created_on'],$row['UserID'] ]);
								$id=DB::getPdo()->lastInsertId();
								$row['ID']=$id;
							}
							
							$InvDate =date_create_from_format('Y-m-d H:i:s', $row['InvDate'] );
							if($InvDate===false){
								$InvDate = new DateTime("now", new DateTimeZone('Asia/Dubai')); 
								$InvDate->setTimeZone(new DateTimeZone('Asia/Dubai')); 
							}
								$row['InvDate']=$InvDate->format('d-M-Y H:i');
								
														
							$res=$app->post($app_class,$row);
							if(is_object($res)){											 
								var_dump(get_protected($res,'targetUrl'));
								//var_dump(get_protected($res,'statusCode'));
							}
							
							$response['success_count']+=1;			
						}
							
												   
						$response['success']=true;
						
														
					} catch(PDOExecption $e) { 
						
						$response['error'].= $e->getMessage();
						 
					} 
					
				 
					
				}catch(\PDOException $e) {
					//echo $e->getMessage()  ;
					//exit;
					 $response['error']= $e->getMessage()  ;
				}
					
				//	$app->terminate();
					
				
			break;	 
		}
	}
	 
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Form Wizard | Okler Themes | Porto-Admin</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">
			 

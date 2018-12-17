<div id="_header" style="display:none;">
	<h2>Register</h2>				
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="<?php echo $url;?>">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Installation</span></li>
			<li><span>Register</span></li>
		</ol>

		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</div>
<div id="_menu" style="display:none;">
	<ul class="nav nav-main">
		<li>
			<a href="javascript:load_page('home');">
				<i class="fa fa-home" aria-hidden="true"></i>
				<span>Dashboard</span>
			</a>
		</li>
		
		<li class="nav-parent nav-expanded nav-active">
			<a>
				<i class="fa fa-list-alt" aria-hidden="true"></i>
				<span>Installation</span>
			</a>
			<ul class="nav nav-children">
				<li class="nav-active">
					<a href="javascript:load_page('register');">
						 Register
					</a>
				</li>
				<li>
					<a href="javascript:load_page('login');">
						 Login
					</a>
				</li>
			</ul>
		</li>
	
	</ul>

</div>	
<?php
	/*
	mysql for MySQL (host, port, dbname, unix_socket)
	pgsql for Postgres (host, port, dbname,user, password)
	sqlite for SQLite (see notes below)
	mssql or sybase or dblib for SQL Server and Sybase (host, dbname, charset, appname, secure)
	firebird for Firebird and Interbase (dbname, charset, role)
	informix for Informix (requires an odbc.ini file; refer to the linked manual page)
	OCI for Oracle (dbname, charset)
	odbc for ODBC (DSN, UID, PWD)
	ibm for IBM DB2 (DSN or DRIVER, DATABASE, HOSTNAME, PORT, PROTOCOL)
	*/
	$dbtypes=[
		'mysql'=>['MySQL','host,dbname,uid,pwd']
		,'pgsql'=>['Postgres','host,dbname,uid,pwd']
		,'mssql'=>['SQL Server','host,dbname,uid,pwd']
		,'sqlite'=>['SQLite','dbname']
	];
	$db_errors=[
			'host'=>'Host is required'
			,'dbname'=>'Database is required'
			,'uid'=>'Username is required'
			,'pwd'=>'Password is required'
			
		];
	$account_tab='active';
	$profile_tab='';
	$confirm_tab='';
	$error='';
	$success=false;
		if(isset($_REQUEST['passwordconfirm']) && $_REQUEST['passwordconfirm']!==$_REQUEST['password']){
			$error='Password doesn\'t match';
		}else if(isset($_REQUEST['passwordconfirm']) && $_REQUEST['passwordconfirm']===$_REQUEST['password']){
				$success=true;
			$dbtype=$_REQUEST['dbtype'];
					$fields=explode(',',$dbtypes[$dbtype][1]);
				foreach($fields as $val){
					if(!isset($_REQUEST[$val]) || $_REQUEST[$val]===''){
						$error=$db_errors[$val];
						$success=false;
						$account_tab='';
						$profile_tab='active';
						$confirm_tab='';
						break;
					}
				}
			if($success===true){
					$success=false;
				try{
					$file_db = new PDO('sqlite:data.sqlite3');
					$file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$file_db->exec('CREATE TABLE IF NOT EXISTS users(
						ID INTEGER PRIMARY KEY AUTOINCREMENT, 
						email VARCHAR(96),
						username VARCHAR(20),
						password VARCHAR(40),
						token TEXT,
						notify INT,
						date_added VARCHAR(20),
						date_modified VARCHAR(20)
						)');
					$file_db->exec('CREATE TABLE IF NOT EXISTS servers(
						ID INTEGER PRIMARY KEY AUTOINCREMENT, 
						host VARCHAR(96),
						dbname VARCHAR(40),
						uid VARCHAR(40),
						pwd VARCHAR(40),
						port VARCHAR(10),
						options TEXT,
						is_default INT,
						is_verified INT,
						date_added VARCHAR(20),
						date_modified VARCHAR(20)
						)');
					$insert = 'INSERT INTO users'.make_insert_query('email,username,password,token,notify,date_added');
					$stmt = $file_db->prepare($insert);
					$row=[];
					$row[]=$_REQUEST['email'];
					$row[]=$_REQUEST['username'];
					$row[]=password_hash($_REQUEST['password'], PASSWORD_BCRYPT, ['cost' => 10]);
					$row[]=bin2hex(openssl_random_pseudo_bytes(16));
					$row[]=$_REQUEST['notify'];
					$row[]=date("Y-m-d h:i:s",time());
					$stmt->execute($row);
					$id=$file_db->lastInsertId();
					 
					
					$insert = 'INSERT INTO servers'.make_insert_query('host,dbname,uid,pwd,port,options,is_default,is_verified,date_added');
					$stmt = $file_db->prepare($insert);
					$row=[];
					$row[]=$_REQUEST['host'];
					$row[]=$_REQUEST['dbname'];
					$row[]=$_REQUEST['uid'];
					$row[]=$_REQUEST['pwd'];
					$row[]=$_REQUEST['port'];
					$row[]='';
					$row[]='1';
					$row[]='0';
					$row[]=date("Y-m-d h:i:s",time());
					$stmt->execute($row);
					$id=$file_db->lastInsertId();
					//var_dump($id);
					
					$file_db = null;
						$success=true;
				}catch(PDOException $e) {
					$error= $e->getMessage();
				}
			}
		}
		
?>
<div id="_content" style="display:none;">
	<div class="row">
		<div class="col-xs-12">
			<section class="panel form-wizard" id="w4">
				<header class="panel-heading">
					<div class="panel-actions">
						<!--
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
						-->
					</div>
	
					<h2 class="panel-title">Registration</h2>
				</header>
				<div class="panel-body">
					<div class="wizard-progress wizard-progress-lg">
						<div class="steps-progress">
							<div class="progress-indicator"></div>
						</div>
						<ul class="wizard-steps">
							<li class="<?php echo $account_tab;?>">
								<a href="#w4-account" data-toggle="tab"><span>1</span>User Info</a>
							</li>
							<li class="<?php echo $profile_tab;?>">
								<a href="#w4-profile" data-toggle="tab"><span>2</span>Server Info</a>
							</li>
							<li class="<?php echo $confirm_tab;?>">
								<a href="#w4-confirm" data-toggle="tab"><span>3</span>Confirmation</a>
							</li>
						</ul>
					</div>
					<form class="form-horizontal" novalidate="novalidate" action="<?php echo $url.'process/';?>" method="post" >
						<input type="hidden" name="route" id="route" value="register">
						<div class="tab-content">
							<div id="w4-account" class="tab-pane <?php echo $account_tab;?>">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-email">Email</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" name="email" id="w4-email" value="<?php echo isset($_REQUEST['email'])?$_REQUEST['email']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-username">Username</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="username" id="w4-username" value="<?php echo isset($_REQUEST['username'])?$_REQUEST['username']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-password">Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="password" id="w4-password" value="<?php echo isset($_REQUEST['password'])?$_REQUEST['password']:'';?>" required minlength="6">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-passwordconfirm">Confirm</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="passwordconfirm" id="w4-passwordconfirm" value="<?php echo isset($_REQUEST['passwordconfirm'])?$_REQUEST['passwordconfirm']:'';?>" required minlength="6">
									</div>
								</div>
							</div>
							<div id="w4-profile" class="tab-pane <?php echo $profile_tab;?>">
								<div class="form-group">
									<label class="col-md-3 control-label">Database Type</label>
									<div class="col-md-9">
										<select data-plugin-selectTwo class="form-control populate" name="dbtype" id="w4-dbtype" onchange="check_db_required" >
											<?php
												foreach($dbtypes as $key=>$val){
													
													$selected=(isset($_REQUEST['dbtype']) && $_REQUEST['dbtype']===$key?'selected':(!isset($_REQUEST['dbtype']) && $key==='mysql'?'selected':''));
													echo '<option value="'.$key.'" '.$selected.' required_fields="'.$val[1].'">'.$val[0].'</option>';
												}
											?>
										</select>
										<script>
											function check_db_required(){
												var all_fields='host,dbname,uid,pwd,port'.split(',');
												var required_fields=this.options[this.selectedIndex].getAttribute('required_fields').split(',');
												for(var i=0;i<all_fields.length;i++){
													$(document.getElementById('w4-'+all_fields[i])).rules("remove");//.removeAttribute('required');
												}
												for(var i=0;i<required_fields.length;i++){
													$(document.getElementById('w4-'+required_fields[i])).rules( "add", {
													  required: true,
													  messages: {
														required: "This field is required.",
													  }
													});
												}
											}
											////check_db_required.call(document.getElementById('w4-dbtype'));
										</script>
									</div>
								</div>
			
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-host">Host</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="host" id="w4-host" value="<?php echo isset($_REQUEST['host'])?$_REQUEST['host']:'';?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-dbname">Database</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="dbname" id="w4-dbname" value="<?php echo isset($_REQUEST['dbname'])?$_REQUEST['dbname']:'';?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-uid">Username</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="uid" id="w4-uid" value="<?php echo isset($_REQUEST['uid'])?$_REQUEST['uid']:'';?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-pwd">Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="pwd" id="w4-pwd" value="<?php echo isset($_REQUEST['pwd'])?$_REQUEST['pwd']:'';?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-port">Port(Optional)</label>
									<div class="col-sm-9">
										<input type="number" class="form-control" name="port" id="w4-port" value="<?php echo isset($_REQUEST['port'])?$_REQUEST['port']:'';?>" >
									</div>
								</div>
							</div>
							
							<div id="w4-confirm" class="tab-pane <?php echo $confirm_tab;?>">
								
								<div class="form-group">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<div class="checkbox-custom">
											<input type="checkbox" name="notify" id="w4-notify" <?php echo isset($_REQUEST['notify']) && $_REQUEST['notify']!==''?'checked':'';?> value="1">
											<label for="w4-notify">Notify through the mail when tasks are done</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<div class="checkbox-custom">
											<input type="checkbox" name="terms" id="w4-terms" <?php echo isset($_REQUEST['terms']) && $_REQUEST['terms']!==''?'checked':'';?> value="1" required>
											<label for="w4-terms">I agree to the terms of service</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="panel-footer">
					<ul class="pager">
						<li class="previous disabled">
							<a><i class="fa fa-angle-left"></i> Previous</a>
						</li>
						<li class="finish hidden pull-right">
							<a>Finish</a>
						</li>
						<li class="next">
							<a>Next <i class="fa fa-angle-right"></i></a>
						</li>
					</ul>
				</div>
			</section>
		</div>
	</div>
</div>
<script>
	 
		document.getElementById('page_header').innerHTML=document.getElementById('_header').innerHTML;
		document.getElementById('menu').innerHTML=document.getElementById('_menu').innerHTML;
		document.getElementById('page_content').innerHTML=document.getElementById('_content').innerHTML;
		
	if ( $.isFunction($.fn[ 'select2' ]) ) {

		$(function() {
			$('[data-plugin-selectTwo]').each(function() {
				var $this = $( this ),
					opts = {};

				var pluginOptions = $this.data('plugin-options');
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginSelect2(opts);
			});
		});

	}
	
	var $w4finish = $('#w4').find('ul.pager li.finish');
	var	$w4validator = $("#w4 form").validate({
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
			$(element).remove();
		},
		errorPlacement: function( error, element ) {
			element.parent().append( error );
		}
	});
	$("#w4 form")[0].onchange= function (e) {
	   form_changed=true;
	};

	$w4finish.on('click', function( ev ) {
		ev.preventDefault();
			////$w4validator.resetForm();
			//check_db_required.call(document.getElementById('w4-dbtype'));
			
		var validated = $('#w4 form').valid();
		if ( validated ) {
			/*
			new PNotify({
				title: 'Congratulations',
				text: 'You completed the wizard form.',
				type: 'custom',
				addclass: 'notification-success',
				icon: 'fa fa-check'
			});
			*/
			 
			ajax_form_post($('#w4 form')[0]);
			form_changed=false;
		}else{
			
		}
	});

	$('#w4').bootstrapWizard({
		tabClass: 'wizard-steps',
		nextSelector: 'ul.pager li.next',
		previousSelector: 'ul.pager li.previous',
		firstSelector: null,
		lastSelector: null,
		onNext: function( tab, navigation, index, newindex ) {
			var validated = $('#w4 form').valid();
			if( !validated ) {
				$w4validator.focusInvalid();
				return false;
			}
			
		},
		onTabClick: function( tab, navigation, index, newindex ) {
			if ( newindex == index + 1 ) {
				return this.onNext( tab, navigation, index, newindex);
			} else if ( newindex > index + 1 ) {
				return false;
			} else {
				return true;
			}
		},
		onTabChange: function( tab, navigation, index, newindex ) {
			var $total = navigation.find('li').size() - 1;
			$w4finish[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
			$('#w4').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
		},
		onTabShow: function( tab, navigation, index ) {
			var $total = navigation.find('li').length - 1;
			var $current = index;
			var $percent = Math.floor(( $current / $total ) * 100);
			$('#w4').find('.progress-indicator').css({ 'width': $percent + '%' });
			tab.prevAll().addClass('completed');
			tab.nextAll().removeClass('completed');
		}
	});
	<?php 
		if($error!==''){
	?>
			new PNotify({
				title: 'Error in registering...',
				text: <?php echo json_encode($error);?>,
				type: 'custom',
				addclass: 'notification-error',
				icon: 'fa fa-bug'
			});
	<?php
		}else if($success===true){
	?>
			new PNotify({
				title: 'Congratulations',
				text: 'You have completed registration. Your registration will be completed by email activation.',
				type: 'custom',
				addclass: 'notification-success',
				icon: 'fa fa-check'
			});
			setTimeout(function(){
				alert('redirect');
			},3000);
	<?php
		}
	?>
</script>

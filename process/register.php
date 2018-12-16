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
							<li class="active">
								<a href="#w4-account" data-toggle="tab"><span>1</span>User Info</a>
							</li>
							<li>
								<a href="#w4-profile" data-toggle="tab"><span>2</span>Server Info</a>
							</li>
							<li>
								<a href="#w4-confirm" data-toggle="tab"><span>3</span>Confirmation</a>
							</li>
						</ul>
					</div>
					<?php
						$account_tab='active';
						$profile_tab='';
						$confirm_tab='';
						$error='';
						$success=false;
							if(isset($_REQUEST['passwordconfirm']) && $_REQUEST['passwordconfirm']!==$_REQUEST['password']){
								$error='Password doesn\'t match';
							}else if(isset($_REQUEST['passwordconfirm']) && $_REQUEST['passwordconfirm']===$_REQUEST['password']){
								try{
									$file_db = new PDO('sqlite:data.sqlite3');
									// Set errormode to exceptions
									//$file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
									$file_db->exec('CREATE TABLE IF NOT EXISTS users (
										ID INTEGER PRIMARY KEY AUTOINCREMENT, 
										email VARCHAR(96),
										username VARCHAR(20),
										password VARCHAR(40),
										token TEXT,
										notify INT,
										date_added VARCHAR(20))');
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
									$file_db = null;
									
									
										$success=true;
								}catch(PDOException $e) {
									$error= $e->getMessage();
								}
								 
							}
							
					?>
					<form class="form-horizontal" novalidate="novalidate" action="<?php echo $url.'process/';?>" method="post" >
						<input type="hidden" name="route" id="route" value="register">
						<div class="tab-content">
							<div id="w4-account" class="tab-pane active">
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
										<input type="password" class="form-control" name="password" id="w4-password" required minlength="6">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-passwordconfirm">Confirm</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="passwordconfirm" id="w4-passwordconfirm" required minlength="6">
									</div>
								</div>
							</div>
							<div id="w4-profile" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-host">Host</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="host" id="w4-host"  value="<?php echo isset($_REQUEST['host'])?$_REQUEST['host']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-dbname">Database</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="dbname" id="w4-dbname"  value="<?php echo isset($_REQUEST['dbname'])?$_REQUEST['dbname']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-uid">Username</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="uid" id="w4-uid"  value="<?php echo isset($_REQUEST['uid'])?$_REQUEST['uid']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-pwd">Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="pwd" id="w4-pwd"  value="<?php echo isset($_REQUEST['pwd'])?$_REQUEST['pwd']:'';?>" required>
									</div>
								</div>
							</div>
							
							<div id="w4-confirm" class="tab-pane">
								
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
		
	/*
	Wizard #4
	*/
	var $w4finish = $('#w4').find('ul.pager li.finish'),
		$w4validator = $("#w4 form").validate({
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

	$w4finish.on('click', function( ev ) {
		ev.preventDefault();
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
			setTimeout(function(){
				new PNotify({
					title: 'Error in registering...',
					text: <?php echo json_encode($error);?>,
					type: 'custom',
					addclass: 'notification-error',
					icon: 'fa fa-bug'
				});
			},100);
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
	<?php
		}
	?>
</script>

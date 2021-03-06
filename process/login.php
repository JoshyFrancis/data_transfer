<div id="_header" style="display:none;">
	<h2>Login</h2>				
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="javascript:load_page('home');">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Login</span></li>
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
				<span>Login</span>
			</a>
			<ul class="nav nav-children">
				<li>
					<a href="javascript:load_page('register');">
						 Register
					</a>
				</li>
				<li class="nav-active">
					<a href="javascript:load_page('login');">
						 Login
					</a>
				</li>
				
			</ul>
		</li>
	
	</ul>

</div>
<?php
		$error='';
		$success=false;
		session('userID',null);
	if(isset($_REQUEST['email']) && $_REQUEST['email']!=='' ){
		try{
			$file_db = new PDO('sqlite:data.sqlite3');
			$file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			 
			$stmt = $file_db->prepare('SELECT ID,password from users where email=?');
			$stmt->execute([$_REQUEST['email']]);
			$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows)>0){
					$ID=$rows[0]['ID'];
				if (password_verify($_REQUEST['password'], $rows[0]['password'])){
					session('userID',$ID);
					$success=true;
				}else{
					$error='Authentication failed.';
				}
			}else{
				$error='User not exists.';
			}
			
			$file_db = null;
		}catch(PDOException $e) {
			$error= $e->getMessage();
		}
	}
	
?>
<div id="_content" style="display:none;">
	<div class="row">
		<div class="col-xs-12">
		
			<section class="body-sign" style="height: 0px;">
				<div class="center-sign">
					<!--
					<a href="/" class="logo pull-left">
						<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
					</a>
					-->
					<div class="panel panel-sign">
						<div class="panel-title-sign mt-xl text-right">
							<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
						</div>
							<div class="panel-body">
								<form id="login_form" action="<?php echo $url.'process/';?>" method="post">
									<input type="hidden" name="route" id="route" value="login"/>
									<div class="form-group mb-lg">
										<label>Email</label>
										<div class="input-group input-group-icon">
											<input name="email" type="email" class="form-control input-lg" value="<?php echo isset($_REQUEST['email'])?$_REQUEST['email']:'';?>" required />
											<span class="input-group-addon">
												<span class="icon icon-lg">
													<i class="fa fa-user"></i>
												</span>
											</span>
										</div>
									</div>

									<div class="form-group mb-lg">
										<div class="clearfix">
											<label class="pull-left">Password</label>
											<a href="javascript:load_page('forget_password');" class="pull-right">Lost Password?</a>
										</div>
										<div class="input-group input-group-icon">
											<input name="password" type="password" class="form-control input-lg" value="<?php echo isset($_REQUEST['password'])?$_REQUEST['password']:'';?>" required minlength="6" />
											<span class="input-group-addon">
												<span class="icon icon-lg">
													<i class="fa fa-lock"></i>
												</span>
											</span>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-8">
											<div class="checkbox-custom checkbox-default">
												<input id="RememberMe" name="rememberme" type="checkbox" <?php echo isset($_REQUEST['rememberme']) && $_REQUEST['rememberme']!==''?'checked':'';?> value="1"/>
												<label for="RememberMe">Remember Me</label>
											</div>
										</div>
										<div class="col-sm-4 text-right">
											<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
											<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
										</div>
									</div>

									<p class="text-center">Don't have an account yet? <a href="javascript:load_page('register');">Register!</a></p>

								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
			
		</div>
	</div>
</div>
<script>
	 
		document.getElementById('page_header').innerHTML=document.getElementById('_header').innerHTML;
		document.getElementById('menu').innerHTML=document.getElementById('_menu').innerHTML;
		document.getElementById('page_content').innerHTML=document.getElementById('_content').innerHTML;
	var login_form=document.getElementById('login_form');
	var	validator = $(login_form).validate({
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
			$(element).remove();
		},
		//errorPlacement: function( error, element ) {
		//	element.parent().append( error );
		//}
	});
	login_form.onchange= function (e) {
	   form_changed=true;
	   window.onbeforeunload = function(event) {event.returnValue = "Changes you made may not be saved.";	};
	};
	login_form.onsubmit=function(){
		var validated = $(this).valid();
		if ( validated ) {
			ajax_form_post(this,function(){
				//alert('success');
				$.magnificPopup.close();
			});
			form_changed=false;
		}
		return false;
	};
	
	<?php 
		if($error!==''){
	?>
			form_changed=true;
			window.onbeforeunload = function(event) {event.returnValue = "Changes you made may not be saved.";	};
			new PNotify({
				title: 'Error in login...',
				text: <?php echo json_encode($error);?>,
				type: 'custom',
				addclass: 'notification-error',
				icon: 'fa fa-bug'
			});
			
	<?php
		}else if($success===true){
	?>
				form_changed=false;
				window.onbeforeunload =null;
			var notify=new PNotify({
				title: 'Congratulations',
				text: 'Login success! You will be redireced to <a href="javascript:close_notify();">home</a> in <span id="notify_seonds">4 seconds</span>',
				type: 'custom',
				addclass: 'notification-success',
				icon: 'fa fa-check'
			});
				notify.seconds=4;
			
			var timer=setInterval(function(){
				form_changed=false;
				window.onbeforeunload =null;
				notify.seconds-=1;
				if(notify.seconds>=0){
					document.getElementById('notify_seonds').innerHTML=notify.seconds+' seconds';
				}else{
					close_notify();
				}
			},1000);
			var close_notify=function(){
				clearInterval(timer);
				notify.remove();
				load_page('home');
			};
	<?php
		}
	?>
</script>

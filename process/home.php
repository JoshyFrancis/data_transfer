<div id="_header" style="display:none;">
	<h2>Home</h2>				
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="javascript:load_page('home');">
					<i class="fa fa-home"></i>
				</a>
			</li>
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
				<span>Home</span>
			</a>
			<ul class="nav nav-children">
				<li>
					<a href="javascript:load_page('logout');">
						 Logout
					</a>
				</li>
			</ul>
		</li>
	
	</ul>

</div>
<?php
		$error='';
		$success=false;
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
<div id="_userbox">
	<?php
		if($_SESSION['user']!==null){
	?>
	<a href="#" data-toggle="dropdown">
		<figure class="profile-picture">
			<img src="assets/images/!logged-user.jpg" alt="<?php echo $_SESSION['user']['username'];?>" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
		</figure>
		<div class="profile-info" data-lock-name="<?php echo $_SESSION['user']['username'];?>" data-lock-email="johndoe@okler.com">
			<span class="name"><?php echo $_SESSION['user']['username'];?></span>
			<span class="role">administrator</span>
		</div>

		<i class="fa custom-caret"></i>
	</a>

	<div class="dropdown-menu">
		<ul class="list-unstyled">
			<li class="divider"></li>
			<li>
				<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
			</li>
			<li>
				<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
			</li>
			<li>
				<a role="menuitem" tabindex="-1" href="javascript:logout();"><i class="fa fa-power-off"></i> Logout</a>
			</li>
		</ul>
	</div>
	<?php
		}
	?>
</div>
<div id="_content" style="display:none;">
	Home
	<?php
		var_dump($_SESSION['user']);
	?>
</div>
<script>
	 
		document.getElementById('page_header').innerHTML=document.getElementById('_header').innerHTML;
		document.getElementById('menu').innerHTML=document.getElementById('_menu').innerHTML;
		document.getElementById('userbox').innerHTML=document.getElementById('_userbox').innerHTML;
		document.getElementById('page_content').innerHTML=document.getElementById('_content').innerHTML;
		function logout(){
			document.getElementById('userbox').innerHTML='';
			load_page('logout');
		}
</script>

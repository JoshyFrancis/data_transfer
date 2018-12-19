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
<div id="_content" style="display:none;">
	Home
	<?php
		var_dump($_SESSION['user']);
	?>
</div>
<script>
	 
		document.getElementById('page_header').innerHTML=document.getElementById('_header').innerHTML;
		document.getElementById('menu').innerHTML=document.getElementById('_menu').innerHTML;
		document.getElementById('page_content').innerHTML=document.getElementById('_content').innerHTML;
	
</script>

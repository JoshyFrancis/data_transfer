<div id="_header" style="display:none;">
	<h2>Login</h2>				
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="<?php echo $url;?>">
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
<div id="_content" style="display:none;">
	<div class="row">
		<div class="col-xs-12">
		
			<section class="body-error error-outside" style="height: 0px;">
				<div class="center-error">

					<div class="error-header">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<!--
										<a href="/" class="logo">
											<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
										</a>
										-->
									</div>
									<div class="col-md-4">
										<form class="form">
											<div class="input-group input-search">
												<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
												<span class="input-group-btn">
													<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="main-error mb-xlg">
								<h2 class="error-code text-dark text-center text-semibold m-none"><?php echo $error_no;?> <i class="fa fa-file"></i></h2>
								<!--
								<p class="error-explanation text-center">We're sorry, but the page you were looking for doesn't exist.</p>
								-->
								<p class="error-explanation text-center"><?php echo $exception->getMessage();?></p>
							</div>
						</div>
						<div class="col-md-4">
							<h4 class="text">Here are some useful links</h4>
							<ul class="nav nav-list primary">
								<li>
									<a href="javascript:load_page('home');"><i class="fa fa-caret-right text-dark"></i> Dashboard</a>
								</li>
								<li>
									<a href="javascript:load_page('profile');"><i class="fa fa-caret-right text-dark"></i> User Profile</a>
								</li>
								<li>
									<a href="javascript:load_page('faq');"><i class="fa fa-caret-right text-dark"></i> FAQ's</a>
								</li>
							</ul>
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
			new PNotify({
				title: 'Congratulations',
				text: 'You completed the wizard form.',
				type: 'custom',
				addclass: 'notification-success',
				icon: 'fa fa-check'
			});
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
</script>

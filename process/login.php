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
			<section class="panel form-wizard" id="w4">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
	
					<h2 class="panel-title">Form Wizard</h2>
				</header>
				<div class="panel-body">
					<div class="wizard-progress wizard-progress-lg">
						<div class="steps-progress">
							<div class="progress-indicator"></div>
						</div>
						<ul class="wizard-steps">
							<li class="active">
								<a href="#w4-account" data-toggle="tab"><span>1</span>Account Info</a>
							</li>
						</ul>
					</div>
	
					<form class="form-horizontal" novalidate="novalidate">
						<div class="tab-content">
							<div id="w4-account" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-username">Username</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="username" id="w4-username" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-password">Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="password" id="w4-password" required minlength="6">
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

<div id="_header" style="display:none;">
	<h2>Register</h2>				
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.html">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Forms</span></li>
			<li><span>Wizard</span></li>
		</ol>

		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
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
							<li>
								<a href="#w4-profile" data-toggle="tab"><span>2</span>Profile Info</a>
							</li>
							<li>
								<a href="#w4-billing" data-toggle="tab"><span>3</span>Billing Info</a>
							</li>
							<li>
								<a href="#w4-confirm" data-toggle="tab"><span>4</span>Confirmation</a>
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
							<div id="w4-profile" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-first-name">First Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="first-name" id="w4-first-name" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-last-name">Last Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="last-name" id="w4-last-name" required>
									</div>
								</div>
							</div>
							<div id="w4-billing" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-cc">Card Number</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="cc-number" id="w4-cc" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="inputSuccess">Expiration</label>
									<div class="col-sm-5">
										<select class="form-control" name="exp-month" required>
											<option>January</option>
											<option>February</option>
											<option>March</option>
											<option>April</option>
											<option>May</option>
											<option>June</option>
											<option>July</option>
											<option>August</option>
											<option>September</option>
											<option>October</option>
											<option>November</option>
											<option>December</option>
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" name="exp-year" required>
											<option>2014</option>
											<option>2015</option>
											<option>2016</option>
											<option>2017</option>
											<option>2018</option>
											<option>2019</option>
											<option>2020</option>
											<option>2021</option>
											<option>2022</option>
										</select>
									</div>
								</div>
							</div>
							<div id="w4-confirm" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="w4-email">Email</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="email" id="w4-email" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<div class="checkbox-custom">
											<input type="checkbox" name="terms" id="w4-terms" required>
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
	alert('ok');
		document.getElementById('page_header').innerHTML=document.getElementById('_header').innerHTML;
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

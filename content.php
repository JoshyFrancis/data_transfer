				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Form Wizard</h2>
					
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
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-lg-6">
								<section class="panel form-wizard" id="w1">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Form Wizard</h2>
									</header>
									<div class="panel-body panel-body-nopadding">
										<div class="wizard-tabs">
											<ul class="wizard-steps">
												<li class="active">
													<a href="#w1-account" data-toggle="tab" class="text-center">
														<span class="badge hidden-xs">1</span>
														Account
													</a>
												</li>
												<li>
													<a href="#w1-profile" data-toggle="tab" class="text-center">
														<span class="badge hidden-xs">2</span>
														Profile
													</a>
												</li>
												<li>
													<a href="#w1-confirm" data-toggle="tab" class="text-center">
														<span class="badge hidden-xs">3</span>
														Confirm
													</a>
												</li>
											</ul>
										</div>
										<form class="form-horizontal" novalidate="novalidate">
											<div class="tab-content">
												<div id="w1-account" class="tab-pane active">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-username">Username</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="username" id="w1-username" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-password">Password</label>
														<div class="col-sm-8">
															<input type="password" class="form-control input-sm" name="password" id="w1-password" minlength="6" required>
														</div>
													</div>
												</div>
												<div id="w1-profile" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-first-name">First Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="first-name" id="w1-first-name" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-last-name">Last Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="last-name" id="w1-last-name" required>
														</div>
													</div>
												</div>
												<div id="w1-confirm" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-email">Email</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="email" id="w1-email" required>
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2"></div>
														<div class="col-sm-10">
															<div class="checkbox-custom">
																<input type="checkbox" name="terms" id="w1-terms" required>
																<label for="w1-terms">I agree to the terms of service</label>
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
							<div class="col-lg-6">
								<section class="panel form-wizard" id="w2">
									<div class="tabs">
										<ul class="nav nav-tabs nav-justify">
											<li class="active">
												<a href="#w2-account" data-toggle="tab" class="text-center">
													<span class="badge hidden-xs">1</span>
													Account
												</a>
											</li>
											<li>
												<a href="#w2-profile" data-toggle="tab" class="text-center">
													<span class="badge hidden-xs">2</span>
													Profile
												</a>
											</li>
											<li>
												<a href="#w2-confirm" data-toggle="tab" class="text-center">
													<span class="badge hidden-xs">3</span>
													Confirm
												</a>
											</li>
										</ul>
										<form class="form-horizontal" novalidate="novalidate">
											<div class="tab-content">
												<div id="w2-account" class="tab-pane active">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w2-username">Username</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" id="w2-username" name="username" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w2-password">Password</label>
														<div class="col-sm-8">
															<input type="password" class="form-control input-sm" name="password" id="w2-password" required minlength="6">
														</div>
													</div>
												</div>
												<div id="w2-profile" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w2-first-name">First Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="first-name" id="w2-first-name" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w2-last-name">Last Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="last-name" id="w2-last-name" required>
														</div>
													</div>
												</div>
												<div id="w2-confirm" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w2-email">Email</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="email" id="w2-email" required>
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-2"></div>
														<div class="col-sm-10">
															<div class="checkbox-custom">
																<input type="checkbox" name="terms" id="w2-terms" required>
																<label for="w2-terms">I agree to the terms of service</label>
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
						<div class="row">
							<div class="col-md-6">
								<section class="panel form-wizard" id="w3">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Form Wizard</h2>
									</header>
									<div class="panel-body">
										<div class="wizard-progress">
											<div class="steps-progress">
												<div class="progress-indicator"></div>
											</div>
											<ul>
												<li class="active">
													<a href="#w3-account" data-toggle="tab"><span>1</span>Account Info</a>
												</li>
												<li>
													<a href="#w3-profile" data-toggle="tab"><span>2</span>Profile Info</a>
												</li>
												<li>
													<a href="#w3-billing" data-toggle="tab"><span>3</span>Billing Info</a>
												</li>
												<li>
													<a href="#w3-confirm" data-toggle="tab"><span>4</span>Confirmation</a>
												</li>
											</ul>
										</div>
										<form class="form-horizontal" novalidate="novalidate">
											<div class="tab-content">
												<div id="w3-account" class="tab-pane active">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w3-username">Username</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="username" id="w3-username" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w3-password">Password</label>
														<div class="col-sm-8">
															<input type="password" class="form-control input-sm" name="password" id="w3-password" minlength="6" required>
														</div>
													</div>
												</div>
												<div id="w3-profile" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w3-first-name">First Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="first-name" id="w3-first-name">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w3-last-name">Last Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="last-name" id="w3-last-name">
														</div>
													</div>
												</div>
												<div id="w3-billing" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w3-cc">Card Number</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="cc-number" id="w3-cc" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="inputSuccess">Expiration</label>
														<div class="col-sm-4">
															<select class="form-control input-sm" name="exp-month" required>
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
															<select class="form-control input-sm" name="exp-year" required>
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
												<div id="w3-confirm" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w3-email">Email</label>
														<div class="col-sm-8">
															<input type="text" class="form-control input-sm" name="email" id="w3-email" required>
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-3"></div>
														<div class="col-sm-9">
															<div class="checkbox-custom">
																<input type="checkbox" name="terms" id="w3-terms" required>
																<label for="w3-terms">I agree to the terms of service</label>
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
							<div class="col-md-6">
								<section class="panel form-wizard" id="w5">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Form Wizard</h2>
									</header>
									<div class="panel-body">
										<div class="wizard-tabs hidden">
											<ul class="wizard-steps">
												<li class="active">
													<a href="#w5-account" data-toggle="tab"><span class="badge">1</span>Account Info</a>
												</li>
												<li>
													<a href="#w5-profile" data-toggle="tab"><span class="badge">2</span>Profile Info</a>
												</li>
												<li>
													<a href="#w5-billing" data-toggle="tab"><span class="badge">3</span>Billing Info</a>
												</li>
												<li>
													<a href="#w5-confirm" data-toggle="tab"><span class="badge">4</span>Confirmation</a>
												</li>
											</ul>
										</div>
										<div class="progress progress-striped progress-xl m-md light">
											<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
												<span class="sr-only">60%</span>
											</div>
										</div>
										<form class="form-horizontal" novalidate="novalidate">
											<div class="tab-content">
												<div id="w5-account" class="tab-pane active">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w5-username">Username</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" name="username" id="w5-username" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w5-password">Password</label>
														<div class="col-sm-8">
															<input type="password" class="form-control" name="password" id="w5-password" minlength="2" required>
														</div>
													</div>
												</div>
												<div id="w5-profile" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w5-first-name">First Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" name="first-name" id="w5-first-name" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w5-last-name">Last Name</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" name="last-name" id="w5-last-name" required>
														</div>
													</div>
												</div>
												<div id="w5-billing" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w5-cc">Card Number</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" name="cc-number" id="w5-cc" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="inputSuccess">Expiration</label>
														<div class="col-sm-4">
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
												<div id="w5-confirm" class="tab-pane">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w5-email">Email</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" name="email" id="w5-email" required>
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-3"></div>
														<div class="col-sm-9">
															<div class="checkbox-custom">
																<input type="checkbox" name="terms" id="w5-terms" required>
																<label for="w5-terms">I agree to the terms of service</label>
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
					<!-- end: page -->
				</section>

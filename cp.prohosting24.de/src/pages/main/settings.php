<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml(getheader($config, $lang->getString("settings") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("settings"), $user, $lang));


$invoceInfo = requestBackend($config, ["userid" => $user->getId()], "getinvoiceinfo", $user->getLang());

$langList = requestBackend($config, [], "getLanguageList", $user->getLang())["response"];


$countryList = $invoceInfo["response"]["countrys"];

if(isset($invoceInfo["response"]["data"]["company_name"])){
	$companyName = $invoceInfo["response"]["data"]["company_name"];
	$street = $invoceInfo["response"]["data"]["street"];
	$house_number = $invoceInfo["response"]["data"]["house_number"];
	$plz = $invoceInfo["response"]["data"]["plz"];
	$city = $invoceInfo["response"]["data"]["city"];
	$selectedCountry = $invoceInfo["response"]["data"]["country"];
	$country = $invoceInfo["response"]["data"]["country"];
} else {
	$companyName = "";
	$street = "";
	$house_number = "";
	$plz = "";
	$city = "";
	$selectedCountry = "";
}

?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Card-->
			<div class="card card-custom">
				<!--begin::Card header-->
				<div class="card-header card-header-tabs-line nav-tabs-line-3x">
					<!--begin::Toolbar-->
					<div class="card-toolbar">
						<ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
							<!--begin::Item-->
							<li class="nav-item mr-3">
								<a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1">
									<span class="nav-icon">
                                    	<span class="svg-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
													<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="nav-text font-size-lg"><?php  echo $lang->getString("address"); ?></span>
								</a>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="nav-item mr-3">
								<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_2">
									<span class="nav-icon">
										<span class="svg-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="nav-text font-size-lg"><?php  echo $lang->getString("account"); ?></span>
								</a>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="nav-item mr-3">
								<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_3">
									<span class="nav-icon">
										<span class="svg-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
													<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
													<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="nav-text font-size-lg"><?php  echo $lang->getString("security"); ?></span>
								</a>
							</li>
							<li class="nav-item mr-3">
								<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_4">
									<span class="nav-icon">
										<span class="svg-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
													<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
													<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="nav-text font-size-lg"><?php  echo $lang->getString("sshkey"); ?></span>
								</a>
							</li>
						</ul>
					</div>
					<!--end::Toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
								<!--begin::Row-->
                                <div class="row">
								    <label class="col-form-label col-3 text-lg-right text-left"></label>
									<div class="col-9">
										<h6 class="text-dark font-weight-bold mb-10"><?php  echo $lang->getString("address"); ?>:</h6>
									</div>
								</div>
								<div class="row justify-content-between">
									<div class="col-md-6 col-sm-3 offset-md-3">
                                        <div class="form-group row">
											<div class="col-sm-12">
                                                <label class="col-form-label text-lg-right text-left"><?php  echo $lang->getString("companyname"); ?></label>
												<input id="edit_adress_companyname" class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $companyName; ?>" />
												<span class="form-text text-muted"><?php  echo $lang->getString("optional"); ?></span>
											</div>
										</div>
                                        <div class="form-group row">
											<div class="col-sm-12">
                                                <label class="col-form-label text-lg-right text-left"><?php  echo $lang->getString("street"); ?></label>
												<input id="edit_adress_street" class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $street; ?>" />
											</div>
										</div>
                                        <div class="form-group row">																
											<div class="col-sm-12">
                                                <label class="col-form-label text-lg-right text-left"><?php  echo $lang->getString("housenr"); ?></label>
												<input id="edit_adress_house_number" class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $house_number; ?>" />
											</div>
										</div>
                                        <div class="form-group row">
											<div class="col-sm-12">
                                                <label class="col-form-label text-lg-right text-left"><?php  echo $lang->getString("postalcode"); ?></label>
												<input id="edit_adress_plz" class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $plz; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="col-form-label text-lg-right text-left"><?php  echo $lang->getString("location"); ?></label>
												<input id="edit_adress_city" class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $city; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="text-lg-right text-left"><?php  echo $lang->getString("country"); ?></label>
												<select class="form-control" id="country_select">
													<?php
													foreach ($countryList as $country) {
														$countryName = $country["namede"];
														if($lang->getLang() == "en"){
															$countryName = $country["nameen"];
														}
														if($country["id"] == $selectedCountry){
															echo '<option value="' . $country["code"] . '" selected="selected">' . $country["namede"] . '</option>';
														} else {
															if($country["code"] == "de"){
																if($country == "" || $selectedCountry == "country"){
																	echo '<option value="' . $country["code"] . '" selected="selected">' . $country["namede"] . '</option>';
																}else {
																	echo '<option value="' . $country["code"] . '">' . $country["namede"] . '</option>';
																}
															} else {
																echo '<option value="' . $country["code"] . '">' . $country["namede"] . '</option>';
															}
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                    	<a id="button_adress_save" onClick="saveAdressData()" class="btn font-weight-bold text-uppercase btn-primary"><?php  echo $lang->getString("save"); ?></a>
                                    </div>
                                </div>
								<!--end::Row-->
						</div>
						<div class="tab-pane px-7" id="kt_user_edit_tab_4" role="tabpanel">
							<div class="row">
								<div class="col-lg-3 col-md-12 bottom15">
									<a onClick="openKeyCreate()" class="btn btn-outline-success font-weight-bold col"><?php  echo $lang->getString("createkey"); ?></a>
									</div>
							</div>
							<div class="row">
                                <div class="col-md-12">
									<?php echo getloadinghtml("settings_keys_load"); ?>
									<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="settings_keys_table" style="display:none;">
										<thead>
											<tr>
												<th>Id</th>
												<th><?php  echo $lang->getString("name"); ?></th>
												<th><?php  echo $lang->getString("created"); ?></th>
												<th><?php  echo $lang->getString("actions"); ?></th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
                                </div>
                            </div>
						</div>
						<div class="tab-pane px-7" id="kt_user_edit_tab_2" role="tabpanel">
								<!--begin::Row-->
								<div class="row">
								    <label class="col-form-label col-3 text-lg-right text-left"></label>
									<div class="col-9">
										<h6 class="text-dark font-weight-bold mb-10"><?php  echo $lang->getString("account"); ?>:</h6>
									</div>
								</div>
								<div class="row justify-content-between">
									<div class="col-md-6 col-sm-3 offset-md-3">
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="text-lg-right text-left"><?php  echo $lang->getString("firstname"); ?></label>
												<input id="edit_firstname" class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $user->getVorname(); ?>" />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="text-lg-right text-left"><?php  echo $lang->getString("lastname"); ?></label>
												<input id="edit_lastname" class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $user->getNachname(); ?>" />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="text-lg-right text-left"><?php  echo $lang->getString("username"); ?></label>
												<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $user->getUsername(); ?>" disabled="disabled"/>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="col-form-label text-lg-right text-left"><?php  echo $lang->getString("email"); ?></label> 
													<div class="input-group input-group-lg input-group-solid">
														<div class="input-group-prepend">
															<span class="input-group-text">
																<i class="la la-at"></i>
															</span>
														</div>
													<input id="edit_email" type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $user->getEmail(); ?>" placeholder="Email" <?php if($user->getSecret() == null){echo 'disabled="disabled"';}; ?>/>
												</div>
											</div>
										</div>
										<div class="row">
								    		<label class="col-form-label col-3 text-lg-right text-left"></label>
											<div class="col-sm-12">
												<h6 class="text-dark font-weight-bold mb-10"><?php  echo $lang->getString("emailnotification"); ?>:</h6>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="text-lg-right text-left"><?php  echo $lang->getString("loginnotification"); ?></label>
												<span class="switch">
							                		<label>
							                			<input id="mail_notification_login" type="checkbox" <?php if ($user->getLoginemail() == 1) { echo 'checked="checked"';} ?> name="select" />
							                			<span></span>
							                		</label>
							                	</span>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="text-lg-right text-left"><?php  echo $lang->getString("newsletter"); ?></label>
												<span class="switch">
							                		<label>
							                			<input id="setting_newsletter" type="checkbox" <?php if ($user->getNewsletter() == 1) { echo 'checked="checked"';} ?>  name="select" />
							                			<span></span>
							                		</label>
							                	</span>
											</div>
										</div>

										<div class="row">
								    		<label class="col-form-label col-3 text-lg-right text-left"></label>
											<div class="col-sm-12">
												<h6 class="text-dark font-weight-bold mb-10"><?php  echo $lang->getString("further"); ?>:</h6>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="text-lg-right text-left"><?php  echo $lang->getString("language"); ?></label>
												<select class="form-control" id="lang_select">
													<?php
													foreach ($langList as $langEntry) {
														if($langEntry["lang"] == $user->getLang()){
															echo '<option value="' . $langEntry["lang"] . '" selected="selected">' . $langEntry["displayname"] . '</option>';
														} else {
															echo '<option value="' . $langEntry["lang"] . '">' . $langEntry["displayname"] . '</option>';
														}
													}
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-12">
                                                <label class="text-lg-right text-left"><?php  echo $lang->getString("darkmode"); ?></label>
												<span class="switch">
							                		<label>
							                			<input id="setting_darkmode" type="checkbox" <?php if ($user->getDarkMode() == 1) { echo 'checked="checked"';} ?> name="select" />
							                			<span></span>
							                		</label>
							                	</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
                                    <div class="col-md-12 text-right">
                                   		<a id="button_account_save" onClick="saveAccountData()" class="btn font-weight-bold text-uppercase btn-primary"><?php  echo $lang->getString("save"); ?></a>
                                    </div>
                                </div>
								<!--end::Row-->
						</div>
						<div class="tab-pane px-7" id="kt_user_edit_tab_3" role="tabpanel">
								<!--begin::Body-->
								<div class="card-body">
									<div class="row">
									    <label class="col-form-label col-3 text-lg-right text-left"></label>
										<div class="col-9">
											<h6 class="text-dark font-weight-bold mb-10"><?php  echo $lang->getString("renewpassword"); ?>:</h6>
										</div>
									</div>
									<div class="row justify-content-between">
										<div class="col-md-6 col-sm-3 offset-md-3">
											<div class="form-group row">
												<div class="col-sm-12">
                                	                <label class="text-lg-right text-left"><?php  echo $lang->getString("currentpassword"); ?></label>
													<input id="edit_password_old" class="form-control form-control-lg form-control-solid" type="password" value="" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-12">
                                	                <label class="text-lg-right text-left"><?php  echo $lang->getString("newpassword"); ?></label>
													<input id="edit_password_new" class="form-control form-control-lg form-control-solid" type="password" value="" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-12">
                                	                <label class="text-lg-right text-left"><?php  echo $lang->getString("repeatnewpassword"); ?></label>
													<input id="edit_password_new2" class="form-control form-control-lg form-control-solid" type="password" value="" />
												</div>
											</div>
											<div class="row">
									    		<label class="col-form-label col-3 text-lg-right text-left"></label>
												<div class="col-sm-12">
													<h6 class="text-dark font-weight-bold mb-10"><?php  echo $lang->getString("2fa"); ?>:</h6>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-12">
                                	                <label class="text-lg-right text-left">2FA / TOTP&nbsp;</label>
													<button id="button_remove2fa" onclick="openRemove2fa()" type="button" class="btn btn-light-danger font-weight-bold btn-sm" <?php if($user->getSecret() == null){echo 'style="display:none"';}; ?>><?php  echo $lang->getString("remove2fa"); ?></button>
													<button id="button_request2fadata" onclick="request2FAData()" type="button" class="btn btn-light-primary font-weight-bold btn-sm" <?php if($user->getSecret() != null){echo 'style="display:none"';}; ?>><?php  echo $lang->getString("setup2fa"); ?></button>
													<div class="form-text text-muted mt-3"><?php  echo $lang->getString("2fat"); ?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
                                    	<div class="col-md-12 text-right">
                                    		<a id="button_password_save" onClick="savePassword()" class="btn font-weight-bold text-uppercase btn-primary"><?php  echo $lang->getString("save"); ?></a>
                                    	</div>
                                	</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<div>
	<div class="modal fade" id="user_add_2fa_modal" tabindex="-1" role="dialog" aria-labelledby="user_add_2fa_modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="user_add_2fa_modalLabel"><?php  echo $lang->getString("2fa"); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<br>
					<div class="row">
						<a id="user_add_2fa_modal_code_2fa_image" style="display: block;margin-left: auto;margin-right: auto;width: 40%;"></a>
					</div>
					<div class="row text-dark font-weight-bold">
						<p><?php  echo $lang->getString("2fasecret"); ?>:<br>
						<text id="user_add_2fa_modal_secret_2fa"></text></p>
					</div>
					<div class="row text-dark font-weight-bold">
						<p><?php  echo $lang->getString("confirmation"); ?>:</p>
						<input type="text" class="form-control" id="user_add_2fa_modal_code_2fa" placeholder="">
					</div>
					<br>
					<div class="row text-dark font-weight-bold">
					<?php echo $lang->getString("settings2fabackupcodelist"); ?>:
					<ul class="list-inline" id="user_add_2fa_backup_codes">
					</ul>
					<p><?php  echo $lang->getString("settings2fabackupcodelistt"); ?></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php  echo $lang->getString("cancel"); ?></button>
					<button id="user_add_2fa_modal_save" type="button" class="btn btn-success" onClick="activate2FA()"><?php  echo $lang->getString("save"); ?></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="user_remove_2fa_modal" tabindex="-1" role="dialog" aria-labelledby="user_remove_2fa_modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="user_remove_2fa_modalLabel"><?php  echo $lang->getString("remove2fa"); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<div class="row text-dark font-weight-bold">
						<p><?php  echo $lang->getString("confirmation"); ?>:</p>
						<input type="text" class="form-control" id="user_remove_2fa_modal_code_2fa" placeholder="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php  echo $lang->getString("cancel"); ?></button>
					<button id="user_remove_2fa_modal_save" type="button" class="btn btn-success" onClick="remove2FA()"><?php  echo $lang->getString("save"); ?></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="setting_key_delete_modal" tabindex="-1" role="dialog" aria-labelledby="setting_key_delete_modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="setting_key_delete_modalLabel"><?php  echo $lang->getString("deletekey"); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<p><?php  echo $lang->getString("deletekeyInfo"); ?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php  echo $lang->getString("cancel"); ?></button>
					<button id="setting_key_delete_modal_save" type="button" class="btn btn-danger" onClick="deleteKey()"><?php  echo $lang->getString("delete"); ?></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="setting_key_display_modal" tabindex="-1" role="dialog" aria-labelledby="setting_key_display_modalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="setting_key_display_modalLabel"><?php  echo $lang->getString("cancel"); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<text id="setting_key_display_modal_key" style="word-break: break-all;"></text>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php  echo $lang->getString("close"); ?></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="setting_key_create_modal" tabindex="-1" role="dialog" aria-labelledby="setting_key_create_modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="setting_key_create_modalLabel"><?php  echo $lang->getString("createkey"); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<textarea class="form-control" id="setting_key_create_modal_key" placeholder="ssh-rsa AAAAB3NzaC1yc2EAAAABJQAAAgEAuBvg7fKyVHKJputT8bNsP1C... user@exmaple.com"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php  echo $lang->getString("cancel"); ?></button>
					<button id="setting_key_create_modal_save" type="button" class="btn btn-success" onClick="createKey()"><?php  echo $lang->getString("save"); ?></button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
echo minifyhtml(getscripts($config, $lang));

echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';
?>

<script>

	var activeKeyId = 0;
	<?php
		if($_COOKIE["ph24_dark"] == 1){
			echo '$("#setting_darkmode").prop( "checked", true);';
		}
	?>

	function saveAccountData(){
		if ($('#mail_notification_login').is(':checked')){
			mail_notification_login = 1;
		} else {
			mail_notification_login = 0;
		}

		if ($('#setting_darkmode').is(':checked')){
			darkmode = 1;
		} else {
			darkmode = 0;
		}

		if ($('#setting_newsletter').is(':checked')){
			setting_newsletter = 1;
		} else {
			setting_newsletter = 0;
		}
		edit_email = $('#edit_email').val();
		if(edit_email == ''){
			toastr["error"]('<?php  echo $lang->getString("emailempty"); ?>');
			return;
		}
		edit_firstname = $('#edit_firstname').val();
		if(edit_firstname == ''){
			toastr["error"]('<?php  echo $lang->getString("firstnameempty"); ?>');
			return;
		}
		edit_lastname = $('#edit_lastname').val();
		if(edit_lastname == ''){
			toastr["error"]('<?php  echo $lang->getString("lastnameempty"); ?>');
			return;
		}
		lang_select = $('#lang_select').val();
		loadButton('#button_account_save');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),email:edit_email,vorname:edit_firstname,nachname:edit_lastname,passwort:0,loginemail:mail_notification_login,newsletter:setting_newsletter,lang:lang_select,darkmode:darkmode},"savesettings",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
			} else {
				toastr["success"]("Daten erfolgreich gespeichert");
				location.reload();
			}
			loadButton('#button_account_save',false);
        });
	}

	function saveAdressData(){
		edit_adress_companyname = $('#edit_adress_companyname').val();
		edit_adress_street = $('#edit_adress_street').val();
		if(edit_adress_street == ''){
			toastr["error"]('<?php  echo $lang->getString("streetempty"); ?>');
			return;
		}
		edit_adress_house_number = $('#edit_adress_house_number').val();
		if(edit_adress_house_number == ''){
			toastr["error"]('<?php  echo $lang->getString("housenumberempty"); ?>');
			return;
		}
		edit_adress_plz = $('#edit_adress_plz').val();
		if(edit_adress_plz == ''){
			toastr["error"]('<?php  echo $lang->getString("postalcodeempty"); ?>');
			return;
		}
		edit_adress_city = $('#edit_adress_city').val();
		if(edit_adress_city == ''){
			toastr["error"]('<?php  echo $lang->getString("locationempty"); ?>');
			return;
		}
		country_select = $('#country_select').val();
		loadButton('#button_adress_save');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),company_name:edit_adress_companyname, street:edit_adress_street, house_number:edit_adress_house_number, plz:edit_adress_plz, city:edit_adress_city, country:country_select},"setinvoiceinfo",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
			} else {
				toastr["success"]("<?php  echo $lang->getString("savescucess"); ?>");
			}
			loadButton('#button_adress_save',false);
        });
	}

	function savePassword(){
		edit_password_old = $('#edit_password_old').val();
		if(edit_password_old == ''){
			toastr["error"]('<?php  echo $lang->getString("oldpasswordempty"); ?>');
			return;
		}
		edit_password_new = $('#edit_password_new').val();
		if(edit_password_new == ''){
			toastr["error"]('<?php  echo $lang->getString("newpasswordempty"); ?>');
			return;
		}
		edit_password_new2 = $('#edit_password_new2').val();
		if(edit_password_new2 == ''){
			toastr["error"]('<?php  echo $lang->getString("newpasswordrepeatempty"); ?>');
			return;
		}
		loadButton('#button_password_save');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),password_old:edit_password_old, password_new:edit_password_new, password_new2:edit_password_new2},"savePassword",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
			} else {
				toastr["success"]("<?php  echo $lang->getString("savescucess"); ?>");
			}
			loadButton('#button_password_save',false);
			$('#edit_password_old').val('');
			$('#edit_password_new').val('');
			$('#edit_password_new2').val('');
        });
	}

	function request2FAData(){
		loadButton('#button_request2fadata');
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"add2fa",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
			} else {
                $('#user_add_2fa_modal_code_2fa_image').html("<img src='" + respond.response[0] + "'>");
				$('#user_add_2fa_modal_secret_2fa').html(respond.response[1]);
				$('#settings_backup_codes_table').DataTable().clear().draw();
				content = '';
                respond.response[2].forEach(element => {
					content += '<li class="list-inline-item">' + element.code + '&nbsp;</li>';
				});
				$('#user_add_2fa_backup_codes').html(content);
				$('#user_add_2fa_modal').modal('show');
			}
			loadButton('#button_request2fadata',false);
        });
	}

	function activate2FA(){
		code = $('#user_add_2fa_modal_code_2fa').val();
		if(code == ""){
			toastr.error("<?php  echo $lang->getString("entercode"); ?>",'');
			return;
		}
		loadButton('#user_add_2fa_modal_save');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),code:code},"add2fa",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
			} else {
				Cookies.set('ph24_notify_success', '<?php  echo $lang->getString("entercode"); ?>');
				toastr["success"]("<?php  echo $lang->getString("entercode"); ?>");
				location.reload();
				$('#user_add_2fa_modal').modal('hide');
				$('#button_remove2fa').show();
				$('#button_request2fadata').hide();
			}
			loadButton('#user_add_2fa_modal_save',false);
        });
	}

	function openRemove2fa(){
		$('#user_remove_2fa_modal').modal('show');
	}

	function remove2FA(){
		code = $('#user_remove_2fa_modal_code_2fa').val();
		if(code == ""){
			toastr.error("<?php  echo $lang->getString("entercode"); ?>",'');
			return;
		}
		loadButton('#user_remove_2fa_modal_save');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), code:code},"remove2fa",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
			} else {
				toastr["success"]("<?php  echo $lang->getString("2faremoved"); ?>");
				$('#user_remove_2fa_modal').modal('hide');
				$('#button_remove2fa').hide();
				$('#button_request2fadata').show();
			}
			loadButton('#user_remove_2fa_modal_save',false);
        });
	}

	function getKeys(){
		$('#settings_keys_table').hide();
		$('#settings_keys_load').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getKeys",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#settings_keys_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#settings_keys_table').DataTable().row.add( [
						element.id,
						element.name,
						element.created_on,
						'<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openKeyDelete(\'' + element.id + '\')\" title=\"<?php  echo $lang->getString("deletekey"); ?>\"><i class=\"fas fa-trash-alt\"></i></button> ' +
                        '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openKeyDisplay(\'' + element.key + '\')\" title=\"<?php  echo $lang->getString("showkey"); ?>\"><i class=\"fas fa-eye\"></i></button> '
                    ] ).draw( false );
				});
				$('#settings_keys_table').show();
				$('#settings_keys_load').hide();
			}
		});
	}

	function deleteKey(){
		loadButton('#setting_key_delete_modal_save');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:activeKeyId},"deleteKey",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("<?php  echo $lang->getString("keyremoved"); ?>");
				$('#setting_key_delete_modal').modal("hide");
				getKeys();
				loadButton('#setting_key_delete_modal_save', false);
			}
		});
	}

	function createKey(){
		key = $('#setting_key_create_modal_key').val();
		if(key == ""){
			toastr["error"]("<?php  echo $lang->getString("keyempty"); ?>");
			return;
		}
		loadButton('#setting_key_create_modal_save');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), key:key},"createKey",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("<?php  echo $lang->getString("keyadded"); ?>");
				$('#setting_key_create_modal').modal("hide");
				getKeys();
			}
			loadButton('#setting_key_create_modal_save', false);
		});
	}

	function openKeyDelete(id){
		activeKeyId = id;
		$('#setting_key_delete_modal').modal("show");
	}

	function openKeyDisplay(key){
		$('#setting_key_display_modal_key').html(key);
		$('#setting_key_display_modal').modal("show");
	}
	function openKeyCreate(){
		$('#setting_key_create_modal').modal("show");
	}

	getKeys();

	$('#settings_keys_table').DataTable({
		"scrollX": true,
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});

	$('#settings_backup_codes_table').DataTable({
		"scrollX": true,
		"responsive": true,
		"paging": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});

</script>

</body>
</html>
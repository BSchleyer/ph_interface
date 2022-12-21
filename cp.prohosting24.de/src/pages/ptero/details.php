<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

if(!isset($access)){
	$access = false;
	$rights = [];
}

if(!$access){
	if (!isset($content[2]) || $content[2] == "") {
		header('Location:' . $url . "service");
		die();
	}
	if(!is_numeric($content[2])){
		header('Location:' . $url . "service");
		die();
	}
	$serviceId = $content[2];
}

$packets = requestBackend($config, ["id" => $serviceId], "pteroGetProduct", $user->getLang());

echo minifyhtml(getheader($config, $lang->getString("appmanagement") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("appmanagement"), $user, $lang));

?>


	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
		<?php echo getloadinghtml("loading"); ?>
			<!--begin::Container-->
			<div class="container" style="display:none;" id="main">
					<!--begin::Row-->
					<div class="row">
						<div class="col-xl-6">
							<!--begin::Stats Widget 4-->
							<div class="card card-custom card-stretch gutter-b">
								<!--begin::Header-->
								<div class="card-header border-0 pt-6">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label font-weight-bolder font-size-h4 text-dark-75">CPU</span>
									</h3>
									<div class="card-toolbar">
										<div id="service_stats_cpu_data" class="font-weight-bolder font-size-h1 text-dark-75">0%</div>
									</div>
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body p-0 h-125px">
									<div id="service_stats_cpu" class="card-rounded-bottom position-absolute bottom-0 w-100" style="height: 120px" data-color="primary"></div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 4-->
						</div>
						<div class="col-xl-6">
							<!--begin::Stats Widget 5-->
							<div class="card card-custom card-stretch gutter-b">
								<!--begin::Header-->
								<div class="card-header border-0 pt-6">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label font-weight-bolder font-size-h4 text-dark-75">RAM</span>
									</h3>
									<div class="card-toolbar">
										<div id="service_stats_ram_data" class="font-weight-bolder font-size-h1 text-dark-75">0/0 GiB</div>
									</div>
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body p-0 h-125px">
									<div id="service_stats_ram" class="card-rounded-bottom position-absolute bottom-0 w-100"></div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::Stats Widget 5-->
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header ribbon ribbon-top border-0 pt-7">
									<div id="service_ribbon_master" class="ribbon-target bg-danger" style="top: -2px; right: 20px;"><?php echo $lang->getString("expired") ?></div>
									<h3 class="card-title"><?php echo $lang->getString("generalinfo") ?></h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6 bottom15">
											<span class="text-dark-75 font-size-h5">App-ID:<br><span id="service_info_id" class="text-dark-75 font-size-lg" >1337</span></span>
										</div>
										<?php
										if(!$access or isset($rights[24])){
										?>
										<div class="col-xl-6 bottom15">
											<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("sftpaccess") ?>:<br><span id="service_info_id" class="text-dark-75 font-size-lg" ><a href="javascript:openSFTP()" id="service_load_sftp"><?php echo $lang->getString("open") ?></a></span></span>
										</div>
										<?php
										} else {
											echo '<div class="col-xl-6 bottom15"></div>';
										}
										?>
										<div class="col-xl-6 bottom15">
											<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("hostsystem") ?>:<br><span id="service_info_host" class="text-dark-75 font-size-lg"></span></span>
										</div>
										<div class="col-xl-6 bottom15">
											<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("app") ?>:<br><span class="text-dark-75 font-size-lg" id="service_info_type"></span></span>
										</div>
										<div class="col-xl-6 bottom15">
											<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("ssd") ?>:<br><span id="service_info_disk" class="text-dark-75 font-size-lg">0GB / 5GB</span></span>
										</div>
										<div class="col-xl-6 bottom15">
											<span class="text-dark-75 font-size-h5"><text id="service_info_expire_text"><?php echo $lang->getString("serviceexpire") ?></text><br><span id="service_info_counter" class="text-dark-75 font-size-lg">44 Tage 2 Stunden 28 Minuten 50 Sekunden</span></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-header border-0 pt-6">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php echo $lang->getString("actions") ?></span>
									</h3>
								</div>
									<div class="card-body">
										<div class="row">
											<div class="col-12 bottom15">
												<a id="button_start_service" onClick="openServiceStart()" class="btn btn-outline-success font-weight-bold col"><?php echo $lang->getString("start") ?></a>
											</div>
											<div class="col-6 bottom15">
												<a id="button_stop_service" onClick="openServiceStop()" class="btn btn-outline-danger font-weight-bold col"><?php echo $lang->getString("stop") ?></a>
											</div>
											<div class="col-6 bottom15">
												<a id="button_shutdown_service" onClick="openServiceShutdown()" class="btn btn-outline-warning font-weight-bold col"><?php echo $lang->getString("shutdown") ?></a>
											</div>
										</div>
										<div class="row">
											<div class="col bottom15">
												<a id="button_renew_service" onClick="openServiceRenewModal()" class="btn btn-outline-primary font-weight-bold col"><?php echo $lang->getString("serviceextend") ?></a>
											</div>
										</div>
										<div class="row">
											<div class="col-6 bottom15">
												<a id="button_upgrade_service" onClick="openServiceUpgradeModal()" class="btn btn-outline-info font-weight-bold col"><?php echo $lang->getString("serviceupgrade") ?></a>
											</div>
											<div class="col-6 bottom15">
												<button id="button_reinstall_service" class="btn btn-outline-primary font-weight-bold col" type="button" data-toggle="modal" data-target="#service_reinstall_modal"><?php echo $lang->getString("reinstall") ?></button>
											</div>
										</div>
										<div class="row">
											<div class="col bottom15">
												<button class="btn btn-outline-primary font-weight-bold col" type="button" data-toggle="modal" data-target="#ptero_login_details"><?php echo $lang->getString("pterologindetails") ?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="card card-custom card-stretch gutter-b">
									<div class=" border-0 pt-7">
										<ul class="nav nav-tabs nav-tabs-line justify-content-center">
											<li class="nav-item" id="service_backup_tab_master">
												<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2" onClick="getBackups()">
													<span class="nav-icon"><i class="flaticon-folder-3"></i></span>
													<span class="nav-text"><?php echo $lang->getString("backup") ?></span>
												</a>
											</li>
											<?php
											if(!$access or isset($rights[20])){
											?>
											<li class="nav-item active">
												<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">
													<span class="nav-icon"><i class="flaticon-map"></i></span>
													<span class="nav-text"><?php echo $lang->getString("network") ?></span>
												</a>
											</li>
											<?php
											}
											if(!$access){
											?>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_7" onClick="getAccessList()">
													<span class="nav-icon"><i class="flaticon-list-2"></i></span>
													<span class="nav-text"><?php echo $lang->getString("shares") ?></span>
												</a>
											</li>
											<?php
											}
											if(!$access or isset($rights[21])){
											?>
											<li class="nav-item" id="service_variables_tab_master">
												<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5" onClick="getVariables()">
													<span class="nav-icon"><i class="flaticon-edit"></i></span>
													<span class="nav-text"><?php echo $lang->getString("variables") ?></span>
												</a>
											</li>
											<?php
											}
											?>
										</ul>
									</div>
									<div class="tab-content mt-5 col" id="myTabContent">
										<?php
										if(!$access){
										?>
										<div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel" aria-labelledby="kt_tab_pane_7">
											<?php echo getloadinghtml("access_list"); ?>
											<div id="access_list_master" style="display:none;">
												<button class="btn btn-outline-primary" type="button" onclick="openAccessNew()"><?php echo $lang->getString("createaccess") ?></button>
												<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="access_list_table">
													<thead>
														<tr>
															<th><?php echo $lang->getString("name") ?></th>
															<th><?php echo $lang->getString("state") ?></th>
															<th><?php echo $lang->getString("actions") ?></th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
										<?php
										}
										?>
										<div class="tab-pane fade card-body" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
											<?php echo getloadinghtml("service_backups"); ?>	
											<div id="service_backups_master" style="display:none">
												<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_backup_table">
													<thead>
														<tr>
															<th><?php echo $lang->getString("name") ?></th>
															<th><?php echo $lang->getString("size") ?></th>
															<th><?php echo $lang->getString("action") ?></th>
															<th><?php echo $lang->getString("created") ?></th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>	
										</div>
										<div class="tab-pane fade active show" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
											<?php echo getloadinghtml("service_ip"); ?>	
											<div id="service_ip_main" class="card-body" style="display:none">
												<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_ip_table">
													<thead>
														<tr>
															<th><?php echo $lang->getString("ip") ?></th>
															<th><?php echo $lang->getString("port") ?></th>
															<th><?php echo $lang->getString("state") ?></th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>	
										<div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
											<?php echo getloadinghtml("service_variables"); ?>	
											<div id="service_variables_main" class="card-body" style="display:none">
												<div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionExample7">
												</div>
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
	<div class="modal fade" id="service_renew_modal" tabindex="-1" role="dialog" aria-labelledby="service_renew_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_renew_modalLabel"><?php echo $lang->getString("serviceextend") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("vserverextendt") ?></p>
                    <p><?php echo $lang->getString("vserverextendperiod") ?>:</p>
                    <br>
                    <span style="text-align:center; margin:auto; display:block;">
                        <div class="modal_renew">
                            <span id="service_renew_3" onclick="switchServiceDayCount(1)">3 <?php echo $lang->getString("days") ?></span>
                            <span id="service_renew_30" onclick="switchServiceDayCount(2)">30 <?php echo $lang->getString("days") ?></span>
                            <span id="service_renew_60" onclick="switchServiceDayCount(3)">60 <?php echo $lang->getString("days") ?></span>
                            <span id="service_renew_90" onclick="switchServiceDayCount(4)">90 <?php echo $lang->getString("days") ?></span>
                            <span id="service_renew_in" onclick="switchServiceDayCount(5)"><?php echo $lang->getString("individual") ?></span>
                        </div>
                    </span>
                    <span style="display:block; max-width:20%; margin:auto; margin-top:1rem;">
                        <input type="number" class="form-control" id="service_renew_days" placeholder="Tage" onchange="calculateServiceRenew()" onkeyup="calculateServiceRenew()" value="3">
                    </span>
                    <br>
                    <p style="margin-bottom:0;margin-top:1rem;"><?php echo $lang->getString("yourcurrentcredit") ?> <?php echo round($user->getGuthaben(), 2); ?> €</p>
                    <p><?php echo $lang->getString("creditafterextend") ?> <text id="service_credit_after">0</text> €</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-primary" id="service_add_credit_button" onclick="openAddCredit()"><?php echo $lang->getString("addcredit") ?></button>
					<button type="button" class="btn btn-primary" id="service_renew_modal_button_autoremove_activate" onclick="openAutoRenew()"><?php echo $lang->getString("setupautoextend") ?></button>
					<button type="button" class="btn btn-primary" id="service_renew_modal_button_autoremove_remove" onclick="removeAutoRenew()"><?php echo $lang->getString("removeautoextend") ?></button>
                    <button type="button" class="btn btn-success" id="service_renew_button" onclick="renewService()"><?php echo $lang->getString("extendtext") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_start_modal" tabindex="-1" role="dialog" aria-labelledby="service_start_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_start_modalLabel"><?php echo $lang->getString("servicestart") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("servicestartt") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_start_modal_button" onclick="startService()"><?php echo $lang->getString("start") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_stop_modal" tabindex="-1" role="dialog" aria-labelledby="service_stop_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_stop_modalLabel"><?php echo $lang->getString("servicestop") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("servicestopt") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_stop_modal_button" onclick="stopService()"><?php echo $lang->getString("stop") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_shutdown_modal" tabindex="-1" role="dialog" aria-labelledby="service_shutdown_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_shutdown_modalLabel"><?php echo $lang->getString("serviceshutdown") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("serviceshutdownt") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_shutdown_modal_button" onclick="shutdownService()"><?php echo $lang->getString("serviceshutdown") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_delete_backup_modal" tabindex="-1" role="dialog" aria-labelledby="service_delete_backup_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_delete_backup_modalLabel"><?php echo $lang->getString("backupdelete") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("backupdeletet") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_delete_backup_modal_button" onclick="deleteBackup()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_download_backup_modal" tabindex="-1" role="dialog" aria-labelledby="service_download_backup_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_download_backup_modalLabel"><?php echo $lang->getString("backupdownload") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<a id="service_download_backup_modal_button" type="button" class="btn btn-success" target="_blank"><?php echo $lang->getString("download") ?></a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_backup_create_modal" tabindex="-1" role="dialog" aria-labelledby="service_backup_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_backup_create_modalLabel"><?php echo $lang->getString("createbackup") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("backuppterot1") ?></p>
                    <p><?php echo $lang->getString("backuppterot2") ?></p>
					<p><?php echo $lang->getString("name") ?>:</p>
                    <input type="text" class="form-control" id="service_backup_create_modal_name" placeholder="Name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_backup_create_modal_button" onclick="createBackup()"><?php echo $lang->getString("create") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_reinstall_modal" tabindex="-1" role="dialog" aria-labelledby="service_reinstall_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_reinstall_modalLabel"><?php echo $lang->getString("servicereinstall") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div id="service_reinstall_modal_master" class="checkbox-list">
						<label class="checkbox">
							<input type="checkbox" id="service_data_delete">
							<span></span><?php echo $lang->getString("serverreinstallt") ?>
						</label>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_reinstall_modal_button" onclick="reinstallService()"><?php echo $lang->getString("servicereinstall") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="service_sftp_data_modal" tabindex="-1" role="dialog" aria-labelledby="service_sftp_data_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_sftp_data_modalLabel"><?php echo $lang->getString("sftpservice") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				<?php echo $lang->getString("username") ?>: <text id="service_sftp_data_modal_username"></text><br>
				<?php echo $lang->getString("password") ?>: <text id="service_sftp_data_modal_password"></text><br>
					Host: <text id="service_sftp_data_modal_host"></text><br>

					<text id="service_sftp_data_modal_string" style="word-wrap: break-word;"></text>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="service_upgrade_modal" tabindex="-1" role="dialog" aria-labelledby="service_upgrade_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_upgrade_modalLabel"><?php echo $lang->getString("serviceupgrade") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="upgrade_packet">
                        <div class="form-group">
                            <label for="service_upgrade_packets"><?php echo $lang->getString("packages") ?></label>
                            <select class="form-control" id="service_upgrade_packets" onchange="upgradeService(1)">
                            </select>
                        </div>
                    </div>
					<?php echo getloadinghtml("service_upgrade_load"); ?>
                    <div id="service_upgrade_calc_1">
                        <label class="kt-checkbox" >
                            <input type="checkbox" id="service_upgrade_restart" /><?php echo $lang->getString("apprestart") ?><span></span>
                        </label>
                        <p><text id="upgrade_credit_after_text"><?php echo $lang->getString("onetimecosts") ?>:</text> <text id="upgrade_credit_after">0</text> €</p>
                        <p><?php echo $lang->getString("costspermonth") ?>: <text id="upgrade_credit_monthly_after">0</text> €</p>
						<p><?php echo $lang->getString("creditafterupgrade") ?>: <text id="upgrade_credit_left">0</text> €</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_upgrade_modal_button" onclick="upgradeService(0)"><?php echo $lang->getString("upgrade") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_access_new_modal" tabindex="-1" role="dialog" aria-labelledby="service_access_new_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_access_new_modalLabel"><?php echo $lang->getString("createnewaccess") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo getloadinghtml("service_access_new_right_load"); ?>
					<div id="service_access_new_modal_master" class="checkbox-list" style="display:none;">
						<label>Einladecode:</label>
						<input type="text" class="form-control" id="service_access_new_invite_code" placeholder="123-456-789-101">
						<br>
                        <label>Anzeigename:</label>
						<input type="text" class="form-control" id="service_access_new_display_name">
						<br>
						<div class="form-group">
							<label for="service_access_new_right_select"><?php echo $lang->getString("rights") ?></label>
							<div class="checkbox-list" id="service_access_new_right_checkboxes"></div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_access_new_modal_button" onclick="createNewAccess()"><?php echo $lang->getString("invite") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="service_access_user_info_modal" tabindex="-1" role="dialog" aria-labelledby="service_access_user_info_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_access_user_info_modalLabel"><?php echo $lang->getString("editAccessRights") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<h4><?php echo $lang->getString("rights") ?></h4>
					<div class="form-group">
						<label for="service_access_edit_right_select"><?php echo $lang->getString("rights") ?></label>
						<div class="checkbox-list" id="service_access_edit_right_checkboxes"></div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
					<button type="button" class="btn btn-success" id="service_access_edit_modal_button" onclick="saveAccess()"><?php echo $lang->getString("save") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="access_delete_modal" tabindex="-1" role="dialog" aria-labelledby="access_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="access_delete_modalLabel"><?php echo $lang->getString("deleteshare") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				<?php echo $lang->getString("sharedeletet") ?><br>
				<?php echo $lang->getString("sharedeletet2") ?><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="access_delete_modal_button" onclick="deleteAccess()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_auto_renew_modal" tabindex="-1" role="dialog" aria-labelledby="service_auto_renew_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_auto_renew_modalLabel"><?php echo $lang->getString("activateautoextend") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("activateautoextendt") ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_auto_renew_modal_button" onclick="activateAutoRenew()"><?php echo $lang->getString("activate") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="ptero_login_details" tabindex="-1" role="dialog" aria-labelledby="ptero_login_detailsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ptero_login_detailsLabel"><?php echo $lang->getString("pterologindetails") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<h5><?php echo $lang->getString("username") ?>:</h5>
					<h6 id="ptero_login_details_username"></h6>
					<h5><?php echo $lang->getString("password") ?>:</h5>
					<h6 id="ptero_login_details_password"></h6>
					<h5><?php echo $lang->getString("loginUrl") ?>:</h5>
					<a target="_blank" href="https://app.prohosting24.de/">https://app.prohosting24.de/</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . 'assets/js/pages/features/charts/apexcharts.js"></script>';
echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';
?>

<script>
	var serviceId = <?php echo $serviceId ?>;
	var price = 0;
	var endTime = 0;
	var displayName = "";
    var host = "";
    var diskUsage = 0;
    var diskSpace = 0;
	var credit = <?php echo $user->getGuthaben(); ?>;
	var creditAddWindow = "";
	var status = "";
	var packet = 0;

	var webSocket = null;
	var token = "";
	var socket = "";
	var serviceStatistikCPU = [];
	var serviceStatistikRAM = [];

	var currentBackup = "";

	var productId = 5;

	var activeAccess = 0;

	function getServiceData(){
        requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getappinfo",function(respond){
            if(respond.fail){
                toastr["error"](respond.error);
            } else {
				price = respond.response.price;
				endTime = respond.response.timeleft;
				displayName = respond.response.displayName;
				status = respond.response.status;
                host = respond.response.nodeid;
                diskUsage = respond.response.diskUsage;
				diskSpace = respond.response.diskSpace;
				autoRenew = respond.response.autorenew;
				packet = respond.response.packetid;
				name = respond.response.name;
				$('#ptero_login_details_username').html(respond.response.username);
				$('#ptero_login_details_password').html(respond.response.password);
				if(respond.response.packet.backups){
					$('#service_backup_tab_master').show();
				} else {
					$('#service_backup_tab_master').hide();
				}
				if(respond.response.packet.variables){
					$('#service_variables_tab_master').show();
				} else {
					$('#service_variables_tab_master').hide();
				}
				if(autoRenew == 0){
					$('#service_renew_modal_button_autoremove_activate').show();
					$('#service_renew_modal_button_autoremove_remove').hide();
				} else {
					$('#service_renew_modal_button_autoremove_activate').hide();
					$('#service_renew_modal_button_autoremove_remove').show();
				}
				$('#service_info_id').html("#" + serviceId);
				$('#service_info_type').html(displayName);
				$('#service_info_host').html("docker" + host);
                $('#service_info_disk').html(diskUsage + 'GB / ' + diskSpace + 'GB');
                $('#service_info_storage').html();
				$('#button_renew_service').show();
				$("#service_ribbon_master").removeClass();
				$('#service_ribbon_master').addClass("ribbon-target");
				$('#button_start_service').hide();
				$('#button_stop_service').hide();
				$('#button_shutdown_service').hide();
				$('#button_upgrade_service').show();
				$('#button_reinstall_service').show();
				$('#masterPageTitle').html("<?php echo $lang->getString("appmanagement"); ?> - " + name);
				switch (status) {
					case 'running':
						$('#button_stop_service').show();
						$('#button_shutdown_service').show();
						$('#service_ribbon_master').html("<?php echo $lang->getString("online") ?>");
						$('#service_ribbon_master').addClass("bg-success");
						break;
                    case 'offline':
						$('#button_start_service').show();
						$('#service_ribbon_master').html("<?php echo $lang->getString("offline") ?>");
						$('#service_ribbon_master').addClass("bg-warning");
						break;
					case 'starting':
						$('#service_ribbon_master').html("<?php echo $lang->getString("started") ?>");
						$('#service_ribbon_master').addClass("bg-success");
						$('#button_stop_service').show();
						$('#button_shutdown_service').show();
						$('#button_reinstall_service').hide();
						break;
					case 'installing':
						$('#service_ribbon_master').html("<?php echo $lang->getString("installation") ?>");
						$('#service_ribbon_master').addClass("bg-primary");
						$('#button_reinstall_service').hide();
						break;
                    case 'stopping':
						$('#service_ribbon_master').html("<?php echo $lang->getString("stopped") ?>");
						$('#service_ribbon_master').addClass("bg-warning");
						$('#button_reinstall_service').hide();
						break;
					case 'expired':
						$('#service_ribbon_master').html("<?php echo $lang->getString("serviceexpire") ?>");
						$('#service_ribbon_master').addClass("bg-warning");
						endTime = respond.response.timeleftdelete;
						$('#service_info_expire_text').html("<?php echo $lang->getString("servicedelete") ?>");
						$('#button_upgrade_service').hide();
						$('#button_reinstall_service').hide();
						break;
					case 'deleted':
						$('#service_ribbon_master').html("<?php echo $lang->getString("deleted") ?>");
						$('#service_ribbon_master').addClass("bg-danger");
						$('#button_renew_service').hide();
						$('#button_upgrade_service').hide();
						$('#button_reinstall_service').hide();
						break;
				}
				<?php
				if($access){
					echo "$('#button_renew_service').hide();
					$('#button_upgrade_service').hide();";
					if(!isset($rights[18])){
						echo "$('#button_start_service').hide();";
					}
					if(!isset($rights[19])){
						echo "$('#button_stop_service').hide();";
						echo "$('#button_shutdown_service').hide();";
					}
					if(!isset($rights[23])){
						echo "$('#button_reinstall_service').hide();";
					}
				}
				?>
				countDownArray = [["service_info_counter",endTime]];
				countDown();
				$('#loading').hide();
				$('#main').show();
				if(token == ''){
					getWebsocketInfo();
				}
			}
        });
	}

	function openServiceStart(){
		$('#service_start_modal').modal('show');
	}

	function openServiceStop(){
		$('#service_stop_modal').modal('show');
	}

	function openServiceShutdown(){
		$('#service_shutdown_modal').modal('show');
	}

	function openBackupDelete(backup){
		currentBackup = backup;
		$('#service_delete_backup_modal').modal('show');
	}

	function openAutoRenew(){
		$('#service_renew_modal').modal('hide');
		$('#service_auto_renew_modal').modal('show');
	}

	function activateAutoRenew(){
		loadButton('#service_auto_renew_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, productId:productId},"activateAutoRenew",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nsetupsuccess") ?>');
				$('#service_auto_renew_modal').modal('hide');
			}
			loadButton('#service_auto_renew_modal_button',false);
			getServiceData();
		});
	}

	function removeAutoRenew(){
		loadButton('#service_renew_modal_button_autoremove_remove');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, productId:productId},"removeAutoRenew",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nsuccessremove") ?>');
				$('#service_renew_modal').modal('hide');
			}
			loadButton('#service_renew_modal_button_autoremove_remove',false);
			getServiceData();
		});
	}


	function openBackupDownload(backup){
		getBackupDownloadLink(backup);
	}

	function startService(){
		loadButton('#service_start_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appstart",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("servicestarted") ?>");
				$('#service_start_modal').modal('hide');		
			}
			loadButton('#service_start_modal_button',false);
		});
	}

	function shutdownService(){
		loadButton('#service_shutdown_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appshutdown",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("servicestarted") ?>");
				$('#service_shutdown_modal').modal('hide');		
			}
			loadButton('#service_shutdown_modal_button',false);
		});
	}

	function getBackups(){
		$('#service_backups_master').hide();
		$('#service_backups').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appgetbackups",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_backup_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#service_backup_table').DataTable().row.add( [
                        element.name,
						(element.bytes / 1074000000).toFixed(2) + "GiB",
						'<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openBackupDelete(\'' + element.uuid + '\')\" title=\"Backup Löschen.\"><i class=\"fas fa-trash-alt\"></i></button> ' +
                        '<button id="backup_download_'+ element.uuid+'" type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openBackupDownload(\'' + element.uuid + '\')\" title=\"<?php echo $lang->getString("backuprestore") ?>\"><i class=\"fas fa-download\"></i></button> ',
						element.created_at
                    ] ).draw( false );
				});
				$('#service_backups_master').show();
				$('#service_backups').hide();
			}
		});
	}

	function getBackupDownloadLink(backup){
		loadButton('#backup_download_' + backup,true,false);
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, name:backup},"appgetbackuplink",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_download_backup_modal_button').attr('href', respond.response.url);
				$('#service_download_backup_modal').modal('show');
			}
			loadButton('#backup_download_' + backup,false);
		});
	}

	function reinstallService(){
		if(!$('#service_data_delete').is(":checked")){
			toastr["error"]('<?php echo $lang->getString("confirmdeletion") ?>');
            return;
		}
		loadButton('#service_reinstall_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId,},"appreinstall",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("startedinstallation") ?>");
				$('#service_reinstall_modal').modal('hide');
			}
			loadButton('#service_reinstall_modal_button',false);
		});
	}


	function deleteBackup(){
		loadButton('#service_delete_backup_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, name:currentBackup},"appdeletebackup",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("backupdeleted") ?>');
				getBackups();
				$('#service_backups_master').hide();
				$('#service_backups').show();
				$('#service_delete_backup_modal').modal('hide');
			}
			loadButton('#service_delete_backup_modal_button',false);
		});
	}

	function createBackup(){
		name = $('#service_backup_create_modal_name').val();
		if(name == ''){
			toastr["error"]('Bitte ein Namen angeben.');
            return;
		}
		loadButton('#service_backup_create_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, name:name},"appcreatebackup",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("backupcreating") ?>');
				$('#loading').show();
				$('#main').hide();
				getServiceData();
				getBackups();
				$('#service_backup_create_modal').modal('hide');
			}
			loadButton('#service_backup_create_modal_button',false);
		});
	}

	function saveAccess(){
		var accessRights = [];
		$('#service_access_edit_right_checkboxes input:checked').each(function() {
			accessRights.push($(this).attr('id'));
		});
		loadButton('#service_access_edit_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: productId, id:serviceId, accessId:activeAccess, accessrights:accessRights },"saveAccessRequest",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("<?php echo $lang->getString("nsharesaved") ?>.");
				$('#service_access_user_info_modal').modal('hide');
				getAccessList();
			}
			loadButton('#service_access_edit_modal_button',false);
		});
	}


	function stopService(){
		loadButton('#service_stop_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appstop",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("servicestopped") ?>");
				$('#service_stop_modal').modal('hide');		
			}
			loadButton('#service_stop_modal_button',false);
		});
	}

	function getWebsocketInfo(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appwebsocket",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				if(token == ''){				
					token = respond.response.token;
					socket = respond.response.socket;
					try{
						webSocket = new WebSocket(socket);
					}catch (e) {
						console.log(e);
					}
					webSocket.onerror=function(event){
						console.log(event);
					};
					webSocket.onopen = function (event) {
						webSocket.send(JSON.stringify({"event": "auth",'args': [token]}));
					};
					webSocket.onmessage = function (event) {
						handleWebsocketMessage(event);
					};
				} else {
					token = respond.response.token;
					webSocket.send(JSON.stringify({"event": "auth",'args': [token]}));
				}
			}
		});
	}
	function sendCommand(command){
		if(command != ''){
			webSocket.send(JSON.stringify({"event": "send command",'args': [command]}));
		}
	}

	function handleWebsocketMessage(event)
	{
		data = JSON.parse(event.data);
		type = data.event;
		switch (type) {
			case "stats":
				args = JSON.parse(data.args[0]);
				cpu = args.cpu_absolute.toFixed(2);
				ram = (args.memory_bytes / 1074000000).toFixed(1);
				ramTotal = (args.memory_limit_bytes / 1074000000).toFixed(1);
				$('#service_stats_cpu_data').html(cpu + "%");
				$('#service_stats_ram_data').html(ram + ' / ' + ramTotal + "GiB");
				date = new Date().getTime();
				serviceStatistikCPU.push({
					y: cpu, 
					x: date
				});
				if(serviceStatistikCPU.length > 1000) {
					serviceStatistikCPU = [];
				}
				serviceChartCPU.updateSeries([{
				data: serviceStatistikCPU
				}])
				serviceStatistikRAM.push({
					y: ram, 
					x: date
				});
				if(serviceStatistikRAM.length > 1000) {
					serviceStatistikRAM = [];
				}
				serviceChartRAM.updateSeries([{
				data: serviceStatistikRAM
				}])
				break;

			case 'token expiring':
				getWebsocketInfo();
				break;
			case 'auth success':
				webSocket.send(JSON.stringify({"event": "send logs",'args': []}));
				break;
		
			default:			
				
				break;
		}
	}

	function renewService(){
		days = $('#service_renew_days').val();
        if(days == ''){
			toastr["error"]('<?php echo $lang->getString("specifydays") ?>');
            return;
        }
		loadButton('#service_renew_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, days:days},"renewapp",function(respond){
            if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("successfulrenew") ?>');
				$('#loading').show();
				$('#main').hide();
				getServiceData();
                $('#service_renew_modal').modal('hide');
			}
			loadButton('#service_renew_button', false);
        });
	}

	function getIpAdresses(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appgetnetwork",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_ip_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					if(element.isDefault){
						tmpStatus = '<span class="label label-xl label-success label-pill label-inline mr-2"><?php echo $lang->getString("primary") ?></span>';
					} else {
						tmpStatus = '';
					}
                    $('#service_ip_table').DataTable().row.add( [
                        element.ip,
						element.port,
						tmpStatus
                    ] ).draw( false );
				});
				$('#service_ip').hide();
				$('#service_ip_main').show();
			}
		});
	}

	function getVariables(){
		$('#service_variables').show();
		$('#service_variables_main').hide();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appgetvariables",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#accordionExample7').html(respond.response.variables);
			}
			$('#service_variables').hide();
			$('#service_variables_main').show();
		});
	}

	function saveVariable(id){
		val = $('#service_variable_' + id).val();
		if(val == ""){
			toastr["error"]("<?php echo $lang->getString("specfiyvalue") ?>");
			return;
		}
		loadButton('#service_variable_button_' + id);
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, val:val, variable:id},"appsetvariables",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("variablesaved") ?>');
				getVariables();
			}
			loadButton('#service_variable_button_' + id, false);
		});
	}

	function openSFTP(){
		loadButton('#service_load_sftp');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appgetsftp",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				window.open(respond.response.string,"_self");
				$('#service_sftp_data_modal_username').html(respond.response.username);
				$('#service_sftp_data_modal_password').html(respond.response.password);
				$('#service_sftp_data_modal_host').html(respond.response.host);
				$('#service_sftp_data_modal_string').html(respond.response.string);
				$('#service_sftp_data_modal').modal('show');
			}
			loadButton('#service_load_sftp', false);
		});
	}

	function getPackets(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"appgetpackets",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$("#service_upgrade_packets").empty();
				respond.response.forEach(element => {
					if(packet == element.id){
						$('#service_upgrade_packets').append(new Option(element.data, element.id,true,true));
					} else {
						$('#service_upgrade_packets').append(new Option(element.data, element.id));
					}
				});
				upgradeService(1);
				$('#service_upgrade_modal').modal('show');
				loadButton('#button_upgrade_service',false);
			}
		});
	}

	function openServiceUpgradeModal(){
		loadButton('#button_upgrade_service');
		getPackets();
	}
	function upgradeService(calculate){
		if(calculate == 0){
			if(!$('#service_upgrade_restart').is(":checked")){
                toastr["error"]('<?php echo $lang->getString("nplsallowrestart") ?>');
                return;
			}
		}
		loadButton('#service_upgrade_modal_button');
		$('#service_upgrade_load').show();
		$('#service_upgrade_calc_1').hide();
		packetid = $('#service_upgrade_packets option:selected').val();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId,packet:packetid,calculate:calculate},"appupgrade",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
			} else {
				loadButton('#service_upgrade_modal_button',false);
				if(calculate == 0){
					$('#service_upgrade_modal').modal('hide');
					toastr["success"]("<?php echo $lang->getString("upgradesuccessful") ?>");
					return;
				}
				if(packet == packetid){
					$('#service_upgrade_modal_button').prop('disabled', true);
				} else {
					$('#service_upgrade_modal_button').prop('disabled', false);
				}
				if(respond.response.change){
					$('#upgrade_credit_after_text').html("<?php echo $lang->getString("onetimecredit") ?>:");
				} else {
					$('#upgrade_credit_after_text').html("<?php echo $lang->getString("onetimecosts") ?>:");
				}
				$('#upgrade_credit_after').html(respond.response.priceOne);
				$('#upgrade_credit_monthly_after').html(respond.response.priceMon);
				$('#upgrade_credit_left').html(respond.response.moneyAfter);
				$('#service_upgrade_calc_1').show();
				$('#service_upgrade_load').hide();
			}
		});
	}

	function openServiceRenewModal(){
		switchServiceDayCount(1);
		$('#service_renew_modal').modal('show');
	}

	function openAddCredit(){
		creditAddWindow = window.open('<?php echo $url; ?>credit/add');
		checkAddCredit();
	}

	function checkAddCredit(){
		if(creditAddWindow.closed){
            window.location.reload();
        } else {
            setTimeout(function() { checkAddCredit(); }, 1000);    
        }
	}

	function calculateServiceRenew(){
		days = $('#service_renew_days').val();
        if(days == ''){
            days = 0;
		}
		price_day = (price / 30);
		price_final = parseFloat((price_day * days).toPrecision(4));
		$('#service_renew_price').html(price_final.toFixed(2));
		credit_after = (credit - price_final).toFixed(2);

		if(credit_after >= 0){
			$('#service_credit_after').html((credit - price_final).toFixed(2));
			$('#service_credit_after').css("color", "");
			$('#service_renew_button').show();
			$('#service_add_credit_button').hide();
		} else {
			$('#service_credit_after').html((credit - price_final).toFixed(2));
			$('#service_credit_after').css("color", "red");
			<?php if($user->getCreditLimit() == 0){ ?>
			$('#service_renew_button').hide();
			$('#service_add_credit_button').show();
			<?php } else {?>
				$('#service_renew_button').show();
				$('#service_add_credit_button').hide();
			<?php }?>
		}
	}

	function switchServiceDayCount(id){
		$("#service_renew_3").removeClass();
        $("#service_renew_30").removeClass();
        $("#service_renew_60").removeClass();
        $("#service_renew_90").removeClass();
		$("#service_renew_in").removeClass();
		$('#service_renew_days').hide();
		switch (id) {
            case 1:
                $("#service_renew_3").addClass("active");
                $('#service_renew_days').val(3);
                break;
            case 2:
                $("#service_renew_30").addClass("active");
                $('#service_renew_days').val(30);
                break;
            case 3:
                $("#service_renew_60").addClass("active");
                $('#service_renew_days').val(60);
                break;
            case 4:
                $("#service_renew_90").addClass("active");
                $('#service_renew_days').val(90);
                break;
            case 5:
                $("#service_renew_in").addClass("active");
                $('#service_renew_days').show();
                break;
            default:
                break;
		}
		calculateServiceRenew();
	}


		
    var options = {
        series: [{
            name: "CPU",
            data: serviceStatistikCPU
        }],
        chart: {
            type: 'area',
            height: '125px',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            sparkline: {
                enabled: true
			},
			animations: {
				enabled: true,
				easing: 'area',
				dynamicAnimation: {
					speed: 1000
				}
			}
        },
        plotOptions: {},
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'solid',
            opacity: 1
        },
        stroke: {
            curve: 'smooth',
            show: true,
            width: 3,
            colors: ["#3699FF"]
        },
        xaxis: {
			type: 'datetime',
			range: 20000
        },
        yaxis: {
            labels: {
                show: false,
                style: {
                    colors: "#B5B5C3",
                    fontSize: '12px',
                    fontFamily: "Poppins"
                }
            }
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                fontFamily: "Poppins"
            },
            y: {
                formatter: function(val) {
                    return val
                }
            }
        },
        colors: ["#E1F0FF"],
        markers: {
            colors: ["#E1F0FF"],
            strokeColor: ["#3699FF"],
            strokeWidth: 3
        }
    };
    var serviceChartCPU = new ApexCharts(document.getElementById("service_stats_cpu"), options);
	serviceChartCPU.render();

    var options = {
        series: [{
            name: "RAM",
            data: serviceStatistikRAM
        }],
        chart: {
            type: 'area',
            height: '125px',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            sparkline: {
                enabled: true
			},
			animations: {
				enabled: true,
				easing: 'area',
				dynamicAnimation: {
					speed: 1000
				}
			}
        },
        plotOptions: {},
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'solid',
            opacity: 1
        },
        stroke: {
            curve: 'smooth',
            show: true,
            width: 3,
            colors: ["#3699FF"]
        },
        xaxis: {
			type: 'datetime',
			range: 20000
        },
        yaxis: {
            labels: {
                show: false,
                style: {
                    colors: "#B5B5C3",
                    fontSize: '12px',
                    fontFamily: "Poppins"
                }
            }
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                fontFamily: "Poppins"
            },
            y: {
                formatter: function(val) {
                    return val
                }
            }
        },
        colors: ["#E1F0FF"],
        markers: {
            colors: ["#E1F0FF"],
            strokeColor: ["#3699FF"],
            strokeWidth: 3
        }
    };
    var serviceChartRAM = new ApexCharts(document.getElementById("service_stats_ram"), options);
    serviceChartRAM.render();

	function getAccessList(){
		$('#access_list_master').hide();
		$('#access_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, productId: productId},"getAccesListService",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#access_list_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					buttons = '<button type=\"button\" id="access_display_info_button_' + element.id + '" class=\"btn btn-outline-primary btn-elevate btn-circle btn-icon\" onclick=\"openAccessInfo(\'' + element.id + '\')\" title=\"<?php echo $lang->getString("showinfo") ?>\"><i class=\"fas fa-eye\"></i></button>';
					buttons = buttons + '&nbsp;<button type=\"button\" id="access_delete_button_' + element.id + '" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openAccessDelete(\'' + element.id + '\')\" title=\"<?php echo $lang->getString("removeshare") ?>\"><i class=\"fas fa-trash\"></i></button>';
					switch (element.status) {
						case 0:
							statusBadge = '<span class="badge badge-success" style=""><?php echo $lang->getString("requestnotaccepted") ?></span>';
							break;
						case 2:
							statusBadge = '<span class="badge badge-danger" style=""><?php echo $lang->getString("requestno") ?></span>';
							break;
						default:
							statusBadge = '<span class="badge badge-success" style=""><?php echo $lang->getString("active") ?></span>';
							break;
					}
					if(element.status != 3){
						$('#access_list_table').DataTable().row.add( [
							element.name,
							statusBadge,
							buttons
						] ).draw( false );
					}
				});
				$('#access_list_master').show();
				$('#access_list').hide();
			}
		});
	}

	function createNewAccess(){
		inviteCode = $('#service_access_new_invite_code').val();
		if(inviteCode == ""){
			toastr["error"]("Bitte geben Sie einen Invite Code an.");
			return;
		}
		displayName = $('#service_access_new_display_name').val();
		if(displayName == ""){
			toastr["error"]("Bitte geben Sie einen Namen an.");
			return;
		}
		var accessRights = [];
		$('#service_access_new_right_checkboxes input:checked').each(function() {
			accessRights.push($(this).attr('id'));
		});
		loadButton('#service_access_new_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: productId, id:serviceId, invitecode:inviteCode, displayname:displayName, accessrights:accessRights },"createAccessRequest",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("Freigabe erfolgreich angelegt.");
				$('#service_access_new_modal').modal('hide');
				getAccessList();
				$('#service_access_new_invite_code').val('');
				$('#service_access_new_display_name').val('');
			}
			loadButton('#service_access_new_modal_button',false);
		});
	}

	function openAccessInfo(id){
		loadButton('#access_display_info_button_' + id,true, false);
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:id},"getAccesUserRights",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				activeAccess = id;
				htmlContent = '';
                respond.response.forEach( element => {
					if(element.checked == 1){
						htmlContent += '<label class="checkbox"><input type="checkbox" id="' + element.id + '" checked><span></span>' + element.name + '</label>';
					} else {
						htmlContent += '<label class="checkbox"><input type="checkbox" id="' + element.id + '"><span></span>' + element.name + '</label>';
					}
				});
				$("#service_access_edit_right_checkboxes").html(htmlContent);
				$('#service_access_user_info_modal').modal('show');
			}
			loadButton('#access_display_info_button_' + id,false);
		});
	}

	function openAccessDelete(id){
		currentAccess = id;
		$('#access_delete_modal').modal("show");
	}

	function openAccessNew(){
		$('#service_access_new_modal').modal('show');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: productId},"getAccessListRights",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				htmlContent = '';
                respond.response.forEach( element => {
					htmlContent += '<label class="checkbox"><input type="checkbox" id="' + element.id + '"><span></span>' + element.name + '</label>';
				});
				$("#service_access_new_right_checkboxes").html(htmlContent);
				$('#service_access_new_modal_master').show();
				$('#service_access_new_right_load').hide();
			}
		});
	}
	function deleteAccess(){
		loadButton('#access_delete_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:currentAccess},"accessDelete",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nshareremoved") ?>');
				getAccessList();
				$('#access_delete_modal').modal('hide');
			}
			loadButton('#access_delete_modal_button',false);
		});
	}
    
	$('#service_backup_table').DataTable({
		"responsive": true,
		"paging": true,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_ip_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
		}
	});

	$('#access_list_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});

	$('#access_user_info_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	setInterval(function() { countDown(); }, 1000);
	setInterval(function() { getServiceData(); }, 5000);
	getServiceData();
	getIpAdresses();

	<?php
	if(!$access){
	?>
	getAccessList();
	<?php
	}
	?>
</script>
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

$vserverproduktinfos = requestBackend($config, ["id" => 1], "getproduktinfos", $user->getLang());
$vserverpacketinfo = requestBackend($config, [], "getpackets", $user->getLang());
$vserverpacketinfon = [];

foreach ($vserverpacketinfo["response"] as $packet) {
    $vserverpacketinfon[$packet["id"]] = $packet;
}

if(isset($_GET["noVNC"])) {
	require_once 'novnc.php';
	die();
}

$noVNCUrl = $url . 'vserver/details/' . $serviceId . '?noVNC=1&autoconnect=1&host=' . $config->getconfigvalue('noVNCSocket')["url"] . '&port=' . $config->getconfigvalue('noVNCSocket')["port"];

$websocketSecure = $config->getconfigvalue('noVNCSocket')["secure"];

if($websocketSecure == 1){
	$noVNCUrl .= '&encrypt=1';
}


echo getheader($config,$lang->getString("vserver") . " - ProHosting24", $lang);

echo getnormalbody($config, $lang->getString("vserver"), $user, $lang);

?>


	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<?php echo getloadinghtml("loading"); ?>
			<div class="container" id="main" style="display:none;">
				<!--begin::Row-->
				<div class="row">
					<div class="col-xl-6">
						<!--begin::Stats Widget 4-->
						<div class="card card-custom card-stretch gutter-b">
							<!--begin::Header-->
							<div class="card-header border-0 pt-6">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php echo $lang->getString("CPU") ?></span>
									<span class="text-muted mt-3 font-weight-bold font-size-lg"><text id="service_info_core">0</text> <?php echo $lang->getString("cpucores") ?></span>
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
									<span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php echo $lang->getString("RAM") ?></span>
									<span class="text-muted mt-3 font-weight-bold font-size-lg"><text id="service_info_ram">0</text> <?php echo $lang->getString("gbram") ?></span>
								</h3>
								<div class="card-toolbar">
									<div id="service_stats_ram_data" class="font-weight-bolder font-size-h1 text-dark-75">0/0 <?php echo $lang->getString("GiB") ?></div>
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
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("kvmserverid") ?>:<br><span id="service_info_id" class="text-dark-75 font-size-lg">1993</span></span>
									</div>
									<?php
									if(!$access or isset($rights[11])){
									?>
									<div class="col-xl-6 bottom15">
										<div class="text-dark-75 font-size-h5"><?php echo $lang->getString("firstpassword") ?>:<br>
											<div id="service_info_pw_master" class="text-dark-75 font-size-lg">
												<a id="service_info_pw" href="javascript:getServicePassword()" >
													<span id="serive_load_pw" class="badge badge-success"><?php echo $lang->getString("show") ?></span>
												</a>
												<?php
													if(!$access or isset($rights[12])){
												?>
												<a href="javascript:openServicePasswordReset()">
													<span id="service_info_resetpw" class="badge badge-success" style="display:none;"><?php echo $lang->getString("resetpassword") ?></span>
												</a>
												<?php
												}
												?>
											</div>
										</div>
									</div>
									<?php
									} else {
										?>
										<div class="col-xl-6 bottom15"></div>
										<?php
									}
									?>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("hostsystem") ?>:<br><span id="service_info_host" class="text-dark-75 font-size-lg">ph24-7</span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("backupslots") ?>:<br><span id="service_info_backup_slots" class="text-dark-75 font-size-lg">2</span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><text id="service_info_expire_text"><?php echo $lang->getString("serviceexpire") ?></text><br><span id="service_info_counter" class="text-dark-75 font-size-lg">44 Tage 2 Stunden 28 Minuten 50 Sekunden</span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("uptime") ?>:<br><span id="service_info_uptime" class="text-dark-75 font-size-lg">64 Tage 23 Stunden 50 Minuten 37 Sekunden</span></span>
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
										<a id="button_shutdown_service" onClick="openServiceShutdown()" class="btn btn-outline-warning font-weight-bold col"><?php echo $lang->getString("shutdown") ?></a>
									</div>
									<div class="col-6 bottom15">
										<a id="button_stop_service" onClick="openServiceStop()" class="btn btn-outline-danger font-weight-bold col"><?php echo $lang->getString("stop") ?></a>
									</div>
									<div class="col-6 bottom15">
										<a id="button_reset_service" onClick="openServiceReset()" class="btn btn-outline-danger font-weight-bold col"><?php echo $lang->getString("resetvps") ?></a>
									</div>
									<div class="col-6 bottom15">
										<a id="button_exec_service" onClick="openServiceExec()" class="btn btn-outline-danger font-weight-bold col"><?php echo $lang->getString("execcommand") ?></a>
									</div>
								</div>
								<div class="row">
									<div class="col bottom15">
										<a id="button_noVNC_service" onClick="openVNCConsole()" class="btn btn-outline-primary font-weight-bold col"><?php echo $lang->getString("vservernovnc") ?></a>
									</div>
									<div class="col bottom15">
										<a id="button_reinstall_service" onClick="openServiceReinstall()" class="btn btn-outline-danger font-weight-bold col"><?php echo $lang->getString("reinstall") ?></a>
									</div>
								</div>
								<div class="row">
									<div class="col bottom15">
										<a id="button_renew_service" onClick="openServiceRenewModal()" class="btn btn-outline-primary font-weight-bold col"><?php echo $lang->getString("serviceextend") ?></a>
									</div>
									<div class="col bottom15">
										<a id="button_upgrade_service" onClick="openServiceUpgradeModal()" class="btn btn-outline-primary font-weight-bold col"><?php echo $lang->getString("serviceupgrade") ?></a>
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
									<li class="nav-item">
								    	<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1" onClick="getIpAdresses()">
								            <span class="nav-icon"><i class="flaticon-map"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("vserveripadresses") ?></span>
								        </a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2" onClick="getBackups()">
								            <span class="nav-icon"><i class="flaticon-folder-3"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("backup") ?></span>
								        </a>
								    </li>
								    <li class="nav-item dropdown">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3" onClick="getLogs()">
								            <span class="nav-icon"><i class="flaticon-list-2"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("actionlog") ?></span>
								        </a>
								    </li>
									<?php
									if(!$access){
									?>
									<li class="nav-item dropdown">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_7" onClick="getAccessList()">
								            <span class="nav-icon"><i class="flaticon-list-2"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("shares") ?></span>
								        </a>
								    </li>
									<?php
									}
									if(!$access){
									?>
									<li class="nav-item dropdown">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_6" onClick="getKeys()">
								            <span class="nav-icon"><i class="flaticon-lock"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("sshkey") ?></span>
								        </a>
								    </li>
									<?php
									}
									?>
									<li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5" onClick="getStatisticData('hour','AVERAGE')">
								            <span class="nav-icon"><i class="flaticon2-analytics-2"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("longtermstatistics") ?></span>
								        </a>
								    </li>
									<?php
									if(!$access){
									?>
									<li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_10" onClick="getHardwareInfo()">
								            <span class="nav-icon"><i class="flaticon2-layers-1"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("hardwareiso") ?></span>
								        </a>
								    </li>
									<?php
									}
									?>
									<li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_12" onClick="getExecList()">
								            <span class="nav-icon"><i class="flaticon-list-2"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("execlist") ?></span>
								        </a>
								    </li>
									<?php
										if(!$access or isset($rights[30])){
										?>
									<li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_13" onClick="getCronList()">
								            <span class="nav-icon"><i class="flaticon-list-2"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("cronjoblist") ?></span>
								        </a>
								    </li>
									<?php
										}
										?>
								</ul>
                        	</div>
							<div class="tab-content mt-5 col" id="myTabContent">
								<div class="tab-pane fade" id="kt_tab_pane_10" role="tabpanel" aria-labelledby="kt_tab_pane_10">
									<?php echo getloadinghtml("service_hardware"); ?>	
									<div id="service_hardware_main" class="card-body" style="display:none">
										<h5><?php echo $lang->getString("vmdisks") ?>:</h5>
										<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#service_add_disk_modal"><?php echo $lang->getString("mountiso") ?></button>
										<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#service_boot_modal"><?php echo $lang->getString("bootorder") ?></button>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_hardware_disk_table">
											<thead>
												<tr>
													<th><?php echo $lang->getString("id") ?></th>
													<th><?php echo $lang->getString("name") ?></th>
													<th><?php echo $lang->getString("storage") ?></th>
													<th><?php echo $lang->getString("size") ?></th>
													<th><?php echo $lang->getString("action") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
										<h5><?php echo $lang->getString("vmharddisks") ?>:</h5>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_hardware_harddisk_table">
											<thead>
												<tr>
													<th><?php echo $lang->getString("id") ?></th>
													<th><?php echo $lang->getString("name") ?></th>
													<th><?php echo $lang->getString("storage") ?></th>
													<th><?php echo $lang->getString("size") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
										<h5><?php echo $lang->getString("vmnetworkcard") ?>:</h5>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_hardware_network_table">
											<thead>
												<tr>
													<th><?php echo $lang->getString("type") ?></th>
													<th><?php echo $lang->getString("mac") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
									<?php echo getloadinghtml("service_ip"); ?>	
									<div id="service_ip_main" class="card-body table-responsive" style="display:none">
										<?php
										if(!$access){
										?>
										<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#service_add_ip_modal"><?php echo $lang->getString("addip") ?></button>
										<?php
										}
										if(!$access or isset($rights[9])){
										?>
										<button class="btn btn-outline-primary" type="button" data-toggle="modal" onClick="openTrafficDisplay()"><?php echo $lang->getString("displaytraffic") ?></button>
										<?php
										}
										?>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_ip_table">
											<thead>
												<tr>
													<th><?php echo $lang->getString("ip") ?></th>
													<th><?php echo $lang->getString("gateway") ?></th>
													<th><?php echo $lang->getString("netmask") ?></th>
													<th><?php echo $lang->getString("rdns") ?></th>
													<th><?php echo $lang->getString("actions") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
									<?php echo getloadinghtml("service_backups"); ?>	
									<div id="service_backups_master" style="display:none">
									<?php
									if(!$access or isset($rights[5])){
									?>
										<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#service_backup_create_modal"><?php echo $lang->getString("createbackup") ?></button>
										<?php
									}
									?>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_backups_table">
											<thead>
												<tr>
													<th><?php echo $lang->getString("name") ?></th>
													<th><?php echo $lang->getString("actions") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
									<?php echo getloadinghtml("service_log"); ?>
									<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_log_table" style="display:none">
										<thead>
											<tr>
												<th>#</th>
												<th><?php echo $lang->getString("action") ?></th>
												<th><?php echo $lang->getString("date") ?></th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
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
								<div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
									<?php echo getloadinghtml("service_statistic"); ?>	
									<div id="service_statistic_main" style="display:none;">
										<h5><?php echo $lang->getString("settings") ?>:</h5>
										<div class="row">
											<div class="col-lg-6 bottom10">
												<p> <?php echo $lang->getString("displaysettings") ?></p>
												<div class="btn-group" role="group">
													<button type="button" id="stats_settings_d" class="btn btn-success" onclick="changeStatisticBtn(0,'AVERAGE')"><?php echo $lang->getString("average") ?></button>
													<button type="button" id="stats_settings_m" class="btn btn-secondary" onclick="changeStatisticBtn(0,'MAX')"><?php echo $lang->getString("maximum") ?></button>
												</div>
											</div>
											<div class="col-lg-6 bottom10">
												<p> <?php echo $lang->getString("timeperiod") ?></p>
												<div class="btn-group" role="group">
													<button type="button" id="stats_settings_hour" class="btn btn-success" onclick="changeStatisticBtn('hour',0)"><?php echo $lang->getString("hour") ?></button>
													<button type="button" id="stats_settings_day" class="btn btn-secondary" onclick="changeStatisticBtn('day',0)"><?php echo $lang->getString("day") ?></button>
													<button type="button" id="stats_settings_week" class="btn btn-secondary" onclick="changeStatisticBtn('week',0)"><?php echo $lang->getString("week") ?></button>
													<button type="button" id="stats_settings_month" class="btn btn-secondary" onclick="changeStatisticBtn('month',0)"><?php echo $lang->getString("month") ?></button>
													<button type="button" id="stats_settings_year" class="btn btn-secondary" onclick="changeStatisticBtn('year',0)"><?php echo $lang->getString("year") ?></button>
												</div>
											</div>
											<div class="col-lg-12">
												<!--begin::Card-->
												<div class="card card-custom gutter-b">
													<!--begin::Header-->
													<div class="card-header h-auto">
														<!--begin::Title-->
														<div class="card-title py-5">
															<h3 class="card-label"><?php echo $lang->getString("CPU") ?></h3>
														</div>
														<!--end::Title-->
													</div>
													<!--end::Header-->
													<div class="card-body">
														<!--begin::Chart-->
														<div id="service_statistic_cpu"></div>
														<!--end::Chart-->
													</div>
												</div>
												<!--end::Card-->
											</div>
											<div class="col-lg-12">
												<!--begin::Card-->
												<div class="card card-custom gutter-b">
													<div class="card-header">
														<div class="card-title">
															<h3 class="card-label"><?php echo $lang->getString("RAM") ?></h3>
														</div>
													</div>
													<div class="card-body">
														<!--begin::Chart-->
														<div id="service_statistic_ram"></div>
														<!--end::Chart-->
													</div>
												</div>
												<!--end::Card-->
											</div>
											<div class="col-lg-12">
												<!--begin::Card-->
												<div class="card card-custom gutter-b">
													<div class="card-header">
														<div class="card-title">
															<h3 class="card-label"><?php echo $lang->getString("diskio") ?></h3>
														</div>
													</div>
													<div class="card-body">
														<!--begin::Chart-->
														<div id="service_statistic_disk"></div>
														<!--end::Chart-->
													</div>
												</div>
												<!--end::Card-->
											</div>
											<div class="col-lg-12">
												<!--begin::Card-->
												<div class="card card-custom gutter-b">
													<div class="card-header">
														<div class="card-title">
															<h3 class="card-label"><?php echo $lang->getString("networkio") ?></h3>
														</div>
													</div>
													<div class="card-body">
														<!--begin::Chart-->
														<div id="service_statistic_network"></div>
														<!--end::Chart-->
													</div>
												</div>
												<!--end::Card-->
											</div>
										</div>
									</div>								
								</div>
								<div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel" aria-labelledby="kt_tab_pane_6">
									<?php echo getloadinghtml("service_keys"); ?>
									<div id="service_keys_master" class="card-body" style="display:none">
										<button type="button" class="btn btn-outline-primary" onClick="openKeyAdd()"><?php echo $lang->getString("assignkey") ?></button>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_keys_table">
											<thead>
												<tr>
													<th>#</th>
													<th><?php echo $lang->getString("keyid") ?></th>
													<th><?php echo $lang->getString("date") ?></th>
													<th><?php echo $lang->getString("action") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="kt_tab_pane_12" role="tabpanel" aria-labelledby="kt_tab_pane_12">
									<?php echo getloadinghtml("service_exec_list"); ?>
									<div id="service_exec_list_master" class="card-body" style="display:none">
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_exec_list_table">
											<thead>
												<tr>
													<th><?php echo $lang->getString("command") ?></th>
													<th><?php echo $lang->getString("pid") ?></th>
													<th><?php echo $lang->getString("date") ?></th>
													<th><?php echo $lang->getString("action") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="kt_tab_pane_13" role="tabpanel" aria-labelledby="kt_tab_pane_13">
									<?php echo getloadinghtml("service_cron_list"); ?>
									<div id="service_cron_list_master" class="card-body" style="display:none">
										<button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#service_cron_create_modal"><?php echo $lang->getString("createcron") ?></button>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_cron_list_table">
											<thead>
												<tr>
													<th><?php echo $lang->getString("name") ?></th>
													<th><?php echo $lang->getString("cron") ?></th>
													<th><?php echo $lang->getString("nextexec") ?></th>
													<th><?php echo $lang->getString("lastexec") ?></th>
													<th><?php echo $lang->getString("date") ?></th>
													<th><?php echo $lang->getString("action") ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
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
                    <p style="margin-bottom:0;margin-top:1rem;"><?php echo $lang->getString("yourcurrentcredit") ?>: <?php echo round($user->getGuthaben(), 2); ?>€</p>
                    <p><?php echo $lang->getString("creditafterextend") ?>: <text id="service_credit_after">0</text>€</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-primary" id="service_renew_modal_button_autoremove_activate" onclick="openAutoRenew()"><?php echo $lang->getString("setupautoextend") ?></button>
					<button type="button" class="btn btn-primary" id="service_renew_modal_button_autoremove_remove" onclick="removeAutoRenew()"><?php echo $lang->getString("removeautoextend") ?></button>
					<button type="button" class="btn btn-primary" id="service_add_credit_button" onclick="openAddCredit()"><?php echo $lang->getString("addcredit") ?></button>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_start_modal_button" onclick="startService()"><?php echo $lang->getString("start") ?></button>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_stop_modal_button" onclick="stopService()"><?php echo $lang->getString("stop") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_reset_modal" tabindex="-1" role="dialog" aria-labelledby="service_reset_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_reset_modalLabel"><?php echo $lang->getString("serviceresetheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("serviceresetwarning") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_reset_modal_button" onclick="resetService()"><?php echo $lang->getString("resetvps") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_exec_modal" tabindex="-1" role="dialog" aria-labelledby="service_exec_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_exec_modalLabel"><?php echo $lang->getString("serviceexecheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo $lang->getString("serviceexecwarning") ?>
					<input type="text" class="form-control" id="service_exec_modal_command">
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_exec_modal_button" onclick="serviceExecCommand()"><?php echo $lang->getString("execcommand") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_exec_info_modal" tabindex="-1" role="dialog" aria-labelledby="service_exec_info_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_exec_info_modalLabel"><?php echo $lang->getString("serviceexecinfoheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo getloadinghtml("service_exec_info_modal_loading"); ?>
					<div id="service_exec_info_master">
						<h4><?php echo $lang->getString("exitcode") ?>: <text id="service_exec_info_exitcode_modal"></text></h4>

						<h4><?php echo $lang->getString("output") ?>:</h4>
						<textarea class="form-control" id="service_exec_info_output_modal" rows="10" disabled></textarea>
					</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_cron_log_modal" tabindex="-1" role="dialog" aria-labelledby="service_cron_log_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_cron_log_modalLabel"><?php echo $lang->getString("servicecronmodalheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo getloadinghtml("service_cron_log_modal_loading"); ?>
					<div id="service_cron_log_master">
						<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="service_cron_log_table">
							<thead>
								<tr>
									<th><?php echo $lang->getString("id") ?></th>
									<th><?php echo $lang->getString("log") ?></th>
									<th><?php echo $lang->getString("date") ?></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_add_ip_modal" tabindex="-1" role="dialog" aria-labelledby="service_add_ip_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_add_ip_modalLabel"><?php echo $lang->getString("addip") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<select class="form-control" id="service_ip_add_type" onchange="updateIpSelect()">
                        <option value="4"><?php echo $lang->getString("newipv4") ?></option>
                    </select>
                    <br>
                    <div id="service_add_ip_info" style="display:none">
					<?php echo $lang->getString("addipv4t") ?>:<br>
					<?php echo $lang->getString("onetime") ?>: <text id="service_add_ip_ipv4_cost_one">10</text> €<br>
					<?php echo $lang->getString("morecostafterupgrade") ?>:<br>
                        <text id="service_add_ip_ipv4_cost">100</text> €
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_add_ip_modal_button" onclick="addIp()"><?php echo $lang->getString("add") ?></button>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_shutdown_modal_button" onclick="shutdownService()"><?php echo $lang->getString("shutdown") ?></button>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="service_password_reset_modal" tabindex="-1" role="dialog" aria-labelledby="service_password_reset_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_password_reset_modalLabel"><?php echo $lang->getString("resetpassword") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("resetpasswordt") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_password_reset_modal_button" onclick="resetServicePassword()"><?php echo $lang->getString("reset") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_delete_key_modal" tabindex="-1" role="dialog" aria-labelledby="service_delete_key_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_delete_key_modalLabel"><?php echo $lang->getString("keydelete") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				<?php echo $lang->getString("keydeletet") ?>
				<?php echo $lang->getString("keydeletet2") ?>
					<label class="checkbox">
						<input type="checkbox" id="service_delete_key_modal_confirm">
						<span></span>
						&nbsp;<?php echo $lang->getString("attentionrestart") ?>
					</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_delete_key_modal_button" onclick="deleteKey()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="setting_key_display_modal" tabindex="-1" role="dialog" aria-labelledby="setting_key_display_modalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="setting_key_display_modalLabel"><?php echo $lang->getString("showkeynormal") ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<text id="setting_key_display_modal_key" style="word-break: break-all;"></text>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="setting_key_create_modal" tabindex="-1" role="dialog" aria-labelledby="setting_key_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setting_key_create_modalLabel"><?php echo $lang->getString("assignkey") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo getloadinghtml("loading_setting_key_create_list"); ?>
					<div id="setting_key_create_modal_master" style="display:none;">
						<label ><?php echo $lang->getString("selectkey") ?>:</label>
                        <select class="form-control" id="setting_key_create_keys">
                        </select>
						<br>
						<label class="checkbox">
							<input type="checkbox" id="setting_key_create_keys_confirm">
							<span></span>
							&nbsp;<?php echo $lang->getString("attentionrestart") ?>
						</label>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="setting_key_create_modal_button" onclick="addKey()"><?php echo $lang->getString("add") ?></button>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_delete_backup_modal_button" onclick="deleteBackup()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_cron_delete_modal" tabindex="-1" role="dialog" aria-labelledby="service_cron_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_cron_delete_modalLabel"><?php echo $lang->getString("crondeletemodalheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("crondeletemodalinfo") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_cron_delete_modal_button" onclick="deleteCron()"><?php echo $lang->getString("delete") ?></button>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="access_delete_modal_button" onclick="deleteAccess()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_reset_rnds_modal" tabindex="-1" role="dialog" aria-labelledby="service_reset_rnds_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_reset_rnds_modalLabel"><?php echo $lang->getString("rdnsreset") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("rdnsresett") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_reset_rnds_modal_button" onclick="resetRNDS()"><?php echo $lang->getString("reset") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_create_ipv6_modal" tabindex="-1" role="dialog" aria-labelledby="service_create_ipv6_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_create_ipv6_modalLabel"><?php echo $lang->getString("ipv6create") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="row">
						<div class="col-6">
						<input type="text" class="form-control" id="service_create_ipv6_left" disabled>
						</div>
						<div class="col-6">
						<input type="text" class="form-control" id="service_create_ipv6_right" placeholder="0:0:0:0">
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_create_ipv6_modal_button" onclick="createIpv6()"><?php echo $lang->getString("create") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_edit_rnds_modal" tabindex="-1" role="dialog" aria-labelledby="service_edit_rnds_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_edit_rnds_modalLabel"><?php echo $lang->getString("rdnsfromip") ?>: <text id="service_edit_rnds_header_modal">1.1.1.1</text> <?php echo $lang->getString("edit") ?>.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("rdns") ?>:</p>
                    <input type="text" class="form-control" id="vserver_rdns_edit" placeholder="RDNS">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_edit_rnds_modal_button" onclick="setRNDS()"><?php echo $lang->getString("save") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_restore_backup_modal" tabindex="-1" role="dialog" aria-labelledby="service_restore_backup_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_restore_backup_modalLabel"><?php echo $lang->getString("backuprestore") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("backuprestoret") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_restore_backup_modal_button" onclick="restoreBackup()"><?php echo $lang->getString("restore") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_backup_create_modal" tabindex="-1" role="dialog" aria-labelledby="service_backup_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_backup_create_modalLabel"><?php echo $lang->getString("backupvservercreate") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("backupvservercreatet") ?></p>
                    <p><?php echo $lang->getString("backupvservercreatet2") ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_backup_create_modal_button" onclick="createBackup()"><?php echo $lang->getString("create") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_cron_create_modal" tabindex="-1" role="dialog" aria-labelledby="service_cron_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_cron_create_modalLabel"><?php echo $lang->getString("servicecroncreateheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="container">
						<div class="row">
							<div class="col">
								<p><?php echo $lang->getString("croncreateinfo") ?></p>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm">
								<p><?php echo $lang->getString("name") ?>:</p>
								<input type="text" class="form-control" id="service_cron_create_modal_name" placeholder="<?php echo $lang->getString("name") ?>">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("action") ?>:</p>
								<select class="form-control" id="service_cron_create_modal_action" onChange="changeCronCreateForm()">
									<option value="start"><?php echo $lang->getString("start") ?></option>
									<option value="stop"><?php echo $lang->getString("stop") ?></option>
									<option value="reset"><?php echo $lang->getString("reset") ?></option>
									<option value="shutdown"><?php echo $lang->getString("shutdown") ?></option>
									<option value="backup"><?php echo $lang->getString("backup") ?></option>
									<option value="command"><?php echo $lang->getString("execcommand") ?></option>
								</select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm">
								<p><?php echo $lang->getString("cronminute") ?>:</p>
								<input type="text" class="form-control" id="service_cron_create_modal_minute" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("cronhour") ?>:</p>
								<input type="text" class="form-control" id="service_cron_create_modal_hour" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("crondaymonth") ?>:</p>
								<input type="text" class="form-control" id="service_cron_create_modal_day_month" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("cronmonth") ?>:</p>
								<input type="text" class="form-control" id="service_cron_create_modal_month" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("crondayweek") ?>:</p>
								<input type="text" class="form-control" id="service_cron_create_modal_day_week" placeholder="*">
							</div>
						</div>
						<br>
						<div class="row" id="service_cron_create_modal_special_master" style="display:none">
							<div class="col-sm">
								<p><?php echo $lang->getString("command") ?>:</p>
								<input type="text" class="form-control" id="service_cron_create_modal_command">
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_cron_create_modal_button" onclick="createCron()"><?php echo $lang->getString("create") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_cron_edit_modal" tabindex="-1" role="dialog" aria-labelledby="service_cron_edit_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_cron_edit_modalLabel"><?php echo $lang->getString("servicecroneditheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="container">
						<div class="row">
							<div class="col">
								<p><?php echo $lang->getString("croncreateinfo") ?></p>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm">
								<p><?php echo $lang->getString("name") ?>:</p>
								<input type="text" class="form-control" id="service_cron_edit_modal_name" placeholder="<?php echo $lang->getString("name") ?>">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("action") ?>:</p>
								<select class="form-control" id="service_cron_edit_modal_action" onChange="changeCronEditForm()">
									<option value="start"><?php echo $lang->getString("start") ?></option>
									<option value="stop"><?php echo $lang->getString("stop") ?></option>
									<option value="reset"><?php echo $lang->getString("reset") ?></option>
									<option value="shutdown"><?php echo $lang->getString("shutdown") ?></option>
									<option value="backup"><?php echo $lang->getString("backup") ?></option>
									<option value="fstrim"><?php echo $lang->getString("fstrim") ?></option>
									<option value="command"><?php echo $lang->getString("execcommand") ?></option>
								</select>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm">
								<p><?php echo $lang->getString("cronminute") ?>:</p>
								<input type="text" class="form-control" id="service_cron_edit_modal_minute" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("cronhour") ?>:</p>
								<input type="text" class="form-control" id="service_cron_edit_modal_hour" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("crondaymonth") ?>:</p>
								<input type="text" class="form-control" id="service_cron_edit_modal_day_month" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("cronmonth") ?>:</p>
								<input type="text" class="form-control" id="service_cron_edit_modal_month" placeholder="*">
							</div>
							<div class="col-sm">
								<p><?php echo $lang->getString("crondayweek") ?>:</p>
								<input type="text" class="form-control" id="service_cron_edit_modal_day_week" placeholder="*">
							</div>
						</div>
						<br>
						<div class="row" id="service_cron_edit_modal_special_master" style="display:none">
							<div class="col-sm">
								<p><?php echo $lang->getString("command") ?>:</p>
								<input type="text" class="form-control" id="service_cron_edit_modal_command">
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_cron_edit_modal_button" onclick="editCron()"><?php echo $lang->getString("save") ?></button>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_auto_renew_modal_button" onclick="activateAutoRenew()"><?php echo $lang->getString("activate") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_ip_traffic_modal" tabindex="-1" role="dialog" aria-labelledby="service_ip_traffic_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_ip_traffic_modalLabel"><?php echo $lang->getString("trafficfromvserver") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo getloadinghtml("service_ip_traffic_load"); ?>
					<div class="accordion" id="service_ip_traffic_display" style="display:none">

					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_upgrade_modal" tabindex="-1" role="dialog" aria-labelledby="service_upgrade_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_upgrade_modalLabel"><?php echo $lang->getString("serviceupdowngrade") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("upgradeyourvserver") ?>.</p>
                    <div id="upgrade_packet">
                        <div class="form-group">
                            <label for="vserver_upgrade_packets"><?php echo $lang->getString("packages") ?></label>
                            <select class="form-control" id="vserver_upgrade_packets" onchange="upgradeService(1)">
                            </select>
                        </div>
                    </div>
                    <div id="upgrade_normal">
                        <div class="form-group">
                            <label for="vserver_upgrade_cores"><?php echo $lang->getString("cores") ?></label>
                            <select class="form-control" id="vserver_upgrade_cores" onchange="upgradeService(1)">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vserver_upgrade_memory"><?php echo $lang->getString("memory") ?></label>
                            <select class="form-control" id="vserver_upgrade_memory" onchange="upgradeService(1)">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vserver_upgrade_disk"><?php echo $lang->getString("ssdstorage") ?></label>
                            <select class="form-control" id="vserver_upgrade_disk" onchange="upgradeService(1)">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vserver_upgrade_backup"><?php echo $lang->getString("backupslots") ?></label>
                            <select class="form-control" id="vserver_upgrade_backup" onchange="upgradeService(1)">
                            </select>
                        </div>
                    </div>
					<?php echo getloadinghtml("service_upgrade_load"); ?>
                    <div id="vserver_upgrade_calc_1">
                        <label class="kt-checkbox" id="vserver_upgrade_reinstall_master">
                            <input type="checkbox" id="vserver_upgrade_reinstall" /> <?php echo $lang->getString("vserverdowngradet") ?>
                            <span></span>
                        </label>
                        <label class="kt-checkbox" >
                            <input type="checkbox" id="vserver_upgrade_restart" /> <?php echo $lang->getString("attentionrestart") ?>
                            <span></span>
                        </label>
                        <p><text id="upgrade_credit_after_text"><?php echo $lang->getString("onetimecosts") ?>:</text> <text id="upgrade_credit_after">0</text>€</p>
                        <p><?php echo $lang->getString("costspermonth") ?>: <text id="upgrade_credit_monthly_after">0</text>€</p>
						<p><?php echo $lang->getString("creditafterupgrade") ?>: <text id="upgrade_credit_left">0</text>€</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_upgrade_modal_button" onclick="upgradeService(0)"><?php echo $lang->getString("upgrade") ?></button>
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
					<?php echo getloadinghtml("loading_serive_os_type"); ?>
					<div id="service_reinstall_modal_master" class="checkbox-list" style="display:none;">
						<label ><?php echo $lang->getString("vserverchooseos") ?>:</label>
                        <select class="form-control" id="service_reinstall_type">
                        </select>
                        <br>
						<label style="margin-top: 10px;" class="checkbox">
							<input type="checkbox" id="service_data_delete">
							<span></span>
							<?php echo $lang->getString("serverreinstallt") ?>
						</label>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_reinstall_modal_button" onclick="reinstallService()"><?php echo $lang->getString("installstart") ?></button>
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
						<label><?php echo $lang->getString("invitationcode") ?>:</label>
						<input type="text" class="form-control" id="service_access_new_invite_code" placeholder="123-456-789-101">
						<br>
                        <label><?php echo $lang->getString("displayname") ?>:</label>
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
					<button type="button" class="btn btn-danger" id="service_access_new_modal_button" onclick="createNewAccess()"><?php echo $lang->getString("invite") ?></button>
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
					<button type="button" class="btn btn-danger" id="service_access_edit_modal_button" onclick="saveAccess()"><?php echo $lang->getString("save") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="hardware_delete_disk_modal" tabindex="-1" role="dialog" aria-labelledby="hardware_delete_disk_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hardware_delete_disk_modalLabel"><?php echo $lang->getString("removeiso") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("removeisowarning") ?></p>
					<label class="checkbox">
						<input type="checkbox" id="hardware_delete_disk_modal_confirm">
						<span></span>
						&nbsp;<?php echo $lang->getString("attentionrestart") ?>
					</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="hardware_delete_disk_modal_button" onclick="diskDelete()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="service_add_disk_modal" tabindex="-1" role="dialog" aria-labelledby="service_add_disk_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_add_disk_modalLabel"><?php echo $lang->getString("mountiso") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="checkbox-list">
						<label ><?php echo $lang->getString("selectiso") ?>:</label>
                        <select class="form-control" id="service_add_disk_modal_list">
                        </select>
                        <br>
						<label style="margin-top: 10px;" class="checkbox">
							<input type="checkbox" id="service_add_disk_modal_confirm">
							<span></span>
							<?php echo $lang->getString("attentionrestart") ?>
						</label>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_add_disk_button" onclick="diskMount()"><?php echo $lang->getString("save") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="service_boot_modal" tabindex="-1" role="dialog" aria-labelledby="service_boot_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_boot_modalLabel"><?php echo $lang->getString("bootorder") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<div class="checkbox-list">
						<label ><?php echo $lang->getString("bootoption") ?> 1:</label>
                        <select class="form-control" id="service_boot_modal_1">
                        </select>
						<label ><?php echo $lang->getString("bootoption") ?> 2:</label>
						<select class="form-control" id="service_boot_modal_2">
                        </select>
						<label ><?php echo $lang->getString("bootoption") ?> 3:</label>
						<select class="form-control" id="service_boot_modal_3">
                        </select>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="service_boot_modal_button" onclick="saveBootOrder()"><?php echo $lang->getString("save") ?></button>
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

<?php
echo "
	array_core = " . json_encode($vserverproduktinfos["response"]["upgrades"]["cores"]) . ";
	array_memory = " . json_encode($vserverproduktinfos["response"]["upgrades"]["memory"]) . ";
	array_disk = " . json_encode($vserverproduktinfos["response"]["upgrades"]["disk"]) . ";
	array_ip = " . json_encode($vserverproduktinfos["response"]["upgrades"]["ip"]) . ";
	array_packet = " . json_encode($vserverpacketinfon) . ";";
	if($user->getSecret() != null){
		echo "var fa = true;";
	} else {
		echo "var fa = true;";
	}
?>
	var serviceId = <?php echo $serviceId; ?>;
	var price = 0;
	var endTime = 0;
	var uptime = 0;
	var nodeId = 0;
	var credit = <?php echo $user->getGuthaben(); ?>;
	var creditAddWindow = "";
	var status = "";
	var autoRenew = 0;

	var backupSlots = 0;
	var coreCount = 0;
	var ramCount = 0;
	var diskSpace = 0
	var ipCount = 0;
	var packet = 0;
	var ipData = [];
	var activeIP = "";
	var daysLeft = 0;
	var activeLeft = "";
	var currentKey = 0;
	var hourly = 0;

	var leftCredit = 0;

	var websocketUrl = "";
	var serviceStatistikCPU = [];
	var serviceStatistikRAM = [];

	var statisticDataCPU = [];
	var statisticDataRAM = [];
	var statisticDataRAMMax = [];
	var statisticDataDISKRead = [];
	var statisticDataDISKWrite = [];
	var statisticDataNETWORKIn = [];
	var statisticDataNETWORKOut = [];

	var productId = 1;

	var currentBackup = "";

	var currentTime = "hour";
	var currentState = "AVERAGE";

	var currentAccess = 0;

	var currentDisk = '';

	var activeAccess = 0;

	var activeCronJob = 0;
	var cronJobList = [];

	function getServiceData(){
        requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getvserverinfos",function(respond){
            if(respond.fail){
                toastr["error"](respond.error);
            } else {
				price = respond.response.price;
				endTime = respond.response.timeleft;
				uptime = respond.response.uptime;
				status = respond.response.status;
				nodeId = respond.response.nodeid;

				backupSlots = respond.response.backupslots;
				coreCount = respond.response.cores;
				ramCount = respond.response.memory / 1024;
				diskSpace = respond.response.disk;
				ipCount = respond.response.ip;
				packet = respond.response.packet;
				daysLeft = respond.response.daysleft;
				autoRenew = respond.response.autorenew;
				hourly = respond.response.hourly;
				name = respond.response.name;
				if(autoRenew == 0){
					$('#service_renew_modal_button_autoremove_activate').show();
					$('#service_renew_modal_button_autoremove_remove').hide();
				} else {
					$('#service_renew_modal_button_autoremove_activate').hide();
					$('#service_renew_modal_button_autoremove_remove').show();
				}
				$('#service_info_core').html(coreCount);
				$('#service_info_ram').html(ramCount);
				$('#service_info_disk').html(diskSpace);

				$('#service_info_id').html(serviceId);
				$('#service_info_host').html('ph24-' + nodeId);
				$('#service_info_backup_slots').html(backupSlots);
				$('#button_renew_service').show();
				$("#service_ribbon_master").removeClass();
				$('#service_ribbon_master').addClass("ribbon-target");
				if(respond.response.upgradeble == 0){
					$('#button_upgrade_service').hide();
				} else {
					$('#button_upgrade_service').show();
				}
				$('#button_start_service').hide();
				$('#button_stop_service').hide();
				$('#button_shutdown_service').hide();
				$('#button_noVNC_service').hide();
				$('#button_reinstall_service').hide();
				$('#button_reset_service').hide();
				$('#button_exec_service').hide();
				$('#service_info_resetpw').hide();
				$('#masterPageTitle').html("<?php echo $lang->getString("vserver"); ?> - " + name);
				countUpArray = [];
				$('#service_info_uptime').html('Offline');
				switch (status) {
					case 'running':
						$('#button_stop_service').show();
						$('#button_noVNC_service').show();
						$('#button_reinstall_service').show();
						$('#button_reset_service').show();
						if(respond.response.agent == 1){
							$('#button_exec_service').show();
							$('#button_shutdown_service').show();
							$('#service_info_resetpw').show();
						}
						$('#service_ribbon_master').html("<?php echo $lang->getString("online") ?>");
						$('#service_ribbon_master').addClass("bg-success");
						countUpArray = [["service_info_uptime",uptime]];
						break;
					case 'stopped':
						$('#button_start_service').show();
						$('#button_noVNC_service').show();
						$('#button_reinstall_service').show();
						$('#service_ribbon_master').html("<?php echo $lang->getString("offline") ?>");
						$('#service_ribbon_master').addClass("bg-warning");
						break;
					case 'stopping':
						$('#button_upgrade_service').hide();
						$('#button_renew_service').hide();
						$('#service_ribbon_master').html("<?php echo $lang->getString("stopped") ?>");
						$('#service_ribbon_master').addClass("bg-warning");
						break;
					case 'shutdown':
						$('#button_upgrade_service').hide();
						$('#button_renew_service').hide();
						$('#service_ribbon_master').html("<?php echo $lang->getString("stopped") ?>");
						$('#service_ribbon_master').addClass("bg-warning");
						break;
					case 'starting':
						$('#button_upgrade_service').hide();
						$('#button_renew_service').hide();
						$('#service_ribbon_master').html("<?php echo $lang->getString("started") ?>");
						$('#service_ribbon_master').addClass("bg-success");
						break;
					case 'installing':
						$('#button_upgrade_service').hide();
						$('#button_renew_service').hide();
						$('#service_ribbon_master').html("<?php echo $lang->getString("installation") ?>");
						$('#service_ribbon_master').addClass("bg-primary");
						break;
					case 'backuprestore':
						$('#button_upgrade_service').hide();
						$('#button_renew_service').hide();
						$('#service_ribbon_master').html("<?php echo $lang->getString("backupbeingimported") ?> " + respond.response.backup + '%');
						$('#service_ribbon_master').addClass("bg-primary");
						break;
					case 'plannedrestore':
						$('#button_upgrade_service').hide();
						$('#button_renew_service').hide();
						$('#service_ribbon_master').html("<?php echo $lang->getString("backupbeingimported") ?>");
						$('#service_ribbon_master').addClass("bg-primary");
						break;
					case 'backup':
						$('#button_upgrade_service').hide();
						$('#button_renew_service').hide();
						if(respond.response.backup == "planned"){
							$('#service_ribbon_master').html("<?php echo $lang->getString("backupplanned") ?>");
						} else {
							$('#service_ribbon_master').html("<?php echo $lang->getString("backupiscreated") ?> " + respond.response.backup + '%');
						}
						$('#service_ribbon_master').addClass("bg-primary");
						break;
					case 'expired':
						$('#service_ribbon_master').html("<?php echo $lang->getString("expired") ?>");
						$('#service_ribbon_master').addClass("bg-warning");
						endTime = respond.response.timeleftdelete;
						$('#service_info_expire_text').html("<?php echo $lang->getString("servicedelete") ?>");
						$('#button_upgrade_service').hide();
						break;
					case 'deleted':
						$('#service_ribbon_master').html("<?php echo $lang->getString("deleted") ?>");
						$('#service_ribbon_master').addClass("bg-danger");
						$('#button_renew_service').hide();
						$('#button_upgrade_service').hide();
						break;
					case 'proxmoxconnectionerror':
						$('#service_ribbon_master').html("<?php echo $lang->getString("proxmoxconnectionerror") ?>");
						$('#service_ribbon_master').addClass("bg-danger");
						$('#button_renew_service').hide();
						$('#button_upgrade_service').hide();
						break;
					default:
						$('#service_ribbon_master').html("<?php echo $lang->getString("errorContactSupport") ?>");
						$('#service_ribbon_master').addClass("bg-danger");
						$('#button_renew_service').hide();
						$('#button_upgrade_service').hide();
						break;
				}
				if(hourly == 1){
					$('#service_info_expire_text').html("<?php echo $lang->getString("nextcalc") ?>:");
					$('#button_renew_service').hide();
					$('#button_upgrade_service').hide();
				}
				if(backupSlots == 1){
					$('#action_backup_hour').hide();
				} else {
					$('#action_backup_hour').show();
				}
				countDownArray = [["service_info_counter",endTime]];
				countDown();
				countUp();
				<?php
				if($access){
					echo "$('#button_renew_service').hide();
					$('#button_upgrade_service').hide();";
					if(!isset($rights[1])){
						echo "$('#button_start_service').hide();";
					}
					if(!isset($rights[2])){
						echo "$('#button_stop_service').hide();";
						echo "$('#button_shutdown_service').hide();";
					}
					if(!isset($rights[3])){
						echo "$('#button_reinstall_service').hide();";
					}
					if(!isset($rights[7])){
						echo "$('#button_noVNC_service').hide();";
					}
				}
				?>
				$('#loading').hide();
				$('#main').show();
				updateIpSelect();
			}
        });
	}

	function getHardwareInfo(){
		$('#service_hardware').show();
		$('#service_hardware_main').hide();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getVServerHardwareInfo",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_hardware_disk_table').DataTable().clear().draw();
                respond.response.disk.forEach(element => {
					$('#service_hardware_disk_table').DataTable().row.add( [
						element.key,
						element.name,
						element.storage,
						element.size,
						'<button type=\"button\" id="access_delete_button_' + element.key + '" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openDiskDelete(\'' + element.key + '\')\" title=\"<?php echo $lang->getString("removeiso") ?>\"><i class=\"fas fa-trash\"></i></button>'
					] ).draw( false );
				});
				$('#service_hardware_harddisk_table').DataTable().clear().draw();
                respond.response.harddisk.forEach(element => {
					$('#service_hardware_harddisk_table').DataTable().row.add( [
						element.key,
						element.name,
						element.storage,
						element.size
					] ).draw( false );
				});
				$('#service_hardware_network_table').DataTable().clear().draw();
                respond.response.network.forEach(element => {
					$('#service_hardware_network_table').DataTable().row.add( [
						element.type,
						element.mac
					] ).draw( false );
				});
				$('#service_add_disk_modal_list').empty();
                respond.response.iso.forEach( element => {
                    var x = document.getElementById('service_add_disk_modal_list');
                    var option = document.createElement('option');
                    option.text = element.name;
                    option.value = element.id;
                    x.add(option);
				});
				$('#service_boot_modal_1').empty();
				$('#service_boot_modal_2').empty();
				$('#service_boot_modal_3').empty();
				respond.response.boot.forEach( element => {
                    option = document.createElement('option');
                    option.text = element;
                    option.value = element;
                    document.getElementById('service_boot_modal_1').add(option);
					option = document.createElement('option');
                    option.text = element;
                    option.value = element;
					document.getElementById('service_boot_modal_2').add(option);
					option = document.createElement('option');
                    option.text = element;
                    option.value = element;
					document.getElementById('service_boot_modal_3').add(option);
				});
				counter = 1;
				respond.response.bootOrder.forEach( element => {
					$("#service_boot_modal_"+ counter).val(element).change();
					counter++;
				});
			}
			$('#service_hardware').hide();
			$('#service_hardware_main').show();
		});
	}

	function openDiskDelete(id){
		currentDisk = id;
		$('#hardware_delete_disk_modal').modal("show");
	}

	function diskDelete(){
		if(!$('#hardware_delete_disk_modal_confirm').is(":checked")){
            toastr["error"]('<?php echo $lang->getString("nplsallowrestart") ?>');
            return;
		}
		loadButton('#hardware_delete_disk_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, disk:currentDisk},"deleteDiskvServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("diskdeleted") ?>');
				getHardwareInfo();
				$('#hardware_delete_disk_modal').modal('hide');
			}
			loadButton('#hardware_delete_disk_modal_button',false);
		});
	}

	function diskMount(){
		if(!$('#service_add_disk_modal_confirm').is(":checked")){
            toastr["error"]('<?php echo $lang->getString("nplsallowrestart") ?>');
            return;
		}
		iso = $('#service_add_disk_modal_list option:selected').val();
		loadButton('#service_add_disk_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, disk:iso},"mountDiskvServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("diskmounted") ?>');
				getHardwareInfo();
				$('#service_add_disk_modal').modal('hide');
			}
			loadButton('#service_add_disk_button',false);
		});
	}

	function changeCronCreateForm(){
		selected = $('#service_cron_create_modal_action option:selected').val();
		$('#service_cron_create_modal_special_master').hide();
		switch(selected){
			case 'command':
				$('#service_cron_create_modal_special_master').show();
			break;
		}
	}

	function changeCronEditForm(){
		selected = $('#service_cron_edit_modal_action option:selected').val();
		$('#service_cron_edit_modal_special_master').hide();
		switch(selected){
			case 'command':
				$('#service_cron_edit_modal_special_master').show();
			break;
		}
	}

	function editCron(){
		loadButton('#service_cron_edit_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId,cronid:activeCronJob, minute:$('#service_cron_edit_modal_minute').val(), hour:$('#service_cron_edit_modal_hour').val(), day_month:$('#service_cron_edit_modal_day_month').val(), month:$('#service_cron_edit_modal_month').val(), day_week:$('#service_cron_edit_modal_day_week').val(), action: $('#service_cron_edit_modal_action option:selected').val(), name:$('#service_cron_edit_modal_name').val(), command:$('#service_cron_edit_modal_command').val()},"vservercronedit",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("cronjobedited") ?>');
				getCronList();
				$('#service_cron_edit_modal').modal('hide');
				$('#service_cron_edit_modal_minute').val('');
				$('#service_cron_edit_modal_hour').val('');
				$('#service_cron_edit_modal_day_month').val('');
				$('#service_cron_edit_modal_month').val('');
				$('#service_cron_edit_modal_day_week').val('');
				$('#service_cron_edit_modal_name').val('');
				$('#service_cron_edit_modal_command').val('');
			}
			loadButton('#service_cron_edit_modal_button',false);
		});
	}

	function createCron(){
		loadButton('#service_cron_create_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, minute:$('#service_cron_create_modal_minute').val(), hour:$('#service_cron_create_modal_hour').val(), day_month:$('#service_cron_create_modal_day_month').val(), month:$('#service_cron_create_modal_month').val(), day_week:$('#service_cron_create_modal_day_week').val(), action: $('#service_cron_create_modal_action option:selected').val(), name:$('#service_cron_create_modal_name').val(), command:$('#service_cron_create_modal_command').val()},"vservercroncreate",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("cronjobcreated") ?>');
				getCronList();
				$('#service_cron_create_modal').modal('hide');
				$('#service_cron_create_modal_minute').val('');
				$('#service_cron_create_modal_hour').val('');
				$('#service_cron_create_modal_day_month').val('');
				$('#service_cron_create_modal_month').val('');
				$('#service_cron_create_modal_day_week').val('');
				$('#service_cron_create_modal_name').val('');
				$('#service_cron_create_modal_command').val('');
			}
			loadButton('#service_cron_create_modal_button',false);
		});
	}

	function saveBootOrder(){
		boot1 = $('#service_boot_modal_1 option:selected').val();
		boot2 = $('#service_boot_modal_2 option:selected').val();
		boot3 = $('#service_boot_modal_3 option:selected').val();
		loadButton('#service_boot_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, boot:[boot1,boot2,boot3]},"saveBootOrdervServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("bootorderchanged") ?>');
				getHardwareInfo();
				$('#service_boot_modal').modal('hide');
			}
			loadButton('#service_boot_modal_button',false);
		});
	}

	function getAccessList(){
		$('#access_list_master').hide();
		$('#access_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, productId: 1},"getAccesListService",function(respond){
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

	function updateIpSelect(){
		ip = $('#service_ip_add_type option:selected').val();
        switch (ip) {
            case '4':
                $('#service_add_ip_info').show();
                ipprice = (array_ip[ip - 1]["price"] - array_ip[ip]["price"]);
                newprice = price + (ipprice.toFixed(2) * -1);
                $('#service_add_ip_ipv4_cost').html(newprice.toFixed(2));
                $('#service_add_ip_ipv4_cost_one').html(((ipprice/ 30) * daysLeft).toFixed(2) * -1);
                break;
        }
	}

	function changeStatisticBtn(time,art){
        if(time != '0'){
            currentTime = time;
        }
        if(art != '0'){
            currentState = art;
        }
        $('#stats_settings_d').removeClass();
        $('#stats_settings_m').removeClass();
        if(art == 'AVERAGE'){
            $('#stats_settings_d').addClass('btn btn-success');
            $('#stats_settings_m').addClass('btn btn-secondary');
        } else {
            $('#stats_settings_d').addClass('btn btn-secondary');
            $('#stats_settings_m').addClass('btn btn-success');
        }
        if(time != '0'){
            $('#stats_settings_hour').removeClass();
            $('#stats_settings_day').removeClass();
            $('#stats_settings_week').removeClass();
            $('#stats_settings_month').removeClass();
            $('#stats_settings_year').removeClass();
        }
        switch (time) {
            case 'hour':
                    $('#stats_settings_hour').addClass('btn btn-success');
                    $('#stats_settings_day').addClass('btn btn-secondary');
                    $('#stats_settings_week').addClass('btn btn-secondary');
                    $('#stats_settings_month').addClass('btn btn-secondary');
                    $('#stats_settings_year').addClass('btn btn-secondary');
                break;
            case 'day':
                    $('#stats_settings_hour').addClass('btn btn-secondary');
                    $('#stats_settings_day').addClass('btn btn-success');
                    $('#stats_settings_week').addClass('btn btn-secondary');
                    $('#stats_settings_month').addClass('btn btn-secondary');
                    $('#stats_settings_year').addClass('btn btn-secondary');
                break;
            case 'week':
                    $('#stats_settings_hour').addClass('btn btn-secondary');
                    $('#stats_settings_day').addClass('btn btn-secondary');
                    $('#stats_settings_week').addClass('btn btn-success');
                    $('#stats_settings_month').addClass('btn btn-secondary');
                    $('#stats_settings_year').addClass('btn btn-secondary');
                break;
            case 'month':
                    $('#stats_settings_hour').addClass('btn btn-secondary');
                    $('#stats_settings_day').addClass('btn btn-secondary');
                    $('#stats_settings_week').addClass('btn btn-secondary');
                    $('#stats_settings_month').addClass('btn btn-success');
                    $('#stats_settings_year').addClass('btn btn-secondary');
                break;
            case 'year':
                    $('#stats_settings_hour').addClass('btn btn-secondary');
                    $('#stats_settings_day').addClass('btn btn-secondary');
                    $('#stats_settings_week').addClass('btn btn-secondary');
                    $('#stats_settings_month').addClass('btn btn-secondary');
                    $('#stats_settings_year').addClass('btn btn-success');
                break;

            default:
                break;
		}
		$('#service_statistic').show();
		$('#service_statistic_main').hide();
        getStatisticData(currentTime,currentState);
    }


	function getStatisticData(time,art){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, time: time,art:art},"getvserverstatistiks",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_statistic_main').show();
				statisticDataCPU.length = 0;
				statisticDataRAM.length = 0;
				statisticDataRAMMax.length = 0;
				statisticDataDISKRead.length = 0;
				statisticDataDISKWrite.length = 0;
				statisticDataNETWORKIn.length = 0;
				statisticDataNETWORKOut.length = 0;
				respond.response.data.forEach( element => {
					time = element.time * 1000;
					cpu = element.cpu.toFixed(2);
					if(!element.mem){
						mem = 0;
					} else {
						mem = (element.mem / 1074000000).toFixed(2);
					}
					maxMem = (element.maxmem / 1074000000).toFixed(2);
					if(!element.diskread){
						diskRead = 0;
					} else {
						diskRead = (element.diskread / 1000000).toFixed(2);
					}
					if(!element.diskwrite){
						diskWrite = 0;
					} else {
						diskWrite = (element.diskwrite / 1000000).toFixed(2);
					}
					if(!element.netout){
						netOut = 0;
					} else {
						netOut = (element.netout / 1000000).toFixed(2);
					}
					if(!element.netin){
						netIn = 0;
					} else {
						netIn = (element.netin / 1000000).toFixed(2);
					}
					statisticDataCPU.push({ y: cpu, x: time});
					statisticDataRAM.push({ y:mem, x: time});
					statisticDataRAMMax.push({ y:maxMem, x: time});
					statisticDataDISKRead.push({ y:diskRead, x: time});
					statisticDataDISKWrite.push({ y:diskWrite, x: time});
					statisticDataNETWORKIn.push({ y:netIn, x: time});
					statisticDataNETWORKOut.push({ y:netOut, x: time});
				});
				statisticDataCPUChart.updateSeries([{
					data: statisticDataCPU
				}])
				statisticDataRAMChart.updateSeries([{
					data: statisticDataRAM
				},
				{
					data: statisticDataRAMMax
				}])
				statisticDataDISKChart.updateSeries([{
					data: statisticDataDISKRead
				},
				{
					data: statisticDataDISKWrite
				}])
				statisticDataNETWORKChart.updateSeries([{
					data: statisticDataNETWORKIn
				},
				{
					data: statisticDataNETWORKOut
				}])
				$('#service_statistic').hide();
			}
		});
	}

	function addIp(){
		ip = $('#service_ip_add_type option:selected').val();
        loadButton('#service_add_ip_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, ip: ip},"addipadress",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr.success('<?php echo $lang->getString("nipadded") ?>.','');
				loadButton('#service_add_ip_modal_button', false);
				$('#service_add_ip_modal').modal('hide');
				getIpAdresses();
				$('#service_ip').show();
				$('#service_ip_main').hide();
			}
		});
	}

	function createIpv6(){
		ip = $('#service_create_ipv6_right').val();
		if(ip == ""){
			toastr["error"]("<?php echo $lang->getString("nplsenterip") ?>.");
			return;
		}
		ip = $('#service_create_ipv6_left').val() + ip;
        loadButton('#service_create_ipv6_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, ip: ip},"addipv6",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr.success('<?php echo $lang->getString("nipadded") ?>.','');
				$('#service_create_ipv6_modal').modal('hide');
				getIpAdresses();
				$('#service_ip').show();
				$('#service_ip_main').hide();
			}
			loadButton('#service_create_ipv6_modal_button', false);
		});
	}

	function getIpAdresses(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getvserveripadressen",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_ip_table').DataTable().clear().draw();
				nextIpv6 = respond.response.nextIpv6;
				$('#service_create_ipv6_right').val(nextIpv6);
                respond.response.array.forEach(element => {
                    ipData[element.ip] = element;
					if(element.netmask == ''){
						<?php
							if(!$access or isset($rights[10])){
								echo "buttons = '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openAddIpv6(\'' + element.left + '\')\" title=\"". $lang->getString("enternewipv6") ."\"><i class=\"fas fa-plus-circle\"></i></button>';";
							} else {
								echo "buttons = '';";
							}
						?>
					} else {
						buttons = "";
						if(element.ipv6){
							<?php
							if(!$access or isset($rights[8])){
								echo "buttons += '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openRNDSReset(\'' + element.ip + '\')\" title=\"". $lang->getString("rdnsentryreset") ."\"><i class=\"fas fa-redo\"></i></button>';";
							}
							if(!$access or isset($rights[6])){
                        		echo "buttons += ' <button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openRNDSEdit(\'' + element.ip + '\')\" title=\"". $lang->getString("rdnsentryedit") ."\"><i class=\"fas fa-edit\"></i></button>';";
							}
							?>
						} else {
							<?php
							if(!$access or isset($rights[8])){
								echo "buttons += '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openRNDSReset(\'' + element.ip + '\')\" title=\"". $lang->getString("rdnsentryreset") ."\"><i class=\"fas fa-redo\"></i></button>';";
							}
							if(!$access or isset($rights[6])){
                        		echo "buttons += ' <button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openRNDSEdit(\'' + element.ip + '\')\" title=\"". $lang->getString("rdnsentryedit") ."\"><i class=\"fas fa-edit\"></i></button> ';";
							}
						?>
						}
					}
                    $('#service_ip_table').DataTable().row.add( [
                        element.ip,
                        element.gw,
                        element.netmask,
                        element.rdns,
						buttons
                    ] ).draw( false );
				});
				$('#service_ip').hide();
				$('#service_ip_main').show();
			}
		});
	}

	function setRNDS(ip = activeIP,target = $('#vserver_rdns_edit').val()){
		loadButton('#service_edit_rnds_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId,ip:ip,target:target},"addrdns",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nrdnsentryupdated") ?>');
				$('#service_edit_rnds_modal').modal('hide');
				$('#service_reset_rnds_modal').modal('hide');
				getIpAdresses();
				$('#service_ip').show();
				$('#service_ip_main').hide();
			}
			loadButton('#service_edit_rnds_modal_button',false);
			loadButton('#service_reset_rnds_modal_button',false);
		});
	}

	function resetRNDS(){
		loadButton('#service_reset_rnds_modal_button');
		setRNDS(activeIP,'in-addr.arpa');
	}

	function createBackup(){
		loadButton('#service_backup_create_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"createbackup",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("backupiscreated") ?>');
				$('#loading').show();
				$('#main').hide();
				getServiceData();
				getBackups();
				$('#service_backup_create_modal').modal('hide');
			}
			loadButton('#service_backup_create_modal_button',false);
		});
	}

	function deleteBackup(){
		loadButton('#service_delete_backup_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, name:currentBackup},"deletebackupvserver",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nbackupdeleted") ?>');
				getBackups();
				$('#service_backups_master').hide();
				$('#service_backups').show();
				$('#service_delete_backup_modal').modal('hide');
			}
			loadButton('#service_delete_backup_modal_button',false);
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

	function deleteKey(){
		if(!$('#service_delete_key_modal_confirm').is(":checked")){
            toastr["error"]('<?php echo $lang->getString("nplsallowrestart") ?>');
            return;
		}
		loadButton('#service_delete_key_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, keyid:currentKey},"deleteKeysvServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nkeydeleted") ?>');
				getKeys();
				$('#service_keys_master').hide();
				$('#service_keys').show();
				$('#service_delete_key_modal').modal('hide');
			}
			loadButton('#service_delete_key_modal_button',false);
		});
	}
	
	function addKey(){
		if(!$('#setting_key_create_keys_confirm').is(":checked")){
            toastr["error"]('<?php echo $lang->getString("nplsallowrestart") ?>');
            return;
		}
		keyid = $('#setting_key_create_keys option:selected').val();
        if(keyid == ''){
			toastr["error"]('<?php echo $lang->getString("nselectkey") ?>');
			return;
		}
		loadButton('#setting_key_create_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, keyid:keyid},"createKeysvServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nassignsuccess") ?>');
				getKeys();
				$('#setting_key_create_modal').modal('hide');
			}
			loadButton('#setting_key_create_modal_button',false);
		});
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

	function restoreBackup(){
		loadButton('#service_restore_backup_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, name:currentBackup},"restoreBackupVServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nbackupimported") ?>');
				getBackups();
				$('#service_backups_master').hide();
				$('#service_backups').show();
				$('#service_restore_backup_modal').modal('hide');
			}
			loadButton('#service_restore_backup_modal_button',false);
		});
	}

	function getBackups(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getbackupsfromvserver",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_backups_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#service_backups_table').DataTable().row.add( [
                        element.volid,
							<?php
							if(!$access or isset($rights[4])){
							?>
								'<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openBackupDelete(\'' + element.volid + '\')\" title=\"<?php echo $lang->getString("backupdelete") ?>\"><i class=\"fas fa-trash-alt\"></i></button> '
							<?php
							} else {
								echo "' '";
							}
							if(!$access or isset($rights[16])){
							?>
                            + '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openBackupRestore(\'' + element.volid + '\')\" title=\"<?php echo $lang->getString("backuprestore") ?>\"><i class=\"fas fa-share-square\"></i></button> '
							<?php
							}
							?>
                    ] ).draw( false );
				});
				$('#service_backups_master').show();
				$('#service_backups').hide();
			}
		});
	}

	function getCronList(){
		$('#service_cron_list_master').hide();
		$('#service_cron_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"vservercrongetbyvserver",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_cron_list_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					cronJobList[element.id] = element;
					cron = element.minute + " " + element.hour + " " + element.day_month + " " + element.month + " " + element.day_week;
                    $('#service_cron_list_table').DataTable().row.add( [
                        element.name,
						cron,
						element.next_run,
						element.last_run,
						element.created_on,
						'<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openCronDisplay(' + element.id + ')\" title=\"<?php echo $lang->getString("showcronlog") ?>\"><i class=\"fas fa-eye\"></i></button> '
						<?php if(!$access or isset($rights[30])){ ?>
						 + '<button type=\"button\" class=\"btn btn-outline-warning btn-elevate btn-circle btn-icon\" onclick=\"openCronEdit(' + element.id + ')\" title=\"<?php echo $lang->getString("editcrontitle") ?>\"><i class=\"fas fa-edit\"></i></button> '
						<?php }
							if(!$access or isset($rights[34])){ ?>
						 + '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openCronDelete(' + element.id + ')\" title=\"<?php echo $lang->getString("deletecrontitle") ?>\"><i class=\"fas fa-trash-alt\"></i></button>'
						<?php } ?>
                    ] ).draw( false );
				});
				$('#service_cron_list_master').show();
				$('#service_cron_list').hide();
			}
		});
	}

	function deleteCron(){
		loadButton('#service_cron_delete_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), cronid:activeCronJob, id:serviceId},"vservercrondelete",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("crondeletesuccess") ?>');
				$('#service_cron_delete_modal').modal('hide');
				getCronList();
				loadButton('#service_cron_delete_modal_button', false);
			}
		});
	}

	function getCronLog(id){
		$('#service_cron_log_modal_loading').show();
		$('#service_cron_log_master').hide();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), cronid:id, id:serviceId},"vservercrongetlog",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
				$('#service_cron_log_modal').modal('hide');
            } else {
				$('#service_cron_log_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#service_cron_log_table').DataTable().row.add( [
                        element.id,
						element.info,
						element.created_on
                    ] ).draw( false );
				});
				$('#service_cron_log_master').show();
				$('#service_cron_log_modal_loading').hide();
			}
		});
	}

	function getKeys(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getKeysvServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_keys_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#service_keys_table').DataTable().row.add( [
                        element.id,
						element.keyid,
						element.created_on,
                        '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openKeyDelete(\'' + element.id + '\')\" title=\"<?php echo $lang->getString("keydelete") ?>\"><i class=\"fas fa-trash-alt\"></i></button> ' +
                        '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openKeyDisplay(\'' + element.key + '\')\" title=\"<?php echo $lang->getString("showkeynormal") ?>\"><i class=\"fas fa-eye\"></i></button>',
                    ] ).draw( false );
				});
				$('#service_keys_master').show();
				$('#service_keys').hide();
			}
		});
	}

	function getLogs(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getvserverlogs",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_log_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#service_log_table').DataTable().row.add( [
                        element.id,
                        element.log,
                        element.created_on,
                    ] ).draw( false );
				});
				$('#service_log_table').show();
				$('#service_log').hide();
			}
		});
	}

	function getAttacks(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getAttacksVServer",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_attacks_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#service_attacks_table').DataTable().row.add( [
                        element.ip,
                        (element.impact_bps / 1000000000).toFixed(2),
                        element.impact_pps,
                        element.type,
                        element.duration_start,
                        element.duration_stop,
                    ] ).draw( false );
				});
				$('#service_attacks').hide();
				$('#service_attacks_table').show();
			}
		});
	}

	function openTrafficDisplay(){
		$('#service_ip_traffic_modal').modal('show');
		$('#service_ip_traffic_load').show();
		$('#service_ip_traffic_display').hide();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"gettrafficforvserver",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_ip_traffic_display').html(respond.response);
				$('#service_ip_traffic_load').hide();
				$('#service_ip_traffic_display').show();
			}
		});
	}

	function openKeyDelete(id){
		currentKey = id;
		$('#service_delete_key_modal').modal('show');
	}

	function createNewAccess(){
		inviteCode = $('#service_access_new_invite_code').val();
		if(inviteCode == ""){
			toastr["error"]("<?php echo $lang->getString("nplsenterinvitecode") ?>.");
			return;
		}
		displayName = $('#service_access_new_display_name').val();
		if(displayName == ""){
			toastr["error"]("<?php echo $lang->getString("nplsentername") ?>.");
			return;
		}
		var accessRights = [];
		$('#service_access_new_right_checkboxes input:checked').each(function() {
			accessRights.push($(this).attr('id'));
		});
		loadButton('#service_access_new_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: 1, id:serviceId, invitecode:inviteCode, displayname:displayName, accessrights:accessRights },"createAccessRequest",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("<?php echo $lang->getString("nsharecreated") ?>.");
				$('#service_access_new_modal').modal('hide');
				getAccessList();
				$('#service_access_new_invite_code').val('');
				$('#service_access_new_display_name').val('');
			}
			loadButton('#service_access_new_modal_button',false);
		});
	}

	function saveAccess(){
		var accessRights = [];
		$('#service_access_edit_right_checkboxes input:checked').each(function() {
			accessRights.push($(this).attr('id'));
		});
		loadButton('#service_access_edit_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: 1, id:serviceId, accessId:activeAccess, accessrights:accessRights },"saveAccessRequest",function(respond){
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

	function openAccessNew(){
		$('#service_access_new_modal').modal('show');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: 1},"getAccessListRights",function(respond){
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

	function openAccessDelete(id){
		currentAccess = id;
		$('#access_delete_modal').modal("show");
	}

	function openKeyDisplay(key){
		$('#setting_key_display_modal_key').html(key);
		$('#setting_key_display_modal').modal("show");
	}
	
	function openBackupDelete(backup){
		currentBackup = backup;
		$('#service_delete_backup_modal').modal('show');
	}

	function openRNDSReset(ip){
		activeIP = ip;
		$('#service_reset_rnds_modal').modal('show');
	}

	function openAddIpv6(left){
		$('#service_create_ipv6_left').val(left);
		activeLeft = left;
		$('#service_create_ipv6_modal').modal('show');
	}

	function openRNDSEdit(ip){
		$('#vserver_rdns_edit').val(ipData[ip].rdns);
		activeIP = ip;
		$('#service_edit_rnds_modal').modal('show');
		$('#service_edit_rnds_header_modal').html(ip);
	}

	function openBackupRestore(backup){
		currentBackup = backup;
		$('#service_restore_backup_modal').modal('show');
	}

	function openServiceStart(){
		$('#service_start_modal').modal('show');
	}

	function openServiceStop(){
		$('#service_stop_modal').modal('show');
	}

	function openServiceReset(){
		$('#service_reset_modal').modal('show');
	}

	function openCronDisplay(id){
		$('#service_cron_log_modal').modal('show');
		getCronLog(id);
	}

	function openCronEdit(id){
		activeCronJob = id;
		$('#service_cron_edit_modal_minute').val(cronJobList[activeCronJob].minute);
		$('#service_cron_edit_modal_hour').val(cronJobList[activeCronJob].hour);
		$('#service_cron_edit_modal_day_month').val(cronJobList[activeCronJob].day_month);
		$('#service_cron_edit_modal_month').val(cronJobList[activeCronJob].month);
		$('#service_cron_edit_modal_day_week').val(cronJobList[activeCronJob].day_week);
		$('#service_cron_edit_modal_name').val(cronJobList[activeCronJob].name);
		$('#service_cron_edit_modal_command').val(cronJobList[activeCronJob].command);
		$('#service_cron_edit_modal_action').val(cronJobList[activeCronJob].action);
		changeCronEditForm();
		$('#service_cron_edit_modal').modal('show');
	}

	function openCronDelete(id){
		activeCronJob = id;
		$('#service_cron_delete_modal').modal('show');
	}

	function openServiceExec(){
		$('#service_exec_modal').modal('show');
	}

	function openServicePasswordReset(){
		$('#service_password_reset_modal').modal('show');
	}

	function openAutoRenew(){
		$('#service_renew_modal').modal('hide');
		$('#service_auto_renew_modal').modal('show');
	}

	function openServiceShutdown(){
		$('#service_shutdown_modal').modal('show');
	}

	function openServiceUpgradeModal(){
		$("#vserver_upgrade_cores").empty();
        array_core.forEach(element => {
            if(coreCount == element.data){
                $('#vserver_upgrade_cores').append(new Option(element.name, element.data,true,true));
            } else {
                $('#vserver_upgrade_cores').append(new Option(element.name, element.data));
            }
        });
        $("#vserver_upgrade_memory").empty();
        array_memory.forEach(element => {
            if(ramCount == element.data){
                $('#vserver_upgrade_memory').append(new Option(element.name, element.data,true,true));
            } else {
                $('#vserver_upgrade_memory').append(new Option(element.name, element.data));
            }
        });
        $("#vserver_upgrade_disk").empty();
        array_disk.forEach(element => {
            if(diskSpace == element.data){
                $('#vserver_upgrade_disk').append(new Option(element.name, element.data,true,true));
            } else {
                $('#vserver_upgrade_disk').append(new Option(element.name, element.data));
            }
        });
        $("#vserver_upgrade_backup").empty();
        for (let index = 2; index < 11; index++) {
            if(backupSlots == index){
                $('#vserver_upgrade_backup').append(new Option(index, index,true,true));
            } else {
                $('#vserver_upgrade_backup').append(new Option(index, index));
            }
        }
        $("#vserver_upgrade_packets").empty();
        for (const [key, element] of Object.entries(array_packet)) {
            if(packet == element.id){
                $('#vserver_upgrade_packets').append(new Option(element.title + " - " + element.cores + "VCores, " + element.memory / 1024 + "GB <?php echo $lang->getString("memory") ?>, " + element.disk + "GB SSD <?php echo $lang->getString("storage") ?>", element.id,true,true));
            } else {
                $('#vserver_upgrade_packets').append(new Option(element.title + " - " + element.cores + "VCores, " + element.memory / 1024 + "GB <?php echo $lang->getString("memory") ?>, " + element.disk + "GB SSD <?php echo $lang->getString("storage") ?>", element.id));
            }
        }
        upgradeService(1);
		$('#service_upgrade_modal').modal('show');
	}

	function openKeyAdd(){
		$('#setting_key_create_modal').modal('show');
		getKeyList();
	}
	
	function openExecInfo(pid){
		$('#service_exec_info_modal').modal('show');
		getExecInfo(pid);
	}

	function getExecInfo(pid){
		$('#service_exec_info_modal_loading').show();
		$('#service_exec_info_master').hide();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, pid:pid},"getVServerExecInfo",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
				$('#service_exec_info_modal').modal('hide');
            } else {
				$('#service_exec_info_exitcode_modal').html(respond.response.exitcode);
				$('#service_exec_info_output_modal').val(respond.response.out);
				
				$('#service_exec_info_master').show();
				$('#service_exec_info_modal_loading').hide();
			}
		});
	}

	function getExecList(){
		$('#service_exec_list_master').hide();
		$('#service_exec_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getVServerExecList",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_exec_list_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#service_exec_list_table').DataTable().row.add( [
                        element.command,
						element.pid,
                        element.created_on,
                        '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openExecInfo(' + element.pid + ')\"><i class=\"fas fa-eye\"></i></button> ',
                    ] ).draw( false );
				});
				$('#service_exec_list_master').show();
				$('#service_exec_list').hide();
			}
		});
	}

	function getKeyList(){
		$('#setting_key_create_modal_master').hide();
		$('#loading_setting_key_create_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getKeys",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#setting_key_create_keys').empty();
                respond.response.forEach( element => {
                    var x = document.getElementById('setting_key_create_keys');
                    var option = document.createElement('option');
                    option.text = element.name;
                    option.value = element.id;
                    x.add(option);
				});
				$('#setting_key_create_modal_master').show();
				$('#loading_setting_key_create_list').hide();
			}
		});
	}

	function openServiceReinstall(){
		$('#service_reinstall_modal').modal('show');
		getOsTypes();
	}

	function upgradeService(calculate){
		if(calculate == 0){
			if(!$('#vserver_upgrade_restart').is(":checked")){
                toastr["error"]('<?php echo $lang->getString("nplsallowrestart") ?>');
                return;
			}
		} else {
			$('#service_upgrade_load').show();
		}
		if(packet != null){
			if(calculate == 0){
                if(array_packet[packetid].disk < diskSpace){
                    if(!document.getElementById('vserver_upgrade_reinstall').checked){
                        toastr["error"]('<?php echo $lang->getString("ndatadeleteconfirm") ?>');
                        return;
                    }
				}
				loadButton('#service_upgrade_modal_button');
			}
            $('#upgrade_normal').hide();
			$('#vserver_upgrade_calc_1').hide();
			packetid = $('#vserver_upgrade_packets option:selected').val();
			requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId,packetid:packetid,calculate:calculate},"upgradepacketvserver",function(respond){
				if(respond.fail){
					toastr["error"](respond.error);
				} else {
					if(packet == packetid){
						$('#service_upgrade_modal_button').prop('disabled', true);
					} else {
						$('#service_upgrade_modal_button').prop('disabled', false);
					}
					if(respond.response.hasOwnProperty("message")){
                        toastr["success"](respond.response.message);
                        $('#service_upgrade_modal').modal('hide');
                        return;
					}
					$('#upgrade_credit_monthly_after').html(respond.response.monthly.toFixed(2));
					leftCredit = (credit + respond.response.change).toFixed(2);
					$('#upgrade_credit_left').html(leftCredit);
                    if(Math.sign(respond.response.change) == 1){
                        $('#upgrade_credit_after_text').html("<?php echo $lang->getString("onetimecredit") ?>:");
						$('#upgrade_credit_after').html(respond.response.change.toFixed(2));
                    } else {
                        $('#upgrade_credit_after_text').html("<?php echo $lang->getString("onetimecosts") ?>:");
						$('#upgrade_credit_after').html(respond.response.change.toFixed(2) * -1);
						if(leftCredit < 0){
							toastr["error"]('<?php echo $lang->getString("nnotenoughmoney") ?>');
							$('#service_upgrade_modal_button').prop('disabled', true);
						}
					}
                    if(calculate == 0){
                        getServiceData();
						$('#loading').show();
						$('#main').hide();
						toastr["success"]('<?php echo $lang->getString("nsuccessmodify") ?>.');
                        $('#service_upgrade_modal').modal('hide');
                        $("#vserver_upgrade_reinstall").prop("checked", false );
						$("#vserver_upgrade_restart").prop("checked", false );
						loadButton('#service_upgrade_modal_button', false);
                    }
					$('#service_upgrade_load').hide();
					$('#vserver_upgrade_calc_1').show();
				}
			});
		} else {
			$('#upgrade_packet').hide();
            cal_cores = $('#vserver_upgrade_cores option:selected').val();
            cal_memory = $('#vserver_upgrade_memory option:selected').val();
            cal_disk = $('#vserver_upgrade_disk option:selected').val();
			cal_slots = $('#vserver_upgrade_backup option:selected').val();
			if(calculate == 0){
				if(cal_disk < diskSpace){
					if(!$('#vserver_upgrade_reinstall').is(":checked")){
						toastr["error"]('<?php echo $lang->getString("ndatadeleteconfirm") ?>');
						return;
					}
				}
				loadButton('#service_upgrade_modal_button');
			}
            $('#vserver_upgrade_calc_1').hide();
			requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId,cores:cal_cores,memory:cal_memory,disk:cal_disk,slots:cal_slots,calculate:calculate},"upgradevserver",function(respond){
				if(respond.fail){
					toastr["error"](respond.error);
				} else {
					if(respond.response.hasOwnProperty("message")){
                        toastr.success(respond.response.message,'');
                        $('#vserver_upgrade_modal').modal('hide');
                        return;
                    }
					$('#upgrade_credit_monthly_after').html(respond.response.monthly.toFixed(2));
					leftCredit = (credit + respond.response.change).toFixed(2);
					$('#upgrade_credit_left').html(leftCredit);
                    if(Math.sign(respond.response.change) == 1){
                        $('#upgrade_credit_after_text').html("<?php echo $lang->getString("onetimecredit") ?>:");
						$('#upgrade_credit_after').html(respond.response.change.toFixed(2));
                    } else {
                        $('#upgrade_credit_after_text').html("<?php echo $lang->getString("onetimecosts") ?>:");
						$('#upgrade_credit_after').html(respond.response.change.toFixed(2) * -1);
						if(leftCredit < 0){
							toastr["error"]('<?php echo $lang->getString("nnotenoughmoney") ?>');
							$('#service_upgrade_modal_button').prop('disabled', true);
						}
					}
                    if(calculate == 0){
                        getServiceData();
						$('#loading').show();
						$('#main').hide();
						toastr["success"]('<?php echo $lang->getString("nsuccessmodify") ?>.');
                        $('#service_upgrade_modal').modal('hide');
                        $("#vserver_upgrade_reinstall").prop("checked", false);
						$("#vserver_upgrade_restart").prop("checked", false);
						loadButton('#service_upgrade_modal_button', false);
					}
					$('#service_upgrade_load').hide();
					$('#vserver_upgrade_calc_1').show();
				}
			});
		}
	}

	function getServicePassword(){
		loadButton('#serive_load_pw');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getvserverpassword",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				
                    $('#service_info_resetpw').show();
				
				$('#service_info_pw_master').html(respond.response);
			}
			loadButton('#serive_load_pw',false);
		});
	}

	function resetServicePassword(){
		loadButton('#service_password_reset_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"vserverresetpassword",function(respond){
			loadButton('#service_password_reset_modal_button',false);
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServicePassword();
				toastr["success"]('<?php echo $lang->getString("nsuccesspwchange") ?>.');
				$('#service_password_reset_modal').modal("hide");
			}
		});
	}

	function getOsTypes(){
		$('#service_reinstall_modal_master').hide();
		$('#loading_serive_os_type').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getimages",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#service_reinstall_type').empty();
                respond.response.forEach( element => {
                    var x = document.getElementById('service_reinstall_type');
                    var option = document.createElement('option');
                    option.text = element.name;
                    option.value = element.intern_id;
                    x.add(option);
				});
				$('#service_reinstall_modal_master').show();
				$('#loading_serive_os_type').hide();
			}
		});
	}

	function reinstallService(){
		if(!$('#service_data_delete').is(":checked")){
			toastr["error"]('<?php echo $lang->getString("ndatadeleteconfirm") ?>');
            return;
		}
		ostype = $('#service_reinstall_type option:selected').val();
        if(ostype == ''){
			toastr["error"]('<?php echo $lang->getString("nplsselectos") ?>');
			return;
		}
		loadButton('#service_reinstall_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, ostype: ostype},"vserverreinstall",function(respond){
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

	function openVNCConsole(){
		window.open('<?php echo $noVNCUrl; ?>', '_blank', 'height=900,width=900');
	}

	function startService(){
		loadButton('#service_start_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"vserverstart",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("servicestarted") ?>.");
				$('#service_start_modal').modal('hide');		
			}
			loadButton('#service_start_modal_button',false);
		});
	}

	function shutdownService(){
		loadButton('#service_shutdown_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"vservershutdown",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("nserviceshutdown") ?>.");
				$('#service_shutdown_modal').modal('hide');		
			}
			loadButton('#service_shutdown_modal_button',false);
		});
	}

	function resetService(){
		loadButton('#service_reset_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"vserverreset",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("servicereseted") ?>.");
				$('#service_reset_modal').modal('hide');		
			}
			loadButton('#service_reset_modal_button',false);
		});
	}

	function serviceExecCommand(){
		command = $('#service_exec_modal_command').val();
		loadButton('#service_exec_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, command:command},"vserverexec",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("servicecommandexecuted") ?>.");
				$('#service_exec_modal').modal('hide');	
				$('#service_exec_modal_command').val('');
				getExecList();
			}
			loadButton('#service_exec_modal_button',false);
		});
	}

	function stopService(){
		loadButton('#service_stop_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"vserverstop",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getServiceData();
				$('#loading').show();
				$('#main').hide();
				toastr["success"]("<?php echo $lang->getString("servicestopped") ?>.");
				$('#service_stop_modal').modal('hide');		
			}
			loadButton('#service_stop_modal_button',false);
		});
	}

	try{
        webSocket = new WebSocket('<?php echo $config->getconfigvalue('socketendpoint'); ?>');
    }catch (e) {
        console.log(e);
	}
	webSocket.onerror=function(event){
        console.log(event);
	};
	
	webSocket.onopen = function (event) {
        webSocket.send(JSON.stringify({'sessionid': Cookies.get('ph24_sessionid'),'serverid': serviceId}));
    };
    webSocket.onmessage = function (event) {
        if(event.data == 'Ping'){
            webSocket.send('Pong');
            return;
        }
        data = JSON.parse(event.data);
		date = new Date().getTime();
		serviceStatistikCPU.push({
			y: data.cpu, 
			x: date
		});
		$('#service_stats_cpu_data').html(data.cpu + '%');
		if(serviceStatistikCPU.length > 1000) {
			serviceStatistikCPU = [];
		}
		serviceChartCPU.updateSeries([{
		  data: serviceStatistikCPU
		}])
		serviceStatistikRAM.push({
			y: (data.mem / 1074000000).toFixed(2), 
			x: date
		});
		$('#service_stats_ram_data').html((data.mem / 1074000000).toFixed(1) + '/' + ramCount + 'GiB');
		if(serviceStatistikRAM.length > 1000) {
			serviceStatistikRAM = [];
		}
		serviceChartRAM.updateSeries([{
		  data: serviceStatistikRAM
        }])
	}

	function renewService(){
		days = $('#service_renew_days').val();
        if(days == ''){
			toastr["error"]('<?php echo $lang->getString("specifydays") ?>');
            return;
        }
		loadButton('#service_renew_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, days:days},"renewvserver",function(respond){
            if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nserviceextendet") ?>.');
				$('#loading').show();
				$('#main').hide();
				getServiceData();
                $('#service_renew_modal').modal('hide');
			}
			loadButton('#service_renew_button', false);
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

	setInterval(function() { countDown();countUp(); }, 1000);
	setInterval(function() { getServiceData(); }, 5000);
	getServiceData();
	getIpAdresses();
	updateIpSelect();

	$('#service_attacks_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_backups_table').DataTable({
		"responsive": true,
		"paging": false,
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
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
		}
	});
	$('#service_log_table').DataTable({
		"responsive": true,
		"paging": true,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_keys_table').DataTable({
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
	$('#service_hardware_disk_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_hardware_harddisk_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_hardware_network_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_exec_list_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_cron_list_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
	$('#service_cron_log_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
</script>
<?php

$script = '<script src="' . $cdn . 'assets/js/vserver.js"></script>';
if (isset($_COOKIE["ph24_dark"])) {
	if($_COOKIE["ph24_dark"] == 1){
		$script = '<script src="' . $cdn . 'assets/js/vserver_dark.js"></script>';
	}
}

echo $script;
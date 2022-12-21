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

echo minifyhtml(getheader($config, $lang->getString("webhosting") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("webhostingmanagement"), $user, $lang));

?>


	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<?php echo getloadinghtml("loading"); ?>
				<div class="row" style="display:none;" id="main">
                	<div class="col-lg-8">
                    	<div class="card card-custom card-stretch gutter-b">
                        	<div class="card-header ribbon ribbon-top border-0 pt-7">
								<div id="service_ribbon_master" class="ribbon-target bg-danger" style="top: -2px; right: 20px;"><?php echo $lang->getString("expire") ?></div>
								<h3 class="card-title"><?php echo $lang->getString("generalinfo") ?></h3>
                        	</div>
							<div class="card-body">
								<div class="row">
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("webhosting") ?> ID:<br><span id="service_info_id" class="text-dark-75 font-size-lg" >1337</span></span>
									</div>
                                    <div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><br><span class="text-dark-75 font-size-lg"></span></span>
									</div>

									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("hostsystem") ?>:<br><span class="text-dark-75 font-size-lg">WebHost 1</span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("domain") ?>:<br><span id="service_info_domain" class="text-dark-75 font-size-lg">test12341231.de</span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("ssdstorage") ?>:<br><span id="service_info_disk" class="text-dark-75 font-size-lg">0GB / 5GB</span></span>
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
                                	<span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php echo $lang->getString("action") ?></span>
                             	</h3>
                         	</div>
							    <div class="card-body">
									<?php
									if(!$access or isset($rights[17])){
									?>
								    <div class="row">
								    	<div class="col bottom15">
								    		<a id="button_requestPleskSession" onClick="requestPleskSession()" class="btn btn-outline-success font-weight-bold col"><?php echo $lang->getString("toplesk") ?>&nbsp&nbsp<i class="fas fa-external-link-alt"></i></a>
								    	</div>
								    </div>
									<?php
									};
									if(!$access){
									?>
                                    <div class="row">
								    	<div class="col bottom15">
								    		<a id="button_renew_service" onClick="openServiceRenewModal()" class="btn btn-outline-primary font-weight-bold col"><?php echo $lang->getString("serviceextend") ?></a>
								    	</div>
								    </div>
									<?php
									}
									?>
                                </div>
							</div>
                    	</div>
                	</div>
					<div class="row" id="mainTableDisplay" style="display:none">
                		<div class="col">
                    	<div class="card card-custom card-stretch gutter-b">
                        	<div class=" border-0 pt-7">
								<ul class="nav nav-tabs nav-tabs-line justify-content-center">
									<li class="nav-item active">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_1" onClick="getWebspaceDomainList()">
								            <span class="nav-icon"><i class="fas fa-globe"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("domains") ?></span>
								        </a>
								    </li>
									<?php
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
								<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">
									<?php echo getloadinghtml("domain_list"); ?>
									<div id="domain_list_master" style="display:none;">
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="domain_list_table">
											<thead>
												<tr>
													<th>#</th>
													<th><?php echo $lang->getString("name") ?></th>
													<th><?php echo $lang->getString("type") ?></th>
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
                    <p><?php echo $lang->getString("serviceextendt") ?></p>
                    <p><?php echo $lang->getString("choosetheperiod") ?>:</p>
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
                    <p style="margin-bottom:0;margin-top:1rem;"><?php echo $lang->getString("yourcredit") ?> <?php echo round($user->getGuthaben(), 2); ?>€</p>
                    <p><?php echo $lang->getString("remainingcredit") ?> <text id="service_credit_after">0</text>€</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-primary" id="service_add_credit_button" onclick="openAddCredit()"><?php echo $lang->getString("addcredit") ?></button>
					<button type="button" class="btn btn-primary" id="service_renew_modal_button_autoremove_activate" onclick="openAutoRenew()"><?php echo $lang->getString("setupautoextend") ?></button>
					<button type="button" class="btn btn-primary" id="service_renew_modal_button_autoremove_remove" onclick="removeAutoRenew()"><?php echo $lang->getString("removeautoextend") ?></button>
                    <button type="button" class="btn btn-success" id="service_renew_button" onclick="renewService()"><?php echo $lang->getString("extendfor") ?></button>
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
</div>

<?php
echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';
?>


<script>
	var serviceId = <?php echo $serviceId; ?>;
	var price = 0;
	var endTime = 0;
	var diskSpace = 0;
	var diskUsage = 0;
	var domain = "";
	var credit = <?php echo $user->getGuthaben(); ?>;
	var creditAddWindow = "";
	var status = "";

	var productId = 2;

	var activeAccess = 0;

	function getServiceData(){
        requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId},"getwebspaceinfo",function(respond){
            if(respond.fail){
                toastr["error"](respond.error);
            } else {
				price = respond.response.price;
				endTime = respond.response.timeleft;
				diskSpace = respond.response.speicher;
				diskUsage = respond.response.diskusage;
				domain = respond.response.domain;
				status = respond.response.status;
				autoRenew = respond.response.autorenew;
				name = respond.response.name;
				$('#service_info_id').html(serviceId);
				$('#service_info_domain').html(domain);
				$('#service_info_disk').html(diskUsage + 'GB / ' + diskSpace + 'GB');
				$('#button_renew_service').show();
				$("#service_ribbon_master").removeClass();
				$('#service_ribbon_master').addClass("ribbon-target");
				$('#masterPageTitle').html("<?php echo $lang->getString("webhostingmanagement"); ?> - " + name);
				if(autoRenew == 0){
					$('#service_renew_modal_button_autoremove_activate').show();
					$('#service_renew_modal_button_autoremove_remove').hide();
				} else {
					$('#service_renew_modal_button_autoremove_activate').hide();
					$('#service_renew_modal_button_autoremove_remove').show();
				}

				switch (status) {
					case 'running':
						$('#service_ribbon_master').html("<?php echo $lang->getString("active") ?>"); 
						$('#service_ribbon_master').addClass("bg-success");
						break;
					case 'expired':
						$('#service_ribbon_master').html("<?php echo $lang->getString("expired") ?>");
						$('#service_ribbon_master').addClass("bg-danger");
						endTime = respond.response.timeleftdelete;
						$('#service_info_expire_text').html("<?php echo $lang->getString("servicedelete") ?>")
						break;
					case 'deleted':
						$('#service_ribbon_master').html("<?php echo $lang->getString("deleted") ?>");
						$('#service_ribbon_master').addClass("bg-danger");
						$('#button_renew_service').hide();
						break;
				}
				countDownArray = [["service_info_counter",endTime]];
				countDown();
				$('#loading').hide();
				$('#main').show();
				$('#mainTableDisplay').show();
			}
        });
	}
	
	function requestPleskSession(){
		loadButton('#button_requestPleskSession');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), webspaceid:serviceId},"webspacegetsession",function(respond){
            if(respond.fail){
                toastr["error"](respond.error);
            } else {
				window.open('https://web.prohosting24.de:8443/enterprise/rsession_init.php?PLESKSESSID=' + respond.response);
			}
			loadButton('#button_requestPleskSession', false);
        });
	}

	function renewService(){
		days = $('#service_renew_days').val();
        if(days == ''){
			toastr["error"]('<?php echo $lang->getString("specifydays") ?>');
            return;
        }
		loadButton('#service_renew_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, days:days},"renewwebspace",function(respond){
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

	function openServiceRenewModal(){
		switchServiceDayCount(1);
		$('#service_renew_modal').modal('show');
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

	function getWebspaceDomainList(){
		$('#domain_list_master').hide();
		$('#domain_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), webspaceid:serviceId},"getdomainlist",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#domain_list_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					if(element.main == 1){
						mainDisplay = '<span class="badge badge-success" style=""><?php echo $lang->getString("maindomain") ?></span>';
					} else {
						mainDisplay = '<span class="badge badge-success" style=""><?php echo $lang->getString("notmaindomain") ?></span>';
					}
					$('#domain_list_table').DataTable().row.add( [
						element.id,
						element.name,
						mainDisplay
					] ).draw( false );
				});
				$('#domain_list_master').show();
				$('#domain_list').hide();
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

	$('#domain_list_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
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
	getWebspaceDomainList();
</script>
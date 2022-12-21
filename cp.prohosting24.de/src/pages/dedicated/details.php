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

echo minifyhtml(getheader($config, $lang->getString("dedicated") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("dedicatedmanagement"), $user, $lang));

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
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("dedicatedlocation") ?><br><span id="service_info_location" class="text-dark-75 font-size-lg" ></span></span>
									</div>
                                    <div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><br><span class="text-dark-75 font-size-lg"></span></span>
									</div>

									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("cpu") ?>:<br><span id="service_info_cpu" class="text-dark-75 font-size-lg"></span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("memory") ?>:<br><span id="service_info_memory" class="text-dark-75 font-size-lg"></span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("dedicateddisk") ?>:<br><span id="service_info_disk" class="text-dark-75 font-size-lg"></span></span>
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
                                    <div class="row">
								    	<div class="col bottom15">
								    		<a id="button_renew_service" onClick="openServiceRenewModal()" class="btn btn-outline-primary font-weight-bold col"><?php echo $lang->getString("serviceextend") ?></a>
								    	</div>
								    </div>
                                </div>
							</div>
                    	</div>
                	</div>
					<div class="row" id="mainTableDisplay" style="display:none">
                		<div class="col">
                    	<div class="card card-custom card-stretch gutter-b">
                        	<div class=" border-0 pt-7">
								<ul class="nav nav-tabs nav-tabs-line justify-content-center">
									<li class="nav-item">
								        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1" onClick="getIpList()">
								            <span class="nav-icon"><i class="flaticon-map"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("vserveripadresses") ?></span>
								        </a>
								    </li>
								</ul>
                        	</div>
							<div class="tab-content mt-5 col" id="myTabContent">
								<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">
									<?php echo getloadinghtml("service_ip"); ?>
									<div id="service_ip_main"class="card-body table-responsive" style="display:none;">
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
    var ipData = [];
    var activeLeft = "";
    var activeIpv6Subnet = 0;

	var productId = 6;

	function getServiceData(){
        apiRequest({}, 'GET', 'service/dedicated/' + serviceId, function(respond){
            price = respond.service.price;
            endTime = respond.service.expire_at;
            name = respond.service.name;
            status = respond.service.status;
			autoRenew = respond.service.autorenew;
            $('#service_info_location').html(respond.location.displayname);
            $('#service_info_cpu').html(respond.config.cpu.displayname);
            $('#service_info_memory').html(respond.config.memory.displayname);
            $('#service_info_disk').html(respond.config.disk.displayname);
            $('#button_renew_service').show();
            $("#service_ribbon_master").removeClass();
			$('#service_ribbon_master').addClass("ribbon-target");
            $('#masterPageTitle').html("<?php echo $lang->getString("dedicatedmanagement"); ?> - " + name);
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
        },function(respond){
            
        });
	}

    function getIpList(){
        apiRequest({}, 'GET', 'service/dedicated/' + serviceId + '/ips', function(respond){
            $('#service_ip_table').DataTable().clear().draw();
            respond.forEach(element => {
                    ipData[element.ip] = element;
					if(element.netmask == ''){
						buttons = '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openAddIpv6(' + element.id + ',\'' + element.left + '\', \'' + element.nextipv6 + '\')\" title=\"<?php echo $lang->getString("enternewipv6"); ?>"><i class=\"fas fa-plus-circle\"></i></button>';
					} else {
						buttons = "";
						if(element.ipv6){
                            buttons += '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openRNDSReset(\'' + element.ip + '\')\" title=\"<?php echo $lang->getString("rdnsentryreset") ; ?>\"><i class=\"fas fa-redo\"></i></button>';
                            buttons += ' <button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openRNDSEdit(\'' + element.ip + '\')\" title=\"<?php echo $lang->getString("rdnsentryedit") ; ?>\"><i class=\"fas fa-edit\"></i></button>';
						} else {
                            buttons += '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openRNDSReset(\'' + element.ip + '\')\" title=\"<?php echo $lang->getString("rdnsentryreset") ; ?>\"><i class=\"fas fa-redo\"></i></button>';
                            buttons += ' <button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openRNDSEdit(\'' + element.ip + '\')\" title=\"<?php echo $lang->getString("rdnsentryedit") ; ?>\"><i class=\"fas fa-edit\"></i></button> ';
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
        },function(respond){
            
        });
    }

    function openAddIpv6(id, left, right){
		$('#service_create_ipv6_left').val(left);
        $('#service_create_ipv6_right').val(right);
		activeIpv6Subnet = id;
		$('#service_create_ipv6_modal').modal('show');
	}

    function createIpv6(){
		ip = $('#service_create_ipv6_right').val();
		if(ip == ""){
			toastr["error"]("<?php echo $lang->getString("nplsenterip") ?>.");
			return;
		}
		ip = $('#service_create_ipv6_left').val() + ip;
        loadButton('#service_create_ipv6_modal_button');
        apiRequest({ip:ip}, 'POST', 'ip/v6/' + activeIpv6Subnet + '/addip', function(respond){
            toastr.success('<?php echo $lang->getString("nipadded") ?>.','');
			$('#service_create_ipv6_modal').modal('hide');
			getIpList();
			$('#service_ip').show();
			$('#service_ip_main').hide();
            loadButton('#service_create_ipv6_modal_button', false);
        },function(respond){
            loadButton('#service_create_ipv6_modal_button', false);
        });
	}


	function renewService(){
		days = $('#service_renew_days').val();
        if(days == ''){
			toastr["error"]('<?php echo $lang->getString("specifydays") ?>');
            return;
        }
		loadButton('#service_renew_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, days:days},"renewdedi",function(respond){
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
	setInterval(function() { countDown(); }, 1000);
	setInterval(function() { getServiceData(); }, 5000);
	getServiceData();
    getIpList();
</script>
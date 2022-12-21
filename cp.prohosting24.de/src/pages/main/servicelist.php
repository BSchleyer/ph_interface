<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

echo minifyhtml(getheader($config, $lang->getString("servicetitle"). " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("serviceheader") . '&nbsp;<a id="enableEdit" href="javascript:enableEdit();"><i class="fas fa-edit"></i></a><a id="disableEdit" style="display:none" href="javascript:disableEdit();"><i class="fas fa-check"></i></a>&nbsp;<a id="disableEdit" href="javascript:openGroupCreate();"><i class="fas fa-plus"></i></a>', $user, $lang));

?>


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container" id="main">
			<?php echo getloadinghtml("loading"); ?>
		</div>
	</div>
</div>


<div>
    <div class="modal fade" id="service_name_modal" tabindex="-1" role="dialog" aria-labelledby="service_name_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_name_modalLabel"><?php echo $lang->getString("servicechangename") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                </div>
                <div class="modal-body">
                    <p>Name:</p>
                    <input type="text" class="form-control" id="service_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("servicechangenameclose") ?></button>
                    <button type="button" class="btn btn-primary" id="service_name_button" onclick="saveServiceName()"><?php echo $lang->getString("servicechangenamesave") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="group_delete_modal" tabindex="-1" role="dialog" aria-labelledby="group_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="group_delete_modalLabel"><?php echo $lang->getString("servicegroupdeleteheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                </div>
                <div class="modal-body">
					<p><?php echo $lang->getString("servicegroupdeleteinfo") ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("servicechangenameclose") ?></button>
                    <button type="button" class="btn btn-danger" id="group_delete_button" onclick="deleteGroup()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="group_create_modal" tabindex="-1" role="dialog" aria-labelledby="group_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="group_create_modalLabel"><?php echo $lang->getString("groupcreateheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                </div>
                <div class="modal-body">
                    <p>Name:</p>
                    <input type="text" class="form-control" id="group_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("servicechangenameclose") ?></button>
                    <button type="button" class="btn btn-primary" id="group_create_button" onclick="createGroup()"><?php echo $lang->getString("servicechangenamesave") ?></button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="group_edit_modal" tabindex="-1" role="dialog" aria-labelledby="group_edit_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="group_edit_modalLabel"><?php echo $lang->getString("groupeditheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                </div>
                <div class="modal-body">
                    <p>Name:</p>
                    <input type="text" class="form-control" id="group_name_edit">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("servicechangenameclose") ?></button>
                    <button type="button" class="btn btn-primary" id="group_edit_button" onclick="editGroup()"><?php echo $lang->getString("servicechangenamesave") ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	echo minifyhtml(getscripts($config, $lang));
?>

<script>
	var url = "<?php echo $url ?>";
	var activeServiceNameId = 0;
	var activeProductId = 0;
	var activeServiceId = 0;
	var activeGroupId = 0;

	var currentDragId = "";
	var currentDragData = "";

	var doUpdate = 1;

	function getServiceList(){
        requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getServiceList",function(respond){
			countDownArray = [];
			$('#loading').hide();
			if(respond.response == ""){
				$('#main').html('<h4 class="text-dark font-weight-bold my-1 mr-5"><?php echo $lang->getString("servicenoservices") ?></h4>');
				return;
			}
			$('#main').html(respond.response);
			countDown();
        });
	}

	function enableEdit(){
		doUpdate = 0;
		$('#enableEdit').hide();
		$('#disableEdit').show();
	}

	function disableEdit(){
		doUpdate = 1;
		$('#enableEdit').show();
		$('#disableEdit').hide();
	}

	function hideService(serviceId){
		loadButton('#service_hide_' + serviceId);
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),id:serviceId},"hideService",function(respond){
			if (respond.fail) {
				toastr.error(respond.error, '');
			} else {
				getServiceList();
			}
			loadButton('#service_hide_' + serviceId, false);
		});
	}

	function openServicePage(productId, serviceId){
		switch (productId) {
			case 1:
				window.location.href = url + 'vserver/details/' + serviceId;
				break;
			case 3:
				window.location.href = url + 'teamspeak/details/' + serviceId;
				break;
			case 2:
				window.location.href = url + 'webspace/details/' + serviceId;
				break;
			case 4:
				window.location.href = url + 'domain/details/' + serviceId;
				break;
			case 5:
				window.location.href = url + 'app/details/' + serviceId;
				break;
			default:
				window.location.href = url;
				break;
		}
	}

	function openGroupDelete(groupId){
		activeGroupId = groupId;
		$('#group_delete_modal').modal('show');
	}

	function openGroupEdit(groupId, name){
		activeGroupId = groupId;
		$('#group_name_edit').val(name);
		$('#group_edit_modal').modal('show');
	}

	function openGroupCreate(){
		$('#group_create_modal').modal('show');
	}

	function deleteGroup(){
		loadButton('#group_delete_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),groupid:activeGroupId},"deleteGroup",function(respond){
			if (respond.fail) {
				toastr.error(respond.error, '');
			} else {
				disableEdit();
				getServiceList();
				toastr.success('<?php echo $lang->getString("groupdeletesuccessful") ?>.','');
				$('#group_delete_modal').modal('hide');
			}
			loadButton('#group_delete_button', false);
		});
	}

	function editGroup(){
		name = $('#group_name_edit').val();
		if (name == "") {
			toastr.error('<?php echo $lang->getString("groupnoname") ?>', '');
			return;
		}
		if (name.length > 64) {
			toastr.error('<?php echo $lang->getString("groupmax64") ?>', '');
			return;
		}
		loadButton('#group_edit_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),name:name,groupid:activeGroupId},"editgroup",function(respond){
			if (respond.fail) {
				toastr.error(respond.error, '');
			} else {
				disableEdit();
				getServiceList();
				toastr.success('<?php echo $lang->getString("groupeditsuccessful") ?>.','');
				$('#group_edit_modal').modal('hide');
				$('#group_name_edit').val('');
			}
			loadButton('#group_edit_button', false);
		});
	}

	function createGroup(){
		name = $('#group_name').val();
		if (name == "") {
			toastr.error('<?php echo $lang->getString("groupnoname") ?>', '');
			return;
		}
		if (name.length > 64) {
			toastr.error('<?php echo $lang->getString("groupmax64") ?>', '');
			return;
		}
		loadButton('#group_create_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),name:name},"creategroup",function(respond){
			if (respond.fail) {
				toastr.error(respond.error, '');
			} else {
				disableEdit();
				getServiceList();
				toastr.success('<?php echo $lang->getString("groupcreatesuccessful") ?>.','');
				$('#group_create_modal').modal('hide');
				$('#group_name').val('');
			}
			loadButton('#group_create_button', false);
		});
	}

	function saveServiceName(){
		name = $('#service_name').val();
		if (name == "") {
			toastr.error('<?php echo $lang->getString("servicenoname") ?>', '');
			return;
		}
		if (name.length > 64) {
			toastr.error('<?php echo $lang->getString("servicemax64") ?>', '');
			return;
		}
		loadButton('#service_name_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),id:activeServiceNameId, name:name, product:activeProductId},"saveservicename",function(respond){
			if (respond.fail) {
				toastr.error(respond.error, '');
			} else {
				getServiceList();
				$('#service_name_modal').modal('hide');
			}
			loadButton('#service_name_button', false);
		});
	}

	function moveServiceToGroup(groupid,product,serviceid){
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),id:serviceid, groupid:groupid, product:product},"moveServiceToGroup",function(respond){
			if (respond.fail) {
				toastr.error(respond.error, '');
			} else {
				toastr.success('<?php echo $lang->getString("groupservicesavedsuccessful") ?>.','');
			}
		});
	}
	
	function displayServiceSuspend(){
        toastr["error"]("<?php echo $lang->getString("servicesuspended") ?>");
    }

	function drag(ev) {
		if(!ev.target.id){
			ev.preventDefault();
			return;	
		}
		if(doUpdate == 1){
			ev.preventDefault();
			return;	
		}
		currentDragId = ev.srcElement.id;
		currentDragData = ev.srcElement.outerHTML;

		activeProductId = ev.srcElement.attributes.productid.nodeValue;
		activeServiceId = ev.srcElement.attributes.serviceid.nodeValue;
	}

	function allowDrop(ev) {
		ev.preventDefault();
	}

	function drop(ev) {
		ev.preventDefault();
		console.log(ev);
		targetId = "";
		groupid = "";
		if(ev.target.attributes.childId){
			targetId = ev.target.attributes.childId.nodeValue;
			groupid = ev.target.attributes.groupid.nodeValue;
		} else {
			if(!ev.target.id || !ev.target.id.includes("main_")){
				ev.path.forEach(element => {
					if(element.id){
						if(element.id.includes("main_")){
							targetId = element.id;
							groupid = element.attributes.groupid.nodeValue;
						}
					}
				});
			} else {
				targetId = ev.target.id;
			}
			if(targetId == ""){
				return;
			}
		}
		if(ev.target.attributes.groupid){
			groupid = ev.target.attributes.groupid.nodeValue;
		}
		$('#' + currentDragId).remove();
		$('#' + targetId).append(currentDragData);
		moveServiceToGroup(groupid,activeProductId,activeServiceId);
	}

	function changeServiceName(id, name, pid){
		$('#service_name_modal').modal('show');
		$('#service_name').val(name);
		activeServiceNameId = id;
		activeProductId = pid;
	}
	setInterval(function() { countDown(); }, 1000);
	setInterval(function() { 
		if(doUpdate == 1){
			getServiceList(); 
		}
	}, 10000);
	getServiceList();
</script>
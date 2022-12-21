<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

echo minifyhtml(getheader($config, $lang->getString("sharesmanage") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("shares"), $user, $lang));


?>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="card card-custom example example-compact">
						<div class="card-header">
							<h3 class="card-title"><?php  echo $lang->getString("sharesmanage"); ?></h3>
						</div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <?php echo getloadinghtml("access_list"); ?>
                                <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="access_list_table" style="display:none">
                                    <thead>
                                        <tr>
                                            <th><?php  echo $lang->getString("name"); ?></th>
                                            <th><?php  echo $lang->getString("state"); ?></th>
                                            <th><?php  echo $lang->getString("serviceid"); ?></th>
                                            <th><?php  echo $lang->getString("action"); ?></th>
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

<div>
    <div class="modal fade" id="service_access_user_info_modal" tabindex="-1" role="dialog" aria-labelledby="service_access_user_info_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_access_user_info_modalLabel"><?php  echo $lang->getString("permissions"); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<h4><?php  echo $lang->getString("permissionst"); ?></h4>
					<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="access_user_info_table">
						<thead>
							<tr>
								<th><?php  echo $lang->getString("name"); ?></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php  echo $lang->getString("close"); ?></button>
                </div>
            </div>
        </div>
	</div>
    <div class="modal fade" id="access_delete_modal" tabindex="-1" role="dialog" aria-labelledby="access_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="access_delete_modalLabel"><?php  echo $lang->getString("deleteshare"); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php  echo $lang->getString("deletesharesure"); ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php  echo $lang->getString("cancel"); ?></button>
					<button type="button" class="btn btn-success" id="access_delete_modal_button" onclick="deleteAccess()"><?php  echo $lang->getString("delete"); ?></button>
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
    var currentAccess = 0;

    function getAccessList(){
		$('#access_list_table').hide();
		$('#access_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getAccessByOwnerUser",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#access_list_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					buttons = '<button type=\"button\" id="access_display_info_button_' + element.id + '" class=\"btn btn-outline-primary btn-elevate btn-circle btn-icon\" onclick=\"openAccessInfo(\'' + element.id + '\')\" title=\"<?php  echo $lang->getString("showpermissions"); ?>\"><i class=\"fas fa-eye\"></i></button>';
					switch (element.status) {
						case 0:
                            buttons = buttons + '&nbsp;<button type=\"button\" id="access_delete_button_' + element.id + '" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openAccessDelete(\'' + element.id + '\')\" title=\"<?php  echo $lang->getString("deleteshare"); ?>\"><i class=\"fas fa-trash\"></i></button>';
							statusBadge = '<span class="badge badge-success" style=""><?php  echo $lang->getString("requestopen"); ?></span>';
							break;
						case 2:
							statusBadge = '<span class="badge badge-danger" style=""><?php  echo $lang->getString("requestno"); ?></span>';
							break;
						default:
							statusBadge = '<span class="badge badge-success" style="">Aktiv</span>';
                            buttons = buttons + '&nbsp;<button type=\"button\" id="access_delete_button_' + element.id + '" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openAccessDelete(\'' + element.id + '\')\" title=\"<?php  echo $lang->getString("deleteshare"); ?>\"><i class=\"fas fa-trash\"></i></button>';
							break;
					}
					if(element.status != 3){
						$('#access_list_table').DataTable().row.add( [
							element.name,
							statusBadge,
							element.serviceid,
							buttons
						] ).draw( false );
					}
				});
				$('#access_list_table').show();
				$('#access_list').hide();
			}
		});
	}
    getAccessList();

    function openAccessInfo(id){
		loadButton('#access_display_info_button_' + id,true, false);
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:id},"getAccesUserRights",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#access_user_info_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					if(element.checked == 1){
						$('#access_user_info_table').DataTable().row.add( [
							element.name
						] ).draw( false );
					}
				});
				$('#service_access_user_info_modal').modal('show');
			}
			loadButton('#access_display_info_button_' + id,false);
		});
	}

    function deleteAccess(){
		loadButton('#access_delete_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:currentAccess},"accessDelete",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php  echo $lang->getString("deletedshare"); ?>');
				getAccessList();
				$('#access_delete_modal').modal('hide');
			}
			loadButton('#access_delete_modal_button',false);
		});
	}

    function openAccessDelete(id){
		currentAccess = id;
		$('#access_delete_modal').modal("show");
	}

    function openServiceManger(id){
		window.open(url + 'access/' + id, '_blank').focus();
	}

    function openAccessAccept(id){
		currentAccess = id;
		$('#access_accept_modal').modal("show");
	}

    $('#access_list_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 1, 'asc' ]],
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

</script>

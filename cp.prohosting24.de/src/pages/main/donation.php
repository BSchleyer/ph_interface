<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml(getheader($config, $lang->getString("donationsnav") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("donationsnav"), $user, $lang));

$donationStats = requestBackend($config, ["userid" => $user->getId()], "getDonationLinkStatistics", $user->getLang());

?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="container" id="main">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder font-size-h4"><?php echo $lang->getString("receiveddonations"); ?></span>
                            </h3>
                            <div class="card-toolbar">
                                <span class="font-weight-bolder font-size-h1"><?php echo $donationStats["response"]["donationCount"]; ?></span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end">
                            <div class="flex-grow-1">
                               <i class="fas fa-users fa-5x icon-color"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder font-size-h4"><?php echo $lang->getString("receivedsofar"); ?></span>
                            </h3>
                            <div class="card-toolbar">
                                <span class="font-weight-bolder font-size-h1"><?php echo $donationStats["response"]["donationAmount"]; ?></span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end">
                            <div class="flex-grow-1">
                                <i class="fas fa-money-bill-wave fa-5x icon-color"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder font-size-h4 "><?php echo $lang->getString("clicks"); ?></span>
                            </h3>
                            <div class="card-toolbar">
                                <span class="font-weight-bolder font-size-h1"><?php echo $donationStats["response"]["clicks"]; ?></span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end">
                            <div class="flex-grow-1">
                                <i class="fas fa-mouse-pointer fa-5x icon-color"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="container">
			<div class="card card-custom gutter-b">
				<div class="card-header flex-wrap py-3">
					<div class="card-title">
						<h3 class="card-label"><?php echo $lang->getString("donationlinklist"); ?></h3>
					</div>
                       <div class="card-toolbar">
						<a href="#" class="btn btn-primary font-weight-bolder" type="button" id="link_create" data-toggle="modal" data-target="#link_create_modal"><?php echo $lang->getString("createlink"); ?></a>
					</div>
				</div>
				<div class="card-body table-responsive">
                <?php echo getloadinghtml("links_table_load", true); ?>
					<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="links_table" style="display:none">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo $lang->getString("name"); ?></th>
								<th><?php echo $lang->getString("link"); ?></th>
                                <th><?php echo $lang->getString("donationlinkdisplay"); ?></th>
								<th><?php echo $lang->getString("created"); ?></th>
                                <th><?php echo $lang->getString("actions"); ?></th>
							</tr>
						</thead>
                        <tbody>
                        </tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="card card-custom gutter-b">
				<div class="card-header flex-wrap py-3">
					<div class="card-title">
						<h3 class="card-label"><?php echo $lang->getString("latestdonations"); ?></h3>
					</div>
				</div>
				<div class="card-body table-responsive">
                <?php echo getloadinghtml("trans_table_load", true); ?>
					<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="trans_table" style="display:none">
    						<thead>
							<tr>
								<th><?php echo $lang->getString("ammount"); ?></th>
                                <th><?php echo $lang->getString("reference"); ?></th>
                                <th><?php echo $lang->getString("donationlinkname"); ?></th>
								<th><?php echo $lang->getString("date"); ?></th>
							</tr>
						</thead>
                        <tbody>
                        </tbody>
					</table>
				</div>
			</div>
</div>
    <div class="modal fade" id="link_create_modal" tabindex="-1" role="dialog" aria-labelledby="link_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="link_create_modalLabel"><?php echo $lang->getString("createlink"); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <label for="exampleSelect1"><?php echo $lang->getString("donationlinkname"); ?>:</label>
                    <input type="text" class="form-control" id="link_create_modal_link" placeholder="Link" >
                    <label for="exampleSelect1"><?php echo $lang->getString("donationlinkdisplay"); ?>:</label>
                    <input type="text" class="form-control" id="link_create_modal_display_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel"); ?></button>
                    <button type="button" class="btn btn-success" id="link_create_modal_button" onclick="createlink()"><?php echo $lang->getString("save"); ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="link_delete_modal" tabindex="-1" role="dialog" aria-labelledby="link_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="link_delete_modalLabel"><?php echo $lang->getString("donationlinkdeletemodalheader") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				    <?php echo $lang->getString("donationlinkdeletemodalinfo") ?><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-danger" id="link_delete_modal_button" onclick="deletelink()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") . '"></script>';

?>

<script>

    var donationBaseUrl = url + "donate/";
    var activeLinkId = 0;


    function getLinks() {
        $('#links_table').hide();
		$('#links_table_load').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getDonationLinks",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#links_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					buttons = '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openDelete(\'' + element.id + '\')\" title=\"<?php  echo $lang->getString("delete"); ?>\"><i class=\"fas fa-trash\"></i></button>';
					$('#links_table').DataTable().row.add( [
						element.id,
						element.name,
                        donationBaseUrl + element.name,
                        element.displayname,
						element.created_on,
						buttons
					] ).draw( false );
				});
				$('#links_table').show();
				$('#links_table_load').hide();
			}
		});
    }

    function getDonations() {
        $('#trans_table').hide();
		$('#trans_table_load').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getDonations",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#trans_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					$('#trans_table').DataTable().row.add( [
						element.amount,
						element.reason,
                        element.linkName,
						element.created_on
					] ).draw( false );
				});
				$('#trans_table').show();
				$('#trans_table_load').hide();
			}
		});
    }

    function openDelete(id) {
        activeLinkId = id;
        $('#link_delete_modal').modal('show');
    }

    function deletelink() {
		loadButton('#link_delete_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:activeLinkId},"deleteDonationLink",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("donationlinkdeleted") ?>');
				$('#link_delete_modal').modal('hide');
                getLinks();
			}
			loadButton('#link_delete_modal_button',false);
		});
    }

    function createlink() {
        name = $('#link_create_modal_link').val();
        displayName = $('#link_create_modal_display_name').val();
        loadButton('#link_create_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), name:name,displayName:displayName},"createDonationLink",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("donationlinkcreated") ?>');
				$('#link_create_modal').modal('hide');
                getLinks();
                $('#link_create_modal_link').val('');
                $('#link_create_modal_display_name').val('');
			}
			loadButton('#link_create_modal_button',false);
		});
    }


    $('#links_table').DataTable({
        "responsive": true,
        "paging": false,
        "order": false,
        "searching": false,
        "info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage");?>"
        }
    });
    $('#trans_table').DataTable({
        "responsive": true,
        "paging": false,
        "order": false,
        "searching": false,
        "info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage");?>"
        }
    });

    getLinks();
    getDonations();
</script>
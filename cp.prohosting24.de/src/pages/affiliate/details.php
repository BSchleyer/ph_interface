<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml(getheader($config, $lang->getString("affiliatesystem") . " - ProHosting24", $lang));


echo minifyhtml(getnormalbody($config, $lang->getString("affiliatesystem"), $user, $lang));


echo getloadinghtml("loading")


?>
<div id="pageMain" style="display:none">
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container" id="main">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 pt-6">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder font-size-h4"><?php  echo $lang->getString("registereduser"); ?></span>
                            </h3>
                            <div class="card-toolbar">
                                <span class="font-weight-bolder font-size-h1" id="registercount">0</span>
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
                                <span class="card-label font-weight-bolder font-size-h4"><?php  echo $lang->getString("paidout"); ?></span>
                            </h3>
                            <div class="card-toolbar">
                                <span class="font-weight-bolder font-size-h1" id="creditcount">0</span>
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
                                <span class="card-label font-weight-bolder font-size-h4 "><?php  echo $lang->getString("clicks"); ?></span>
                            </h3>
                            <div class="card-toolbar">
                                <span class="font-weight-bolder font-size-h1" id="clickcount">0</span>
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
	</div>
</div>


<div class="d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-custom gutter-b">
				<div class="card-header flex-wrap py-3">
					<div class="card-title">
						<h3 class="card-label"><?php  echo $lang->getString("createlink"); ?></h3>
					</div>
                       <div class="card-toolbar">
						<a href="#" class="btn btn-primary font-weight-bolder" type="button" id="link_create" data-toggle="modal" data-target="#link_create_modal"><?php  echo $lang->getString("createlink"); ?></a>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="links_table">
						<thead>
							<tr>
								<th>ID</th>
								<th><?php  echo $lang->getString("name"); ?></th>
								<th><?php  echo $lang->getString("link"); ?></th>
								<th><?php  echo $lang->getString("created"); ?></th>
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
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-custom gutter-b">
				<div class="card-header flex-wrap py-3">
					<div class="card-title">
						<h3 class="card-label"><?php  echo $lang->getString("affiliatetransactions"); ?></h3>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="trans_table">
						<thead>
							<tr>
								<th><?php  echo $lang->getString("ammount"); ?></th>
								<th><?php  echo $lang->getString("date"); ?></th>
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
    <div class="modal fade" id="link_create_modal" tabindex="-1" role="dialog" aria-labelledby="link_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="link_create_modalLabel"><?php  echo $lang->getString("createlink"); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <label for="exampleSelect1">Link:</label>
                    <input type="text" class="form-control" id="link_create_modal_link" placeholder="Link" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php  echo $lang->getString("cancel"); ?></button>
                    <button type="button" class="btn btn-success" id="link_create_modal_save" onclick="createlink()"><?php  echo $lang->getString("save"); ?></button>
                    <button class="btn btn-success" id="link_create_modal_save_load" type="button" aria-disabled="true" style="display:none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span >Loading...</span>
                </button>
                </div>
            </div>
        </div>
    </div>
<?php

echo minifyhtml(getscripts($config, $lang));

echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';

?>
<script>
var internapi = '<?php echo $config->getconfigvalue('internapi') ?>';
var url = '<?php echo $config->getconfigvalue('frontendurl')?>a/';
$('#pageMain').hide();
function loadaffiliate() {
    $('#load').show();
    $('#pageMain').hide();
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'affiliateinfos');
        },
        url: internapi,
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error(respond.error,'');
            } else {
                usercount = respond.response[1][0];
                $('#registercount').html(usercount);
                clicks = respond.response[1][1];
                $('#clickcount').html(clicks);
                paymentamount = respond.response[1][2];
                $('#creditcount').html(paymentamount.toFixed(2)+' €');
                links = respond.response[0][0];
                $('#links_table').DataTable().clear().draw();
                links.forEach(element => {
                    $('#links_table').DataTable().row.add( [
                        element.id,
                        element.link,
                        url + element.link,
                        element.created_on
                    ] ).draw( false );
                });
                $('#links_table').DataTable().draw();
                payments = respond.response[0][1];
                $('#trans_table').DataTable().clear().draw();
                payments.forEach(element => {
                    $('#trans_table').DataTable().row.add( [
                        parseFloat(element.amount).toFixed(2) + " €",
                        element.created_on
                    ] ).draw( false );
                });
                $('#trans_table').DataTable().draw();
                $('#loading').hide();
                $('#pageMain').show();
            }
        }
    });
}

function createlink(){
    name = $('#link_create_modal_link').val();
    if(name == ''){
        toastr.error("Bitte geben die einen Namen ein.",'');
        return; 
    }
    $('#link_create_modal_save').hide();
    $('#link_create_modal_save_load').show();
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'createlink');
        },
        url: internapi,
        data: { sessionid: Cookies.get('ph24_sessionid'), name:name},
        success: function(respond){
            if(respond.fail){
                toastr.error(respond.error,'');
            } else {
                loadaffiliate();
                $('#link_create_modal').modal('hide');
                toastr.success('Link erfolgreich erstellt','');
            }
            $('#link_create_modal_save').show();
            $('#link_create_modal_save_load').hide();
        }
    });
}

loadaffiliate();
var links_table = $('#links_table').DataTable({
        order: [[ 0, 'asc' ]],
        responsive: true,
        searching: false,
        paging:false,
        info: false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
    });
var trans_table = $('#trans_table').DataTable({
    order: [[ 0, 'asc' ]],
    responsive: true,
    searching: false,
    paging:true,
    info: false,
    "language": {
        "url": "<?php $lang->getString("datatablelanguage"); ?>"
    }
});
</script>

<?php

echo minifyhtml("</body></html>");

<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

$creditadd = requestBackend($config, [], "checkextracredit", $user->getLang())["response"];


echo minifyhtml(getheader($config, "Übersicht - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, "Übersicht", $user, $lang));

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
							<h3 class="card-title">Offene Positionen</h3>
						</div>
                            <div class="card-body">
                                <!--begin: Datatable-->
                                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <?php echo getloadinghtml("loading"); ?>
                                    <div id="master" style="display:none">
                                        <h3>Service Übersicht</h3>
                                        <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="hourly_table_service">
                                            <thead>
                                                <tr>
                                                    <th>Dienst</th>
                                                    <th>Informationen</th>
                                                    <th>Nutzung</th>
                                                    <th>Aktuelle Kosten</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <h3>Traffic Übersicht</h3>
                                        <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="hourly_table_traffic">
                                            <thead>
                                                <tr>
                                                    <th>Tag</th>
                                                    <th>Genutzter Traffic</th>
                                                    <th>Kosten</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div>
                                            Gesamte Kosten: <text id="invoice_sum"></text> €<br>
                                            Nächste Abrechnung: <text id="invoice_date"></text>
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


<?php
echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';
?>

<script>
	 function getStats(){
        requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getHourlyStatsHTML",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
                sum = respond.response.sum;
                date = respond.response.date;
                $('#invoice_sum').html(sum);
                $('#invoice_date').html(date);
                $('#hourly_table_service').DataTable().clear().draw();
                respond.response.list.forEach(element => {
                    $('#hourly_table_service').DataTable().row.add( [
                        "#" + element.id,
                        "Cpu Einheiten: " + element.count.cores + "<br>" + 
                        "Ram EInheiten: " + element.count.memory + "<br>" +
                        "Disk Einheiten: " + element.count.disk + "<br>" + 
                        "Backupslot Einheiten: " + element.count.backupslots + "<br>" + 
                        "Ipv4 Einheiten: " + element.count.ipv4 + "<br>" + 
                        "Ipv6 Einheiten: " + element.count.ipv6 + "<br>",
                        element.usage + " Stunden",
                        element.price + " €",
                    ] ).draw( false );
				});
                $('#hourly_table_traffic').DataTable().clear().draw();
                respond.response.traffic.forEach(element => {
                    $('#hourly_table_traffic').DataTable().row.add( [
                        element.date,
                        element.gb + " MB",
                        element.price + " €",
                    ] ).draw( false );
				});
                $('#loading').hide();
                $('#master').show();
			}
		});
    }
    $('#hourly_table_service').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'asc' ]],
		"searching": false,
		"info": false,
        "ordering": true,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
    $('#hourly_table_traffic').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'asc' ]],
		"searching": false,
		"info": false,
        "ordering": true,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
    getStats();
</script>
<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Rechte - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Rechte", $user));

echo minifyhtml('<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">');

echo minifyhtml('
<div class="row">
	<div class="col-xl-3">
        <div class="kt-portlet">
        	<div class="kt-portlet__head">
        		<div class="kt-portlet__head-label">
        			<h3 class="kt-portlet__head-title">Actions</h3>
        		</div>
        	</div>
            <div class="kt-portlet__body">
                <div class="col-xl-12">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#neuesrecht">
                        Neues Recht
                    </button>
                    <div class="modal fade" id="neuesrecht" tabindex="-1" role="dialog" aria-labelledby="neuesrechtLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="neuesrechtLabel">Neues Recht erstellen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>Name:</p>
                                    <input class="form-control" type="text" value="" id="rechtname">
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="rechterstellenbutton" class="btn btn-brand" onclick="rechterstellen()" >Erstellen</button>
                                    <button class="btn btn-primary" id="rechterstellenbutton_load" type="button" aria-disabled="true" style="display:none">
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
										<span >Loading...</span>
									</button>
			        			</div>
			        		</div>
			        	</div>
			        </div>
                </div>
        	</div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--mobile">
        	<div class="kt-portlet__head">
        		<div class="kt-portlet__head-label">
        			<h3 class="kt-portlet__head-title">
        				Rechte Übersicht
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml() . '
        		<table class="table table-striped-   table-hover" id="rechte_tabelle" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
        					<th>Name</th>
        					<th>Erstellt am</th>
        				</tr>
        			</thead>
        			<tbody>
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
</div>');

echo '</div>';

echo minifyhtml(getbodyfooter($config));

echo minifyhtml(getscripts($config));
if (isset($_COOKIE["ph24_notify_success"])) {
    echo minifyhtml("<script>toastr.success('" . $_COOKIE["ph24_notify_success"] . "','');Cookies.remove('ph24_notify_success');</script>");
}

echo getdatatables($config);

echo minifyhtml("
<script>
function getrechte(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getrights');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#rechte_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#rechte_tabelle').DataTable().row.add( [
                        element.id,
                        element.name,
                        element.created_on
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('rechte_tabelle').style.display = '';
            }
        }
    });
}
function rechterstellen() {
    document.getElementById('rechterstellenbutton').style.display = 'none';
    document.getElementById('rechterstellenbutton_load').style.display = '';
    name = $('#rechtname').val();
    if(name == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('rechterstellenbutton').style.display = '';
        document.getElementById('rechterstellenbutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'addright');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), name: name},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#neuesrecht').modal('hide');
                toastr.success('Recht erfolgreich erstellt','');
                document.getElementById('rechterstellenbutton').style.display = '';
                document.getElementById('rechterstellenbutton_load').style.display = 'none';
                getrechte();
            }
        }
    });
}
$('#rechte_tabelle').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
getrechte();
</script>
");
echo minifyhtml("</body></html>");

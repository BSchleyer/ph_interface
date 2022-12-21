<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Nodes - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Nodes", $user));

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#neuenode">
                        Neue Node
                    </button>
                    <div class="modal fade" id="neuenode" tabindex="-1" role="dialog" aria-labelledby="neuenodeLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="neuenodeLabel">Neue Node erstellen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>Name:</p>
                                    <input class="form-control" type="text" value="" id="nodename">
                                    <p>Hostname:</p>
                                    <input class="form-control" type="text" value="" id="hostname">
                                    <p>IP:</p>
                                    <input class="form-control" type="text" value="" id="ip">
                                    <p>Username:</p>
                                    <input class="form-control" type="text" value="" id="username">
                                    <p>Password:</p>
                                    <input class="form-control" type="password" value="" id="password">
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="nodeerstellenbutton" class="btn btn-brand" onclick="nodeerstellen()" >Erstellen</button>
                                    <button class="btn btn-primary" id="nodeerstellenbutton_load" type="button" aria-disabled="true" style="display:none">
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
        				Node Übersicht
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml() . '
        		<table class="table table-striped-   table-hover" id="nodes_tabelle" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
                            <th>Name</th>
                            <th>Hostname</th>
                            <th>IP</th>
                            <th>Username</th>
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
echo getdatatables($config);

echo minifyhtml("
<script>
function getnodes(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getnodes');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#nodes_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#nodes_tabelle').DataTable().row.add( [
                        element.id,
                        element.name,
                        element.hostname,
                        element.ip,
                        element.username,
                        element.created_on
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('nodes_tabelle').style.display = '';
            }
        }
    });
}
function nodeerstellen() {
    document.getElementById('nodeerstellenbutton').style.display = 'none';
    document.getElementById('nodeerstellenbutton_load').style.display = '';
    name = $('#nodename').val();
    if(name == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('nodeerstellenbutton').style.display = '';
        document.getElementById('nodeerstellenbutton_load').style.display = 'none';
        return;
    }
    hostname = $('#hostname').val();
    if(hostname == ''){
        toastr.error('Der Hostname darf nicht leer sein','Fehler');
        document.getElementById('nodeerstellenbutton').style.display = '';
        document.getElementById('nodeerstellenbutton_load').style.display = 'none';
        return;
    }
    ip = $('#ip').val();
    if(ip == ''){
        toastr.error('Die IP darf nicht leer sein','Fehler');
        document.getElementById('nodeerstellenbutton').style.display = '';
        document.getElementById('nodeerstellenbutton_load').style.display = 'none';
        return;
    }
    username = $('#username').val();
    if(username == ''){
        toastr.error('Der Username darf nicht leer sein','Fehler');
        document.getElementById('nodeerstellenbutton').style.display = '';
        document.getElementById('nodeerstellenbutton_load').style.display = 'none';
        return;
    }
    password = $('#password').val();
    if(password == ''){
        toastr.error('Das Passwort darf nicht leer sein','Fehler');
        document.getElementById('nodeerstellenbutton').style.display = '';
        document.getElementById('nodeerstellenbutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'createnode');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), name: name, hostname: hostname, ip: ip, username: username, password: password},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#neuenode').modal('hide');
                toastr.success('Node erfolgreich erstellt','');
                document.getElementById('nodeerstellenbutton').style.display = '';
                document.getElementById('nodeerstellenbutton_load').style.display = 'none';
                getnodes();
            }
        }
    });
}
$('#nodes_tabelle').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
getnodes();
</script>
");
echo minifyhtml("</body></html>");

<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Gruppen - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Gruppen", $user));

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#neuegruppe">
                        Neue Gruppe
                    </button>
                    <div class="modal fade" id="neuegruppe" tabindex="-1" role="dialog" aria-labelledby="neuegruppeLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="neuegruppeLabel">Neue Gruppe erstellen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>Name:</p>
                                    <input class="form-control" type="text" value="" id="gruppenname">
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="gruppeerstellenbutton" class="btn btn-brand" onclick="gruppeerstellen()" >Erstellen</button>
                                    <button class="btn btn-primary" id="gruppeerstellenbutton_load" type="button" aria-disabled="true" style="display:none">
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
        				Gruppen Übersicht
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml() . '
        		<table class="table table-striped-   table-hover" id="gruppen_tabelle" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
        					<th>Name</th>
                            <th>Erstellt am</th>
                            <th>Actions</th>
        				</tr>
        			</thead>
        			<tbody>
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
    <div class="modal fade" id="editgroup" tabindex="-1" role="dialog" aria-labelledby="editgroupLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editgroupLabel">Gruppe bearbeiten</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    <p>Name:</p>
                    <input class="form-control" type="text" value="" id="edit_gruppenname">
                    <input type="hidden" value="" id="edit_id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="button" id="gruppeeditierenbutton" class="btn btn-brand" onclick="gruppenedit()" >Speichern</button>
                    <button class="btn btn-primary" id="gruppeeditierenbutton_load" type="button" aria-disabled="true" style="display:none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						<span >Loading...</span>
					</button>
				</div>
			</div>
		</div>
    </div>
    <div class="modal fade" id="deletegroup" tabindex="-1" role="dialog" aria-labelledby="deletegroupLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deletegroupLabel">Gruppe Löschen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    Sind Sie sich sicher, dass Sie diese Gruppe <text id="deletegruppenname"></text> löschen wollen?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-brand" data-dismiss="modal">Abrechen</button>
                    <button type="button" id="gruppendeletebutton" class="btn btn-outline-danger" onclick="gruppendelete()" >Löschen</button>
                    <button class="btn btn-outline-danger" id="gruppendeletebutton_load" type="button" aria-disabled="true" style="display:none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						<span >Loading...</span>
					</button>
				</div>
			</div>
		</div>
    </div>

    <div class="col-xl-12" id="rechtezugruppendiv" style="display:none">
        <div class="kt-portlet kt-portlet--mobile">
        	<div class="kt-portlet__head">
        		<div class="kt-portlet__head-label">
        			<h3 class="kt-portlet__head-title">
        				Rechte zur Gruppe <text id="rechtzugruppename"></text>
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml("load_gruppenzurechte") . '
        		<table class="table table-striped-   table-hover" id="rechtezugruppen_tabelle" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
        					<th>Name</th>
                            <th>Actions</th>
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
var delteid = 0;
var aktivegroupid = 0;
function openeditgroup(id,name){
    $('#edit_gruppenname').val(name);
    $('#edit_id').val(id);
    $('#editgroup').modal('show');
}

function opendeletegroup(id,name){
    $('#deletegruppenname').html(name);
    delteid = id;
    $('#deletegroup').modal('show');
}

function gotorechtetogroup(id,name){
    $('#rechtzugruppename').html(name);
    aktivegroupid = id;
    document.getElementById('rechtezugruppendiv').style.display = '';
    getrechtezugruppen();
}

function addright(id){
    $('#recht_' + id).html('<button type=\"button\" onclick=\"removeright(' + id + ')\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\"><i class=\"fas fa-trash-alt\" title=\"Recht entfernen\"></i></button>');
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'addrighttogroup');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'),rightid:id,groupid:aktivegroupid},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            }
            toastr.success('Recht erfolgreich hinzugefügt','');
        }
    });
}

function removeright(id){
    $('#recht_' + id).html('<button type=\"button\" onclick=\"addright(' + id + ')\" class=\"btn btn-outline-success btn-elevate btn-circle btn-icon\"><i class=\"fas fa-plus-circle\" title=\"Recht hinzufügen\"></i></button>');
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'removerighttogroup');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'),rightid:id,groupid:aktivegroupid},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            }
            toastr.success('Recht erfolgreich entfernt','');
        }
    });
}

function getrechtezugruppen(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getrechtezugruppen');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'),groupid:aktivegroupid},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#rechtezugruppen_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    if(element.has){
                        button = '<text id=\"recht_' + element.id + '\" ><button type=\"button\" onclick=\"removeright(' + element.id + ')\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\"><i class=\"fas fa-trash-alt\" title=\"Recht entfernen\"></i></button></text>&nbsp;';
                    } else {
                        button = '<text id=\"recht_' + element.id + '\" ><button type=\"button\" onclick=\"addright(' + element.id + ')\" class=\"btn btn-outline-success btn-elevate btn-circle btn-icon\"><i class=\"fas fa-plus-circle\" title=\"Recht hinzufügen\"></i></button></text>&nbsp;';
                    }
                    $('#rechtezugruppen_tabelle').DataTable().row.add( [
                        element.id,
                        element.name,
                        button,
                    ] ).draw( false );
                });
                document.getElementById('load_gruppenzurechte').style.display = 'none';
                document.getElementById('rechtezugruppen_tabelle').style.display = '';
            }
        }
    });
}



function getgruppen(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getgroups');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#gruppen_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#gruppen_tabelle').DataTable().row.add( [
                        element.id,
                        element.name,
                        element.created_on,
                        '<button type=\"button\" onclick=\"openeditgroup(' + element.id + ',\'' + element.name + '\')\" class=\"btn btn-outline-primary btn-elevate btn-circle btn-icon\"><i class=\"fas fa-cog\"></i></button>&nbsp;' +
                        '<button type=\"button\" onclick=\"opendeletegroup(' + element.id + ',\'' + element.name + '\')\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\"><i class=\"fas fa-trash-alt\"></i></button>&nbsp;' +
                        '<button type=\"button\" onclick=\"gotorechtetogroup(' + element.id + ',\'' + element.name + '\')\" class=\"btn btn-outline-focus btn-elevate btn-circle btn-icon\"><i class=\"fas fa-users-cog\"></i></button>',
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('gruppen_tabelle').style.display = '';
            }
        }
    });
}

function gruppendelete() {
    document.getElementById('gruppendeletebutton').style.display = 'none';
    document.getElementById('gruppendeletebutton_load').style.display = '';
    if(delteid == ''){
        toastr.error('Die Id darf nicht leer sein','Fehler');
        document.getElementById('gruppendeletebutton').style.display = '';
        document.getElementById('gruppendeletebutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'deletegroup');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), id: delteid},
        success: function(respond){
            if(respond.fail){
                toastr.error(respond.error,'');
                document.getElementById('gruppendeletebutton').style.display = '';
                document.getElementById('gruppendeletebutton_load').style.display = 'none';
            } else {
                $('#deletegroup').modal('hide');
                toastr.success('Gruppe erfolgreich gelöscht','');
                document.getElementById('gruppendeletebutton').style.display = '';
                document.getElementById('gruppendeletebutton_load').style.display = 'none';
                getgruppen();
                $('#deletegruppenname').html('');
            }
        }
    });
}


function gruppenedit() {
    document.getElementById('gruppeeditierenbutton').style.display = 'none';
    document.getElementById('gruppeeditierenbutton_load').style.display = '';
    name = $('#edit_gruppenname').val();
    if(name == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('gruppeeditierenbutton').style.display = '';
        document.getElementById('gruppeeditierenbutton_load').style.display = 'none';
        return;
    }
    id = $('#edit_id').val();
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'editgroup');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), name: name, id: id},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#editgroup').modal('hide');
                toastr.success('Gruppe erfolgreich erstellt','');
                document.getElementById('gruppeeditierenbutton').style.display = '';
                document.getElementById('gruppeeditierenbutton_load').style.display = 'none';
                getgruppen();
                $('#edit_gruppenname').val('');
                $('#edit_id').val('');
            }
        }
    });
}

function gruppeerstellen() {
    document.getElementById('gruppeerstellenbutton').style.display = 'none';
    document.getElementById('gruppeerstellenbutton_load').style.display = '';
    name = $('#gruppenname').val();
    if(name == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('gruppeerstellenbutton').style.display = '';
        document.getElementById('gruppeerstellenbutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'addgroup');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), name: name},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#neuegruppe').modal('hide');
                toastr.success('Gruppe erfolgreich erstellt','');
                document.getElementById('gruppeerstellenbutton').style.display = '';
                document.getElementById('gruppeerstellenbutton_load').style.display = 'none';
                getgruppen();
                $('#gruppenname').val('');
            }
        }
    });
}
$('#gruppen_tabelle').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
$('#rechtezugruppen_tabelle').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
getgruppen();
</script>
");
echo minifyhtml("</body></html>");

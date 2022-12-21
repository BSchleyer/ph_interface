<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "VServer Pakete - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "VServer Pakete", $user));

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#neuepacket">
                        Neues Paket
                    </button>
                    <div class="modal fade" id="neuepacket" tabindex="-1" role="dialog" aria-labelledby="neuepacketLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="neuepacketLabel">Neues Paket anlegen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>SortId:</p>
                                    <input class="form-control" type="text" value="" id="sortid">
                                    <p>Title:</p>
                                    <input class="form-control" type="text" value="" id="title">
                                    <p>Beschreibung:</p>
                                    <input class="form-control" type="text" value="" id="description">
                                    <p>Cores:</p>
                                    <input class="form-control" type="number" value="" id="cores">
                                    <p>Memory:</p>
                                    <input class="form-control" type="number" value="" id="memory">
                                    <p>Disk:</p>
                                    <input class="form-control" type="number" value="" id="disk">
                                    <p>Price:</p>
                                    <input class="form-control" type="number" value="" id="price">
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="createpacketbutton" class="btn btn-brand" onclick="createpacket()" >Erstellen</button>
                                    <button class="btn btn-primary" id="createpacketbutton_load" type="button" aria-disabled="true" style="display:none">
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
        		<table class="table table-striped-   table-hover" id="vserverpackets_tabelle" style="display:none">
        			<thead>
        				<tr>
                            <th>SortID</th>
                            <th>Title</th>
                            <th>Cores</th>
                            <th>Memory</th>
                            <th>Disk</th>
                            <th>Preis</th>
                            <th>Erstellt am</th>
                            <th>Aktionen</th>
        				</tr>
        			</thead>
        			<tbody>
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
    <div class="modal fade" id="editpacket" tabindex="-1" role="dialog" aria-labelledby="editpacketLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editpacketLabel">Paket bearbeiten</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    <p>SortId:</p>
                    <input class="form-control" type="text" value="" id="edit_sortid">
                    <p>Title:</p>
                    <input class="form-control" type="text" value="" id="edit_title">
                    <p>Beschreibung:</p>
                    <input class="form-control" type="text" value="" id="edit_description">
                    <p>Cores:</p>
                    <input class="form-control" type="number" value="" id="edit_cores">
                    <p>Memory:</p>
                    <input class="form-control" type="number" value="" id="edit_memory">
                    <p>Disk:</p>
                    <input class="form-control" type="number" value="" id="edit_disk">
                    <p>Price:</p>
                    <input class="form-control" type="number" value="" id="edit_price">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="button" id="savepacketbutton" class="btn btn-brand" onclick="savepacket()" >Speichern</button>
                    <button class="btn btn-primary" id="savepacketbutton_load" type="button" aria-disabled="true" style="display:none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						<span >Loading...</span>
					</button>
				</div>
			</div>
		</div>
    </div>
    <div class="modal fade" id="deletepacket" tabindex="-1" role="dialog" aria-labelledby="deletepacketLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deletepacketLabel">Paket löschen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    <h2>Warnung!</h2>
                    Die Löschung dieser Paket Konfiguration wird allen betroffenen Kunden Server in Konfigurierbare Server umwandeln.
                    Der ändert sich erst bei Up- oder Downgrade.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>
                    <button type="button" id="deletepacketbutton" class="btn btn-outline-danger" onclick="deletepacket()" >Löschen</button>
                    <button class="btn btn-outline-danger" id="deletepacketbutton_load" type="button" aria-disabled="true" style="display:none">
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						<span >Loading...</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>');

echo '</div>';

echo minifyhtml(getbodyfooter($config));

echo minifyhtml(getscripts($config));
echo getdatatables($config);

?>
<script>
packets = [];
currenteditid = 0;
function getpackets(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getpackets');
        },
        url: '<?php echo $config->getconfigvalue('internapi') ?>',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#vserverpackets_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    packets[element.id] = element;
                    editbutton = '<button type="button" class="btn btn-outline-brand btn-elevate btn-circle btn-icon" onclick="openedit(' + element.id + ')"><i class="fas fa-edit"></i></button>';
                    deletebutton = '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"opendelete(' + element.id + ')\"><i class="fas fa-trash-alt"></i></button>';
                    $('#vserverpackets_tabelle').DataTable().row.add( [
                        element.sortid,
                        element.title,
                        element.cores,
                        element.memory,
                        element.disk,
                        element.price,
                        element.created_on,
                        editbutton + ' ' + deletebutton
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('vserverpackets_tabelle').style.display = '';
            }
        }
    });
}
function createpacket() {
    document.getElementById('createpacketbutton').style.display = 'none';
    document.getElementById('createpacketbutton_load').style.display = '';
    sortid = $('#sortid').val();
    if(sortid == ''){
        toastr.error('Die SortId darf nicht leer sein','Fehler');
        document.getElementById('createpacketbutton').style.display = '';
        document.getElementById('createpacketbutton_load').style.display = 'none';
        return;
    }
    title = $('#title').val();
    if(title == ''){
        toastr.error('Der Titel darf nicht leer sein','Fehler');
        document.getElementById('createpacketbutton').style.display = '';
        document.getElementById('createpacketbutton_load').style.display = 'none';
        return;
    }
    description = $('#description').val();
    if(description == ''){
        toastr.error('Die Beschreibung darf nicht leer sein','Fehler');
        document.getElementById('createpacketbutton').style.display = '';
        document.getElementById('createpacketbutton_load').style.display = 'none';
        return;
    }
    cores = $('#cores').val();
    if(cores == ''){
        toastr.error('Cores ist empty','Fehler');
        document.getElementById('createpacketbutton').style.display = '';
        document.getElementById('createpacketbutton_load').style.display = 'none';
        return;
    }
    memory = $('#memory').val();
    if(memory == ''){
        toastr.error('Memory ist empty','Fehler');
        document.getElementById('createpacketbutton').style.display = '';
        document.getElementById('createpacketbutton_load').style.display = 'none';
        return;
    }
    disk = $('#disk').val();
    if(disk == ''){
        toastr.error('Disk ist empty','Fehler');
        document.getElementById('createpacketbutton').style.display = '';
        document.getElementById('createpacketbutton_load').style.display = 'none';
        return;
    }
    price = $('#price').val();
    if(price == ''){
        toastr.error('Price ist empty','Fehler');
        document.getElementById('createpacketbutton').style.display = '';
        document.getElementById('createpacketbutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'createpacket');
        },
        url: '<?php echo $config->getconfigvalue('internapi') ?>',
        data: { sessionid: Cookies.get('ph24_sessionid'), sortid: sortid, title: title, description: description, cores: cores, memory: memory, disk: disk, price: price},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#neuepacket').modal('hide');
                toastr.success('Paket erfolgreich erstellt','');
                document.getElementById('createpacketbutton').style.display = '';
                document.getElementById('createpacketbutton_load').style.display = 'none';
                getpackets();
            }
        }
    });
}

function openedit(id){
    $('#edit_sortid').val(packets[id].sortid);
    $('#edit_title').val(packets[id].title);
    $('#edit_description').val(packets[id].description);
    $('#edit_cores').val(packets[id].cores);
    $('#edit_memory').val(packets[id].memory);
    $('#edit_disk').val(packets[id].disk);
    $('#edit_price').val(packets[id].price);
    currenteditid = id;
    $('#editpacket').modal('show');
}

function savepacket(){
    document.getElementById('savepacketbutton').style.display = 'none';
    document.getElementById('savepacketbutton_load').style.display = '';
    sortid = $('#edit_sortid').val();
    if(sortid == ''){
        toastr.error('Die SortId darf nicht leer sein','Fehler');
        document.getElementById('savepacketbutton').style.display = '';
        document.getElementById('savepacketbutton_load').style.display = 'none';
        return;
    }
    title = $('#edit_title').val();
    if(title == ''){
        toastr.error('Der Titel darf nicht leer sein','Fehler');
        document.getElementById('savepacketbutton').style.display = '';
        document.getElementById('savepacketbutton_load').style.display = 'none';
        return;
    }
    description = $('#edit_description').val();
    if(description == ''){
        toastr.error('Die Beschreibung darf nicht leer sein','Fehler');
        document.getElementById('savepacketbutton').style.display = '';
        document.getElementById('savepacketbutton_load').style.display = 'none';
        return;
    }
    cores = $('#edit_cores').val();
    if(cores == ''){
        toastr.error('Cores ist empty','Fehler');
        document.getElementById('savepacketbutton').style.display = '';
        document.getElementById('savepacketbutton_load').style.display = 'none';
        return;
    }
    memory = $('#edit_memory').val();
    if(memory == ''){
        toastr.error('Memory ist empty','Fehler');
        document.getElementById('savepacketbutton').style.display = '';
        document.getElementById('savepacketbutton_load').style.display = 'none';
        return;
    }
    disk = $('#edit_disk').val();
    if(disk == ''){
        toastr.error('Disk ist empty','Fehler');
        document.getElementById('savepacketbutton').style.display = '';
        document.getElementById('savepacketbutton_load').style.display = 'none';
        return;
    }
    price = $('#edit_price').val();
    if(price == ''){
        toastr.error('Price ist empty','Fehler');
        document.getElementById('savepacketbutton').style.display = '';
        document.getElementById('savepacketbutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'editpacket');
        },
        url: '<?php echo $config->getconfigvalue('internapi') ?>',
        data: { sessionid: Cookies.get('ph24_sessionid'), id: currenteditid,sortid: sortid, title: title, description: description, cores: cores, memory: memory, disk: disk, price: price},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#editpacket').modal('hide');
                toastr.success('Paket erfolgreich bearbeitet','');
                document.getElementById('savepacketbutton').style.display = '';
                document.getElementById('savepacketbutton_load').style.display = 'none';
                getpackets();
            }
        }
    });
}

function opendelete(id){
    currenteditid = id;
    $('#deletepacket').modal('show');
}

function deletepacket(){
    document.getElementById('deletepacketbutton').style.display = 'none';
    document.getElementById('deletepacketbutton_load').style.display = '';
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'deletepacket');
        },
        url: '<?php echo $config->getconfigvalue('internapi') ?>',
        data: { sessionid: Cookies.get('ph24_sessionid'), id: currenteditid},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#deletepacket').modal('hide');
                toastr.success('Paket erfolgreich gelöscht','');
                document.getElementById('deletepacketbutton').style.display = '';
                document.getElementById('deletepacketbutton_load').style.display = 'none';
                getpackets();
            }
        }
    });
}
$('#vserverpackets_tabelle').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
getpackets();
</script>
<?php
echo minifyhtml("</body></html>");

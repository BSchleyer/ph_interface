<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Images - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Images", $user));

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#neuesimage">
                        Neues Image
                    </button>
                    <div class="modal fade" id="neuesimage" tabindex="-1" role="dialog" aria-labelledby="neuesimageLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="neuesimageLabel">Neues Image erstellen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>InternId:</p>
                                    <input class="form-control" type="number" value="" id="internid">
                                    <p>Name:</p>
                                    <input class="form-control" type="text" value="" id="name">
                                    <p>Icon:</p>
                                    <input class="form-control" type="text" value="" id="icon">
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="imageerstellenbutton" class="btn btn-brand" onclick="imageerstellen()" >Erstellen</button>
                                    <button class="btn btn-primary" id="imageerstellenbutton_load" type="button" aria-disabled="true" style="display:none">
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
        		<table class="table table-striped-   table-hover" id="images_tabelle" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
                            <th>InternId</th>
                            <th>Name</th>
                            <th>Icon</th>
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
function getimages(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getimages');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#images_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#images_tabelle').DataTable().row.add( [
                        element.id,
                        element.intern_id,
                        element.name,
                        element.icon,
                        element.created_on
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('images_tabelle').style.display = '';
            }
        }
    });
}
function imageerstellen() {
    document.getElementById('imageerstellenbutton').style.display = 'none';
    document.getElementById('imageerstellenbutton_load').style.display = '';
    internid = $('#internid').val();
    if(internid == ''){
        toastr.error('Die Internid darf nicht leer sein','Fehler');
        document.getElementById('imageerstellenbutton').style.display = '';
        document.getElementById('imageerstellenbutton_load').style.display = 'none';
        return;
    }
    name = $('#name').val();
    if(name == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('imageerstellenbutton').style.display = '';
        document.getElementById('imageerstellenbutton_load').style.display = 'none';
        return;
    }
    icon = $('#icon').val();
    if(icon == ''){
        toastr.error('Das Icon darf nicht leer sein','Fehler');
        document.getElementById('imageerstellenbutton').style.display = '';
        document.getElementById('imageerstellenbutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'createimage');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), internid: internid, name: name,icon:icon},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#neuesimage').modal('hide');
                toastr.success('Image erfolgreich erstellt','');
                document.getElementById('imageerstellenbutton').style.display = '';
                document.getElementById('imageerstellenbutton_load').style.display = 'none';
                getimages();
            }
        }
    });
}
$('#images_tabelle').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
getimages();
</script>
");
echo minifyhtml("</body></html>");

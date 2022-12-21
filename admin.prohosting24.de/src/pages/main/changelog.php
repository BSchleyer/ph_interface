<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Changelog - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Changelog", $user));

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newchangelog">
                        Neuer Changelog
                    </button>
                    <div class="modal fade" id="newchangelog" tabindex="-1" role="dialog" aria-labelledby="newchangelogLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="newchangelogLabel">Neues Recht erstellen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>Header:</p>
                                    <input class="form-control" type="text" value="" id="changelog_header">
                                    <p>Content:</p>
                                    <textarea class="summernote-simple" name="changelog_content" id="changelog_content"></textarea>
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="createchangelogbutton" class="btn btn-brand" onclick="createchangelog()" >Erstellen</button>
                                    <button class="btn btn-primary" id="createchangelogbutton_load" type="button" aria-disabled="true" style="display:none">
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
        		<table class="table table-striped-   table-hover" id="changelog_table" style="display:none">
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
function getchangelog(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getchangelog');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#changelog_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#changelog_table').DataTable().row.add( [
                        element.id,
                        element.header,
                        element.created_on
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('changelog_table').style.display = '';
            }
        }
    });
}
function createchangelog() {
    document.getElementById('createchangelogbutton').style.display = 'none';
    document.getElementById('createchangelogbutton_load').style.display = '';
    header = $('#changelog_header').val();
    if(header == ''){
        toastr.error('Der Header darf nicht leer sein','Fehler');
        document.getElementById('createchangelogbutton').style.display = '';
        document.getElementById('createchangelogbutton_load').style.display = 'none';
        return;
    }
    content = $('#changelog_content').val();
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'addchangelog');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), header: header,content:content},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#newchangelog').modal('hide');
                toastr.success('Changelog erfolgreich erstellt','');
                document.getElementById('createchangelogbutton').style.display = '';
                document.getElementById('createchangelogbutton_load').style.display = 'none';
                getchangelog();
            }
        }
    });
}
$('#changelog_table').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
getchangelog();
$('.summernote-simple').summernote({minHeight: 250,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
    ]
    });
</script>
");
echo minifyhtml("</body></html>");

<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Email - Templates - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Email - Templates", $user));

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#neuestemplate">
                        Neues Template
                    </button>
                    <div class="modal fade" id="neuestemplate" tabindex="-1" role="dialog" aria-labelledby="neuestemplateLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="neuestemplateLabel">Neues Tenplate erstellen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>Name:</p>
                                    <input class="form-control" type="text" value="" id="templatename">
                                    <br>
                                    <p>Titel:</p>
                                    <input class="form-control" type="text" value="" id="templatetitel">
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="templateerstellenbutton" class="btn btn-brand" onclick="templateerstellen()" >Erstellen</button>
                                    <button class="btn btn-primary" id="templateerstellenbutton_load" type="button" aria-disabled="true" style="display:none">
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
        				Templates Übersicht
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml() . '
        		<table class="table table-striped-   table-hover" id="template_tabelle" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
        					<th>Name</th>
                            <th>Titel</th>
                            <th>Aktionen</th>
                            <th>Erstellt</th>
        				</tr>
        			</thead>
        			<tbody>
        			</tbody>
        		</table>
        	</div>
        </div>
        <div class="modal fade" id="edittemplate" tabindex="-1" role="dialog" aria-labelledby="edittemplateLabel" aria-hidden="true">
		    <div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
		    		<div class="modal-header">
		    			<h5 class="modal-title" id="edittemplateLabel">Template Editieren</h5>
		    			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    				<span aria-hidden="true">&times;</span>
		    			</button>
		    		</div>
                    <div class="modal-body">
                        <p>Name:</p>
                        <input class="form-control" type="text" value="" id="edit_templatename">
                        <br>
                        <p>Titel:</p>
                        <input class="form-control" type="text" value="" id="edit_templatetitel">
                        <br>
                        <p>Inhalt:</p>
                        <div id="templatedata">
                        </div>
                        <br>
                        <p>Inhalt ohne HTML:</p>
                        <div id="templatedatanohtml">
                        </div>
		    		</div>
		    		<div class="modal-footer">
		    			<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="button" id="templatesavebutton" class="btn btn-brand" onclick="templatesave()" >Speichern</button>
                        <button class="btn btn-primary" id="templatesavebutton_load" type="button" aria-disabled="true" style="display:none">
		    				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
		    				<span >Loading...</span>
		    			</button>
		    		</div>
		    	</div>
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
echo minifyhtml('
<style>
#templatedata {
    margin: auto;
    height: 400px;
    width: 90%;
    font-size: 18px!important;
}
#templatedatanohtml {
    margin: auto;
    height: 400px;
    width: 90%;
    font-size: 18px!important;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/ace.js" integrity="sha256-5Xkhn3k/1rbXB+Q/DX/2RuAtaB4dRRyQvMs83prFjpM=" crossorigin="anonymous"></script>');

echo "
<script>
var editor = ace.edit('templatedata');
editor.session.setMode('ace/mode/html');
var editornohtml = ace.edit('templatedatanohtml');
editornohtml.session.setMode('ace/mode/text');
currenttemplate = 0;
function gettemplates(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'gettemplates');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#template_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#template_tabelle').DataTable().row.add( [
                        element.id,
                        element.name,
                        element.title,
                        '<button type=\"button\" onclick=\"gettemplate(' + element.id + ')\" class=\"btn btn-outline-primary btn-elevate btn-circle btn-icon\"><i class=\"fas fa-cog\"></i></button>&nbsp;',
                        element.created_on
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('template_tabelle').style.display = '';
            }
        }
    });
}

function gettemplate(id){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'gettemplate');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'),id:id},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#edittemplate').modal('show');
                currenttemplate = id;
                $('#edit_templatename').val(respond.response[0].name);
                $('#edit_templatetitel').val(respond.response[0].title);
                editor.setValue(respond.response[0].data);
                editornohtml.setValue(respond.response[0].data_nohtml);
            }
        }
    });
}

function templatesave() {
    document.getElementById('templatesavebutton').style.display = 'none';
    document.getElementById('templatesavebutton_load').style.display = '';
    name = $('#edit_templatename').val();
    if(name == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('templatesavebutton').style.display = '';
        document.getElementById('templatesavebutton_load').style.display = 'none';
        return;
    }
    title = $('#edit_templatetitel').val();
    if(title == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('templatesavebutton').style.display = '';
        document.getElementById('templatesavebutton_load').style.display = 'none';
        return;
    }
    data = editor.getValue();
    if(data == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('templatesavebutton').style.display = '';
        document.getElementById('templatesavebutton_load').style.display = 'none';
        return;
    }
    data_nohtml = editornohtml.getValue();
    if(data_nohtml == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('templatesavebutton').style.display = '';
        document.getElementById('templatesavebutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'updatetemplate');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), id:currenttemplate,name: name, title: title, data: data, date_nohtml: data_nohtml},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#edittemplate').modal('hide');
                toastr.success('Template erfolgreich erstellt','');
                document.getElementById('templatesavebutton').style.display = '';
                document.getElementById('templatesavebutton_load').style.display = 'none';
                gettemplates();
            }
        }
    });
}

function templateerstellen() {
    document.getElementById('templateerstellenbutton').style.display = 'none';
    document.getElementById('templateerstellenbutton_load').style.display = '';
    name = $('#templatename').val();
    if(name == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('templateerstellenbutton').style.display = '';
        document.getElementById('templateerstellenbutton_load').style.display = 'none';
        return;
    }
    title = $('#templatetitel').val();
    if(title == ''){
        toastr.error('Der Name darf nicht leer sein','Fehler');
        document.getElementById('templateerstellenbutton').style.display = '';
        document.getElementById('templateerstellenbutton_load').style.display = 'none';
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'addtemplate');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), name: name, title: title, data: 'Edit Me', date_nohtml: 'Edit Me'},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#neuestemplate').modal('hide');
                toastr.success('Template erfolgreich erstellt','');
                document.getElementById('templateerstellenbutton').style.display = '';
                document.getElementById('templateerstellenbutton_load').style.display = 'none';
                gettemplates();
            }
        }
    });
}

$('#template_tabelle').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});


gettemplates();
</script>
";
echo minifyhtml("</body></html>");

<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Discount - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Discount", $user));

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newdiscount">
                        Neuer Discount Code
                    </button>
                    <div class="modal fade" id="newdiscount" tabindex="-1" role="dialog" aria-labelledby="newdiscountLabel" aria-hidden="true">
			        	<div class="modal-dialog" role="document">
			        		<div class="modal-content">
			        			<div class="modal-header">
			        				<h5 class="modal-title" id="newdiscountLabel">Neuen Rabattcode erstellen</h5>
			        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        					<span aria-hidden="true">&times;</span>
			        				</button>
			        			</div>
                                <div class="modal-body">
                                    <p>Code:</p>
                                    <input class="form-control" type="text" value="" id="discount_code">
                                    <p>Nutzungen:</p>
                                    <input class="form-control" type="number" value="" id="discount_count">
                                    <p>Type:</p>
                                    <select class="form-control" id="discount_type" onchange="switchtype()">
										<option value="0">Geld</option>
										<option value="1">Produkt</option>
										<option value="2">Einmaliger Rabatt</option>
										<option value="3">Dauerhafter Rabatt</option>
                                    </select>
                                    <div id="discount_money_div">
                                        <p>Geld:</p>
                                        <input class="form-control" type="number" value="" id="discount_money">
                                    </div>
                                    <div id="discount_prozent_div">
                                        <p>Prozent:</p>
                                        <input class="form-control" type="number" value="" id="discount_prozent">
                                    </div>
                                    <div id="discount_product_div">
                                        <p>Produkt:</p>
                                        <select class="form-control" id="discount_product">
                                            <option value="1">KVM Server</option>
                                            <option value="100">KVM Server Packet</option>
                                            <option value="2">Webspace</option>
                                            <option value="5">Ptero/option>
                                        </select>
                                    </div>
			        			</div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    <button type="button" id="creatediscountcodebutton" class="btn btn-brand" onclick="creatediscountcode()" >Erstellen</button>
                                    <button class="btn btn-primary" id="creatediscountcodebutton_load" type="button" aria-disabled="true" style="display:none">
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
        		<table class="table table-striped-   table-hover" id="discount_table" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
        					<th>Code</th>
                            <th>Uses Left</th>
                            <th>Type</th>
                            <th>Erstellt</th>
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
function getalldiscounts(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getalldiscounts');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#discount_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#discount_table').DataTable().row.add( [
                        element.id,
                        element.code,
                        element.count,
                        element.type,
                        element.created_on
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('discount_table').style.display = '';
            }
        }
    });
}
function switchtype(){
    $('#discount_money_div').hide();
    $('#discount_prozent_div').hide();
    $('#discount_product_div').hide();
    switch($('#discount_type option:selected').val()){
        case '0':
            $('#discount_money_div').show();
        break;
        case '2':
            $('#discount_prozent_div').show();
            $('#discount_product_div').show();
        break;
        case '3':
            $('#discount_prozent_div').show();
            $('#discount_product_div').show();
        break;
    }
}
function creatediscountcode() {
    document.getElementById('creatediscountcodebutton').style.display = 'none';
    document.getElementById('creatediscountcodebutton_load').style.display = '';
    discount_code = $('#discount_code').val();
    if(discount_code == ''){
        toastr.error('Der Code darf nicht leer sein','Fehler');
        document.getElementById('creatediscountcodebutton').style.display = '';
        document.getElementById('creatediscountcodebutton_load').style.display = 'none';
        return;
    }
    discount_count = $('#discount_count').val();
    if(discount_count == ''){
        toastr.error('Der Count darf nicht leer sein','Fehler');
        document.getElementById('creatediscountcodebutton').style.display = '';
        document.getElementById('creatediscountcodebutton_load').style.display = 'none';
        return;
    }
    discount_type = $('#discount_type option:selected').val();
    data = '';
    switch(discount_type){
        case '0':
            data = '[' + $('#discount_money').val() + ']';
        break;
        case '2':
            data = '[' + $('#discount_prozent').val() + ',' + $('#discount_product option:selected').val() + ']';
        break;
        case '3':
            data = '[' + $('#discount_prozent').val() + ',' + $('#discount_product option:selected').val() + ']';
        break;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'creatediscount');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'), type: discount_type,data:data,count:discount_count,code:discount_code},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#newdiscount').modal('hide');
                toastr.success('Discount erfolgreich erstellt','');
                document.getElementById('creatediscountcodebutton').style.display = '';
                document.getElementById('creatediscountcodebutton_load').style.display = 'none';
                getalldiscounts();
            }
        }
    });
}
$('#discount_table').DataTable({
    responsive: true,
    pageLength: 10,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
getalldiscounts();
switchtype();
</script>
");
echo minifyhtml("</body></html>");

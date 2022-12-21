<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
if (isset($content[1])) {
    if($content[1] != "") {
         
        $router->sendclient("kundendetails", $router, $config, $content, $user);
        return;   
    }
}
$url = $config->getconfigvalue('url');
echo getheader($config, "Kunden - ProHosting24");
$accounts = requestBackend($config, [], "getuserlist");
echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo getnormalbody($config, "Kunden", $user);

echo '<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">';

echo '
<div class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--mobile">
        	<div class="kt-portlet__head">
        		<div class="kt-portlet__head-label">
        			<h3 class="kt-portlet__head-title">
        				Kunden Übersicht
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">

        		<table class="table display nowrap" id="kunden_tabelle" style="width=100%">
        			<thead>
        				<tr style="height=10px" id="table_test">
        					<th style="height=10px">#</th>
                            <th>Username</th>
                            <th>Vorname</th>
                            <th>Nachname</th>
                            <th>Guthaben</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Erstellt am</th>
                            <th>Aktionen</th>
        				</tr>
        			</thead>
                    <tbody>';
foreach ($accounts["response"] as $account) {
    $status = '<span class="badge badge-danger">Error</span>';
    $showbutton = '<button type="button" class="btn btn-outline-info btn-elevate btn-circle btn-icon" onclick="showkunde(' . $account["id"] . ')"><i class="fas fa-link"></i></button>';
    switch ($account["status"]) {
        case 0:
            $status = '<span class="badge badge-success">Aktiviert</span>';
            break;
        case 1:
            $status = '<span class="badge badge-warning">Gesperrt</span>';
            break;
        case 2:
            $status = '<span class="badge badge-warning">Deaktiviert</span>';
            break;
        case 3:
            $status = '<span class="badge badge-danger">Gelöscht</span>';
            break;

    }
    echo '<tr>
            <td>' . $account["id"] . '</td>
            <td>' . $account["username"] . '</td>
            <td>' . $account["vorname"] . '</td>
            <td>' . $account["nachname"] . '</td>
            <td>' . $account["guthaben"] . '</td>
            <td>' . $account["email"] . '</td>
            <td>' . $status . '</td>
            <td>' . $account["created_on"] . '</td>
            <td>' . $showbutton . '</td>
        </tr>';
}
echo '</tbody>
        		</table>
        	</div>
        </div>
    </div>
</div>';

echo '</div>';

echo getbodyfooter($config);

echo getscripts($config);
if (isset($_COOKIE["ph24_notify_success"])) {
    echo minifyhtml("<script>toastr.success('" . $_COOKIE["ph24_notify_success"] . "','');Cookies.remove('ph24_notify_success');</script>");
}

echo getdatatables($config);
minifypage();
?>
<script>
    var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
function getkunden(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getuserlist');
        },
        url: internapi,
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#kunden_tabelle').DataTable().clear().draw();
                respond.response.forEach(element => {
                    showbutton = '<button type="button" class="btn btn-outline-info btn-elevate btn-circle btn-icon" onclick=\"showkunde(' + element.id + ')\"><i class="fas fa-link"></i></button>';
                    statusicon = '<span class="badge badge-danger">Error</span>';
                    switch (element.status) {
                        case 0:
                            statusicon = '<span class="badge badge-success">Aktiviert</span>';
                            break;
                        case 1:
                            statusicon = '<span class="badge badge-warning">Gesperrt</span>';
                            break;
                        case 2:
                            statusicon = '<span class="badge badge-warning">Deaktiviert</span>';
                            break;
                        case 3:
                            statusicon = '<span class="badge badge-danger">Gelöscht</span>';
                            break;

                        default:
                            break;
                    }
                    $('#kunden_tabelle').DataTable().row.add( [
                        element.id,
                        element.username,
                        element.vorname,
                        element.nachname,
                        element.guthaben,
                        element.email,
                        statusicon,
                        element.created_on,
                        showbutton
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('kunden_tabelle').style.display = '';
            }
        }
    });
}
$('#kunden_tabelle').DataTable({
    pageLength: 10,
    scrollX: true,
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});


function showkunde(id){
    url = '<?php echo $url; ?>kunden/' + id;
    window.open(url, '_blank').focus();
}

</script>

<?php
echo minifyhtml("</body></html>");

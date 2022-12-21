<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
if (!isset($content[1])) {
    
    $router->sendclient("404", $router, $config, $content, $user);
    return;
}
$url = $config->getconfigvalue('url');
$kundenid = $content[1];
$frontendurl = $config->getconfigvalue('frontendurl');
$classes = new ClassNamer();
echo minifyhtml(getheader($config, "Kundendetails - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Kundedetails", $user));

echo minifyhtml('<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">');
echo getloadinghtml();
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="maindisplay"  style="padding-left: 10px;display:none;">
    <div class="row">
        <div class="col-xl-7">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Allgemeine Informationen:</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <h5 style="padding-top: 8px;">
                                <text id="statusanzeige"> </text>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-xl-6">
                            <h5>Username:</h5>
                            <div>
                                <text id="customer_infos_username"></text>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <h5>Umsatz:</h5>
                            <div>
                                <text id="customer_infos_money"></text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <h5 style="padding-top: 10px;">Vorname:</h5>
                            <div>
                                <text id="customer_infos_vorname"></text>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <h5 style="padding-top: 10px;">Nachname:</h5>
                            <div>
                                <text id="customer_infos_nachname"></text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <h5 style="padding-top: 10px;">Email:</h5>
                            <div>
                                <text id="customer_infos_email"></text>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <h5 style="padding-top: 10px;">Guthaben:</h5>
                            <div>
                                <text id="customer_infos_guthaben"></text> €
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Aktionen</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 5px;">
                            <button type="button" class="btn btn-outline-primary btn-huge" data-toggle="modal" data-target="#customer_guthaben_modal">
                                <i class="fas fa-coins"></i>&#160;&#160;Guthaben ändern
                            </button>
                        </div>
                        <div class="col-md-6" style="margin-top: 5px;">
                            <button type="button" class="btn btn-outline-success btn-huge" onClick="loginaskunde()">
                                <i class="fas fa-external-link-alt"></i>&#160;&#160;Als Kunde einloggen
                            </button>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-success btn-huge" onClick="lockaccount(0)" id="lock_0" style="margin-top: 5px;">
                                <i class="fas fa-lock-open"></i>&#160;&#160;Account aktivieren
                            </button>
                            <button type="button" class="btn btn-outline-success btn-huge" id="lock_0_load" aria-disabled="true" style="margin-top: 5px;">
                                <i class="fas fa-cog fa-spin"></i>&#160;&#160;Account aktivieren
                            </button>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-danger btn-huge" onClick="lockaccount(1)" id="lock_1" style="margin-top: 5px;">
                                <i class="fas fa-lock"></i>&#160;&#160;Account sperren
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-huge" id="lock_1_load" style="margin-top: 5px;">
                                <i class="fas fa-cog fa-spin"></i>&#160;&#160;Account sperren
                            </button>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-warning btn-huge" onClick="lockaccount(2)" id="lock_2" style="margin-top: 5px;">
                                <i class="fas fa-lock"></i>&#160;&#160;Account deaktivieren
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-huge" id="lock_2_load" style="margin-top: 5px;">
                                <i class="fas fa-cog fa-spin"></i>&#160;&#160;Account deaktivieren
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="kt-portlet kt-portlet--mobile">
                <ul class="nav nav-tabs" role="tablist" style="padding-top: 10px;padding-left: 10px;padding-right: 10px;">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_2_1">
                            <i class="fas fa-server"></i> Dienste
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_2" onclick="loadtickets()">
                            <i class="fas fa-ticket-alt"></i> Tickets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_3" onclick="loadcredithistory()">
                            <i class="fas fa-coins"></i> Guthaben Historie
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_2_4" onclick="loadtransactionshistory()">
                            <i class="fas fa-money-check"></i> Transaktionen
                        </a>
                    </li>
                </ul>
                <div class="tab-content" style="padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
                    <div class="tab-pane active" id="kt_tabs_2_1" role="tabpanel">
                        <?php echo getloadinghtml("kunde_service_load"); ?>
                        <table class="table table-striped- table-hover" id="kunde_service" style="display:none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ServiceID</th>
                                    <th>Name</th>
                                    <th>Preis</th>
                                    <th>Rabatt</th>
                                    <th>Status</th>
                                    <th>Restliche Laufzeit</th>
                                    <th>Aktionen</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="kt_tabs_2_2" role="tabpanel">
                        <?php echo getloadinghtml("kunde_tickets_load"); ?>
                        <table class="table table-striped- table-hover" id="kunde_tickets" style="display:none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titel</th>
                                    <th>Status</th>
                                    <th>Aktionen</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="kt_tabs_2_3" role="tabpanel">
                        <?php echo getloadinghtml("kunde_credit_history_load"); ?>
                        <table class="table table-striped- table-hover" id="kunde_credit_history" style="display:none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Änderung</th>
                                    <th>Grund</th>
                                    <th>Uhrzeit</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="kt_tabs_2_4" role="tabpanel">
                        <?php echo getloadinghtml("kunde_trans_history_load"); ?>
                        <table class="table table-striped- table-hover" id="kunde_trans_history" style="display:none">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Betrag</th>
                                    <th>Umsatz</th>
                                    <th>Uhrzeit</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="modal fade" id="customer_guthaben_modal" tabindex="-1" role="dialog" aria-labelledby="customer_guthaben_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customer_guthaben_modalLabel">Guthaben anpassen.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                </div>
                <div class="modal-body">
                    <p>Änderung:</p>
                    <input type="text" class="form-control" id="customer_change" placeholder="+/-">
                    <p>Grund:</p>
                    <input type="text" class="form-control" id="customer_change_reason" placeholder="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Abbrechen</button>
                    <button type="button" class="btn btn-brand" id="customer_guthaben_button" onclick="changeguthaben()">Speichern</button>
                    <button class="btn btn-brand" id="customer_guthaben_button_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
			        </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="customer_transfer_service" tabindex="-1" role="dialog" aria-labelledby="customer_transfer_serviceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customer_transfer_serviceLabel">Service Transferrieren.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                </div>
                <div class="modal-body">
                    <p>Userid:</p>
                    <input type="number" class="form-control" id="customer_transfer_service_userid" placeholder="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Abbrechen</button>
                    <button type="button" class="btn btn-brand" id="customer_transfer_service_button" onclick="transferservice()">Speichern</button>
                    <button class="btn btn-brand" id="customer_transfer_service_button_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
			        </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="customer_lock_service" tabindex="-1" role="dialog" aria-labelledby="customer_lock_serviceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customer_lock_serviceLabel">Service Sperren.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Diese aktion sperrt den Dienst.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Abbrechen</button>
                    <button type="button" class="btn btn-brand" id="customer_lock_service_button" onclick="lockservice()">Speichern</button>
                    <button class="btn btn-brand" id="customer_lock_service_button_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
			        </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="customer_unlock_service" tabindex="-1" role="dialog" aria-labelledby="customer_unlock_serviceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customer_unlock_serviceLabel">Service Entsperren.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Diese aktion entsperrt den Dienst.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Abbrechen</button>
                    <button type="button" class="btn btn-brand" id="customer_unlock_service_button" onclick="unlockservice()">Speichern</button>
                    <button class="btn btn-brand" id="customer_unlock_service_button_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
			        </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="customer_storno_service" tabindex="-1" role="dialog" aria-labelledby="customer_storno_serviceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customer_storno_serviceLabel">Service Stornieren.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Diese aktion storniert den Dienst und gibt dem Kunden die Restlaufzeit als Guthaben.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Abbrechen</button>
                    <button type="button" class="btn btn-brand" id="customer_storno_service_button" onclick="stornoservice()">Speichern</button>
                    <button class="btn btn-brand" id="customer_storno_service_button_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
			        </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

echo '</div>';

echo minifyhtml(getbodyfooter($config));

echo minifyhtml(getscripts($config));
if (isset($_COOKIE["ph24_notify_success"])) {
    echo minifyhtml("<script>toastr.success('" . $_COOKIE["ph24_notify_success"] . "','');Cookies.remove('ph24_notify_success');</script>");
}

echo getdatatables($config);

?>
<script>
    var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
    var userid = <?php echo $kundenid; ?>;
    var countdownarray = [];
    function getkundeninfos(){
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getuserinfoadmin');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    $('#customer_infos_username').html(respond.response.username);
                    $('#customer_infos_vorname').html(respond.response.vorname);
                    $('#customer_infos_nachname').html(respond.response.nachname);
                    $('#customer_infos_email').html(respond.response.email);
                    $('#customer_infos_guthaben').html(respond.response.guthaben);
                    $('#customer_infos_money').html(respond.response.moneymade + ' € (' + respond.response.moneymadeu + '€)');
                    document.getElementById('lock_0').style.display = 'none';
                    document.getElementById('lock_1').style.display = 'none';
                    document.getElementById('lock_2').style.display = 'none';
                    document.getElementById('lock_0_load').style.display = 'none';
                    document.getElementById('lock_1_load').style.display = 'none';
                    document.getElementById('lock_2_load').style.display = 'none';
                    statusicon = '';
                    switch (respond.response.status) {
                        case 0:
                            statusicon = '<span class="badge badge-success">Aktiviert</span>';
                            document.getElementById('lock_1').style.display = '';
                            document.getElementById('lock_2').style.display = '';
                            break;
                        case 1:
                            statusicon = '<span class="badge badge-warning">Gesperrt</span>';
                            document.getElementById('lock_0').style.display = '';
                            document.getElementById('lock_2').style.display = '';
                            break;
                        case 2:
                            statusicon = '<span class="badge badge-warning">Deaktiviert</span>';
                            document.getElementById('lock_0').style.display = '';
                            document.getElementById('lock_1').style.display = '';
                            break;
                        case 3:
                            statusicon = '<span class="badge badge-danger">Gelöscht</span>';
                            break;

                        default:
                            break;
                    }
                    $('#statusanzeige').html(statusicon);
                    document.getElementById('load').style.display = 'none';
                    document.getElementById('maindisplay').style.display = '';
                }
            }
        });
    }
    getkundeninfos();

    function changeguthaben(){
        change = $('#customer_change').val();
        if(change == ''){
            toastr.error('Bitte einen Betrag angeben.','Fehler');
            return;
        }
        reason = $('#customer_change_reason').val();
        if(reason == ''){
            toastr.error('Bitte einen Grund angeben.','Fehler');
            return;
        }

        document.getElementById('customer_guthaben_button').style.display = 'none';
        document.getElementById('customer_guthaben_button_load').style.display = '';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'changeguthaben');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid, change:change,reason:reason},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    getkundeninfos();
                    $('#customer_guthaben_modal').modal('hide');
                    $('#customer_change_reason').val('');
                    $('#customer_change').val('');
                    document.getElementById('customer_guthaben_button').style.display = '';
                    document.getElementById('customer_guthaben_button_load').style.display = 'none';
                }
            }
        });
    }

    function loginaskunde(){
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getsessionforuser');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    Cookies.set('ph24_sessionid', respond.response, { expires: 10,  path: '/cp/' });
                    if(Cookies.get('ph24_admin_session') == undefined){
                        Cookies.set('ph24_admin_session', Cookies.get("ph24_sessionid"), { expires: 10})
                    }
                    window.open('<?php echo $frontendurl; ?>cp/', '_blank').focus();
                }
            }
        });
    }

    function loadcredithistory(){
        document.getElementById('kunde_credit_history_load').style.display = '';
        document.getElementById('kunde_credit_history').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getcredithistory');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    $('#kunde_credit_history').DataTable().clear().draw();
                    respond.response.forEach(element => {

                        $('#kunde_credit_history').DataTable().row.add( [
                            element.id,
                            element.change,
                            element.reason,
                            element.created_on
                        ] ).draw( false );
                    });
                    document.getElementById('kunde_credit_history_load').style.display = 'none';
                    document.getElementById('kunde_credit_history').style.display = '';
                }
            }
        });
    }

    function loadtransactionshistory(){
        document.getElementById('kunde_trans_history_load').style.display = '';
        document.getElementById('kunde_trans_history').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'gettransaktions');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    $('#kunde_trans_history').DataTable().clear().draw();
                    respond.response.forEach(element => {
                        $('#kunde_trans_history').DataTable().row.add( [
                            element.id,
                            element.amount,
                            element.amount_t,
                            element.created_on
                        ] ).draw( false );
                    });
                    document.getElementById('kunde_trans_history_load').style.display = 'none';
                    document.getElementById('kunde_trans_history').style.display = '';
                }
            }
        });
    }

    function loadgetservicelist(){
        document.getElementById('kunde_service_load').style.display = '';
        document.getElementById('kunde_service').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getservicelist');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    $('#kunde_service').DataTable().clear().draw();
                    countdownarray.length = 0;
                    respond.response.forEach(element => {
                        if(element.produktid == 4 || element.produktid == 5){
                            transferbutton = '';
                        } else {
                            transferbutton = '<button type="button" class="btn btn-outline-info btn-elevate btn-circle btn-icon" onclick=\"opentransfer(' + element.id + ')\"><i class="fas fa-external-link-alt"></i></button> ';
                        }
                        if(element.status == 1){
                            lockbutton = '<button type="button" class="btn btn-outline-success btn-elevate btn-circle btn-icon" onclick=\"openunlock(' + element.id + ')\"><i class="fas fa-lock-open"></i></button>';
                            statusbadge = '<span class=\"badge badge-danger\">Gesperrt</span>';
                        } else {
                            lockbutton = '<button type="button" class="btn btn-outline-danger btn-elevate btn-circle btn-icon" onclick=\"openlock(' + element.id + ')\"><i class="fas fa-lock"></i></button>';
                            statusbadge = '<span class=\"badge badge-success\">Normal</span>';
                        }
                        $('#kunde_service').DataTable().row.add( [
                            element.id,
                            element.serviceid,
                            element.name,
                            element.price + ' €(' + (element.price * (1 - element.discount)).toFixed(2) + ' €)',
                            element.discount,
                            statusbadge,
                            '<text id="' + element.id + '_service_time" >Time</text>',
                            transferbutton +
                            '<button type="button" class="btn btn-outline-warning btn-elevate btn-circle btn-icon" onclick=\"openstorno(' + element.id + ')\"><i class="fas fa-money-bill"></i></button> ' +
                            lockbutton
                        ] ).draw( false );
                        countdownarray.push([element.id + '_service_time',element.timeleft]);
                    });
                    document.getElementById('kunde_service_load').style.display = 'none';
                    document.getElementById('kunde_service').style.display = '';
                }
            }
        });
    }
    loadgetservicelist();

    var activeserverid = 0;


    function opentransfer(id){
        activeserverid = id;
        $('#customer_transfer_service').modal('show');
    }

    function transferservice(){
        targetuserid = $('#customer_transfer_service_userid').val();
        if(targetuserid == ''){
            toastr.error('Bitte einene UserID angeben.','Fehler');
            return;
        }
        document.getElementById('customer_transfer_service_button_load').style.display = '';
        document.getElementById('customer_transfer_service_button').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'transferservice');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), targetuserid: targetuserid,serviceid:activeserverid},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    $('#customer_transfer_service').modal('hide');
                    toastr.success('Service erfolgreich transferriert.','');
                    loadgetservicelist();
                }
                document.getElementById('customer_transfer_service_button_load').style.display = 'none';
                document.getElementById('customer_transfer_service_button').style.display = '';
            }
        });
    }

    function openstorno(id){
        activeserverid = id;
        $('#customer_storno_service').modal('show');
    }

    function openlock(id){
        activeserverid = id;
        $('#customer_lock_service').modal('show');
    }

    function openunlock(id){
        activeserverid = id;
        $('#customer_unlock_service').modal('show');
    }

    function unlockservice(){
        document.getElementById('customer_unlock_service_button_load').style.display = '';
        document.getElementById('customer_unlock_service_button').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'unlockservice');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), serviceid:activeserverid},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    $('#customer_unlock_service').modal('hide');
                    toastr.success('Service erfolgreich entsperrt.','');
                    loadgetservicelist();
                    document.getElementById('customer_unlock_service_button').style.display = '';
                    document.getElementById('customer_unlock_service_button_load').style.display = 'none';
                }
            }
        });
    }

    function lockservice(){
        document.getElementById('customer_lock_service_button_load').style.display = '';
        document.getElementById('customer_lock_service_button').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'lockservice');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), serviceid:activeserverid},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    $('#customer_lock_service').modal('hide');
                    toastr.success('Service erfolgreich gesperrt.','');
                    loadgetservicelist();
                    document.getElementById('customer_lock_service_button').style.display = '';
                    document.getElementById('customer_lock_service_button_load').style.display = 'none';
                }
            }
        });
    }

    function stornoservice(){
        document.getElementById('customer_storno_service_button_load').style.display = '';
        document.getElementById('customer_storno_service_button').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'stornoservice');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), serviceid:activeserverid},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    $('#customer_storno_service').modal('hide');
                    toastr.success('Service erfolgreich gesperrt.','');
                    loadgetservicelist();
                    document.getElementById('customer_storno_service_button').style.display = '';
                    document.getElementById('customer_storno_service_button_load').style.display = 'none';
                }
            }
        });
    }

    function loadtickets(){
        document.getElementById('kunde_tickets_load').style.display = '';
        document.getElementById('kunde_tickets').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getticketsforuserid');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    $('#kunde_tickets').DataTable().clear().draw();
                    respond.response.forEach(element => {
                        switch (element.status) {
                            case 0:
                                status = '<span class=\"btn btn-label-info btn-pill\">Neu</span>';
                                break;

                            case 1:
                                status = '<span class=\"btn btn-label-success btn-pill\">Warten auf Antwort</span>';
                                break;

                            case 2:
                                status = '<span class=\"btn btn-label-warning btn-pill\">Warten auf Kunde</span>';
                                break;

                            case 3:
                                status = '<span class=\"btn btn-label-success btn-pill\">Geschlossen</span>';
                                break;

                            case 4:
                                status = '<span class=\"btn btn-label-danger btn-pill\">Suspendiert</span>';
                                break;

                            default:
                                status = '<span class=\"btn btn-label-danger btn-pill\">Error</span>';
                                break;
                        }
                        $('#kunde_tickets').DataTable().row.add( [
                            element.id,
                            element.title,
                            status,
                            '<button type="button" class="btn btn-outline-info btn-elevate btn-circle btn-icon" onclick=\"showticket(' + element.id + ')\"><i class="fas fa-external-link-alt"></i></button>'
                        ] ).draw( false );
                    });
                    document.getElementById('kunde_tickets_load').style.display = 'none';
                    document.getElementById('kunde_tickets').style.display = '';
                }
            }
        });
    }

    function lockaccount(status){
        document.getElementById('lock_' + status).style.display = 'none';
        document.getElementById('lock_' + status + '_load').style.display = '';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'changestatus');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), userid: userid, status:status},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    getkundeninfos();
                }
                document.getElementById('lock_' + status).style.display = '';
                document.getElementById('lock_' + status + '_load').style.display = 'none';
            }
        });
    }


    function showticket(ticketid){
        window.open('<?php echo $url; ?>support/ticket/' + ticketid, '_blank').focus();
    }

    var kunde_tickets = $('#kunde_tickets').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[ 0, 'desc' ]],
        lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
    });

    $('#kunde_credit_history').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[ 0, 'desc' ]],
        lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
    });

    $('#kunde_trans_history').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[ 0, 'desc' ]],
        lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
    });

    window.addEventListener('resize', change);
    async function change(){
        await sleep(200);
        responsive.columns.adjust().draw();
    }


    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    var first = true;
    function countdown(){
        var now = new Date().getTime();

        countdownarray.forEach(element => {
            var distance = (element[1] * 1000) - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById(element[0]).innerHTML = days + ' Tage ' + hours + ' Stunden ' + minutes + ' Minuten ' + seconds + ' Sekunden ';
            if(first){
                first = false;
                dashboard_l.columns.adjust().draw();
            }
        });
    }
    var x = setInterval(function() {
        countdown();
    }, 1000);

</script>

<?php
echo minifyhtml("</body></html>");

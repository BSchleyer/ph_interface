<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Index - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Dashboard", $user));

$dashboardinfos = requestBackend($config, [], "admindashboardinfo")["response"];

?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="maindisplay">
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-3 kt-widget-3--brand">
                        <div class="kt-widget-3__content" style="background:#00A8FF;">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Umsatz heute</div>
                                </div>
                                <div class="kt-widget-3__content-section">
                                    <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["money"]; ?> €</span>
                                </div>
                            </div>
                            <div class="kt-widget-3__content-stats">
                                <div class="kt-widget-3__content-progress">
                                    <div class="progress">
                                        <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-3 kt-widget-3--brand">
                        <div class="kt-widget-3__content" style="background:#00A8FF;">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Kunden</div>
                                </div>
                                <div class="kt-widget-3__content-section">
                                    <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["usercount"]; ?></span>
                                </div>
                            </div>
                            <div class="kt-widget-3__content-stats">
                                <div class="kt-widget-3__content-progress">
                                    <div class="progress">
                                        <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-3 kt-widget-3--brand">
                        <div class="kt-widget-3__content" style="background:#00A8FF;">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Mails in Queue</div>
                                </div>
                                <div class="kt-widget-3__content-section">
                                    <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["mailcount"]; ?></span>
                                </div>
                            </div>
                            <div class="kt-widget-3__content-stats">
                                <div class="kt-widget-3__content-progress">
                                    <div class="progress">
                                        <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget-3 kt-widget-3--brand">
                        <div class="kt-widget-3__content" style="background:#00A8FF;">
                            <div class="kt-widget-3__content-info">
                                <div class="kt-widget-3__content-section">
                                    <div class="kt-widget-3__content-title">Freie IPs</div>
                                </div>
                                <div class="kt-widget-3__content-section">
                                    <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["freeips"]; ?></span>
                                </div>
                            </div>
                            <div class="kt-widget-3__content-stats">
                                <div class="kt-widget-3__content-progress">
                                    <div class="progress">
                                        <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget-3 kt-widget-3--brand">
                    <div class="kt-widget-3__content" style="background:#00A8FF;">
                        <div class="kt-widget-3__content-info">
                            <div class="kt-widget-3__content-section">
                                <div class="kt-widget-3__content-title">Cores</div>
                            </div>
                            <div class="kt-widget-3__content-section">
                                <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["cores"]; ?></span>
                            </div>
                        </div>
                        <div class="kt-widget-3__content-stats">
                            <div class="kt-widget-3__content-progress">
                                <div class="progress">
                                    <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget-3 kt-widget-3--brand">
                    <div class="kt-widget-3__content" style="background:#00A8FF;">
                        <div class="kt-widget-3__content-info">
                            <div class="kt-widget-3__content-section">
                                <div class="kt-widget-3__content-title">Memory</div>
                            </div>
                            <div class="kt-widget-3__content-section">
                                <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["memory"] / 1024; ?> GB</span>
                            </div>
                        </div>
                        <div class="kt-widget-3__content-stats">
                            <div class="kt-widget-3__content-progress">
                                <div class="progress">
                                    <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget-3 kt-widget-3--brand">
                    <div class="kt-widget-3__content" style="background:#00A8FF;">
                        <div class="kt-widget-3__content-info">
                            <div class="kt-widget-3__content-section">
                                <div class="kt-widget-3__content-title">Disk</div>
                            </div>
                            <div class="kt-widget-3__content-section">
                                <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["disk"]; ?> GB</span>
                            </div>
                        </div>
                        <div class="kt-widget-3__content-stats">
                            <div class="kt-widget-3__content-progress">
                                <div class="progress">
                                    <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
            <div class="kt-portlet__body kt-portlet__body--fluid">
                <div class="kt-widget-3 kt-widget-3--brand">
                    <div class="kt-widget-3__content" style="background:#00A8FF;">
                        <div class="kt-widget-3__content-info">
                            <div class="kt-widget-3__content-section">
                                <div class="kt-widget-3__content-title">Hourly Server</div>
                            </div>
                            <div class="kt-widget-3__content-section">
                                <span class="kt-widget-3__content-number"><?php echo $dashboardinfos["hourlyServerCount"]; ?></span>
                            </div>
                        </div>
                        <div class="kt-widget-3__content-stats">
                            <div class="kt-widget-3__content-progress">
                                <div class="progress">
                                    <div class="progress-bar bg-light" style="width: 100%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-sm-6" style="margin-bottom:.5rem;">
            <div class="card customcard">
                <div class="card-header kt-font-bolder" style="background:#00A8FF; color:#ffffff;">
                    Ihr Konto
                </div>
                <div class="card-body">
                    <h2 class="card-title">
                    <?php echo $user->getVorname(); ?> <?php echo $user->getNachname(); ?>
                    </h2>
                    <div class="row">
                        <div class="col-xl-6">
                            <p class="card-text" style="margin-bottom:0;">
                                Geschäzter Monatlicher Umsatz: <?php echo $dashboardinfos["monthly"]; ?> € <br>
                                eta remaining sales: <?php echo $dashboardinfos["monthlyt"]; ?> € (<?php echo $dashboardinfos["etaRemaningSalesNoMoney"]; ?> €)<br>
                                Unbezahlte Transaktionen: <?php echo $dashboardinfos["invoiceNotPaid"]; ?> €
                            </p>
                        </div>
                        <div class="col-xl-6">

                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="button" class="btn btn-outline-primary" style="float:right; clear:left; text-align:center; margin-right:1rem;" onclick="opensupportpin()">
                        <i class="fas fa-info-circle" style="margin:auto;"></i>&nbsp;SupportPin
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6" style="margin-bottom:.5rem;">

                <div class="card customcard">
                    <div class="card-header kt-font-bolder" style="background:#00A8FF; color:#ffffff;">
                        Placeholder
                    </div>
                    <div class="card-body">

                    </div>
                </div>

        </div>
        <div class="col-xl-6 col-sm-6" style="margin-bottom:.5rem;">

                <div class="card customcard">
                    <div class="card-header kt-font-bolder" style="background:#00A8FF; color:#ffffff;">
                        Letzte Supportanfragen
                    </div>
                    <div class="card-body">
                        <?php echo getloadinghtml('dashboard_s_load'); ?>
                        <div id="dashboard_s_div" style="display:none">
                            <table class="table table-striped- table-hover" id="dashboard_s">
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
                    </div>
                </div>

        </div>
        <div class="col-xl-6 col-sm-6" style="margin-bottom:.5rem;">

                <div class="card customcard">
                    <div class="card-header kt-font-bolder" style="background:#00A8FF; color:#ffffff;">
                        Changelog
                    </div>
                    <div class="card-body" style="height:100px; overflow:auto;overflow-x: hidden;">


                        <div id="kt-widget-slider-13-1" class="kt-slider carousel slide" data-ride="carousel" data-interval="8000" style="display:inline;">
                            <div class="kt-slider__head" style="clear:both; display:inline-flex;float:right; margin-bottom:0;">
                                <div class="kt-slider__label"></div>
                                <div class="kt-slider__nav">
                                    <a class="kt-slider__nav-prev carousel-control-prev" href="#kt-widget-slider-13-1" role="button" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="kt-slider__nav-next carousel-control-next" href="#kt-widget-slider-13-1" role="button" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="carousel-inner" style="display:inherit">
                            <?php
$changelogs = requestBackend($config, [], "getchangelog");
$first = "active";
foreach ($changelogs["response"] as $changelog) {

    echo '
    <div class="carousel-item kt-slider__body ' . $first . '">
        <div class="kt-widget-13">
            <div class="kt-widget-13__body">
                <a class="kt-widget-13__title">' . $changelog["header"] . '</a>
                <div class="kt-widget-13__desc">
                    ' . $changelog["content"] . '
                </div>
            </div>
            <div class="kt-widget-13__foot">
                <div class="kt-widget-13__label">
                    <div class="btn btn-sm btn-label btn-bold">
                    ' . $changelog["created_on"] . '
                    </div>
                </div>
            </div>
        </div>
    </div>';
    $first = "";
}
?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <div>
        <div class="modal fade" id="support_pin_modal" tabindex="-1" role="dialog" aria-labelledby="support_pin_modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="support_pin_modalLabel">SupportPin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Pin:</p>
                        <input type="text" class="form-control" id="support_pin">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn btn-brand" id="support_pin_button" onclick="gotocustomer()">Weiter</button>
                        <button class="btn btn-brand" id="support_pin_button_load" type="button" aria-disabled="true" style="display:none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span >Loading...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo minifyhtml(getbodyfooter($config));

echo minifyhtml(getscripts($config));
if (isset($_COOKIE["ph24_notify_success"])) {
    echo minifyhtml("<script>toastr.success('" . $_COOKIE["ph24_notify_success"] . "','');Cookies.remove('ph24_notify_success');</script>");
}

echo getdatatables($config);
minifypage();
?>
<script>
    var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
    function gettickets(){
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getsupportticketsadmin');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid')},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    $('#dashboard_s').DataTable().clear().draw();
                    respond.response.length=10;
                    respond.response.forEach(element => {
                        actions = '<button type="button" class="btn btn-outline-primary btn-sm" onclick="openticket(' + element.id + ')"><i class="fas fa-external-link-alt"></i>&nbsp;Öffnen</button>';
                        switch (element.status) {
                            case 0:
                                status = '<span class="badge badge-info">Neu</span>';
                                break;

                            case 1:
                                status = '<span class="badge badge-success">Warten auf Antwort</span>';
                                break;

                            case 2:
                                status = '<span class="badge badge-warning">Warten auf Kunde</span>';
                                break;

                            case 3:
                                status = '<span class="badge badge-success">Geschlossen</span>';
                                break;

                            case 4:
                                status = '<span class="badge badge-danger">Suspendiert</span>';
                                break;

                            default:
                                status = '<span class="badge badge-danger">Error</span>';
                                break;
                        }
                        $('#dashboard_s').DataTable().row.add( [
                            element.id,
                            element.title.substring(0,40),
                            status,
                            actions
                        ] ).draw( false );
                    });
                    document.getElementById('dashboard_s_load').style.display = 'none';
                    document.getElementById('dashboard_s_div').style.display = '';
                    dashboard_s.columns.adjust().draw();
                }
            }
        });
    }

    function openticket(id){
        window.open('<?php echo $url; ?>support/ticket/' + id, '_blank').focus();
    }

    var dashboard_s =  $('#dashboard_s').DataTable({
        order: [[ 0, 'desc' ]],
        responsive: false,
        searching: false,
        paging:false,
        info: false,
        scrollY:'150px',
        scrollCollapse: true,
        "initComplete": function(settings, json) {
            $('body').find('.dataTables_scrollBody').addClass("scrollbar");
        },
    });

    $("#dashboard_s_wrapper").css("margin-top", "-25px");

    window.addEventListener('resize', change);
    async function change(){
        await sleep(200);
        dashboard_s.columns.adjust().draw();
    }


    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    gettickets();

    function opensupportpin(){
        $('#support_pin_modal').modal('show');
    }


    function gotocustomer(){
        $('#support_pin_button').hide();
        $('#support_pin_button_load').show();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'convertsupportpin');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'),pin:$('#support_pin').val()},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    window.open('<?php echo $url; ?>kunden/' + respond.response, '_blank').focus();
                }
                $('#support_pin_button').show();
                $('#support_pin_button_load').hide();
            }
        });
    }

</script>


<?php

echo minifyhtml("</body></html>");

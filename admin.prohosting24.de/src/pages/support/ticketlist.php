<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Support - Tickets - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Support", $user));

echo minifyhtml('<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">');

echo minifyhtml('
<div class="row">
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Ihre Support Tickets</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml() . '
        		<table class="table table-striped-   table-hover" id="ticket_table" style="display:none">
        			<thead>
        				<tr>
                            <th>TicketId</th>
                            <th>Titel</th>
                            <th>Status</th>
                            <th>Letzte Antwort</th>
                            <th>Erstellt</th>
                            <th>Aktionen</th>
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
echo "
<script>
aktiveserverid = 0;
function gettickets(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'getsupporttickets');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid')},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#ticket_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    actions = '';
                    closebutton = '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"closeticket(' + element.id + ')\"><i class=\"flaticon-lock\"></i></button>';
                    detailsbutton = '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"gotodetails(' + element.id + ')\"><i class=\"fas fa-ticket-alt\"></i></button>';
                    actions += detailsbutton;
                    switch (element.status) {
                        case 0:
                            actions += closebutton;
                            status = '<span class=\"btn btn-label-info btn-pill\">Neu</span>';
                            break;

                        case 1:
                            actions += closebutton;
                            status = '<span class=\"btn btn-label-success btn-pill\">Warten auf Antwort</span>';
                            break;

                        case 2:
                            actions += closebutton;
                            status = '<span class=\"btn btn-label-warning btn-pill\">Warten auf Kunde</span>';
                            break;

                        case 3:
                            status = '<span class=\"btn btn-label-success btn-pill\">Geschlossen</span>';
                            break;

                        case 4:
                            status = '<span class=\"btn btn-label-danger btn-pill\">Suspendiert</span>';
                            break;

                        case 5:
                            actions += closebutton;
                            status = '<span class=\"btn btn-label-success btn-pill\">In Bearbeitung</span>';
                            break;

                        default:
                            status = '<span class=\"btn btn-label-danger btn-pill\">Error</span>';
                            break;
                    }
                    $('#ticket_table').DataTable().row.add( [
                        element.id,
                        element.title,
                        status,
                        element.last_answer,
                        element.created_on,
                        actions
                    ] ).draw( false );
                });
                document.getElementById('load').style.display = 'none';
                document.getElementById('ticket_table').style.display = '';
            }
        }
    });
}

function closeticket (id){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'closesupportticketadmin');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid') , ticketid:id},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                gettickets();
            }
        }
    });
}

function gotodetails(id){
    window.location.replace('" . $url . "support/ticket/' + id);
}

$('#ticket_table').DataTable({
    responsive: true,
    pageLength: 10,
    order: [[ 0, 'desc' ]],
    lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
});
gettickets();
</script>
";

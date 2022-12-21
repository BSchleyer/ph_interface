<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
$ticketid = $content[2];
echo minifyhtml(getheader($config, "Support - Ticket - Details - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Support - Ticket - Details", $user));

echo minifyhtml('<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">');

echo minifyhtml(getloadinghtml() . '
<div class="row" data-sticky-container id="ticketmain">
    <div class="col-lg-3">
        <div class="kt-portlet sticky" data-sticky="true" data-margin-top="33" data-sticky-class="kt-sticky">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div style="padding-top: 10px;padding-left:10px;padding-bottom:10px;padding-right:10px;">
                    <h3><text id="dtitel" style="word-wrap: break-word;"></text> - #<text id="dticketid"></text></h3>
                    <h5 style="padding-top: 10px;">Status:</h5>
                    <div id="dstatus"></div>
                    <h5 style="padding-top: 10px;">Eröffnet am:</h5>
                    <text id="dcreated"></text>
                    <h5 style="padding-top: 10px;">Letzte Antwort:</h5>
                    <text id="dlastupdate"></text>
                    <h5 style="padding-top: 10px;">Kunden Id:</h5>
                    #<text id="customerid">000</text>
                    <h5 style="padding-top: 10px;">Mitarbeiter:</h5>
                    <text id="adminDisplay">000</text>
                    <div style="margin-bottom: 10px">
                        <button type="button" class="btn btn-outline-success btn-huge" style="display:none;" id="adminassignticket_load">
                            <i class="fas fa-cog fa-spin"></i>&#160;&#160;Mir zuweisen
                        </button>
                        <button type="button" onclick="assignTicket(' . $ticketid . ')" class="btn btn-outline-success btn-huge" style="display:none;" id="adminassignticket">
                            &#160;&#160;Mir zuweisen
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-danger btn-huge" onclick="closeticket(' . $ticketid . ')" style="display:none;" id="closeticketbutton">
                            <i class="flaticon-lock"></i>&#160;&#160;Ticket Schließen
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-huge" style="display:none;" id="closeticketbutton_load">
                            <i class="fas fa-cog fa-spin"></i>&#160;&#160;Ticket Schließen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9" id="ticketmaster">
    </div>
</div>
');

echo '</div>';

echo minifyhtml(getbodyfooter($config));

echo minifyhtml(getscripts($config));
if (isset($_COOKIE["ph24_notify_success"])) {
    echo minifyhtml("<script>toastr.success('" . $_COOKIE["ph24_notify_success"] . "','');Cookies.remove('ph24_notify_success');</script>");
}

echo "
<script>
ticketid = " . $ticketid . ";

function getticketdetails(){
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'supportticketdetailsadmin');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid'),ticketid:ticketid},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                $('#dticketid').html(respond.response[0].id);
                $('#dtitel').html(respond.response[0].title);
                $('#dcreated').html(respond.response[0].created_on);
                $('#dlastupdate').html(respond.response[0].last_answer);
                $('#customerid').html('<a href=\"javascript:showkunde(' + respond.response[0].userid + ')\">' + respond.response[0].userid + '</a>');
                if(respond.response[0].admin == 0){
                    $('#adminassignticket').show();
                    $('#adminDisplay').hide();
                } else {
                    $('#adminassignticket').show();
                    $('#adminDisplay').show();
                    $('#adminDisplay').html(respond.response[0].admin);
                    $('#adminDisplay').html(respond.response[0].adminUserName);
                }
              	document.getElementById('closeticketbutton').style.display = 'none';
                status = '';
                switch (respond.response[0].status) {
                    case 0:
                        document.getElementById('closeticketbutton').style.display = '';
                        status = '<span class=\"badge badge-info\">Neu</span>';
                        break;

                    case 1:
                        document.getElementById('closeticketbutton').style.display = '';
                        status = '<span class=\"badge badge-success\">Warten auf Antwort</span>';
                        break;

                    case 2:
                        document.getElementById('closeticketbutton').style.display = '';
                        status = '<span class=\"badge badge-warning\">Warten auf Kunde</span>';
                        break;

                    case 3:
                        status = '<span class=\"badge badge-success\">Geschlossen</span>';
                        break;

                    case 4:
                        status = '<span class=\"badge badge-danger\">Suspendiert</span>';
                        break;

                    case 5:
                        document.getElementById('closeticketbutton').style.display = '';
                        status = '<span class=\"badge badge-success\">In Bearbeitung</span>';
                        break;

                    default:
                        status = '<span class=\"badge badge-danger\">Error</span>';
                        break;
                }
                $('#dstatus').html(status);
                document.getElementById('ticketmaster').innerHTML = '';
                respond.response.answer.forEach(element => {
                    mitarbeiter = '';
                    if(element.mitarbeiter == 1){
                        mitarbeiter = '- Mitarbeiter&nbsp';
                    }
                    extern = '';
                    if(element.extern == 0){
                        extern = '- Intern&nbsp';
                    }
                    innerhtml = document.getElementById('ticketmaster').innerHTML;
                    document.getElementById('ticketmaster').innerHTML = innerhtml + `
                    <div class='kt-portlet'>
                        <div class='kt-portlet__head'>
                            <div class='kt-portlet__head-label'>
                                <h3 class='kt-portlet__head-title'>` + element.vorname + ` ` + element.nachname + `&nbsp` + mitarbeiter + `&nbsp` + extern + `</h3>
                                am ` + element.created_on + `
                            </div>
                        </div>
                        <div class='kt-portlet__body'>
                            ` + element.text + `
                        </div>
                    </div>`;
                });

                innerhtml = document.getElementById('ticketmaster').innerHTML;
                document.getElementById('ticketmaster').innerHTML = innerhtml +`
                <div class='kt-portlet'>
                    <div class='kt-portlet__head'>
                        <div class='kt-portlet__head-label'>
                            <h3 class='kt-portlet__head-title'>Antworten</h3>
                        </div>
                    </div>
                    <div class='kt-portlet__body'>
                        <div class='col-lg-12'>
                            <textarea class='summernote-simple' name='inhalt' id='inhalt'></textarea>
                        </div>
                        <hr>
                        <div class='col-lg-3'>
                            <label class='kt-checkbox'>
								<input type='checkbox' id='extern' name='extern'> Extern
								<span></span>
                            </label>
                            <br>
                            <button type='button' id='ticket_answer_button' class='btn btn-outline-success' onclick='answerticket()'>Antworten</button>
                            <button class='btn btn-outline-success' id='ticket_answer_button_load' type='button' aria-disabled='true' style='display:none'>
                                <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>
                                <span >Loading...</span>
                            </button>
                        </div>
                    </div>
                </div>`;
                document.getElementById('load').style.display = 'none';
                document.getElementById('ticketmain').style.display = '';

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
            }
        }
    });
}

function closeticket (id){
    document.getElementById('closeticketbutton_load').style.display = '';
    document.getElementById('closeticketbutton').style.display = 'none';
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'closesupportticketadmin');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid') , ticketid:ticketid},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                getticketdetails();
            }
            document.getElementById('closeticketbutton_load').style.display = 'none';
            document.getElementById('closeticketbutton').style.display = '';
        }
    });
}

function assignTicket (id){
    document.getElementById('adminassignticket_load').style.display = '';
    document.getElementById('adminassignticket').style.display = 'none';
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'assignsupportticketadmin');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid') , ticketid:ticketid},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                getticketdetails();
            }
            document.getElementById('adminassignticket_load').style.display = 'none';
            document.getElementById('adminassignticket').style.display = '';
        }
    });
}

function answerticket (){
    document.getElementById('ticket_answer_button_load').style.display = '';
    document.getElementById('ticket_answer_button').style.display = 'none';
    text = $('#inhalt').val();
    if(text == ''){
        toastr.error('Bitte einen Text eingeben','Fehler');
        document.getElementById('ticket_answer_button_load').style.display = 'none';
        document.getElementById('ticket_answer_button').style.display = '';
        return;
    }
    if ($('#extern').is(':checked')){
        extern = 1;
    } else {
        extern = 0;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'answerticketadmin');
        },
        url: '" . $config->getconfigvalue('internapi') . "',
        data: { sessionid: Cookies.get('ph24_sessionid') , ticketid:ticketid,text:text,extern:extern},
        success: function(respond){
            if(respond.fail){
                toastr.error('Fehler bei Ajax Request.','');
            } else {
                getticketdetails();
            }
            document.getElementById('ticket_answer_button_load').style.display = 'none';
            document.getElementById('ticket_answer_button').style.display = '';
        }
    });
}


getticketdetails();

var KTStickyPanelsDemo = function () {

    var demo1 = function () {
        if (KTLayout.onAsideToggle) {
            var sticky = new Sticky('.sticky');

            KTLayout.onAsideToggle(function() {
                setTimeout(function() {
                    sticky.update(); 
                }, 50);
            });
        }
    }

    return {
        init: function() {
            demo1();
        }
    };
}();
function showkunde(id){
    url = '" . $url . "kunden/' + id;
    window.open(url, '_blank').focus();
}

jQuery(document).ready(function() {
    KTStickyPanelsDemo.init();
});
</script>
";

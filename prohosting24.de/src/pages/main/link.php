<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
if (!isset($content[1]) || $content[1] == "") {
    $router->sendclient("404", $router, $config, $content, $user,$lang);
    die();
}

$linkinfo = requestBackend($config, ["link" => $content[1]], "getlinkinfo");

if (count($linkinfo["response"]) != 1) {
    $router->sendclient("404", $router, $config, $content, $user,$lang);
    die();
}
if ($linkinfo["response"][0]["done"] == 1) {
    $router->sendclient("404", $router, $config, $content, $user,$lang);
    die();
}
$userid = $linkinfo["response"][0]["userid"];
$action = $linkinfo["response"][0]["action"];
switch ($action) {
    case 'passwordforgot':
        $header = "Passwort vergessen";
        $buttontext = "Paswort ändern";
        $successmessage = "Das Passwort wurde erfolgreich geändert.";
        break;

    default:
        $router->sendclient("404", $router, $config, $content, $user,$lang);
        die();
        break;
}


echo minifyhtml(getheader($config, "Link - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
echo '

<hr style="background-color: #00A8FF; height: .5rem; margin: 0; padding: 0;">
<div class="features-two padding-top50 padding-bottom50">
    <div class="custom-width">
        <div class="box-shadow">
            <span class="padding-top10 padding-bottom30 webspacebestellung">
                <div class=" text-center" style="padding-bottom: 2rem;">
                    <h2><b>' . $header . '</b></h2>
                </div>
                <div style="text-align:center;">';
switch ($action) {
    case 'passwordforgot':
        echo '  <span class="webspaceformfix">
                    <span style="display:block; text-align: left; margin-left: 10%; margin-bottom: .2rem; font-size: 1.7rem; margin-top:3.5rem;"><b>Neues Passwort</b>:</span>
                    <input class="form-control" type="password" style="height: 45px; font-size: 15px; display:block;" placeholder="" id="new_pw" >
                </span>';
        echo '  <span class="webspaceformfix">
                <span style="display:block; text-align: left; margin-left: 10%; margin-bottom: .2rem; font-size: 1.7rem; margin-top:3.5rem;"><b>Neues Passwort wiederholen</b>:</span>
                <input class="form-control" type="password" style="height: 45px; font-size: 15px; display:block;" placeholder="" id="new_pw_w" >
            </span>';
        break;
}
echo '
                    <span class="webspace_summe">
                        <button type="button" class="domainbutton btn-primary btn-domainbutton" style="text-align:right;" onClick="linkresolve()">' . $buttontext . '</button>
                    </span>
                </div>
            </span>
        </div>
     </div>
</div>

';
echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));
echo '<script src="' . $cdn . 'js/js.cookie.min.js"></script>';
echo '<script src="' . $cdn . 'vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>';

?>
<script>

var action = '<?php echo $action ?>';
var link = '<?php echo $content[1] ?>';
var successmessage = '<?php echo $successmessage ?>';


function linkresolve(){
    dataa = {};
    switch (action) {
        case 'passwordforgot':
            password = $('#new_pw').val();
            if(password == ''){
                toastr.error('Das Passwort darf nicht leer sein','Fehler');
                return;
            }
            password_1 = $('#new_pw_w').val();
            if(password != password_1){
                toastr.error('Die Passwörter stimmen nicht über ein','Fehler');
                return;
            }
            dataa.passwort = password;
            break;

        default:
            break;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'linkresolve');
        },
        url: ' <?php echo $config->getconfigvalue('internapi') ?>',
        data: { link:link,action: action,data: JSON.stringify(dataa)},
        success: function(respond){
            if(respond.fail){
                toastr.error(respond.error,'Fehler');
            } else {
                Cookies.set('ph24_notify_success', successmessage);
                window.location.href = ' <?php echo $url ?>/cp';
            }
        }
    });
}
</script>

<?php

echo '</body></html>';

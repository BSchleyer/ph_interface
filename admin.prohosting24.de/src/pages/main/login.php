<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();

echo minifyhtml(getloginheader($config, "Login - AdminCp - ProHosting24"));
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$internapi = $config->getconfigvalue('internapi');
echo minifyhtml('
<body style="background-image: url(' . $cdn . 'img/bg_1.jpg)" class="kt-login-v1--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid__item  kt-grid__item--fluid kt-grid kt-grid--hor kt-login-v1" id="kt_login_v1">
            <div class="kt-grid__item">
                <div class="kt-login-v1__head">
                    <div class="kt-login-v1__logo">
                        <h3 class="kt-login-v1__intro" style="color: white;">ProHosting24</h3>
                    </div>
                    <div class="kt-login-v1__signup">
                        <h4 class="kt-login-v1__heading">Noch keinen Account?</h4>
                        <a href="#">Registrieren</a>
                    </div>
                </div>
            </div>
            <div class="kt-grid__item  kt-grid kt-grid--ver  kt-grid__item--fluid">
                <div class="kt-login-v1__body">
                    <div class="kt-login-v1__section">
                        <div class="kt-login-v1__info">
                            <h3 class="kt-login-v1__intro">ProHosting24 - AdminCp</h3>
                            <p>Dies ist das AdminCp von Prohosting24</p>
                        </div>
                    </div>
                    <div class="kt-login-v1__seaprator"></div>
                    <div class="kt-login-v1__wrapper">
                        <div class="kt-login-v1__container">
                            <h3 class="kt-login-v1__title">
                                Einloggen
                            </h3>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Email" id="email" name="email" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Passwort" id="password" name="password">
                                </div>
                                <div class="kt-login-v1__actions">
                                    <a href="#" class="kt-login-v1__forgot">
                                        Passwort Vergessen
                                    </a>
                                    <input type="submit" id="login" name="login" class="btn btn-pill btn-elevate" onclick="login()">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-grid__item">
                <div class="kt-login-v1__footer">
                    <div class="kt-login-v1__menu">
                        <a href="' . $url . '/impressum">Impressum</a>
                        <a href="' . $url . '/datenschutz">Datenschutz</a>
                        <a href="' . $url . '/agb">AGB</a>
                    </div>
                    <div class="kt-login-v1__copyright" style="color: white;">
                        &copy; 2017 - ' . date("Y") . ' ProHosting24
                    </div>
                </div>
            </div>
        </div>
    </div>');
?>
<script>
function login(){
    $("#login").button('loading');
    email = $("#email").val();
    if(email == ""){
        toastr.error("Die Email darf nicht leer sein",'Fehler');
        $("#login_send").button('reset');
        return;
    }
    password = $("#password").val();
    if(password == ""){
        toastr.error("Das Passwort darf nicht leer sein",'Fehler');
        $("#login_send").button('reset');
        return;
    }
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', "login");
            request.setRequestHeader("key", "login");
        },
        url: <?php echo "'" . $internapi . "'" ?>,
        data: { email: email,password: password,length: 10 },
        success: function(respond){
            console.log(respond);
            $("#login_send").button('reset');
            if(respond.fail){
                toastr.error(respond.error,'Fehler');
            } else {
                Cookies.set('ph24_sessionid', respond.response,{ expires: 10 });
                Cookies.set('ph24_notify_success', 'Sie haben sich erfolgreich eingeloggt');
                window.location.replace(<?php echo "'" . $url . "'" ?>);
            }
        }
    });
}
</script>
<?php
echo minifyhtml(getloginscripts($config));

echo minifyhtml("</body>
    </html>");

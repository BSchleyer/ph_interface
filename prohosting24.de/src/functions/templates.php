<?php


defined('QnqH1tm25iKsgqXAOoUd') or die();

function getheader($config, $pagetitle, $lang, $name, $desc = "")
{
    if($desc == ""){
        $desc = $lang->getString("metadescription");
    }
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');

    $toaster = "";

    $toasterNeed = ["domains", "link"];

    if(in_array($name, $toasterNeed)){
        $toaster = '<link rel="stylesheet" href="' . $cdn . 'vendors/general/toastr/build/toastr.min.css">';
    }

    $return = '
    <!DOCTYPE html>
    <html lang="' .$lang->getString("lang") .'" style="scroll-behavior: smooth;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="' .$desc .'">
        <meta property="image" content="' .$lang->getString("logourl") .'">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ProHosting24">';
        $langData = $lang->getLangInfo();

        foreach ($langData["data"] as $langName => $data) {
            if($name == "index"){
                $name = "";
            }
            $return .= '<link rel="alternate" href="https://'.$data["domain"]. '/' . $name . '" hreflang="' . $langName .'" />';
        }
        $return .= '
        <link rel="icon" type="image/png" sizes="32x32" href="' . $url . '/favicon.png">
        <title>' . $pagetitle . '</title>
        <link rel="stylesheet" href="' . $cdn . 'css/fontawesome-icons/css/all.min.css">
        <link rel="stylesheet" href="' . $cdn . 'css/bootsnav.min.css">
        <link rel="stylesheet" href="' . $cdn . 'css/bootstrap.min.css">
        <link rel="stylesheet" href="' . $cdn . 'css/aos.min.css">
        <link rel="stylesheet" href="' . $cdn . 'css/animate.min.css">
        <link rel="stylesheet" href="' . $cdn . 'css/style.min.css">
        <link rel="stylesheet" href="' . $cdn . 'css/responsive.min.css">' . $toaster . '
        <link rel="stylesheet" href="' . $cdn . 'css/bootstrap-slider.min.css"/>
        <script src="' . $cdn . 'js/jquery.min.js"></script>
        <script src="' . $cdn . 'js/bootstrap-slider.min.js"></script>
        <script src="' . $cdn . 'js/cookie-consent.js"></script>
        <script type="text/javascript" src="' . $cdn . 'js/cookie-consent.js" charset="UTF-8"></script>
</head>
 ';
 return $return;
}

function getjs($config)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
    <script src="' . $cdn . 'js/bootsnav.min.js"></script>
    <script src="' . $cdn . 'js/bootstrap.min.js"></script>
    <script src="' . $cdn . 'js/aos.min.js"></script>
    <script src="' . $cdn . 'js/custom.min.js"></script>';
}

function getunderfooter($config, $lang)
{
    $url = $config->getconfigvalue('url');
    return '
    <div class="under-footer2">
        <div class="custom-width">
            <div class="row">
                <p>© 2017 - ' . date("Y") . ' ' .$lang->getString("frontfooter") .'
                </p>
            </div>
        </div>
    </div>
    ';
}

function getnormalfooter($config, $lang)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
        <footer class="light-footer">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-2">
                    <h4>' .$lang->getString("products") .'</h4>
                    <ul>
                        <li><a href="' . $url . '/'.$lang->getString("vps") .'">' .$lang->getString("vserver") .'</a></li>
                        <li><a href="' . $url . '/'.$lang->getString("vpsplans") .'">' .$lang->getString("vserverpackage") .'</a></li>
                        <li><a href="' . $url . '/webspace">' .$lang->getString("webhosting") .'</a></li>
                        <li><a href="' . $url . '/domains">' .$lang->getString("domains") .'</a></li>
                        <li><a href="' . $url . '/apps">' .$lang->getString("applications") .'</a></li>

                    </ul>
                </div>
                <div class="col-sm-2">
                    <h4>' .$lang->getString("company") .'</h4>
                    <ul>
                        <li><a href="' . $url . '/'.$lang->getString("dcurl") .'">' .$lang->getString("datacenter") .'</a></li>
                        <li><a href="' . $url . '/'.$lang->getString("ddosurl") .'">' .$lang->getString("ddos-protection") .'</a></li> 
                        <li><a href="' . $url . '/'.$lang->getString("virturl") .'">' .$lang->getString("virtualization") .'</a></li>
                        <li><a href="' . $url . '/ceph">' .$lang->getString("ceph") .'</a></li>
                        <li><a href="' . $url . '/hardware">' .$lang->getString("ourhardware") .'</a></li>
                        <li><a href="' . $url . '/'.$lang->getString("uplinkurl") .'">' .$lang->getString("uplink") .'</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 location-info">
                    <h4>' .$lang->getString("infrastructure") .'</h4>
                    <ul>
                        <li><a target="_blank" href="https://status.prohosting24.de/">' .$lang->getString("footerstatus") .'</a></li>
                        <li><a target="_blank" href="https://grafana.prohosting24.de/d/L6lw-sYMz/pve-cluster-public?orgId=1&refresh=5s">' .$lang->getString("grafana") .'</a></li>
                    </ul>
                    <h5>noc@prohosting24.de</h5>
                    <h5>abuse@prohosting24.de</h5>
                </div>
                <div class="col-sm-2">
                    <h4>' .$lang->getString("legal") .'</h4>
                    <ul>
                        <li><a href="' . $url . '/'.$lang->getString("imprinturl") .'">' .$lang->getString("imprint") .'</a></li>
                        <li><a href="' . $url . '/'.$lang->getString("tosurl") .'">' .$lang->getString("tos") .'</a></li>
                        <li><a href="' . $url . '/'.$lang->getString("contacturl") .'">' .$lang->getString("contact") .'</a></li>
                        <li><a href="' . $url . '/'.$lang->getString("privacyurl") .'">' .$lang->getString("privacy") .'</a></li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    <h4>' .$lang->getString("address") .'</h4>
                    <div class="location-info">
                        <h5>ProHosting24</h5>
                        <h5>z.Hd. Nicolas Janzen</h5>
                        <h5>Ellernkamp, 6A<h5>
                        <h5>33818, Leopoldshöhe</h5>
                        <br>
                        <h5>+49 (0) 5208 286 99 33</h5>
                        <h5>info@prohosting24.de</h5>
                    </div>
                </div>
                <div class="col-sm-2">
                    <h4>' .$lang->getString("social") .'</h4>
                    <div class="social-media">
                        <a target="_blank" rel="noopener noreferrer nofollow" href="https://twitter.com/ProHosting24"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" rel="noopener noreferrer nofollow" href="https://www.instagram.com/prohosting24"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" rel="noopener noreferrer nofollow" href="https://www.youtube.com/prohosting24"><i class="fab fa-youtube"></i></a>
                        <a target="_blank" rel="noopener noreferrer nofollow" href="http://discord.prohosting24.de"><i class="fab fa-discord"></i></a>
                        <a target="_blank" rel="noopener noreferrer nofollow" href="ts3server://ph24"><i class="fab fa-teamspeak"></i> </a>
                        <a target="_blank" rel="noopener noreferrer nofollow" href="https://www.facebook.com/ProHosting24"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>';
}

function gettopbar($config, $user, $lang)
{
    $url = $config->getconfigvalue('url');
    $welcomestring = $lang->getString("welcome");
    $loginstring = '<a class="topbar-link" href="' . $url . '/login"><i class="fa fa-user"></i> ' .$lang->getString("login") .'</a>';
    if ($user->getUsername() != "") {
        $welcomestring = $lang->getString("welcomeuser") . " " . $user->getUsername();
        $loginstring = '<a class="topbar-link" href="' . $url . '/cp/"><i class="fa fa-user"></i> ' .$lang->getString("clientarea") .'</a>';
        if ($user->checkright(1)) {
            $loginstring .= '<a class="topbar-link" href="' . $url . '/admin/"><i class="fa fa-user"></i> ' .$lang->getString("adminarea") .'</a>';
        }
        
        $loginstring .= '<a class="topbar-link" href="' . $url . '/logout"><i class="fas fa-sign-out-alt"></i> ' .$lang->getString("logout") .'</a>';
    }
    return '
    <div class="top-bar margin-for-home">
        <div class="custom-width">
            <div class="left-topbar aligment-for-home">
                <p>' . $welcomestring . '</p>
            </div>
            <div class="right-topbar">
            <a class="topbar-link" href="mailto:info@prohosting24.de"><i class="fa fa-envelope"></i>
            info@prohosting24.de</a>
            <a class="topbar-link hidden-xs" href="tel:+4952082869933"><i class="fa fa-phone"></i>
            +49 (0) 5208 286 99 33</a>' .
        $loginstring
        . '</div>
        </div>
    </div>

    ';
}

function getnavbar($config, $lang)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
    <nav class="navbar navbar-default dark navbar-sticky no-background bootsnav">
        <div class="custom-width">
            <div class="navbar-header" style="padding-top: 7px; padding-bottom: 7px;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu" aria-label="Menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="' . $url . '"><img src="' .$lang->getString("logourl") .'" style="width: 220px; margin-top: 1%; margin-bottom: 1%;" class="logo"alt=""></img></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeIn" data-out="fadeOut">
                    <li><a href="' . $url . '/webspace">' .$lang->getString("webhosting") .'</a></li>
                    <li><a href="' . $url . '/domains">' .$lang->getString("domains") .'</a></li>
                    <li class="dropdown">
                        <a href="' . $url . '/server" class="dropdown-toggle" data-toggle="dropdown">Server</a>
                        <ul class="dropdown-menu">
                        <li><a href="' . $url . '/'.$lang->getString("vps") .'">' .$lang->getString("vserver") .'</a></li>
                        <li><a href="' . $url . '/'.$lang->getString("vpsplans") .'">' .$lang->getString("vserverpackage") .'</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="' . $url . '/apps" class="dropdown-toggle" data-toggle="dropdown">' .$lang->getString("applications") .'</a>
                        <ul class="dropdown-menu">
                            <li><a href="' . $url . '/mariadb">MariaDB</a></li>
                            <li><a href="' . $url . '/postgresql">PostgreSQL</a></li>
                            <li><a href="' . $url . '/mongodb">MongoDB</a></li>
                            <li><a href="' . $url . '/redis">Redis</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="' . $url . '/apps" class="dropdown-toggle" data-toggle="dropdown">Gameserver</a>
                        <ul class="dropdown-menu">
                            <li><a href="' . $url . '/minecraft">Minecraft Java</a></li>
                            <li><a href="' . $url . '/minecraft-nukkit">Minecraft Nukkit</a></li>
                            <li><a href="' . $url . '/minecraft-pocketmine">Minecraft Pocketmine</a></li>
                            <li><a href="' . $url . '/rust">Rust</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="buttons">
                            <a style="margin-top: 10%; margin-bottom: 7%;" href="' . $url . '/'.$lang->getString("cp") .'" target="_blank" class="btn btn-small btn-green">' .$lang->getString("clientarea") .'</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    
    <script type="text/javascript" charset="UTF-8">
    document.addEventListener(\'DOMContentLoaded\', function () {
    cookieconsent.run({"notice_banner_type":"simple","consent_type":"express","palette":"dark","language":"de","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"ProHosting24","website_privacy_policy_url":"https://prohosting24.de/datenschutz"});
    });
    </script>
    <script type="text/plain" cookie-consent="functionality">
    (function(w, d, s, u) {
        w.RocketChat = function(c) { w.RocketChat._.push(c) }; w.RocketChat._ = []; w.RocketChat.url = u;
        var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
        j.async = true; j.src = \'https://chat.prohosting24.de/livechat/rocketchat-livechat.min.js?_=201903270000\';
        h.parentNode.insertBefore(j, h);
    })(window, document, \'script\', \'https://chat.prohosting24.de/livechat\');
    </script>';
}

function gettwitterbanner($config, $lang)
{
    return '
    <div class="call-to-action2">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-12">
                    <h4>' .$lang->getString("twitter") .'<span> <a style="color: white" target="_blank" rel="noopener noreferrer nofollow" href="https://twitter.com/ProHosting24">@ProHosting24</a></span></h4>
                </div>
            </div>
        </div>
    </div>';
}

function getloadinghtml($id = "load", $hide = false)
{
    $hidehtml = '';
    if ($hide) {
        $hidehtml = "style='display:none'";
    }
    return "
	<div id='" . $id . "' class='sk-circle' " . $hidehtml . ">
		<div class='sk-circle1 sk-child'></div>
		<div class='sk-circle2 sk-child'></div>
		<div class='sk-circle3 sk-child'></div>
		<div class='sk-circle4 sk-child'></div>
		<div class='sk-circle5 sk-child'></div>
		<div class='sk-circle6 sk-child'></div>
		<div class='sk-circle7 sk-child'></div>
		<div class='sk-circle8 sk-child'></div>
		<div class='sk-circle9 sk-child'></div>
		<div class='sk-circle10 sk-child'></div>
		<div class='sk-circle11 sk-child'></div>
		<div class='sk-circle12 sk-child'></div>
	</div>";
}

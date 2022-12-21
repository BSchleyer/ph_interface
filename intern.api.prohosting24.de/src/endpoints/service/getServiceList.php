<?php

defined('RZGvsletoIujWnzKrNyB') or die();

$apirespond = requestBackend($config, ["userid" => $user->getId()], "getownservices");
$cpUrl = $config->getConfigValue("cpURL");









if ($apirespond == null) {
    
    $response->setfail(true, $lang->getString("error"));
    print_r(json_encode($response->getresponsearray()));
    die();
}

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}

$groups = [];

foreach ($apirespond["response"]["groups"] as $group) {
    $groups[$group["id"]] = $group;
    $groups[$group["id"]]["servicehtml"] = "";
}

$returnHTMLvserver = "";

$returnHTMLteamspeak = "";

$returnHTMLwebspace = "";

$returnHTMLdomain = "";

$returnHTMLapp = "";
if (isset($apirespond["response"]["vserver"])) {
    foreach ($apirespond["response"]["vserver"] as $entry) {
        $manageButton = '<a href="' . $cpUrl . 'vserver/details/' . $entry["id"] . '" class="btn btn-sm btn-primary font-weight-bolder px-6">' . $lang->getString("servicevpsmanage") . '</a>';
        switch ($entry["status"]) {
            case 'running':
                $statusBadgeColor = "bg-success";
                $statusBadgeName = $lang->getString("online");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'stopped':
                $statusBadgeColor = "bg-warning";
                $statusBadgeName = $lang->getString("offline");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'starting':
                $statusBadgeColor = "bg-success";
                $statusBadgeName = "Startet";
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'stopping':
            case 'shutdown':
                $statusBadgeColor = "bg-warning";
                $statusBadgeName = "Stoppt";
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'installing':
                $statusBadgeColor = "bg-primary";
                $statusBadgeName = $lang->getString("installation");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'expired':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("expired");
                $timeName = $lang->getString("servicedelete");
                $timeleft = $entry["delete_at"];
                break;
            case 'deleted':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("deleted");
                $timeName = "";
                $timeleft = $entry["delete_at"];
                $manageButton = '<a id="service_hide_' . $entry["mainid"] . '" href="javascript:hideService(' . $entry["mainid"] . ')" class="btn btn-sm btn-danger font-weight-bolder px-6">' . $lang->getString("hide") . '</a>';
                break;
            case 'locked':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("locked");
                $timeName = $lang->getString("serviceexpire");
                $manageButton = '';
                $timeleft = $entry["timeleft"];
                break;
            default:
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("errorContactSupport");
                $timeName = $lang->getString("errorContactSupport");
                $timeleft = 0;
                break;
        }
        if ($entry["hourly"] == 1) {
            $timeName = "Nächste Berechnung in:";
        }
        $countId = "masterTime_" . $entry["id"];
        $header = "Server-ID: #" . $entry["id"];
        if ($entry["name"] != null) {
            $header = $entry["name"];
        }
        $return = '<div class="col-xl-4 servicecard" draggable="true" ondragstart="drag(event)" id="service_' . $entry["id"] . '" productid="1" serviceid="' . $entry["id"] . '">
    <div class="card card-custom">
        <div class="card-header ribbon ribbon-top">
            <div class="ribbon-target ' . $statusBadgeColor . '" style="margin-left: 10px; right: 20px;">' . $statusBadgeName . '</div>
            <h3 class="card-title" >
                <i class="fas fa-server icon-xxl">&nbsp</i>&nbsp;' . $header . '&nbsp;<a href="javascript:changeServiceName(' . $entry["id"] . ',\'' . $header . '\',1);"><i class="fas fa-edit"></i></a>
            </h3>
        </div>
        <div class="card-body padding15a">
            <div class="center-text">
            ' . $manageButton . '
            </div>
            <div class="center-text top10 bottom10">
                <span class="font-weight-bolder font-size-h4">' . $timeName . '</span><br>
                <span class="font-weight-bolder font-size-h7" id="' . $countId . '"><script>countDownArray.push(["' . $countId . '",' . $timeleft . '])</script></span>
            </div>
        </div>
    </div>
</div>';
        if (isset($groups[$entry["groupid"]])) {
            $groups[$entry["groupid"]]["servicehtml"] .= $return;
        } else {
            $returnHTMLvserver .= $return;
        }
    }
}
if (isset($apirespond["response"]["webspace"])) {
    foreach ($apirespond["response"]["webspace"] as $entry) {
        $manageButton = '<a href="' . $cpUrl . 'webspace/details/' . $entry["id"] . '" class="btn btn-sm btn-primary font-weight-bolder px-6">' . $lang->getString("servicewebspacemanage") . '</a>';
        switch ($entry["status"]) {
            case 'running':
                $statusBadgeColor = "bg-success";
                $statusBadgeName = $lang->getString("online");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'expired':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("expired");
                $timeName = $lang->getString("servicedelete");
                $timeleft = $entry["delete_at"];
                break;
            case 'deleted':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("deleted");
                $timeName = "";
                $timeleft = $entry["delete_at"];
                $manageButton = '<a id="service_hide_' . $entry["mainid"] . '" href="javascript:hideService(' . $entry["mainid"] . ')" class="btn btn-sm btn-danger font-weight-bolder px-6">' . $lang->getString("hide") . '</a>';
                break;
            case 'locked':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("locked");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                $manageButton = '';
                break;

            default:
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("error");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = 0;
                break;
        }
        $header = "Webspace-ID: #" . $entry["id"];
        if ($entry["name"] != null) {
            $header = $entry["name"];
        }
        $countId = "masterTime_" . $entry["id"];
        $return = '<div class="col-xl-4 servicecard"  draggable="true" ondragstart="drag(event)" id="service_' . $entry["id"] . '" productid="2" serviceid="' . $entry["id"] . '">
    <div class="card card-custom">
        <div class="card-header ribbon ribbon-top">
            <div class="ribbon-target ' . $statusBadgeColor . '" style="margin-left: 10px; right: 20px;">' . $statusBadgeName . '</div>
            <h3 class="card-title" >
                <i class="fas fa-globe-americas icon-xxl">&nbsp</i>&nbsp;' . $header . '&nbsp;<a href="javascript:changeServiceName(' . $entry["id"] . ',\'' . $header . '\',2);"><i class="fas fa-edit"></i></a>
            </h3>
        </div>
        <div class="card-body padding15a">
            <div class="center-text">
                ' . $manageButton . '
            </div>
            <div class="center-text top10 bottom10">
                <span class="font-weight-bolder font-size-h4">' . $timeName . '</span><br>
                <span class="font-weight-bolder font-size-h7" id="' . $countId . '"><script>countDownArray.push(["' . $countId . '",' . $timeleft . '])</script></span>
            </div>
        </div>
    </div>
</div>';
        if (isset($groups[$entry["groupid"]])) {
            $groups[$entry["groupid"]]["servicehtml"] .= $return;
        } else {
            $returnHTMLwebspace .= $return;
        }
    }
}
if (isset($apirespond["response"]["domains"])) {
    foreach ($apirespond["response"]["domains"] as $entry) {
        $statusBadgeName = $lang->getString("locked");
        $manageButton = '<a href="' . $cpUrl . 'domain/details/' . $entry["id"] . '" class="btn btn-sm btn-primary font-weight-bolder px-6">' . $lang->getString("servicedomainmanage") . '</a>';
        switch ($entry["status"]) {
            case 'running':
                $statusBadgeColor = "bg-success";
                $statusBadgeName = $lang->getString("online");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'expired':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("expired");
                $timeName = $lang->getString("servicedelete");
                $timeleft = $entry["delete_at"];
                break;
            case 'deleted':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("deleted");
                $timeName = "";
                $timeleft = $entry["delete_at"];
                $manageButton = '<a id="service_hide_' . $entry["mainid"] . '" href="javascript:hideService(' . $entry["mainid"] . ')" class="btn btn-sm btn-danger font-weight-bolder px-6">' . $lang->getString("hide") . '</a>';
                break;
            case 'locked':
                $statusBadgeColor = "bg-danger";
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                $manageButton = '';
                break;

            default:
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("error");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = 0;
                break;
        }
        $countId = "masterTime_" . $entry["id"];
        $return = '<div class="col-xl-4 servicecard" draggable="true" ondragstart="drag(event)" id="service_' . $entry["id"] . '" productid="4" serviceid="' . $entry["id"] . '">
    <div class="card card-custom">
        <div class="card-header ribbon ribbon-top">
            <div class="ribbon-target ' . $statusBadgeColor . '" style="margin-left: 10px; right: 20px;">' . $statusBadgeName . '</div>
            <h3 class="card-title" >
                <i class="fas fa-at icon-xxl">&nbsp</i>&nbsp;' . $entry["sld"] . "." . $entry["tld"] . '
            </h3>
        </div>
        <div class="card-body padding15a">
            <div class="center-text">
                ' . $manageButton . '
            </div>
            <div class="center-text top10 bottom10">
                <span class="font-weight-bolder font-size-h4">' . $timeName . '</span><br>
                <span class="font-weight-bolder font-size-h7" id="' . $countId . '"><script>countDownArray.push(["' . $countId . '",' . $timeleft . '])</script></span>
            </div>
        </div>
    </div>
</div>';
        if (isset($groups[$entry["groupid"]])) {
            $groups[$entry["groupid"]]["servicehtml"] .= $return;
        } else {
            $returnHTMLdomain .= $return;
        }
    }
}

if (isset($apirespond["response"]["app"])) {
    foreach ($apirespond["response"]["app"] as $entry) {
        $manageButton = '<a href="' . $cpUrl . 'app/details/' . $entry["id"] . '" class="btn btn-sm btn-primary font-weight-bolder px-6">' . $lang->getString("serviceappmanage") . '</a>';
        switch ($entry["status"]) {
            case 'running':
                $statusBadgeColor = "bg-success";
                $statusBadgeName = $lang->getString("online");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'offline':
                $statusBadgeColor = "bg-warning";
                $statusBadgeName = $lang->getString("offline");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'expired':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("expired");
                $timeName = $lang->getString("servicedelete");
                $timeleft = $entry["delete_at"];
                break;
            case 'installing':
                $statusBadgeColor = "bg-primary";
                $statusBadgeName = $lang->getString("installation");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                break;
            case 'deleted':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("deleted");
                $timeName = "";
                $timeleft = $entry["delete_at"];
                $manageButton = '<a id="service_hide_' . $entry["mainid"] . '" href="javascript:hideService(' . $entry["mainid"] . ')" class="btn btn-sm btn-danger font-weight-bolder px-6">' . $lang->getString("hide") . '</a>';
                break;
            case 'locked':
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("locked");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = $entry["timeleft"];
                $manageButton = '';
                break;

            default:
                $statusBadgeColor = "bg-danger";
                $statusBadgeName = $lang->getString("error");
                $timeName = $lang->getString("serviceexpire");
                $timeleft = 0;
                break;
        }
        $countId = "masterTime_" . $entry["id"];
        $header = $entry["displayname"] . " - #" . $entry["id"];
        if ($entry["name"] != null) {
            $header = $entry["name"];
        }
        $return = '<div class="col-xl-4 servicecard" draggable="true" ondragstart="drag(event)" id="service_' . $entry["id"] . '" productid="5" serviceid="' . $entry["id"] . '">
        <div class="card card-custom">
            <div class="card-header ribbon ribbon-top">
                <div class="ribbon-target ' . $statusBadgeColor . '" style="margin-left: 10px; right: 20px;">' . $statusBadgeName . '</div>
                <h3 class="card-title" >
                    <i class="fab fa-docker icon-xxl">&nbsp</i>&nbsp;' . $header . '&nbsp;<a href="javascript:changeServiceName(' . $entry["id"] . ',\'' . $header . '\',5);"><i class="fas fa-edit"></i></a>
                </h3>
            </div>
            <div class="card-body padding15a">
                <div class="center-text">
                    ' . $manageButton . '
                </div>
                <div class="center-text top10 bottom10">
                    <span class="font-weight-bolder font-size-h4">' . $timeName . '</span><br>
                    <span class="font-weight-bolder font-size-h7" id="' . $countId . '"><script>countDownArray.push(["' . $countId . '",' . $timeleft . '])</script></span>
                </div>
            </div>
        </div>
    </div>';
        if (isset($groups[$entry["groupid"]])) {
            $groups[$entry["groupid"]]["servicehtml"] .= $return;
        } else {
            $returnHTMLapp .= $return;
        }
    }
}

$return = "";

foreach ($groups as $group) {
    $return .= '<h4 class="text-dark font-weight-bold my-1 mr-5 top20" id="main_vserver_header" ondragover="allowDrop(event)" ondrop="drop(event)" childId="main_' . $group["id"] . '" groupid="' . $group["id"] . '">' . $group["displayname"] . '&nbsp;<a href="javascript:openGroupDelete(' . $group["id"] . ');"><i class="far fa-trash-alt"></i></a>&nbsp;<a href="javascript:openGroupEdit(' . $group["id"] . ',\'' . $group["displayname"] . '\');"><i class="far fa-edit"></i></a></h4>
    <div class="row" id="main_' . $group["id"] . '" ondragover="allowDrop(event)" ondrop="drop(event)" groupid="' . $group["id"] . '">' . $group["servicehtml"] . '
    </div>';
}

if ($returnHTMLvserver != "") {
    $return .= '<h4 class="text-dark font-weight-bold my-1 mr-5 top20" id="main_vserver_header" childId="main_vserver">' . $lang->getString("vserver") . '</h4>
    <div class="row" id="main_vserver">' . $returnHTMLvserver . '
    </div>';
}
if ($returnHTMLwebspace != "") {
    $return .= '<h4 class="text-dark font-weight-bold my-1 mr-5 top20" id="main_webspace_header" childId="main_webspace">' . $lang->getString("webhosting") . '</h4>
    <div class="row" id="main_webspace">' . $returnHTMLwebspace . '
    </div>';
}
if ($returnHTMLdomain != "") {
    $return .= '<h4 class="text-dark font-weight-bold my-1 mr-5 top20" id="main_domain_header" childId="main_domain">' . $lang->getString("domain") . '</h4>
    <div class="row" id="main_domain">' . $returnHTMLdomain . '
    </div>';
}
if ($returnHTMLapp != "") {
    $return .= '<h4 class="text-dark font-weight-bold my-1 mr-5 top20" id="main_app_header" childId="main_app">' . $lang->getString("applications") . '</h4>
    <div class="row" id="main_app">' . $returnHTMLapp . '
    </div>';
}

$response->setresponse($return);

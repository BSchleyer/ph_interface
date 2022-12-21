<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["id"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}
$ownerid = requestBackend($config, ["id" => $_POST["id"]], "getvserverowner");
if ($ownerid["response"] != $user->getID()) {
    $accessUser = requestBackend($config, ["id" => $_POST["id"],"productid" => 1, "userid" => $user->getID()], "getAccessUserInfoByProduct");
    if(!$accessUser["response"]["access"] || !isset($accessUser["response"]["access"])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
    if(!isset($accessUser["response"]["rights"][9])){
        $response->setfail(true, $lang->getString("vservernotowner"));
        print_r(json_encode($response->getresponsearray()));
        die();
    }
}


$apirespond = requestBackend($config, ["vserver" => $_POST["id"]], "gettrafficforvserver");

$htmlReturn = "";

foreach ($apirespond["response"] as $year => $month) {
    $htmlReturn .= "<div> <h3>Jahr ". $year ."</h3>
    <table class='white-text table table-head-noborder'>
        <thead>
            <tr>
                <th>Monat</th>
                <th>Traffic in</th>
                <th>Traffic Out</th>
            </tr>
        </thead><tbody>";
    foreach ($month as $monthName => $monthData) {

        switch ($monthName) {
            case '1':
                $monthName = "Januar";
                break;
            case '2':
                $monthName = "Februar";
                break;
            case '3':
                $monthName = "März";
                break;
            case '4':
                $monthName = "April";
                break;
            case '5':
                $monthName = "Mai";
                break;
            case '6':
                $monthName = "Juni";
                break;
            case '7':
                $monthName = "Juli";
                break;
            case '8':
                $monthName = "August";
                break;
            case '9':
                $monthName = "September";
                break;
            case '10':
                $monthName = "Oktober";
                break;
            case '11':
                $monthName = "November";
                break;
            case '12':
                $monthName = "Dezember";
                break;
            default:
                $monthName = "Fehler";
                break;
        }
        if(isset($monthData["in"])){
            $htmlReturn .= "<tr>
            <th scope='row'>".$monthName."</th>
            <td>".round($monthData["in"] / 1000,2) . " GB</td>
            <td>".round($monthData["out"] / 1000,2) ." GB</td>
            </tr>";
        }
    }   
    $htmlReturn .= "</tbody></table></div>";
}

$response->setresponse($htmlReturn);

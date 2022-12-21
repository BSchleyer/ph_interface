<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["ticketid"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$id = explode("_",$_POST["ticketid"]);

if(count($id) != 1){
    $id = $id[1];
} else {
    $id = $_POST["ticketid"];
}


$ticketinfo = requestBackend($config, ["ticketid" => $id, "admin" => 0], "getticketdetails");

if ($ticketinfo["response"][0]["userid"] != $user->getID()) {
    
    $response->setfail(true, $lang->getString("ticketerrornotowner"));
    return;
}

$responseHTML = '<div class="d-flex align-items-center justify-content-between flex-wrap card-spacer-x py-5">
<div class="d-flex align-items-center mr-2 py-2">
    <div class="font-weight-bold font-size-h3 mr-3">'.$ticketinfo["response"][0]["title"].'</div>
</div>
</div>
<div class="mb-3">
';

foreach ($ticketinfo["response"]["answer"] as $ticket) {
    $responseHTML .= '<div class="cursor-pointer shadow-xs toggle-on" data-inbox="message">
    <div class="d-flex align-items-center card-spacer-x py-6">
        <span class="symbol symbol-light-primary symbol-35 mr-3">
            <span class="symbol-label font-weight-bolder">'.mb_substr($ticket["vorname"], 0, 1). mb_substr($ticket["nachname"], 0, 1).'</span>
        </span>
        <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
            <div class="d-flex">
                <a class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">'.$ticket["vorname"].' '.$ticket["nachname"].'</a>
                <div class="font-weight-bold text-muted">
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="font-weight-bold text-muted mr-2">'.$ticket["created_on"].'</div>
        </div>
    </div>
    <div class="card-spacer-x py-3 toggle-off-item">
        <p>'.$ticket["text"].'</p>
    </div>
</div>';
}

$responseHTML .= '</div>';

$response->setresponse(minifyhtml($responseHTML));

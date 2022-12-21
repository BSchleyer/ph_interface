<?php

defined('RZGvsletoIujWnzKrNyB') or die();


$apirespond = requestBackend($config, ["status" => [0,1,2,4,5], "admin" => 0, "userid" => $user->getID()], "gettickets");

if ($apirespond["fail"] == 1) {
    
    $response->setfail(true, $apirespond["error"]);
    print_r(json_encode($response->getresponsearray()));
    die();
}


$htmlReturn = "";

foreach ($apirespond["response"] as $ticket) {
    switch ($ticket["status"]) {
        case '0':
            $statusBadge = '<span class="label label-light-primary font-weight-bold label-inline mr-1">'. $lang->getString("ticketwaitforreply").'</span>';
            break;
        case '1':
            $statusBadge = '<span class="label label-light-primary font-weight-bold label-inline mr-1">'. $lang->getString("ticketwaitforreply").'</span>';
            break;
        case '2':
            $statusBadge = '<span class="label label-light-success font-weight-bold label-inline mr-1">'. $lang->getString("ticketanswernow").'</span>';
            break;
        case '3':
            $statusBadge = '<span class="label label-light-danger font-weight-bold label-inline">'. $lang->getString("ticketclosed").'</span>';
            break;
        case '4':
            $statusBadge = '<span class="label label-light-danger font-weight-bold label-inline">'. $lang->getString("ticketsuspended").'</span>';
            break;
        case '5':
            $statusBadge = '<span class="label label-light-success font-weight-bold label-inline">'. $lang->getString("ticketinprogress").'</span>';
            break;
        default:
            $statusBadge = '<span class="label label-light-danger font-weight-bold label-inline">Error</span>';
            break;
    }
    $htmlReturn .= '<div id="ticket_'. $ticket["id"].'" class="d-flex align-items-start list-item card-spacer-x py-3" data-inbox="message">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center mr-3" data-inbox="actions">
                <a id="action_close_ticket'.$ticket["id"].'" onClick="closeTicket('.$ticket["id"].')" class="btn btn-icon btn-xs text-hover-warning" data-toggle="tooltip" data-placement="right" title="'. $lang->getString("ticketclose").'">
                    <i class="flaticon-lock text-muted"></i>
                </a>
            </div>
            <div class="d-flex align-items-center flex-wrap w-xxl-200px mr-3" data-toggle="view">
            <div class="symbol symbol-light-primary symbol-35 mr-3">
                <span class="symbol-label font-weight-bolder">PH</span>
            </div>
            <a class="font-weight-bold text-dark-75 text-hover-primary">ProHosting24</a>
        </div>														
    </div>
    <div class="flex-grow-1 mt-2 mr-2" data-toggle="view">
        <div>
            <span class="font-weight-bolder font-size-lg mr-2">'.$ticket["title"].'</span>
        </div>
        <div class="mt-2">
            '.$statusBadge.'
        </div>
    </div>
    <div class="mt-2 mr-3 font-weight-bolder text-right" data-toggle="view">'.$ticket["created_on"].'</div>
</div>';
}

$response->setresponse(minifyhtml($htmlReturn));

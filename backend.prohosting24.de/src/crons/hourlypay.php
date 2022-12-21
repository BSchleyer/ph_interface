<?php




$hourlymoneyNotPaid  = $masterdatabase->select("hourly_log",[
    "[>]service_main" => ["serviceid" => "id"],
], [
    "hourly_log.price",
    "hourly_log.id",
    "service_main.userid"
], [
    "hourly_log.paid[=]" => 0,
]);

$data = [];

foreach ($hourlymoneyNotPaid as $entry){
    if(!isset($data[$entry["userid"]])){
        $data[$entry["userid"]] = [];
        $data[$entry["userid"]]["price"] = 0;
        $data[$entry["userid"]]["id"] = [];
        $data[$entry["userid"]]["id"]["log"] = [];
        $data[$entry["userid"]]["id"]["in"] = [];
        $data[$entry["userid"]]["id"]["out"] = [];
    }
    $data[$entry["userid"]]["price"] += $entry["price"];
    $data[$entry["userid"]]["id"]["log"][] = $entry["id"];
}

$hourlyTrafficInNotPaid  = $masterdatabase->select("hourly_traffic_in",[
    "[>]service_main" => ["serviceid" => "id"],
], [
    "hourly_traffic_in.price",
    "hourly_traffic_in.id",
    "service_main.userid"
], [
    "hourly_traffic_in.paid[=]" => 0,
]);


foreach ($hourlyTrafficInNotPaid as $entry){
    if(!isset($data[$entry["userid"]])){
        $data[$entry["userid"]] = [];
        $data[$entry["userid"]]["price"] = 0;
        $data[$entry["userid"]]["id"] = [];
        $data[$entry["userid"]]["id"]["log"] = [];
        $data[$entry["userid"]]["id"]["in"] = [];
        $data[$entry["userid"]]["id"]["out"] = [];
    }
    $data[$entry["userid"]]["price"] += $entry["price"];
    $data[$entry["userid"]]["id"]["in"][] = $entry["id"];
}


$hourlyTrafficOutNotPaid  = $masterdatabase->select("hourly_traffic_out",[
    "[>]service_main" => ["serviceid" => "id"],
], [
    "hourly_traffic_out.price",
    "hourly_traffic_out.id",
    "service_main.userid"
], [
    "hourly_traffic_out.paid[=]" => 0,
]);

foreach ($hourlyTrafficOutNotPaid as $entry){
    if(!isset($data[$entry["userid"]])){
        $data[$entry["userid"]] = [];
        $data[$entry["userid"]]["price"] = 0;
        $data[$entry["userid"]]["id"] = [];
        $data[$entry["userid"]]["id"]["log"] = [];
        $data[$entry["userid"]]["id"]["in"] = [];
        $data[$entry["userid"]]["id"]["out"] = [];
    }
    $data[$entry["userid"]]["price"] += $entry["price"];
    $data[$entry["userid"]]["id"]["out"][] = $entry["id"];
}

foreach ($data as $userId => $price){
    $user = new User();
    $user->load_id($masterdatabase, $userId);
    $user->changeguthaben($masterdatabase, $price["price"] * -1, "Stündliche KVM Server abrechnung. " . date('M Y'));

    $masterdatabase->update("hourly_log",[
        "paid" => 1
    ],[
        "id" => $price["id"]["log"]
    ]);
    $masterdatabase->update("hourly_traffic_in",[
        "paid" => 1
    ],[
        "id" => $price["id"]["in"]
    ]);
    $masterdatabase->update("hourly_traffic_out",[
        "paid" => 1
    ],[
        "id" => $price["id"]["out"]
    ]);
}
<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["username", "email", "password", "vorname", "nachname", "lang"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}


$fields = [
    'username' => $_POST["username"],
    'email' => $_POST["email"],
    'password' => $_POST["password"],
    'vorname' => $_POST["vorname"],
    'nachname' => $_POST["nachname"],
    'lang' => $_POST["lang"],
    'sessionid' => 1,
    'ip' => getclientip(),
];

if(isset($_POST["affiliate"])) {
    $fields["affiliate"] = $_POST["affiliate"];
}
if(!isset($_POST["lang"])) {
    $selectedLang = "de";
    global $selectedLang;
} else {
    $selectedLang = "en";
    global $selectedLang;
}



$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $config->getconfigvalue("backendendpoint"),
    CURLOPT_USERAGENT => 'ProHosting24 Intern',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $fields,
]);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Function: createuser',
    'key: ' . $config->getconfigvalue("backendapikey"),
));

$apirespond = json_decode(curl_exec($curl), true);

curl_close($curl);
if ($apirespond["fail"] == 1) {
    $response->setfail(true, $apirespond["error"]);
    return;
}

$response->setresponse($apirespond["response"]);

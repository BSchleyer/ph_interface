<?php

defined('RZGvsletoIujWnzKrNyB') or die();

if (!checkpost($_POST, ["username", "email", "password"])) {
    $response->setfail(true, $lang->getString("missingpostvariable"));
    return;
}

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $config->getconfigvalue("backendendpoint"),
    CURLOPT_USERAGENT => 'ProHosting24 Intern',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => [
        'username' => $_POST["username"],
        'email' => $_POST["email"],
        'password' => $_POST["password"],
    ],
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

$response->setresponse($lang->getString("responseusercreatedsuccessfully"));

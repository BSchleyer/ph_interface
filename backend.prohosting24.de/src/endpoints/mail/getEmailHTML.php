<?php

defined('Sp5Rc08l2TtOjxxSIiCf') or die();

if (!checkpost($_POST, ["userid","id"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}

$mail = new Mail($masterdatabase, $config);

$mailDetails = $mail->getSingleEmail($_POST["userid"], $_POST["id"]);

if(count($mailDetails) != 1){
    $response->fail(404, "Mail not found");
}

$mailDetails = $mailDetails[0];

$content = "";

$template = $mail->gettemplatename($mailDetails["template"]);

$template = $template[0];

$content = $template["header"] . $template["data"] . $template["htmlfooter"];

if(isset($mailDetails["data"])){
    $data = json_decode($mailDetails["data"],true);
} else {
    $data = [];
}

$user = new UserNew($dependencyInjector, $_POST["userid"]);

$data["name"] = htmlspecialchars($user->getValue("vorname") . " " . $user->getValue("nachname"));

$content = $mail->convertEmailContent($content, $data, $dependencyInjector);
$title = $mail->convertEmailContent($mailDetails["title"], $data, $dependencyInjector);

$response->setresponse([
    "content" => $content,
    "title" => $title
]);
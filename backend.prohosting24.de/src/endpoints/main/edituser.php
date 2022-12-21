<?php


defined('Sp5Rc08l2TtOjxxSIiCf') or die();


if (!checkpost($_POST, ["userid", "email", "passwort", "vorname", "nachname", "loginemail", "newsletter", "lang","darkmode"])) {
    $response->setfail(true, "Missing Variable in POST");
    return;
}
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $response->setfail(true, "Ungültiges E-Mail Format");
    return;
}

$emailcountcheck = $masterdatabase->select("main_user", [
    "id",
], [
    "email" => strtolower($_POST["email"]),
]);

if (count($emailcountcheck) != 0) {
    
    foreach ($emailcountcheck as $user) {
        if ($user["id"] != $_POST["userid"]) {
            $response->setfail(true, "Diese Email ist vergeben.");
            return;
        }
    }
}

if($_POST["newsletter"] != 0){
    if($_POST["newsletter"] != 1){
        $_POST["newsletter"] = 0;
    }
}

$lang = new Language($dependencyInjector, null);

$langList = $lang->getAll(["lang" => $_POST["lang"]]);
if(count($langList) != 1){
    $response->setfail(true, "Bitte wählen Sie eine Sprache aus.");
    return;
}

$data = [
    "vorname" => htmlspecialchars($_POST["vorname"]),
    "nachname" => htmlspecialchars($_POST["nachname"]),
    "loginemail" => $_POST["loginemail"],
    "newsletter" => $_POST["newsletter"],
    "lang" => $_POST["lang"],
    "darkmode" => $_POST["darkmode"],
];

$user = new User();
$user->load_id($masterdatabase,$_POST["userid"]);

if($user->getSecret() != null){
    $data["email"] = $_POST["email"];
}

if($_POST["passwort"] == "0"){
    $masterdatabase->update("main_user", $data, [
        "id" => $_POST["userid"],
    ]);
} else {
    if ($_POST["passwort"] == "") {
        $response->setfail(true, "Das Passwort darf nicht leer sein.");
        return;
    }
    if ($_POST["passwort"] == " ") {
        $response->setfail(true, "Das Passwort darf nicht leer sein.");
        return;
    }
    $data["password"] = password_hash($_POST["passwort"], PASSWORD_ARGON2I);
    $masterdatabase->update("main_user", $data, [
        "id" => $_POST["userid"],
    ]);
    $user->deletesessions($masterdatabase);
}
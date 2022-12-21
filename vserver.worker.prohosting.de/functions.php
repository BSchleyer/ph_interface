<?php



function encrypt_decrypt($action, $string, $secret_key, $secret_iv)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    
    $key = hash('sha256', $secret_key);

    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


function sendDataToDiscordFeed($url, $title, $text, $link, $fields = [],$hexColor =  "222226")
{
    $json_data = json_encode([
        "content" => "",
        "username" => "",
        "tts" => false,
        "avatar_url" => "https://cdn.prohosting24.eu/img/logo/logo3.jpg",
        "embeds" => [
            [
                "title" => $title,
                "type" => "rich",
                "description" => $text,
                "url" => $link,
                "timestamp" => date("c", strtotime("now")),
                "color" => hexdec($hexColor),
                "footer" => [
                    "text" => "Ph24 - ProxmoxQueueWorker",
                    "icon_url" => "https://cdn.prohosting24.eu/img/logo/logo3.jpg"
                ],
                "author" => [
                    "name" => "Prohosting24.de",
                    "url" => "https://prohosting24.de/"
                ],
                "fields" => $fields
            ]
        ]

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec( $ch );

    curl_close( $ch );
}
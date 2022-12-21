<?php



function requestBackend($config, $post, $function)
{

    $post_url = '';
    foreach ($post as $key => $value) {
        $post_url .= $key . '=' . $value . '&';
    }

    $post_url = rtrim($post_url, '&');
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $config["backendApiUrl"],
        CURLOPT_USERAGENT => 'ProHosting24 Intern',
        CURLOPT_POST => 1,
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Function: ' . $function,
        'key: ' . $config["backendApiKey"],
    ));
    
    $apirespond = json_decode(curl_exec($curl), true);
    
    curl_close($curl);
    return $apirespond;
}

$config = json_decode(file_get_contents('config.json'), true);

if(!isset($_GET["token"])){
    return;
}

if($config["token"] != $_GET["token"]){
    return;
}

$data = requestBackend($config,[],"getFullLanguageList");

file_put_contents('langs.json', json_encode($data["response"]));
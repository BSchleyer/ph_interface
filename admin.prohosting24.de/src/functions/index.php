<?php


function requestBackend($config, $post, $funktion)
{

    $post_url = '';
    foreach ($post as $key => $value) {
        $post_url .= $key . '=' . $value . '&';
    }

    $post_url = rtrim($post_url, '&');
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $config->getconfigvalue("backendendpoint"),
        CURLOPT_USERAGENT => 'ProHosting24 Intern',
        CURLOPT_POST => 1,
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Function: ' . $funktion,
        'key: ' . $config->getconfigvalue("backendapikey"),
    ));
    
    $apirespond = json_decode(curl_exec($curl), true);
    
    curl_close($curl);
    return $apirespond;
}

function getclientip()
{
    if (isset($_SERVER['HTTP_X_REAL_IP'])) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function minifypage()
{
    echo minifyhtml(ob_get_clean());
}

<?php


    public static function getInbetweenStrings($start, $end, $str)
    {
        $matches = [];
        $regex = "/$start([a-zA-Z0-9_]*)$end/";
        preg_match_all($regex, $str, $matches);
        return $matches[1];
    }

    public static function errorLog($type, $message, $error, $sendToDc = true)
    {
        if(is_object($error)){
            $errorTmp = $error->getMessage() . "\n";
            $errorTmp .= $error->getTraceAsString();
            if(is_a($error, \GuzzleHttp\Exception\ClientException::class)){
                $errorTmp .= $error->getResponse()->getBody();
            }
            $error = $errorTmp;
        }
        $sysLog = new Syslog(Functions::$dependencyInjector, null);
        $sysLog->log($type,[
            "error" => $error,
            "message" => $message
        ]);
        if(!$sendToDc){
            return;
        }

        $fields = [];

        if(is_array($error)) {
            foreach ($error as $key => $value) {
                $fields[] = ["name" => $key, "value" => $value];
            }
            $error = "";
        }

        $json_data = json_encode([
            "content" => "",
            "username" => "",
            "tts" => false,
            "avatar_url" => "https://cdn.prohosting24.eu/img/logo/logo3.jpg",
            "embeds" => [
                [
                    "title" => $message,
                    "type" => "rich",
                    "description" => $error,
                    "timestamp" => date("c", strtotime("now")),
                    "color" => hexdec("#00A8FF"),
                    "footer" => [
                        "text" => "Ph24 - Backend - " . $_SERVER["HTTP_HOST"],
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

        $ch = curl_init( Functions::$dependencyInjector->getConfig()->getconfigvalue("discord_error_channel") );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec( $ch );

        curl_close( $ch );
    }
    
    public static function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            
            mt_rand( 0, 0xffff ),

            
            
            mt_rand( 0, 0x0fff ) | 0x4000,

            
            
            
            mt_rand( 0, 0x3fff ) | 0x8000,

            
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    public static function getCurrentDatePGSQL() {
        $date = new DateTime();
        return $date->format('Y-m-d H:i:s');
    }

    public static function flipIp($ip)
    {
        $ipa = explode(":", $ip);
        if (count($ipa) == 1) {
            $ip = explode(".", $ip);
            $ip = $ip[3] . "." . $ip[2] . "." . $ip[1] . "." . $ip[0];
            return $ip;
        }
        if (count($ipa) == 6) {
            $ipa = explode("::", $ip);
            $ipa = $ipa[0] . ":0:0:0:" . $ipa[1];
            $ipa = explode(":", $ipa);
        }
        $newip = "";
        foreach ($ipa as $key => $value) {
            
            while (strlen($value) < 4) {
                $value = "0" . $value;
            }
            $newip = $newip . "." . $value[0] . "." . $value[1] . "." . $value[2] . "." . $value[3];
        }
        $newip = explode(".", $newip);
        $newipr = "";
        foreach (array_reverse($newip) as $key => $value) {
            $newipr = $newipr . "." . $value;
        }
        return substr(substr($newipr, 1), 0, -1);
    }

}
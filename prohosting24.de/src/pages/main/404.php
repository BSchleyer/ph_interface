<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

echo minifyhtml(getheader($config, "404 - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml('
<div class="default-header error-page" style="background: linear-gradient(to right, rgba(18, 9, 39, 0.9) 0%, transparent 92%, transparent 100%), url(' . $cdn . 'img/dedicated.jpg) center;">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("404title") .'<br> <span class="green-color">' .$lang->getString("404error") .'</span></h2>
                    <br>
                    <p>' .$lang->getString("404text") .'</p>
                </div>
                <div class="buttons">
                    <a href="' . $url . '" class="btn btn-green btn-large">' .$lang->getString("404back") .'<i class="fa fa-share"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));


echo '</body></html>';

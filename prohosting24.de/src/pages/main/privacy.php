<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

echo minifyhtml(getheader($config, $lang->getString("privacypolicy") . " - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');

echo minifyhtml('
<hr>
<div class="padding-top50 custom-width">
<div class="main-title text-center">
    <h3 style="word-wrap: break-word;">'.$lang->getString("privacypolicy").'</h3>
</div>
</div>


<div>
<div class="policy">

    '.$lang->getString("preamble").'
    
    <br>

    '.$lang->getString("typeofdata").'

    <br>

    '.$lang->getString("affectedpersons").'

    <br>

    '.$lang->getString("purposeofprocessing").'

    <br>

    '.$lang->getString("usedterms").'

    <br>

    '.$lang->getString("legalbases").'

    <br>

    '.$lang->getString("securitymeasures").'

    <br>

    '.$lang->getString("cooperation").'

    <br>

    '.$lang->getString("trasnferthirdcountrys").'

    <br>

    '.$lang->getString("rightofdatasubjects").'

    <br>

    '.$lang->getString("rightofwithdrawal").'

    <br>

    '.$lang->getString("datadeletion").'

    <br>

    '.$lang->getString("updatesprivacypolicy").'

    <br>

    '.$lang->getString("businessprocessing").'

    <br>

    '.$lang->getString("orderprocessing").'

    <br>

    '.$lang->getString("agencyservices").'


    <br>

    '.$lang->getString("externalpayment").'

    <br>

    '.$lang->getString("dataorganization").'

    <br>

    '.$lang->getString("businessanalyses").'

    <br>

    '.$lang->getString("affiliatepolicy").'

    <br>

    '.$lang->getString("applicationprivacy").'

    <br>

    '.$lang->getString("privacyregister").'


    <br>

    '.$lang->getString("contactprivacy").'

    <br>

    '.$lang->getString("newsletterprivacy").'

    <br>

    '.$lang->getString("logfiles").'

    <br>

    '.$lang->getString("socialprivacy").'

    <br>

    '.$lang->getString("cloudflareprivacy").'

    <br>

    '.$lang->getString("livechatprivacy").'

    <br>


    
</div>
</div>


');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));


echo '</body></html>';

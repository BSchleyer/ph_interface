<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

echo minifyhtml(getheader($config, $lang->getString("tos") . " - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');

echo minifyhtml('
<hr>
<div class="padding-top50 custom-width">
<div class="main-title text-center">
    <h3 style="word-wrap: break-word;">' .$lang->getString("tost") .'</h3>
</div>
</div>

<div class="policy">

<h3>' .$lang->getString("general") .'</h3>

<p>' .$lang->getString("generalt") .'</p>

<br>

<h3>' .$lang->getString("service") .'</h3>

<p>' .$lang->getString("servicet") .'</p>

<br>

<h3>' .$lang->getString("contractual") .'</h3>

<p>' .$lang->getString("contractualt") .'</p>

<br>

<h3>' .$lang->getString("registrationrules") .'</h3>

<p>' .$lang->getString("registrationrulest") .'</p>

<br>

<h3>' .$lang->getString("customeraccount") .'</h3>

<p>' .$lang->getString("customeraccountt") .'</p>

<br>

<h3>' .$lang->getString("terminateaccount") .'</h3>

<p>' .$lang->getString("terminateaccountt") .'</p>

<br>

<h3>' .$lang->getString("donations") .'</h3>

<p>' .$lang->getString("donationst") .'</p>

<br>

<h3>' .$lang->getString("withdrawal") .'</h3>

<p>' .$lang->getString("withdrawalt") .'</p>

<br>

<h3>' .$lang->getString("liability") .'</h3>

<p>' .$lang->getString("liabilityt") .'</p>

<br>

<h3>' .$lang->getString("toschange") .'</h3>

<p>' .$lang->getString("toschanget") .'</p>

<br>

<h3>' .$lang->getString("abuseprohibition") .'</h3>

<p>' .$lang->getString("abuseprohibitiont") .'</p>

<br>

<h3>' .$lang->getString("sharedhosting") .'</h3>

<p>' .$lang->getString("sharedhostingt") .'</p>

<br>

<h3>' .$lang->getString("otherregulations") .'</h3>

<p>' .$lang->getString("otherregulationst") .'</p>

</div>

');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));


echo '</body></html>';

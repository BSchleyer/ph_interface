<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, $lang->getString("uplink") . " - ProHosting24", $lang, $name, $lang->getString("metadescription")));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
echo minifyhtml('

<!-- Default Page Header -->
<div class="default-header uplink">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("uplink") .'</h2>
                    <p>' .$lang->getString("dclocation") .', ' .$lang->getString("datacenterh") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Default Page Header ends here -->


<div class="domain-boxes padding-top50">
        <div class="custom-width">
            <div class="row">
                <div class="main-title text-center">
                    <h2>' .$lang->getString("theuplink") .'</h2>
                    <p>' .$lang->getString("theuplinkt") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="list-features2 padding-bottom50 padding-top50">
        <div class="custom-width">
            <div class="row">
                <div class="main-title title-white text-center">
                    <h2>' .$lang->getString("uplinkbody") .'</h2>
                </div>
                <div class="col-sm-3">
                    <div class="left-lists">
                        <ul>
                            <li>' .$lang->getString("uplinkbody1") .'</li>
                            <li>' .$lang->getString("uplinkbody2") .'</li>
                            <li>' .$lang->getString("uplinkbody3") .'</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="left-lists">
                        <ul>
                            <li>' .$lang->getString("uplinkbody4") .'</li>
                            <li>' .$lang->getString("uplinkbody5") .'</li>
                            <li>' .$lang->getString("uplinkbody6") .'</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="left-lists">
                        <ul>
                            <li>' .$lang->getString("uplinkbody7") .'</li>
                            <li>' .$lang->getString("uplinkbody8") .'</li>
                            <li>' .$lang->getString("uplinkbody9") .'</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="left-lists">
                        <ul>
                            <li>' .$lang->getString("uplinkbody10") .'</li>
                            <li>' .$lang->getString("uplinkbody11") .'</li>
                            <li>' .$lang->getString("uplinkbody12") .'</li>
                        </ul>
                   </div>
                </div>
            </div>
        </div>
    </div>




    <div class="tripple-cols lighter-bg2 padding-bottom50 padding-top50">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right">
                    <i class="fa fa-gem pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("uplinkbody8") .'</h4>
                        <p>' .$lang->getString("uplinkbody8t") .'</p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                    <i class="fa fa-history pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("uplinkbody5") .'</h4>
                        <p>' .$lang->getString("uplinkbody5t") .'</p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                    <i class="fa fa-shield-alt pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("ddosprotection") .'</h4>
                        <p>' .$lang->getString("ddosprotectiont1") .'</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));


echo '</body></html>';

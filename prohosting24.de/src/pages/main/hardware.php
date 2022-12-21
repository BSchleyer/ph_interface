<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

echo minifyhtml(getheader($config, "Server - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

echo minifyhtml('

<!-- Default Page Header -->
<div class="default-header server-page">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("ourhardware") .'</h2>
                    <p>' .$lang->getString("hardwaret") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Default Page Header ends here -->




<div class="team padding-bottom50 padding-top50">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs0.png" class="img-responsive" alt="">
                </div>
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs1.png" class="img-responsive" alt="">
                </div>
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs2.png" class="img-responsive" alt="">
                </div>
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs3.png" class="img-responsive" alt="">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Features style four -->
<div class="features-four padding-top50 padding-bottom50 text-center">
    <div class="custom-width">
        <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <img src="' . $cdn . 'img/server/server-specs10.jpg" class="img-responsive" alt="">
        </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="content-top">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="text-container">
                                <i class="fa fa-microchip"></i>
                                <h4>' .$lang->getString("cpu") .'</h4>
                                <p><br>' .$lang->getString("cput") .'</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="text-container">
                                <i class="fa fa-memory"></i>
                                <h4>' .$lang->getString("memory") .'</h4>
                                <p><br>' .$lang->getString("memoryt") .'</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="text-container">
                                <i class="fa fa-hdd"></i>
                                <h4>' .$lang->getString("storage") .'</h4>
                                <p><br>' .$lang->getString("storaget") .'</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-bottom">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="text-container">
                                <i class="fa fa-digital-tachograph"></i>
                                <h4>' .$lang->getString("mainboard") .'</h4>
                                <p><br>' .$lang->getString("mainboardt") .'</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="text-container">
                                <i class="fa fa-exchange-alt"></i>
                                <h4>' .$lang->getString("uplink") .'</h4>
                                <p><br>' .$lang->getString("uplinkt1") .'<br>' .$lang->getString("uplinkt2") .'</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="text-container">
                                <i class="fa fa-recycle"></i>
                                <h4>' .$lang->getString("spareparts") .'</h4>
                                <p><br>' .$lang->getString("sparepartst") .'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features style four ends here -->





<div class="team padding-bottom50 padding-top50">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs7.jpg" class="img-responsive" alt="">
                </div>
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs6.jpg" class="img-responsive" alt="">
                </div>
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs4.jpg" class="img-responsive" alt="">
                </div>
                <div class="col-sm-3">
                    <img src="' . $cdn . 'img/server/server-specs9.jpg" class="img-responsive" alt="">
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

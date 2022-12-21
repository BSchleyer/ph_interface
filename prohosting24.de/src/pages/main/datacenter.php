<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

echo minifyhtml(getheader($config, $lang->getString("datacenter") . " - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

echo minifyhtml('

<!-- Default Page Header -->
<div class="default-header datacenter-page">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("datacenterhead") .'</h2>
                    <p>' .$lang->getString("dclocation") .', ' .$lang->getString("datacenterh") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Default Page Header ends here -->



<!-- Features style 2 -->
<div class="features-two padding-top50 ">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-8">
                <div class="box-shadow">
                    <div class="list-features">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main-title text-left">
                                    <h2>' .$lang->getString("dchead") .'</h2>
                                    <p>' .$lang->getString("dcheadt") .'</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4></h4>
                                <ul>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt1") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt2") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt3") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt4") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt5") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt6") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt7") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt8") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt9") .'</li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <h4></h4>
                                <ul>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt10") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt11") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt13") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt14") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt15") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt16") .'</li>
                                    <li><i class="fa fa-plus"></i> ' .$lang->getString("dcheadt17") .'</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <img src="' . $cdn . 'img/rechenzentrum/racks.jpg" class="img-responsive" alt=""><br>
            </div>
        </div>
    </div>
</div>
<!-- Features style 2 ends here -->

<!-- Team members -->
<div class="team padding-bottom50 padding-top50">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-4">
                <div class="members">
                    <img src="' . $cdn . 'img/rechenzentrum/löschgas.jpg" class="img-responsive img-center" alt="">
                    <div class="member-text">
                        <h4>' .$lang->getString("dcbody1") .'</h4>
                        <p>' .$lang->getString("dcbodyt1") .'</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="members">
                    <img src="' . $cdn . 'img/rechenzentrum/überwachung.jpg" class="img-responsive img-center" alt="">
                    <div class="member-text">
                        <h4>' .$lang->getString("dcbody2") .'</h4>
                        <p>' .$lang->getString("dcbodyt2") .'</p><br>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="members">
                    <img src="' . $cdn . 'img/rechenzentrum/wärmetauscher.jpg" class="img-responsive img-center" alt="">
                    <div class="member-text">
                        <h4>' .$lang->getString("dcbody3") .'</h4>
                        <p>' .$lang->getString("dcbodyt3") .'</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team members ends here-->



');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));


echo '</body></html>';

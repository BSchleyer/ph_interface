<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

echo minifyhtml(getheader($config, $lang->getString("ddosprotection"). " - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

echo minifyhtml('

<!-- Default Page Header -->
<div class="default-header mitigation-page">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("ddosprotection") .'</h2>
                    <p>' .$lang->getString("ddosprotectiont") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Default Page Header ends here -->



<!-- Layout - Text right  -->
<div class="layout-text contact-layout left-layout padding-bottom60 padding-top60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-container" data-aos="fade-up">
                    <h3>' .$lang->getString("ddosbody") .'</h3>
                    <div class="text-content">
                        <div class="text">
                            <p>' .$lang->getString("ddosbodyt") .'</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img src="' . $cdn . 'img/arbor.jpg" class="img-responsive" alt="" data-aos="fade-right">
                <img src="' . $cdn . 'img/arbor.jpg" class="img-absolute" alt="" data-aos="fade-right">
            </div>
        </div>
    </div>
</div>
<!-- Layout - Text right ends here  -->



    <!-- Features in lists -->
    <div class="list-features2">
        <div class="custom-width">
            <div class="row">
                <div class="main-title title-white text-center" style="margin-top: 40px; margin-bottom: -40px">
                    <h2>' .$lang->getString("ddosfilter") .'</h2>
                </div>
                <div class="col-sm-3">
                    <div class="left-lists">
                        <ul>
                            <h3 style="color: white">Flood Attacks</h3>
                            <li>TCP</li>
                            <li>UDP</li>
                            <li>ICMP</li>
                            <li>DNS Amplification</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="left-lists">
                        <ul>
                            <h3 style="color: white">TCP Stack Attacks</h3>
                            <li>SYN</li>
                            <li>FIN</li>
                            <li>RST</li>
                            <li>SYN ACK</li>
                            <li>URG-PSH</li>
                            <li>TCP Flags</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="left-lists">
                        <ul>
                            <h3 style="color: white">Fragmentation Attacks</h3>
                            <li>Teardrop</li>
                            <li>Targa3</li>
                            <li>Jolt2</li>
                            <li>Nestea</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3" style="margin-bottom: 140px">
                    <div class="left-lists">
                        <ul>
                            <h3 style="color: white">Application Attacks</h3>
                            <li>HTTP GET floods</li>
                            <li>SIP Invite floods</li>
                            <li>DNS attacks</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features in lists ends here -->


    <!-- Triple cols -->
    <div class="tripple-cols lighter-bg2 padding-bottom50 padding-top50">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-4" data-aos="fade-right">
                    <i class="fas fa-shield-alt pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("ddosfooter1") .'</h4>
                        <p>' .$lang->getString("ddosfootert1") .'</p>
                    </div>
                </div>
                <div class="col-sm-4" data-aos="fade-right" data-aos-delay="200">
                    <i class="fa fa-exchange-alt pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("ddosfooter2") .'</h4>
                        <p>' .$lang->getString("ddosfootert2") .'</p>
                    </div>
                </div>
                <div class="col-sm-4" data-aos="fade-right" data-aos-delay="100">
                    <i class="fa fa-history pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("ddosfooter3") .'</h4>
                        <p>' .$lang->getString("ddosfootert3") .'</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Triple cols ends here -->




');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));


echo '</body></html>';

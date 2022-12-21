<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, "CEPH - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
echo minifyhtml('

<!-- Default Page Header -->
<div class="default-header ceph">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("cephcloud") .'</h2>
                    <p>' .$lang->getString("cephcloudt") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Default Page Header ends here -->

<div class="tripple-cols lighter-bg2 padding-bottom50 padding-top50">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right">
                    <i class="fa fa-check-circle pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("failsafe") .'</h4>
                        <p>' .$lang->getString("failsafet") .'</p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                    <i class="fa fa-heart pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("selfheal") .'</h4>
                        <p>' .$lang->getString("selfhealt") .'</p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                    <i class="fas fa-sort-alpha-down pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("cephmigrate") .'</h4>
                        <p>' .$lang->getString("cephmigratet") .'</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Features style four -->
    <div class="features-four padding-top50 padding-bottom50 text-center">
        <div class="custom-width">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="content-top">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-container">
                                    <i class="fa fa-database"></i>
                                    <h4>' .$lang->getString("cephfs") .'</h4>
                                    <p>' .$lang->getString("cephfst") .'</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-container">
                                    <i class="fa fa-cube"></i>
                                    <h4>' .$lang->getString("cephblk") .'</h4>
                                    <p>' .$lang->getString("cephblkt") .'</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-container">
                                    <i class="fa fa-sort-numeric-up"></i>
                                    <h4>' .$lang->getString("cephobject") .'</h4>
                                    <p>' .$lang->getString("cephobjectt") .'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-bottom">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-container">
                                    <i class="fa fa-envelope"></i>
                                    <h4>' .$lang->getString("lowlatency") .'</h4>
                                    <p>' .$lang->getString("lowlatencyt") .'</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-container">
                                    <i class="fa fa-bolt"></i>
                                    <h4>' .$lang->getString("strongpower") .'</h4>
                                    <p>' .$lang->getString("strongpowert") .'</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="text-container">
                                    <i class="fa fa-tachometer-alt"></i>
                                    <h4>' .$lang->getString("morebandwith") .'</h4>
                                    <p>' .$lang->getString("morebandwitht") .'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <img src="https://cdn.prohosting24.eu/img/logo/ceph.png"></img>
                </div>
            </div>
        </div>
    </div>
    <!-- Features style four ends here -->






<!-- Faq -->
<div class="faq padding-bottom50 padding-top50 gray-bg">
    <div class="custom-width">
        <h3>' .$lang->getString("faq") .'</h3>
        <div class="accordion">
            <div class="accordion-item">
                <a>' .$lang->getString("faq5q") .'</a>
                <div class="content">
                    <p>' .$lang->getString("faq5a") .'</p>
                </div>
            </div>
            <div class="accordion-item">
                <a>' .$lang->getString("faq14q") .'</a>
                <div class="content">
                    <p>' .$lang->getString("faq14a") .'</p>
                </div>
            </div>
            <div class="accordion-item">
                <a>' .$lang->getString("faq15q") .'</a>
                <div class="content">
                    <p>' .$lang->getString("faq15a") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Faq ends here -->

');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));

echo '</body></html>';

<?php


defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config,  $lang->getString("homepagetitle") , $lang, $name));


echo '<body>';


echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml('
<!-- Home Page Header -->
<div class="home-header" style="background: linear-gradient(to right, rgba(18, 9, 39, 0.9) 0%, transparent 92%, transparent 100%), url(' . $cdn . 'img/homepage.webp) center;">
    <div class="custom-width">
        <div class="row" style="margin-bottom:100px;">
            <div class="col-sm-12">
                <div class="text-container">
                    <div class="home-title animated fadeInLeft">
                        <h2>' .$lang->getString("homepageheading") .'
                            <br>
                            <a class="typewrite" data-period="2000" data-type=\'[ ' .$lang->getString("typewriter") .']\'>
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Home Page Header -->
<!-- cooler test -->

<!-- SSL Boxes -->
<div class="ssl-boxes padding-bottom50">
    <div class="custom-width">
        <div class="row">
            <div class="all-boxes">
                <div class="col-lg-3 col-sm-6 col-xs-12 margin-bottom-sm">
                    <div class="ssl-box text-center">
                        <div class="box-header">
                            <i class="fab fa-docker"></i>
                        </div>
                        <h4>' .$lang->getString("applications") .'
                        </h4>
                        <div class="box-description">
                            <h2><span class="dollar-sign">' .$lang->getString("startingati") .' €</span>2,50</h2>
                            <a href="' . $url . '/apps">' .$lang->getString("selection") .' <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 margin-bottom-sm margin-bottom-xs">
                    <div class="ssl-box text-center">
                        <div class="box-header">
                            <i class="fas fa-at"></i>
                            <h4>' .$lang->getString("domains") .'</h4>
                        </div>
                        <div class="box-description">
                            <p></p>
                            <h2><span class="dollar-sign">' .$lang->getString("startingati") .' €</span>6,95</h2>
                            <a href="' . $url . '/domains">' .$lang->getString("selection") .' <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 margin-bottom-xs">
                    <div class="ssl-box text-center">
                        <div class="box-header">
                            <i class="fas fa-server"></i>
                            <h4>' .$lang->getString("server") .'</h4>
                        </div>
                        <div class="box-description">
                            <p></p>
                            <h2><span class="dollar-sign">' .$lang->getString("startingati") .' €</span>3,90</h2>
                            <a href="' . $url . '/server">' .$lang->getString("selection") .' <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="ssl-box text-center">
                        <div class="box-header">
                            <i class="fas fa-globe"></i>
                            <h4>' .$lang->getString("webhosting") .'</h4>
                        </div>
                        <div class="box-description">
                            <h2><span class="dollar-sign">' .$lang->getString("startingati") .' €</span>2,50</h2>
                            <a href="' . $url . '/webspace">' .$lang->getString("selection") .' <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SSL Boxes section ends here -->



<!-- Triple cols -->
<div class="tripple-cols lighter-bg2 padding-bottom50 padding-top50">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-4" data-aos="fade-right">
                <i class="fa fa-headset pull-left"></i>
                <div class="text">
                    <h4>' .$lang->getString("fastsupport") .'</h4>
                    <p>' .$lang->getString("fastsupporttext") .'</p>
                </div>
            </div>
            <div class="col-sm-4" data-aos="fade-right" data-aos-delay="100">
                <i class="fa fa-file-invoice pull-left"></i>
                <div class="text">
                    <h4>' .$lang->getString("prepaidsystem") .'</h4>
                    <p>' .$lang->getString("prepaidsystemtext") .'</p>
                </div>
            </div>
            <div class="col-sm-4" data-aos="fade-right" data-aos-delay="200">
                <i class="fa fa-euro-sign pull-left"></i>
                <div class="text">
                    <h4>' .$lang->getString("payment") .'</h4>
                    <p>' .$lang->getString("paymenttext") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Triple cols ends here -->


<!-- Triple cols -->
<div class="tripple-cols lighter-bg2 padding-bottom50 padding-top50">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-4" data-aos="fade-right">
                <i class="fab fa-cloudscale pull-left"></i>
                <div class="text">
                    <h4>' .$lang->getString("kvm") .'</h4>
                    <p>' .$lang->getString("kvmtext") .'</p>
                </div>
            </div>
            <div class="col-sm-4" data-aos="fade-right" data-aos-delay="100">
                <i class="fa fa-warehouse pull-left"></i>
                <div class="text">
                    <h4>' .$lang->getString("datacenterh") .'</h4>
                    <p>' .$lang->getString("datacentertext") .'</p>
                </div>
            </div>
            <div class="col-sm-4" data-aos="fade-right" data-aos-delay="200">
                <i class="fa fa-shield-alt pull-left"></i>
                <div class="text">
                    <h4>' .$lang->getString("ddos-protection") .'</h4>
                    <p>' .$lang->getString("ddostext") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Triple cols ends here -->

<!-- Call to action -->
<div class="call-to-action cta-green">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-6">
                <h3>ProHosting24 ' .$lang->getString("server") .'</h3>
                <p>' .$lang->getString("servertext") .' <a style="color: white;" href="/' .$lang->getString("virturl") .'"> ' .$lang->getString("servertext1") .'</p>
            </div>
            <div class="col-sm-6">
                <div class="buttons">
                    <a href="' . $url . '/server" class="btn btn-outline btn-large">' .$lang->getString("learnmore") .'<i class="fas fa-external-link-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Call to action ends here -->


<!-- Layout - Text right  -->
<div class="layout-text layout-domain gray-layout left-layout padding-bottom60 padding-top60">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="text-container" data-aos="fade-up">
                    <h3>' .$lang->getString("experience") .'</h3>
                    <p>' .$lang->getString("experiencetext") .'</p>
                    <div class="text-content">
                        <img src="' . $cdn . 'img/icons/2.png" class="img-responsive pull-left" alt="">
                        <div class="text">
                            <h4>' .$lang->getString("enterprisestorage") .'</h4>
                            <p>' .$lang->getString("enterprisestoragetext") .'</p>
                        </div>
                    </div>
                    <div class="text-content">
                        <img src="' . $cdn . 'img/icons/4.png" class="img-responsive pull-left" alt="">
                        <div class="text">
                            <h4>' .$lang->getString("scalability") .'</h4>
                            <p>' .$lang->getString("scalabilitytext") .'</p>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <a href="' . $url . '/' .$lang->getString("virturl") .'" class="btn btn-large btn-green">' .$lang->getString("learnmore") .'<i class="fas fa-external-link-alt"></i></a>
                </div>
            </div>
            <div class="col-sm-6 domain-img">
                <img src="' . $cdn . 'img/epyc.webp" class="img-responsive" alt="" data-aos="fade-right">
            </div>
        </div>
    </div>
</div>
<!-- Layout - Text right ends here  -->



<!-- Testimonials slider -->
<section class="testimonials white-bg" id="carousel">
    <div class="custom-width">
        <div class="row">
            <div class="col-md-12">
                <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="4000">
                    <ol class="carousel-indicators">
                        <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-4">
                                <div class="text-left">
                                    <h2>' .$lang->getString("clients") .'</h2>
                                    <p>' .$lang->getString("clientstext") .'</p>
                                    <div class="buttons">
                                        <a target="_blank" rel="noopener noreferrer nofollow" href="https://g.page/ProHosting24/review?gm"
                                            class="btn btn-small btn-outline outline-dark">' .$lang->getString("rategoogle") .'
                                        <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="profile-circle"><img src="' . $cdn . 'img/reviews/zion.png" class="img-responsive" alt="">
                                </div>
                                <blockquote>
                                    <p>
                                        <i class="fa quote fa-quote-right fa-sm pull-left"></i>
                                            <br>' .$lang->getString("client3") .'
                                        <i class="fa quote fa-quote-right fa-sm "></i>
                                    </p>
                                    <small><a target="_blank"  rel="noopener noreferrer nofollow" href="https://g.page/ProHosting24/review?gm"> google.com</a></small>
                                </blockquote>
                            </div>
                            <div class="col-sm-4">
                                <div class="profile-circle"><img src="' . $cdn . 'img/reviews/michael.png" class="img-responsive" alt="">
                                </div>
                                <blockquote>
                                    <p>
                                        <i class="fa quote fa-quote-right fa-sm pull-left"></i>
                                            <br>' .$lang->getString("client4") .'
                                        <i class="fa quote fa-quote-right fa-sm "></i></p>
                                    <small><a target="_blank"  rel="noopener noreferrer nofollow" href="https://g.page/ProHosting24/review?gm"> google.com</a></small>
                                </blockquote>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-4">
                                <div class="text-left">
                                    <h2>' .$lang->getString("clients") .'</h2>
                                    <p>' .$lang->getString("clientstext") .'</p>
                                    <div class="buttons">
                                        <a href="https://de.trustpilot.com/review/prohosting24.de" rel="noopener noreferrer nofollow" class="btn btn-small btn-outline outline-dark">' .$lang->getString("ratetrustpilot") .'<i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="profile-circle"><img src="' . $cdn . 'img/reviews/invalidgaming93.png" class="img-responsive" alt="">
                                </div>
                                <blockquote>
                                    <p>
                                        <i class="fa quote fa-quote-right fa-sm pull-left"></i>
                                            <br>' .$lang->getString("client1") .'
                                        <i class="fa quote fa-quote-right fa-sm "></i></p>
                                    <small><a target="_blank" href="https://de.trustpilot.com/review/prohosting24.de" rel="noopener noreferrer nofollow" > trustpilot.com</a></small>
                                </blockquote>
                            </div>
                            <div class="col-sm-4">
                                <div class="profile-circle"><img src="' . $cdn . 'img/reviews/deathgamerhd.webp" class="img-responsive" alt="">
                                </div>

                                <blockquote>
                                    <p><i class="fa quote fa-quote-right fa-sm pull-left"></i>
                                        <br>' .$lang->getString("client2") .'
                                        <i class="fa quote fa-quote-right fa-sm "></i></p>
                                    <small>
                                        <a target="_blank" href="https://de.trustpilot.com/review/prohosting24.de" rel="noopener noreferrer nofollow" > trustpilot.com</a>
                                    </small>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));


echo '</body></html>';

<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();

echo minifyhtml(getheader($config, "Apps - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

echo minifyhtml('

<!-- Default Page Header -->
<div class="default-header app">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("applicationshead") .'</h2>
                    <p>' .$lang->getString("applicationsheadt") .'</p>
                    <h4>' .$lang->getString("startingat") .'</h4>
                    <h3>€ 2,50 / ' .$lang->getString("monthly") .'</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Default Page Header ends here -->

<!-- table -->
<div class="dedicated-pricing padding-top50 padding-bottom50">
    <div class="custom-width">
        <div class="main-title text-center">
            <h2>' .$lang->getString("appstitle") .'</h2>
            <p>' .$lang->getString("appstitlet") .'</p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>' .$lang->getString("application") .'</th>
                        <th>' .$lang->getString("cpu") .'</th>
                        <th>' .$lang->getString("memory") .'</th>
                        <th>' .$lang->getString("ssd") .'</th>
                        <th>IPv4 ' .$lang->getString("ipaddress") .'</th>
                        <th>' .$lang->getString("monthly") .'</th>
                        <th>' .$lang->getString("learnmore") .'</th>
                    </tr>
                </thead>
                <tr data-aos="fade-up" data-aos-delay="50">
                    <td>MariaDB</td>
                    <td>1 ' .$lang->getString("core") .'</td>
                    <td>1 GB</td>
                    <td>10 GB</td>
                    <td>1</td>
                    <td class="price-in-table"> 3,45 €</td>
                    <td><a class="btn btn-small btn-green" href="' . $url . '/mariadb">' .$lang->getString("overview") .'<i class="fas fa-share"></i></a></td>
                </tr>
                <tr data-aos="fade-up" data-aos-delay="50">
                    <td>PostgreSQL</td>
                    <td>1 ' .$lang->getString("core") .'</td>
                    <td>1 GB</td>
                    <td>10 GB</td>
                    <td>1</td>
                    <td class="price-in-table"> 3,45 €</td>
                    <td><a class="btn btn-small btn-green" href="' . $url . '/postgresql">' .$lang->getString("overview") .'<i class="fas fa-share"></i></a></td>
                </tr>
                <tr data-aos="fade-up" data-aos-delay="50">
                    <td>MongoDB</td>
                    <td>1 ' .$lang->getString("core") .'</td>
                    <td>1 GB</td>
                    <td>10 GB</td>
                    <td>1</td>
                    <td class="price-in-table"> 3,45 €</td>
                    <td><a class="btn btn-small btn-green" href="' . $url . '/mongodb">' .$lang->getString("overview") .'<i class="fas fa-share"></i></a></td>
                </tr>
                <tr data-aos="fade-up" data-aos-delay="50">
                    <td>Redis</td>
                    <td>1 ' .$lang->getString("core") .'</td>
                    <td>1 GB</td>
                    <td>10 GB</td>
                    <td>1</td>
                    <td class="price-in-table"> 3,45 €</td>
                    <td><a class="btn btn-small btn-green" href="' . $url . '/redis">' .$lang->getString("overview") .'<i class="fas fa-share"></i></a></td>
                </tr>
                <tr data-aos="fade-up" data-aos-delay="50">
                    <td>Minecraft</td>
                    <td>2 ' .$lang->getString("cores") .'</td>
                    <td>1 GB</td>
                    <td>5 GB</td>
                    <td>1</td>
                    <td class="price-in-table"> 2,50 €</td>
                    <td><a class="btn btn-small btn-green" href="' . $url . '/minecraft">' .$lang->getString("overview") .'<i class="fas fa-share"></i></a></td>
                </tr>
                <tr data-aos="fade-up" data-aos-delay="50">
                    <td>Rust</td>
                    <td>4 ' .$lang->getString("cores") .'</td>
                    <td>4 GB</td>
                    <td>35 GB</td>
                    <td>1</td>
                    <td class="price-in-table"> 9,25 €</td>
                    <td><a class="btn btn-small btn-green" href="' . $url . '/rust">' .$lang->getString("overview") .'<i class="fas fa-share"></i></a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- table end-->

<!-- Features style four -->
<div class="features-four padding-top50 padding-bottom50 text-center">
    <div class="custom-width">
        <div class="row">
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
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <img src="' . $cdn . 'img/server/server-specs0.png" class="img-responsive" alt="">
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
                <a>' .$lang->getString("faq7q") .'</a>
                <div class="content">
                    <p>' .$lang->getString("faq7a") .'</p>
                </div>
            </div>
            <div class="accordion-item">
                <a>' .$lang->getString("faq8q") .'</a>
                <div class="content">
                    <p>' .$lang->getString("faq8a") .'</p>
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

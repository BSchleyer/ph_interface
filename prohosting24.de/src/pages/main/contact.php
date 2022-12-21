<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, $lang->getString("contact") ." - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
echo minifyhtml('
<div class="default-header contact">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("contact") .'</h2>
                    <p>' .$lang->getString("contactt") .'</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="boxes-one padding-top50 padding-bottom50" style="background-color:#F7F9FF;">
    <div class="custom-width">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="box">
                    <i data-aos="zoom-in" class="fas fa-5x fa-ticket-alt img-responsive img-center aos-init aos-animate" style="color: #00A8FF" alt="Hosting"></i><br>
                    <h4>' .$lang->getString("contactbody1") .'</h4>
                    <h4>' .$lang->getString("contactbodyt1") .'</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="box">
                    <i data-aos="zoom-in" class="fas fa-5x fa-mail-bulk img-responsive img-center aos-init aos-animate" style="color: #00A8FF" alt="Hosting"></i><br>
                    <h4>' .$lang->getString("contactbody2") .'</h4>
                    <h4>' .$lang->getString("contactbodyt2") .'</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="box">
                    <i data-aos="zoom-in" class="fas fa-5x fa-phone img-responsive img-center aos-init aos-animate" style="color: #00A8FF" alt="Hosting"></i><br>
                    <h4>' .$lang->getString("contactbody3") .'</h4>
                    <h4>' .$lang->getString("contactbodyt3") .'</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="box">
                    <i data-aos="zoom-in" class="fab fa-5x fa-whatsapp img-responsive img-center aos-init aos-animate" style="color: #00A8FF" alt="Hosting"></i><br>
                    <h4>' .$lang->getString("contactbody4") .'</h4>
                    <h4>' .$lang->getString("contactbodyt4") .'</h4>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="faq padding-bottom50 padding-top50 gray-bg">
        <div class="custom-width">
            <h3>' .$lang->getString("faq") .'</h3>
            <div class="accordion">
                <div class="accordion-item">
                    <a>' .$lang->getString("faq9q") .'</a>
                    <div class="content">
                        <p>' .$lang->getString("faq9a") .'</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>' .$lang->getString("faq10q") .'</a>
                    <div class="content">
                        <p>' .$lang->getString("faq10a") .'</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>' .$lang->getString("faq11q") .'</a>
                    <div class="content">
                        <p>' .$lang->getString("faq11a") .'</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>' .$lang->getString("faq12q") .'</a>
                    <div class="content">
                        <p>' .$lang->getString("faq12a") .'</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <a>' .$lang->getString("faq13q") .'</a>
                    <div class="content">
                        <p>' .$lang->getString("faq13a") .'</p>
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

<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, $lang->getString("virtualization") . " - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
echo minifyhtml('

<!-- Default Page Header -->
<div class="default-header virtualization">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2>' .$lang->getString("virtualization") ."&nbsp". $lang->getString("withproxmox").'</h2>
                    <p>' .$lang->getString("virtualizationt") .'</p>
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
                    <i class="fa fa-exchange-alt pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("loadbalancing") .'</h4>
                        <p>' .$lang->getString("loadbalancingt") .'</p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                    <i class="fa fa-cube pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("kvmvirt") .'</h4>
                        <p>' .$lang->getString("kvmvirtt") .'</p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                    <i class="fas fa-sort-alpha-down pull-left"></i>
                    <div class="text">
                        <h4>' .$lang->getString("livemigrate") .'</h4>
                        <p>' .$lang->getString("livemigratet") .'</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Boxes style two -->
    <div class="boxes-two padding-bottom50 padding-top50">
        <div class="container">
            <div class="row">
                <div class="main-title text-center">
                    <h2>ProHosting24 ' .$lang->getString("cephcloud") .'</h2>
                    <p>' .$lang->getString("cephvirtcloudt") .'</p>
                </div>
                <div class="col-sm-4">
                    <div class="box-container">
                        <div class="box-title">
                            <h4><i class="fa fa-server"></i>' .$lang->getString("vserver") .'</h4>
                        </div>
                        <ul>
                            <li>' .$lang->getString("highperformance") .'</li>
                            <li>' .$lang->getString("nomaintenancedowntime") .'</li>
                            <li>' .$lang->getString("autobalancer") .'</li>
                            <li>' .$lang->getString("onlyinseconds") .'</li>
                            <li>' .$lang->getString("livemgrationvirt") .'</li>
                            <li>' .$lang->getString("3replication") .'</li>
                        </ul>
                        <div class="buttons">
                            <a href="' . $url . '/' .$lang->getString("vps") .'" class="btn btn-green btn-small">' .$lang->getString("learnmore") .'<i class="fa fa-long-arrow-alt-right"></i></a>
                            <a href="' . $url . '/ceph" class="btn btn-outline outline-dark btn-small">' .$lang->getString("cephcloud") .'</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box-container">
                        <div class="box-title">
                            <h4><i class="fa fa-server"></i>' .$lang->getString("vserverpackage") .'</h4>
                        </div>
                        <ul>
                            <li>' .$lang->getString("highperformance") .'</li>
                            <li>' .$lang->getString("nomaintenancedowntime") .'</li>
                            <li>' .$lang->getString("autobalancer") .'</li>
                            <li>' .$lang->getString("onlyinseconds") .'</li>
                            <li>' .$lang->getString("livemgrationvirt") .'</li>
                            <li>' .$lang->getString("3replication") .'</li>
                        </ul>
                        <div class="buttons">
                            <a href="' . $url . '/' .$lang->getString("vpsplans") .'" class="btn btn-green btn-small">' .$lang->getString("learnmore") .'<i class="fa fa-long-arrow-alt-right"></i></a>
                            <a href="' . $url . '/ceph" class="btn btn-outline outline-dark btn-small">' .$lang->getString("cephcloud") .'</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box-container">
                        <div class="box-title">
                            <h4><i class="fa fa-server"></i>' .$lang->getString("cephcloud") .'</h4>
                        </div>
                            <li>' .$lang->getString("autobalance") .'</li>
                            <li>' .$lang->getString("selfhealing") .'</li>
                            <li>' .$lang->getString("cephrados") .'</li>
                            <li>' .$lang->getString("cephssd") .'</li>
                            <li>' .$lang->getString("cephperformance") .'</li>
                            <li>' .$lang->getString("cephha") .'</li>
                        </ul>
                        <div class="buttons">
                            <a href="' . $url . '/ceph" class="btn btn-green btn-small">' .$lang->getString("cephcloud") .'<i class="fa fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<!-- Faq -->
<div class="faq padding-bottom50 padding-top50 gray-bg">
    <div class="custom-width">
        <h3>' .$lang->getString("faq") .'</h3>
        <div class="accordion">
            <div class="accordion-item">
                <a>' .$lang->getString("faq15q") .'</a>
                <div class="content">
                    <p>' .$lang->getString("faq15a") .'</p>
                </div>
            </div>
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

<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, "Nachhaltigkeit - ProHosting24", $lang, $name));


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
                    <h2>Nachhaltigkeit mit Proxmox</h2>
                    <p>
                        Von einfachen standalone nodes bis hin zu Hyperkonvergenten Cluster lösungen mit shared Networkstorage.<br>Mit Promxox machen wir alles möglich.
                    </p>
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
                        <h4>Loadbalancing</h4>
                        <p>
                            Im Falle auftretender Last spitzen werden Server über das Cluster neuverteilt. 
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
                    <i class="fa fa-cube pull-left"></i>
                    <div class="text">
                        <h4>KVM Virtualisierung</h4>
                        <p>
                            Dank der Vollvirtualisierung durch KVM können Sie jeden beliebigen Kernel installieren und modifzieren.
                        </p>
                    </div>
                </div>
                <div class="col-sm-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                    <i class="fas fa-sort-alpha-down pull-left"></i>
                    <div class="text">
                        <h4>Live Migration</h4>
                        <p>
                            Keine Downtime mehr durch Updates und Wartungen an betroffenen Hosystemen.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="tripple-cols lighter-bg2 padding-bottom50">
        <div class="custom-width">
            <h2 style="margin-left: -15px; margin-bottom: 20px">
                2020-21 launchen wir die PH24-Ceph Cloud
            </h2>
            <div class="row">
                <iframe style="margin: auto; width: 100%; height:625px;" src="https://www.youtube-nocookie.com/embed/QBkH1g4DuKE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>

<!-- Faq -->
<div class="faq padding-bottom50 padding-top50 gray-bg">
    <div class="custom-width">
        <h3>Häufig gestellte Fragen</h3>
        <div class="accordion">
            <div class="accordion-item">
                <a>Ändert sich bei einer Live Migration meine IP-Adresse?</a>
                <div class="content">
                    <p>
                        Nein, alle Server behalten Ihre IP-Adressen und bleiben zu jedem Zeitpunkt unter dieser auch erreichbar.
                    </p>
                </div>
            </div>
            <div class="accordion-item">
                <a>Können meine Daten verloren gehen?</a>
                <div class="content">
                    <p>
                        Alle Daten werden Redundant gespeichert um Ausfälle vorzubeugen.
                    </p>
                </div>
            </div>
            <div class="accordion-item">
                <a>Was für SSDs werden verwendet?</a>
                <div class="content">
                    <p>
                        Wir verbauen nur low latency Datacenter SATA SSDs der Firma Samsung ab größen von jeweils 1-2TB.
                    </p>
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

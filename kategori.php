<?php include 'layout/header.php';

$sayfada = 10;


if (isset($_GET['sef'])) {


    //yazılan veya tıklanılan kategoriyi kontrol ediyoruz
    $kategorisor = $db->prepare("SELECT * FROM kategori WHERE kategori_seo=:kategori_seo");
    $kategorisor->execute(
        array(
            'kategori_seo' => $_GET['sef']
        )
    );

    //eğer kategori bulunamadıysa kategori filtresi yapmadan tüm haberleri gösteriyoruz
    if ($kategorisor->rowCount() == 0) {
        header("Location:kategori");
    }
    $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
    ?> 
        <head>
        <title><?php echo $kategoricek['kategori_isim'] ?></title>
        </head>

        
        <?php

    //eğer kategori var ise sayfalamadan önce o kategoride bulunan toplam haber sayısını alıyoruz
    $habersor = $db->prepare("SELECT * FROM haber where haber_durum=:durum and kategori_id=:kategori_id order by haber_tarih desc ");
    $habersor->execute(
        array(
            'durum' => 1,
            'kategori_id' => $kategoricek['kategori_id']

        )
    );




    //sayfalama işlemi sorgu ve sayfalama özellikleri
    $toplam_içerik = $habersor->rowCount();
    $toplam_sayfa = ceil($toplam_içerik / $sayfada);

    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
    if ($sayfa < 1)
        $sayfa = 1;
    if ($sayfa > $toplam_sayfa)
        $sayfa = $toplam_sayfa;
    $limit = ($sayfa - 1) * $sayfada;


    //eğer belirtilen kategoride haber yok ise olması gereken sorguyu yazıyoruz
    if ($toplam_içerik == 0) {
        $habersor = $db->prepare("SELECT * FROM haber where haber_durum=:durum and kategori_id=:kategori_id order by haber_tarih desc ");
        $habersor->execute(
            array(
                'durum' => 1,
                'kategori_id' => $kategoricek['kategori_id']

            )
        );
    }
    //ve eğer belirtilen kategoride haber var ise sayfalama özelliklerine göre verileri çekiyoruz
    else {
        $habersor = $db->prepare("SELECT * FROM haber where haber_durum=:durum and kategori_id=:kategori_id order by haber_tarih desc limit $limit,$sayfada");
        $habersor->execute(
            array(
                'durum' => 1,
                'kategori_id' => $kategoricek['kategori_id']

            )
        );

        $habersor = $db->prepare("SELECT 
haber.haber_seo_url,
haber.haber_ana_foto,
haber.kategori_id,
haber.haber_baslik,
haber.haber_ana_detay,
haber.haber_tarih,
haber.yazar_id,
kategori.kategori_id,
kategori.kategori_isim,
kategori.kategori_seo,
yazar.name,
yazar.surname 

from haber INNER JOIN kategori on haber.kategori_id=kategori.kategori_id INNER JOIN yazar ON haber.yazar_id=yazar.yazar_id 
Where haber_durum=:durum and haber.kategori_id=:kategori_id 
order by haber.haber_tarih
desc limit $limit,$sayfada");

        $habersor->execute(
            array(
                'durum' => 1,
                'kategori_id' => $kategoricek['kategori_id']
            )
        );



        
    }





} else {

    //eğer herhangi bir kategori ismi girilmediyse çalışması gereken sorguyu yazıyoruz
    $habersor = $db->prepare("SELECT 
haber.haber_seo_url,
haber.haber_ana_foto,
haber.kategori_id,
haber.haber_baslik,
haber.haber_ana_detay,
haber.haber_tarih,
haber.yazar_id,
kategori.kategori_id,
kategori.kategori_isim,
kategori.kategori_seo,
yazar.name,
yazar.surname

 FROM haber INNER JOIN kategori ON haber.kategori_id=kategori.kategori_id INNER JOIN yazar ON haber.yazar_id=yazar.yazar_id
 where haber_durum=:durum order by haber.haber_tarih desc");
    $habersor->execute(
        array(
            'durum' => 1
        )
    );


    //sayfalama işlemi sorgu
    $toplam_içerik = $habersor->rowCount();
    $toplam_sayfa = ceil($toplam_içerik / $sayfada);

    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
    if ($sayfa < 1)
        $sayfa = 1;
    if ($sayfa > $toplam_sayfa)
        $sayfa = $toplam_sayfa;
    $limit = ($sayfa - 1) * $sayfada;

    $habersor = $db->prepare("SELECT 
haber.haber_seo_url,
haber.haber_ana_foto,
haber.kategori_id,
haber.haber_baslik,
haber.haber_ana_detay,
haber.haber_tarih,
haber.yazar_id,
kategori.kategori_id,
kategori.kategori_isim,
kategori.kategori_seo,
yazar.name,
yazar.surname

 FROM haber INNER JOIN kategori ON haber.kategori_id=kategori.kategori_id INNER JOIN yazar ON haber.yazar_id=yazar.yazar_id
 where haber_durum=:durum order by haber.haber_tarih desc limit $limit,$sayfada");
    $habersor->execute(
        array(
            'durum' => 1
        )
    );
    ?>
    <head>
            <title>Tüm Kategoriler</title>
        </head>
    <?php


}



?> 

<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-gears bg-primary"></i>
                    <?php if (isset($_GET['sef'])) {
                        echo $kategoricek['kategori_isim'];
                    } else {
                        echo 'Kategoriler';
                    } ?>

                    <small class="hidden-xs-down hidden-sm-down">
                        <?php if (isset($_GET['sef'])) {
                            echo 'Kategorisindeki Haber İçerikleri';
                        } else {
                            echo 'Tüm Kategorilerdeki Haber İçerikleri';
                        } ?>
                    </small>
                </h2>
            </div><!-- end col -->

        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section">
    <div class="container">
        <div class="row">


            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-grid-system">
                        <div class="row">

                            <?php

                            while ($habercek = $habersor->fetch(PDO::FETCH_ASSOC)) { ?>

                                <div class="col-md-6">
                                    <div class="blog-box">
                                        <div class="post-media">
                                            <a href="<?php echo "haber-" . seo($habercek['haber_seo_url']) ?>" title="">
                                                <img style="height:210px; object-fit:cover"
                                                    src="management/process/<?php echo $habercek['haber_ana_foto'] ?>"
                                                    alt="" class="img-fluid">
                                                <div class="hovereffect">
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta big-meta">
                                            <span class="color-orange"><a
                                                    href="<?php echo "kategori-" . seo($habercek['kategori_isim']) ?>"
                                                    title=""><?php echo $habercek['kategori_isim'] ?></a></span>
                                            <h4><a href="<?php echo "haber-" . seo($habercek['haber_seo_url']) ?>"
                                                    title=""><?php echo $habercek['haber_baslik'] ?></a></h4>
                                            <p>
                                                <?php echo substr($habercek['haber_ana_detay'], 0, 200);
                                                echo '...' ?>
                                            </p>
                                            <small><a title="">
                                                    <?php echo tarih($habercek['haber_tarih']); ?>
                                                </a></small>
                                            <small><a href="tech-author.html" title="">
                                                    <?php echo $habercek['name'], ' ', $habercek['surname'] ?>
                                                </a></small>

                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                </div><!-- end col -->
                            <?php }
                            $sor = $habersor->rowCount();
                            if ($sor == 0) {
                                echo '<p class="p-4"style="text-transform:capitalize">Maalesef bu kategoride bir haber yok</p><br>';
                            }
                            ?>



                        </div><!-- end row -->
                    </div><!-- end blog-grid-system -->
                </div><!-- end page-wrapper -->

                <hr class="invis3">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                <?php
                                if (!isset($_GET['sef'])) { ?>
                                    <li class="page-item"><a class="page-link"
                                            href="<?php echo "kategori" . "?sayfa=" . $sayfa - 1 ?>" <?php if ($sayfa - 1 == 0)
                                                         echo 'style="display:none;"' ?>>Geri</a></li>

                                        <?php

                                                     $s = 0;

                                                     while ($s < $toplam_sayfa) {

                                                         $s++; ?>
                                        <li class="page-item"><a class="page-link"
                                                href="<?php echo "kategori" . "?sayfa=" . $s ?>" <?php if ($sayfa == 1 && $toplam_sayfa == 1)
                                                           echo 'style="display:none;"'; ?>><?php echo $s ?> </a></li>
                                    <?php } ?>
                                    <li class="page-item"><a class="page-link"
                                            href="<?php echo "kategori" . "?sayfa=" . $sayfa + 1 ?>" <?php if ($sayfa + 1 > $toplam_sayfa)
                                                         echo 'style="display:none;"' ?>>İleri</a></li>
                                    <?php } else { ?>


                                    <li class="page-item"><a class="page-link"
                                            href="<?php echo "kategori-" . "{$_GET['sef']}" . "&sayfa=" . $sayfa - 1 ?>" <?php if ($sayfa - 1 == 0 || $sayfa == 0)
                                                         echo 'style="display:none;"' ?>>Geri</a></li>
                                        <?php

                                                     $s = 0;

                                                     while ($s < $toplam_sayfa) {

                                                         $s++; ?>
                                        <li class="page-item"><a class="page-link"
                                                href="<?php echo "kategori-" . "{$_GET['sef']}" . "?sayfa=" . $s ?>" <?php if ($sayfa == 1 && $toplam_sayfa == 1)
                                                           echo 'style="display:none;"'; ?>><?php echo $s ?>
                                            </a></li>
                                    <?php } ?>
                                    <li class="page-item"><a class="page-link"
                                            href="<?php echo "kategori-" . "{$_GET['sef']}" . "?sayfa=" . $sayfa + 1 ?>" <?php if ($sayfa + 1 > $toplam_sayfa)
                                                         echo 'style="display:none;"' ?>>İleri</a></li>
                                    <?php } ?>
                            </ul>
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->


            <!---================
             Özelleştirilmiş sidebar
            ======================--->
            <?php include 'layout/kategorisidebar.php' ?>

            <!---================
            Özelleştirilmiş sidebar
            ======================--->

        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php include 'layout/footer.php' ?>
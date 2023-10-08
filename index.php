<?php
include 'layout/header.php'
    ?>

<head>
    <title>
        <?php echo $askset['title'] ?>
    </title>
</head>

<?php
$onecikanlar = $db->prepare("SELECT 
haber.haber_seo_url,
haber.haber_ana_foto,
haber.kategori_id,
haber.haber_baslik,
haber.haber_ana_detay,
haber.haber_tarih,
haber.yazar_id,
haber.haber_one_cikan,
kategori.kategori_id,
kategori.kategori_isim,
kategori.kategori_seo,
yazar.name,
yazar.surname
FROM haber
INNER JOIN kategori ON haber.kategori_id=kategori.kategori_id
INNER JOIN yazar ON haber.yazar_id=yazar.yazar_id where haber_one_cikan=1");
$onecikanlar->execute();
$haberler = array();

while ($habercek2 = $onecikanlar->fetch(PDO::FETCH_ASSOC)) {
    $haberler[] = $habercek2; 
}

?>
<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">
            <div class="first-slot ">
                <div class="masonry-box post-media" style="border-radius: 12px">
                    <img src="management/process/<?php echo $haberler[0]['haber_ana_foto'] ?>" id="resim1" alt="788x443"
                        class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a
                                        href="<?php echo "kategori-" . $haberler[0]['kategori_seo'] ?>" title=""><?php echo $haberler[0]['kategori_isim'] ?></a></span>
                                <h4><a href="<?php echo "haber-" . seo($haberler[0]['haber_seo_url']) ?>" title=""><?php echo $haberler[0]['haber_baslik'] ?></a></h4>
                                <small><a title="">
                                        <?php echo tarih($haberler[0]['haber_tarih']) ?>
                                    </a></small>
                                <small><a title="">
                                        <?php echo $haberler[0]['name'] . ' ' . $haberler[0]['surname'] ?>
                                    </a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end first-side -->

            <div class="second-slot">
                <div class="masonry-box post-media" style="border-radius: 12px">
                    <img src="management/process/<?php echo $haberler[1]['haber_ana_foto'] ?>" id="resim2" alt="394x449"
                        class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a
                                        href="<?php echo "kategori-" . $haberler[1]['kategori_seo'] ?>" title=""><?php echo $haberler[1]['kategori_isim'] ?></a></span>
                                <h4><a href="<?php echo "haber-" . seo($haberler[1]['haber_seo_url']) ?>" title=""><?php echo $haberler[1]['haber_baslik'] ?></a></h4>
                                <small><a title="">
                                        <?php echo tarih($haberler[1]['haber_tarih']) ?>
                                    </a></small>
                                <small><a title="">
                                        <?php echo $haberler[1]['name'] . ' ' . $haberler[1]['surname'] ?>
                                    </a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->

            <div class="last-slot">
                <div class="masonry-box post-media" style="border-radius: 12px">
                    <img src="management/process/<?php echo $haberler[2]['haber_ana_foto'] ?>" id="resim3"
                        class="img-fluid" style="">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a
                                        href="<?php echo "kategori-" . $haberler[2]['kategori_seo'] ?>" title=""><?php echo $haberler[2]['kategori_isim'] ?></a></span>
                                <h4><a href="<?php echo "haber-" . seo($haberler[2]['haber_seo_url']) ?>" title=""><?php echo $haberler[2]['haber_baslik'] ?></a>
                                </h4>
                                <small><a title="">
                                        <?php 
                                        $tarih = tarih($haberler[2]['haber_tarih']);


                                        echo $tarih; ?>
                                    </a></small>
                                <small><a title="">
                                        <?php echo $haberler[2]['name'] . ' ' . $haberler[2]['surname'] ?>
                                    </a></a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->
        </div><!-- end masonry -->
    </div>
</section>
<style>
    #resim1,
    #resim2,
    #resim3 {
        width: 100%;
        height: 450px;
        object-fit: cover;
    }

    @media only screen and (max-width: 600px) {

        #resim1,
        #resim2,
        #resim3 {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

    }
</style>

<?php
$sayfada = 10;

$sorgu = $db->prepare("SELECT * from haber ");
$sorgu->execute();


$toplam_içerik = $sorgu->rowCount();
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

<section class="section">
    <div class="container ">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Öne Çıkan Haberler <a href="#"><i class="fa fa-rss"></i></a></h4>
                    </div><!-- end blog-top -->


                    <div class="blog-list clearfix">

                        <?php
                        while ($habercek = $habersor->fetch(PDO::FETCH_ASSOC)) { 
                            
                            $seourl = "haber-" . seo($habercek['haber_seo_url']);
                            $haberbaslik = $habercek['haber_baslik'];
                            $haber_foto = $habercek['haber_ana_foto'];
                            $haber_ana_detay =substr($habercek['haber_ana_detay'], 0, 75) . "...";
                            $kategorilink = "kategori-" . $habercek['kategori_seo'];
                            $kategori_isim =$habercek['kategori_isim'];
                            $haber_tarih = tarih($habercek['haber_tarih']);
                            $yazar = $habercek['name']. ' '. $habercek['surname'];
                            ?>




                            <div class="blog-box row">
                                <div class="col-md-4">
                                    <div class="post-media post-media2" style="border-radius: 12px">
                                        <a href="<?php echo $seourl ?>"
                                            title="<?php echo $haberbaslik ?>">
                                            <img src="management/process/<?php echo $haber_foto ?>"
                                                class="img-fluid haber">
                                            <div class="hovereffect"></div>
                                        </a>
                                    </div><!-- end media -->
                                </div><!-- end col -->

                                <div class="blog-meta big-meta col-md-8">
                                    <h4 style="border-radius: 12px"><a href="<?php echo $seourl ?>">   <?php echo $haberbaslik ?>   </a></h4>
                                    <p>  <?php echo $haber_ana_detay ?>  </p>
                                    <small class="firstsmall"><a class="bg-orange" href="<?php echo $kategorilink ?>" title=""><?php echo $kategori_isim ?> </a></small>
                                    <small><a title=""> <?php echo $haber_tarih; ?>  </a></small>
                                    <small><a  href="#" title=""> <?php echo $yazar ?>  </a></small>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->

                            <hr class="invis">

                        <?php } ?>



                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                <style>
                    .haber {
                        height: 150px;
                        object-fit: cover;
                    }

                    @media only screen and (max-width: 768px) {
                        .haber {
                            height: 240px;
                            object-fit: cover;
                        }

                    }
                </style>


                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link"
                                        href="<?php echo "index" . "?sayfa=" . $sayfa - 1 ?>" <?php if ($sayfa - 1 == 0) echo 'style="display:none;"' ?>>Geri</a></li>
                                    <?php

                                        $s = 0;

                                        while ($s < $toplam_sayfa) {

                                        $s++; ?>
                                    <li class="page-item"><a class="page-link" href="<?php echo "index" . "?sayfa=" . $s ?>"<?php if ($sayfa == 1 && $toplam_sayfa == 1)echo 'style="display:none;"'; ?>><?php echo $s ?> </a></li>
                                <?php } ?>
                                <li class="page-item"><a class="page-link" href="<?php echo "index" . "?sayfa=" . $sayfa + 1 ?>" <?php if ($sayfa + 1 > $toplam_sayfa) echo 'style="display:none;"' ?>>İleri</a></li>
                                </ul>
                            </nav>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end col -->

            <?php include 'layout/sidebar.php'; ?>
        </div><!-- end row -->

    </div><!-- end container -->

</section>



<?php

include 'layout/footer.php';
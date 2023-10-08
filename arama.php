<?php include 'layout/header.php';
if (empty($_GET['search'])) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

$arama = $_GET['search'];


$sayfada = 10;

$sorgu = $db->prepare("SELECT * from haber where haber_baslik LIKE '%$arama%' or haber_ana_detay LIKE '%$arama%' ");
$sorgu->execute();


$toplam_içerik = $sorgu->rowCount();
$toplam_sayfa = ceil($toplam_içerik / $sayfada);

$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
if ($sayfa < 1)
    $sayfa = 1;
if ($sayfa > $toplam_sayfa)
    $sayfa = $toplam_sayfa;
$limit = ($sayfa - 1) * $sayfada;

if($toplam_içerik==0){
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
     where haber_durum=:durum and haber_baslik LIKE '%$arama%' or haber_ana_detay LIKE '%$arama%' order by haber.haber_tarih desc ");
    $habersor->execute(
        array(
            'durum' => 1
        )
    );
}else{
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
     where haber_durum=:durum and haber_baslik LIKE '%$arama%' or haber_ana_detay LIKE '%$arama%' order by haber.haber_tarih desc limit $limit,$sayfada");
    $habersor->execute(
        array(
            'durum' => 1
        )
    ); 
}



?>

<head>
    <title>Arama: <?php echo $_GET['search'] ?></title>
</head>
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-gears bg-primary"></i> Arama Sonucu<small
                        class="hidden-xs-down hidden-sm-down"></small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">

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

                            $sorgu = $habersor->rowCount();
                            if ($sorgu == 0)
                                echo '<div class="col-md-6">Bir şey bulunamadı!</div>';
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
                                                    href="<?php echo "kategori-" . $habercek['kategori_seo'] ?>"
                                                    title=""><?php echo $habercek['kategori_isim'] ?></a></span>
                                            <h4><a href="<?php echo "haber-" . seo($habercek['haber_seo_url']) ?>"
                                                    title=""><?php echo $habercek['haber_baslik'] ?></a></h4>
                                            <p>
                                                <?php echo substr($habercek['haber_ana_detay'], 0, 75) . "..." ?>
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


                            ?>











                        </div><!-- end row -->
                    </div><!-- end blog-grid-system -->
                </div><!-- end page-wrapper -->

                <hr class="invis3">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                
                            <li class="page-item"><a class="page-link" href="<?php echo "arama?search=".$arama."&sayfa=".$sayfa-1?>" <?php if($sayfa-1==0 || $toplam_içerik==0)echo 'style="display:none;"' ?>>Geri</a></li>
                                <?php

                                $s = 0;

                                while ($s < $toplam_sayfa) {

                                    $s++; ?>
                                   <li class="page-item"><a class="page-link" href="<?php echo "arama?search=".$arama."&sayfa=".$s?>"><?php echo $s ?></a></li>
                                    
                               <?php }

                                ?>
                                <li class="page-item"><a class="page-link" href="<?php echo "arama?search=".$arama."&sayfa=".$sayfa+1?>"<?php if($sayfa+1>$toplam_sayfa)echo 'style="display:none;"' ?>>İleri</a></li>
                            </ul>
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
            <!---================
                    Özelleştirilmiş sidebar
                    ======================--->
                    <?php include 'layout/sidebar.php' ?>

<!---================
        Özelleştirilmiş sidebar
        ======================--->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php include 'layout/footer.php' ?>


sayfa=<?php echo $s;?>
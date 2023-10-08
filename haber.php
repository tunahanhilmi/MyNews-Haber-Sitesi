<?php include 'layout/haberheader.php';



$habersor = $db->prepare("SELECT 
haber.haber_id,
haber.haber_seo_url,
haber.haber_ana_foto,
haber.haber_baslik,
haber.haber_ana_detay,
haber.haber_tarih,
haber.haber_detay,
haber.haber_anahtar_kelimeler,
kategori.kategori_id,
kategori.kategori_isim,
kategori.kategori_seo,
yazar.name,
yazar.surname
FROM haber 
INNER JOIN kategori ON haber.kategori_id=kategori.kategori_id 
INNER JOIN yazar ON haber.yazar_id=yazar.yazar_id 
where haber_seo_url=:sef");
$habersor->execute(
    array(
        'sef' => $_GET['sef']
    )
);

if($habersor-> rowCount()==0|| !$_GET['sef']){
    header("Location:index.php");
}
$habercek = $habersor->fetch(PDO::FETCH_ASSOC);
?>
<head>
    <title>
        <?php echo $habercek['haber_baslik'] ?>
    </title>
    <!-- meta tagları -->
    <meta name="keywords" content="<?php echo $habercek['haber_anahtar_kelimeler'] ?>">
    <meta name="description" content="<?php echo $habercek['haber_ana_detay'] ?>">
    <meta name="author" content="<?php echo $habercek['name']." ".$habercek['surname']; ?>">
</head>



<style>
    h2 {
        border-left: 5px solid #00708D;
        padding-left: 10px;
    }

    img {
        width: 100%;
    }
</style>
<?php

$seourl = "haber-" . seo($habercek['haber_seo_url']);
$haberbaslik = $habercek['haber_baslik'];
$haber_foto = $habercek['haber_ana_foto'];
$haber_ana_detay =substr($habercek['haber_ana_detay'], 0, 75) . "...";
$kategorilink = "kategori-" . $habercek['kategori_seo'];
$kategori_isim =$habercek['kategori_isim'];
$haber_tarih = tarih($habercek['haber_tarih']);
$yazar = $habercek['name']. ' '. $habercek['surname'];
$haber_detay =$habercek['haber_detay'];

?>

<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="index">Ana Sayfa</a></li>
                            <li class="breadcrumb-item"><a>Haber</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="<?php echo $kategorilink ?>"><?php echo $kategori_isim; ?></a> </li>
                        </ol>


                        <span class="color-orange"><a href="<?php $kategorilink ?>" title=""><?php echo $kategori_isim ?></a></span>

                        <h1>
                            <?php echo $haberbaslik ?>
                        </h1>

                        <div class="blog-meta big-meta">
                            <small><a title=""> <?php echo $haber_tarih ?> </a></small>
                            <small><a href="yazar" title="Yazarın Adı Soyadı"> <?php echo $yazar ?> </a></small>
                        </div><!-- end meta -->

                    </div><!-- end title -->

                    <div class="single-post-media">
                        <img src="management/process/<?php echo $haber_foto ?>" alt=""
                            class="img-fluid">
                    </div><!-- end media -->

                    <div class="blog-content">
                        <div class="pp">
                            <?php echo  $haber_detay?>
                        </div><!-- end pp -->
                    </div><!-- end content -->

                    
                    <div class="blog-title-area">
                        <div class="tag-cloud-single">
                            <span>Etiketler</span>
                            <small><a title="">teknoloji</a></small>
                            <small><a title="">etkinlik</a></small>
                            <small><a title="">proje</a></small>
                            <small><a title="">teknofest</a></small>
                        </div> <!--end meta -->
                    </div><!--end title -->



                    <hr class="invis1">

                    <!--  <div class="custombox authorbox clearfix">
                         <h4 class="small-title">Yazar Hakkında</h4>
                         <div class="row">
                             <?php // include 'layout/about-author.php' ?>-->

                    <!--</div>end col 
                     </div>end row 
                 </div> end author-box 

                 <hr class="invis1"> 
                 --->


                    <?php
                    $yorumsor = $db->prepare("SELECT * FROM yorum where durum=:durum and haber_id=:id order by tarih asc");
                    $yorumsor->execute(
                        array(
                            'durum' => 1,
                            'id' => $habercek['haber_id']
                        )
                    );
                    ?>
                   
                    <div class="custombox clearfix">
                        <h4 class="small-title">
                            <?php echo $say = $yorumsor->rowCount(); ?> Yorum
                        </h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="comments-list">
                                    <?php while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="media custombox">
                                        <a class="media-left" href="#">
                                            <img src="management/process/images/no-pp.png"
                                                style="opacity: 0.5; width:50px" alt="" class="rounded-circle">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading user_name">
                                                <?php echo $yorumcek['isim'] . ' ' . $yorumcek['soyisim'] ?> <small > <?php echo formatTarih($yorumcek['tarih']) ?></small>
                                            </h4>
                                            <p>
                                                <?php echo $yorumcek['yorum'] ?>
                                            </p>
                                            <a href="#" style=" background: rgba(0, 0, 0, 0) linear-gradient(to right, #d32727 0px, #ff4646 100%) repeat scroll 0 0 !important;
    border-radius: 15px;" class="btn btn-primary btn-sm">Rapor Et</a>
                                            
                                        </div>
                                    </div>
                                    <?php }
                                    if ($say == 0) {
                                        echo 'Henüz bir yorum yapılmamış. İlk Yorumu sen yapmak ister misin?';
                                    } ?>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                    <hr class="invis1" id="yorum">


                    <div class="custombox clearfix">
                        <h4 class="small-title">Yorum Yap</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-wrapper" action="management/process/process.php" method="POST"
                                    autocomplete="off">
                                    <input type="text" required name="isim" class="form-control" required
                                        placeholder="İsim">
                                    
                                   
                                    <div class="form-control"> <select name="cinsiyet" class="form-control">
                                        <option value="0">Cinsiyetiniz (isteğe bağlı)</option>
                                        <option value="1">Erkek</option>
                                        <option value="2">Kadın</option>
                                        
                                    </select>
                                    <small>Cinsiyet sorgusu istatistik için kullanılmaktadır. Herhangi gizlilik sorununa yol açmaz.</small>
                                    </div>
                                    <textarea required class="form-control" name="yorum" required
                                        placeholder="Yorumunuz"></textarea>
                                    
                                    <input type="hidden" name="haber_id" value="<?php echo $habercek['haber_id'] ?>">
                                    <input type="hidden" name="link" value="<?php echo $habercek['haber_seo_url'] ?>">
                                    <br><br>
                                    <button type="submit" name="yorumyaz" class="btn btn-primary">Yorumu Gönder</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->

            <?php include 'layout/sidebar.php' ?>

        </div><!-- end row -->
    </div><!-- end container -->
</section>

<script>
        setTimeout(function () {
            document.getElementById("msgbox").style.display = "none";
        }, 3000);
</script>

<?php include 'layout/footer.php' ?>
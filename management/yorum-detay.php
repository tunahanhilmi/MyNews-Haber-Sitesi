<?php
include 'header.php';
$yorumsor = $db->prepare("SELECT * FROM yorum where yorum_id=:id");
$yorumsor->execute(
    array(
        'id' => $_GET['yorum_id']
    )
);
$say = $yorumsor->rowCount();
$yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC);


$habersor = $db->prepare("SELECT * FROM haber where haber_id=:id ");
$habersor->execute(array(
    'id' => $yorumcek['haber_id']
));
$habercek = $habersor->fetch(PDO::FETCH_ASSOC);
?>

<head>
    <title>Yorum Detayı</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">


                    <div class="col-md-12 col-lg-12">
                        <form action="process/process.php" method="POST">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title">Yorum Detay</strong>
                                </div>
                                <div class="card-body my-n2">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">İsim Soyisim</label>
                                            <input required type="text" id="" class="form-control" disabled value="<?php echo $yorumcek['isim'] . ' ' . $yorumcek['soyisim'] ?>">
                                        </div>







                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Cinsiyet</label>
                                            <input required type="text" id="" class="form-control" disabled value="<?php if ($yorumcek['cinsiyet'] == "0") {
                                                                                                                        echo 'Belirtilmemiş';
                                                                                                                    } else if ($yorumcek['cinsiyet'] == "1") {
                                                                                                                        echo 'Erkek';
                                                                                                                    } else {
                                                                                                                        echo 'Kadın';
                                                                                                                    }  ?>">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Yorum</label>
                                            <input required type="text" id="" class="form-control" disabled value="<?php echo $yorumcek['yorum'] ?>">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Haber</label>
                                            <input required type="text" id="" class="form-control" disabled value="<?php echo $habercek['haber_baslik'] ?>">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Gönderi Zamanı</label>
                                            <input required type="text" id="" class="form-control" disabled value="<?php echo tarih($yorumcek['tarih']) ?>">
                                        </div>
                                        
                                        <?php
                                        if($kullanicicek['authority']==2){?>
                                            <div class="form-group mb-3">
                                            <label for="simpleinput">IP Adress</label>
                                            <input required type="text" id="" class="form-control" disabled value="<?php echo $yorumcek['ip_adress'] ?>">
                                        </div>
                                       <?php }

                                        if ($_GET['dr'] == "1") { ?>
                                            <b style="color:green" id="msgbox" class="form-control alert alert-success">
                                                Yorum Onaylandı</b>

                                        <?php } else if ($_GET['dr'] == "2") { ?>
                                            <b style="color:red" id="msgbox" class="form-control alert alert-danger"> Yorum Kaldırıldı/Reddedildi </b>
                                        <?php }

                                        ?>
                                        <?php

                                        if ($_GET['dr'] == "3") { ?>
                                            <b id="msgbox" class="form-control alert alert-warning">
                                                Sunucu Hatası Lütfen yönetici ile iletiişime geçiniz</b>

                                        <?php } ?>
                                    </div>

                                    <script>
                                        setTimeout(function() {
                                            document.getElementById("msgbox").style.display = "none";
                                        }, 3500);
                                    </script>

                                    <input type="hidden" name="yorum_id" value="<?php echo $yorumcek['yorum_id'] ?>">
                                </div><!--İnputlar bitiş-->

                            
                                <div class="col-md-12" align="right">
                                    <a target="_blank" href="../haber-<?php echo $habercek['haber_seo_url'] ?>" type="submit" class="btn mb-2 btn-info" style="border-radius:30px; color:#fff" name="iltunread">Habere Git</a>

                                    <?php
                                    if ($yorumcek['durum'] == 0) {
                                    ?>
                                        <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff" name="yorumonay">Onay Ver</button>
                                        <button type="submit" class="btn mb-2 btn-danger" style="border-radius:30px; color:#fff" name="yorumred">Reddet</button>
                                    <?php } else if ($yorumcek['durum'] == 1) { ?>
                                        <button type="submit" class="btn mb-2 btn-danger" style="border-radius:30px; color:#fff" name="yorumred">Yorumu Kaldır</button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn mb-2 btn-warning" style="border-radius:30px; color:#fff" name="yorumonay">Yorumu Yayınla</button>
                                    <?php } ?>
                                        <button type="submit" class="btn mb-2 btn-danger" style="border-radius:30px; color:#fff" name="yorumsil" onclick="return confirm('Silmek istediğinize emin misiniz?')">Yorumu sil</button>
                                    


                                </div>

                        </form>



                    </div>
                </div>
            </div> <!-- Striped rows -->
        </div> <!-- .row-->
    </div> <!-- .col-12 -->


    </div> <!-- .row-->
    </div> <!-- .col-12 -->
    </div> <!-- .row -->
    </div> <!-- .container-fluid -->


    <?php include 'sidebar.php' ?>
</main> <!-- main -->
</div> <!-- .wrapper -->

<?php include 'footer.php' ?>
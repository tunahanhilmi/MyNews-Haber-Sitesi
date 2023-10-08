<?php
include 'header.php';
$siteayar = $db->prepare("SELECT 
site_ayar.logo,
site_ayar.favicon
 FROM site_ayar
Where id=:id
");

$siteayar->execute(
    array(
        'id' => 1
    )
);
$siteayarcek = $siteayar->fetch(PDO::FETCH_ASSOC);

?>

<head>
    <title>Logo ve favicon ayarları</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">


                    <div class="col-md-12 col-lg-6">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title">Logo güncelle</strong>
                                </div>
                                <div class="card-body my-n2">


                                    <div class="col-md-12">

                                        <style>
                                            #pp {
                                                width: 150px;
                                                height: 150px;
                                                object-fit: cover;
                                                border-radius: 50%;
                                            }
                                        </style>

                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <?php if (strlen($kullanicicek['photo']) > 0) { ?>
                                                <img id="pp" src="<?php echo $siteayarcek['logo'] ?>" alt=""
                                                    class="form-control p-0">
                                            <?php } else { ?>
                                                <img id="pp" src="process/images/no-pp.png" alt="" class="form-control p-0">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Logo</label>
                                        <input required type="file" name="logo" class="form-control">
                                    </div>

                                </div>
                                <input type="hidden" name="eskilogo" value="<?php echo $siteayarcek['logo'] ?>">
                                <div class="col-md-12" align="right">

                                    <button type="submit" class="btn mb-2 btn-success"
                                        style="border-radius:30px; color:#fff" name="submit1">Güncelle</button>

                                </div>

                                <?php
                                if (isset($_POST['submit1'])) {

                                    if (isset($_FILES['logo'])) {
                                        $hata = $_FILES['logo']['error'];
                                        if ($hata != 0) {
                                            echo 'Resim gönderilirken bir hata gerçekleşti.';
                                            echo $hata;
                                        } else {
                                            $resimBoyutu = $_FILES['logo']['size'];
                                            if ($resimBoyutu == 0) {
                                                header("Location:../pp-guncelle?dr=1");
                                            } else {
                                                $tip = $_FILES['logo']['type'];
                                                $resimAdi = $_FILES['logo']['name'];

                                                $uzantisi = explode('.', $resimAdi);
                                                $uzantisi = $uzantisi[count($uzantisi) - 1];

                                                $yeni_adi = "upload/images/" . time() . "." . $uzantisi;

                                                if ($tip == 'image/jpeg' || $tip == 'image/png') {
                                                    move_uploaded_file($_FILES["logo"]["tmp_name"], $yeni_adi);
                                                } else {
                                                    echo 'Yanlızca JPG ve PNG resim gönderebilirsiniz.';
                                                    header("refresh:1");
                                                    exit;
                                                }
                                            }
                                        }
                                    }
                                    $guncelle = $db->prepare("UPDATE site_ayar SET logo=:logo
                                where id=1 ");

                                    $update = $guncelle->execute(
                                        array(
                                            'logo' => $yeni_adi

                                        )
                                    );
                                    if ($update) {
                                        unlink($_POST['eskilogo']);
                                        echo '<div style="color:green" id="msgbox" class="form-group alert alert-success m-3">Logo güncellendi, lütfen bekleyiniz!</div>';
                                        header("refresh:2");
                                    } else {

                                        header("refresh:2");
                                    }
                                }

                                ?>
                            </div>


                            <script>
                                setTimeout(function () {
                                    document.getElementById("msgbox").style.display = "none";
                                }, 3500);
                            </script>



                        </form>

                    </div><!--İnputlar bitiş-->

















                    <!---favicon--->
                    <div class="col-md-12 col-lg-6">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title">Favicon güncelle</strong>
                                </div>
                                <div class="card-body my-n2">


                                    <div class="col-md-12">

                                        <style>
                                            #pp {
                                                width: 150px;
                                                height: 150px;
                                                object-fit: cover;
                                                border-radius: 50%;
                                            }
                                        </style>

                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <?php if (strlen($kullanicicek['photo']) > 0) { ?>
                                            <img id="pp" src="<?php echo $siteayarcek['favicon'] ?>" alt=""
                                                class="form-control p-0">
                                            <?php } else { ?>
                                            <img id="pp" src="process/images/no-pp.png" alt="" class="form-control p-0">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Favicon</label>
                                        <input required type="file" name="favicon" class="form-control">
                                    </div>

                                </div>
                                <input type="hidden" name="eskifavicon" value="<?php echo $siteayarcek['favicon'] ?>">
                                <div class="col-md-12" align="right">

                                    <button type="submit" class="btn mb-2 btn-success"
                                        style="border-radius:30px; color:#fff" name="submit2">Güncelle</button>

                                </div>
                                <?php
                                if (isset($_POST['submit2'])) {

                                    if (isset($_FILES['favicon'])) {
                                        $hata = $_FILES['favicon']['error'];
                                        if ($hata != 0) {
                                            echo 'Resim gönderilirken bir hata gerçekleşti.';
                                            echo $hata;
                                        } else {
                                            $resimBoyutu = $_FILES['favicon']['size'];
                                            if ($resimBoyutu == 0) {
                                                header("Location:../pp-guncelle?dr=1");
                                            } else {
                                                $tip = $_FILES['favicon']['type'];
                                                $resimAdi = $_FILES['favicon']['name'];

                                                $uzantisi = explode('.', $resimAdi);
                                                $uzantisi = $uzantisi[count($uzantisi) - 1];

                                                $yeni_adi = "upload/images/" . time() . "." . $uzantisi;

                                                if ($tip == 'image/jpeg' || $tip == 'image/png') {

                                                    move_uploaded_file($_FILES["favicon"]["tmp_name"], $yeni_adi);

                                                } else {
                                                    echo 'Yanlızca JPG ve PNG resim gönderebilirsiniz.';
                                                    header("refresh:1");
                                                    exit;
                                                }
                                            }
                                        }
                                    }
                                    $guncelle = $db->prepare("UPDATE site_ayar SET favicon=:favicon
                                where id=1 ");

                                    $update = $guncelle->execute(
                                        array(
                                            'favicon' => $yeni_adi

                                        )
                                    );
                                    if ($update) {
                                        unlink($_POST['eskifavicon']);
                                        echo '<div style="color:green" id="msgbox" class="form-group alert alert-success m-3">Favicon güncellendi, lütfen bekleyiniz!</div>';
                                        header("refresh:1");
                                    } else {
                                        header("refresh:1");
                                    }
                                }

                                ?>
                            </div>


                        </form>
                    </div><!--İnputlar bitiş-->




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
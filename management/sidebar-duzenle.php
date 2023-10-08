<?php
include 'header.php';
$sidebarsor = $db->prepare("SELECT * FROM sidebar where sidebar_id=:id");
$sidebarsor->execute(
    array(
        'id' => 1
    )
);
$sidebarcek = $sidebarsor->fetch(PDO::FETCH_ASSOC);
?>

<head>
    <title>Profil Fotoğrafı Değiştir</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">


                    <div class="col-md-12 col-lg-6">
                        <form action="process/process.php" method="POST" enctype="multipart/form-data">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title">Yayınlanan Afiş</strong>
                                </div>
                                <div class="card-body my-n2">


                                    <div class="col-md-12">

                                        <style>
                                            #pp2 {
                                                width: 400px;
                                                height: auto;
                                                object-fit: cover;

                                            }
                                        </style>

                                        <div class="form-group mb-3 d-flex justify-content-center">

                                            <?php if (strlen($sidebarcek['afis']) > 0) { ?>
                                                <img id="pp2" src="process/<?php echo $sidebarcek['afis'] ?>" alt="" class="form-control p-0">

                                            <?php } else { ?>
                                                <img id="pp2" src="process/images/no-pp.png" alt="" class="form-control p-0">
                                            <?php  } ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Afiş Yükle</label>
                                        <input required type="file" name="afis" class="form-control">
                                    </div>
                                    <?php
                                    if ($_GET['dr'] == "1") { ?>

                                        <div id="msgbox" class=" form-control col-12 p-0">
                                            <p class="form-control alert alert-success">Fotoğraf Seçilmedi!</p>
                                        </div>
                                    <?php }



                                    if ($_GET['dr'] == "2") { ?>

                                        <div id="msgbox" class=" form-control col-12 p-0">
                                            <p class="form-control alert alert-success">Afiş Başarıyla Güncellendi!</p>
                                        </div>
                                    <?php }
                                    if ($_GET['dr'] == "3") { ?>
                                        <div id="msgbox" class="form-control">
                                            <p class="form-control alert alert-danger">Afiş Güncellenemedi Lütfen Tekrar Deneyiniz!</p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-12" align="right">

                                    <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff" name="afisguncelle">Afişi Güncelle</button>

                                </div>
                            </div>

                            <input type="hidden" name="eskiafis" value="<?php echo $sidebarcek['afis'] ?>">
                            <script>
                                setTimeout(function() {
                                    document.getElementById("msgbox").style.display = "none";
                                }, 3500);
                            </script>




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
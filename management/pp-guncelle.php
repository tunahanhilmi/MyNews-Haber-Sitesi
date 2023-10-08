<?php
include 'header.php';

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
                                    <strong class="card-title">Profil Fotoğrafı Güncelle</strong>
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
                                                <img id="pp" src="process/<?php echo $kullanicicek['photo'] ?>" alt="" class="form-control p-0">
                                            <?php } else { ?>
                                                <img id="pp" src="process/images/no-pp.png" alt="" class="form-control p-0">
                                            <?php  } ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Fotoğraf</label>
                                        <input required type="file" name="photo" class="form-control">
                                    </div>
                                    <?php
                                    if ($_GET['dr'] == "1") { ?>

                                        <div id="msgbox" class=" form-control col-12 p-0">
                                            <p class="form-control alert alert-success">Fotoğraf Seçilmedi!</p>
                                        </div>
                                    <?php }



                                    if ($_GET['dr'] == "2") { ?>

                                        <div id="msgbox" class=" form-control col-12 p-0">
                                            <p class="form-control alert alert-success">Profil Fotoğrafı Başarıyla Güncellendi!</p>
                                        </div>
                                    <?php }
                                    if ($_GET['dr'] == "3") { ?>
                                        <div id="msgbox" class="form-control">
                                            <p class="form-control alert alert-danger">Profiliniz Fotoğrafı Güncellenemedi Lütfen Tekrar Deneyiniz!</p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-12" align="right">

                                    <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff" name="ppguncelle">Profilimi Güncelle</button>

                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $kullanicicek['id'] ?>">
                            <input type="hidden" name="eskipp" value="<?php echo $kullanicicek['photo'] ?>">
                            <script>
                                setTimeout(function() {
                                    document.getElementById("msgbox").style.display = "none";
                                }, 3500);
                            </script>





                    </div><!--İnputlar bitiş-->


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
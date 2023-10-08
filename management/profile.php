<?php
include 'header.php';

?>

<head>
    <title>Profilim</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">


                    <div class="col-md-12 col-lg-6">
                        <form action="process/process.php" method="POST">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title"><?php echo $kullanicicek['name'] ?> Detay</strong>
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
                                                <img id="pp" src="process/images/no-pp.png" alt="" class="form-control">
                                            <?php  } ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">İsim</label>
                                        <input required type="text" name="name" class="form-control" value="<?php echo $kullanicicek['name'] ?>">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Soyisim</label>
                                        <input required type="text" name="surname" class="form-control" value="<?php echo  $kullanicicek['surname'] ?>">
                                    </div>





                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Mail </label>
                                        <input required type="text" name="mail" class="form-control" value="<?php echo $kullanicicek['mail'] ?>">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Telefon</label>
                                        <input required type="text" name="telNumber" class="form-control" value="<?php echo $kullanicicek['telNumber'] ?>">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Yetki</label>
                                        <?php if ($kullanicicek['authority'] == 0) { ?>
                                            <input required type="text" id="" class="form-control" disabled value="Yetkisiz">
                                        <?php }
                                        if ($kullanicicek['authority'] == 1) { ?>
                                            <input required type="text" id="" class="form-control" disabled value="Admin">
                                        <?php }
                                        if ($kullanicicek['authority'] == 2) { ?>
                                            <input required type="text" id="" class="form-control" disabled value="Adminastor">
                                        <?php } ?>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Kayıt Tarihi</label>
                                        <input required type="text" id="" class="form-control" disabled value="<?php echo $kullanicicek['registrationDate'] ?>">
                                    </div>
                                    <div class="form-group mb-3">

                                        <?php
                                        if ($_GET['dr'] == "1") { ?>

                                            <div id="msgbox" class=" form-control col-12 p-0">
                                                <p class="form-control alert alert-success">Profil Başarıyla Güncellendi!</p>
                                            </div>
                                        <?php }
                                        if ($_GET['dr'] == "2") { ?>
                                            <div id="msgbox" class="form-control">
                                                <p class="form-control alert alert-danger">Profiliniz Güncellenemedi Lütfen Tekrar Deneyiniz!</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="<?php echo $kullanicicek['id'] ?>">
                                <script>
                                    setTimeout(function() {
                                        document.getElementById("msgbox").style.display = "none";
                                    }, 3500);
                                </script>



                                <div class="col-md-12" align="right">

                                    <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff" name="profilguncelle">Profilimi Güncelle</button>
                                    <a href="pp-guncelle" class="btn mb-2 btn-info" style="border-radius:30px; color:#fff">Profil Foto Güncelle</a>
                                </div>

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
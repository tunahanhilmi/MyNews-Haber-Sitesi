<?php
include 'header.php';

?>

<head>
    <title>Şifre Değiştir</title>
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
                                    <strong class="card-title">Şifre Değiştir</strong>
                                </div>
                                <div class="card-body my-n2">


                                    <div class="col-md-12">

                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Eski Şifre</label>
                                        <input required type="password" name="eski" class="form-control" >
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Yeni Şifre</label>
                                        <input required type="password" name="yeni1" class="form-control" >
                                    </div>





                                    <div class="form-group mb-3">
                                        <label for="simpleinput">Yeni Şifre (Tekrar)</label>
                                        <input required type="password" name="yeni2" class="form-control" ">
                                    </div>


                            
                                    <div class="form-group mb-3">

                                        <?php
                                        if ($_GET['dr'] == "1") { ?>

                                            <div id="msgbox" class=" form-control col-12 p-0">
                                                <p class="form-control alert alert-danger">Eski Şifreniz Yanlış!</p>
                                            </div>
                                        <?php }
                                        if ($_GET['dr'] == "2") { ?>
                                            <div id="msgbox" >
                                                <p class="form-control alert alert-danger">Yeni şifre en az 6 karakter olmalıdır!</p>
                                            </div>
                                        <?php } if ($_GET['dr'] == "3") { ?>
                                            <div id="msgbox" >
                                                <p class="form-control alert alert-danger">Şifreler Uyuşmuyor!</p>
                                            </div>
                                        <?php } if ($_GET['dr'] == "4") { ?>
                                            <div id="msgbox" >
                                                <p class="form-control alert alert-success">Şifre başarıyla değiştirildi!</p>
                                            </div>
                                        <?php } if ($_GET['dr'] == "5") { ?>
                                            <div id="msgbox">
                                                <p class="form-control alert alert-danger">Şifre Değiştirilemedi. Yöneticiye Bildiriniz!</p>
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

                                    <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff" name="sifredegistir">Şifremi Değiştir</button>

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
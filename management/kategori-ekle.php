<?php
include 'header.php';

if ($kullanicicek['authority'] != 2) {
    header("Location:dashboard");
}
?>
<head>
  <title>Kategori Ekle</title>
</head>

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">


                    <div class="col-md-12 col-lg-6">
                        <form action="process/process.php" method="POST" autocomplete="off">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title">Kategori Ekle</strong>
                                </div>
                                <div class="card-body my-n2">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Kategori İsmi</label>
                                            <input required type="text" id="" class="form-control" name="kategori_isim">
                                        </div>

                                        <?php if ($_GET['dr'] == "1") { ?>
                                            <div style="color:red" id="msgbox" class="form-group alert alert-danger"> Bu kategori önceden eklenmiş!</div>
                                        <?php } ?>
                                        <?php if ($_GET['dr'] == "2") { ?>
                                            <div style="color:red" id="msgbox" class="form-group alert alert-danger"> Kategori Eklenemedi</div>
                                        <?php } ?>
                                    </div>




                                </div><!--İnputlar bitiş-->

                                <div class="col-md-12" align="right">
                                    <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff" name="kategoriekle">Kategori Ekle</button>

                                </div>

                        </form>

                        <script>
                            setTimeout(function() {
                                document.getElementById("msgbox").style.display = "none";
                            }, 3500);
                        </script>

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
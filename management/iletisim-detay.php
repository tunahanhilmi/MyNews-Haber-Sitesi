<?php
include 'header.php';
$iletisimsor = $db->prepare("SELECT * FROM iletisim where iletisim_id=:id");
$iletisimsor->execute(
    array(
        'id' => $_GET['iletisim_id']
    )
);
$say = $iletisimsor->rowCount();
$iletisimcek = $iletisimsor->fetch(PDO::FETCH_ASSOC);
?>
<head>
  <title>İletişim Detayı</title>
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
                                    <strong class="card-title">iletisim Mesaj Detay</strong>
                                </div>
                                <div class="card-body my-n2">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">İsim Soyisim</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $iletisimcek['iname'] ?>">
                                        </div>





                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Mail </label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $iletisimcek['mail'] ?>">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Telefon</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $iletisimcek['phone'] ?>">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Konu</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $iletisimcek['isubject'] ?>">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Mesaj</label>
                                            <textarea disabled id="" class="form-control" cols="30"
                                                rows="10"><?php echo $iletisimcek['imessage'] ?></textarea>

                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Gönderi Zamanı</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $iletisimcek['time'] ?>">
                                        </div>
                                        <?php

                                        if ($_GET['dr'] == "1") { ?>
                                            <b style="color:green" id="msgbox" class="form-control alert alert-success">
                                                Mesaj Okundu
                                                Olarak İşaretlendi!</b>

                                        <?php } else if ($_GET['dr'] == "2") { ?>
                                                <b style="color:red" id="msgbox" class="form-control alert alert-danger"> İşlem
                                                    Başarısız </b>
                                        <?php }

                                        ?>
                                        <?php

                                        if ($_GET['dr'] == "3") { ?>
                                            <b id="msgbox" class="form-control alert alert-warning">
                                                Mesaj Okunması Kaldırıldı!</b>

                                        <?php } else if ($_GET['dr'] == "4") { ?>
                                                <b style="color:red" id="msgbox" class="form-control alert alert-danger"> İşlem
                                                    Başarısız</b>
                                        <?php }

                                        ?>
                                    </div>

                                    <script>
                                        setTimeout(function () {
                                            document.getElementById("msgbox").style.display = "none";
                                        }, 3500);
                                    </script>

                                    <input type="hidden" name="iletisim_id"
                                        value="<?php echo $iletisimcek['iletisim_id'] ?>">
                                </div><!--İnputlar bitiş-->

                                <div class="col-md-12" align="right">

                                    <?php
                                    if ($iletisimcek['situation'] == 0) {
                                        ?>
                                        <button type="submit" class="btn mb-2 btn-success"
                                            style="border-radius:30px; color:#fff" name="iltread">Okundu Olarak
                                            İşaretle</button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn mb-2 btn-warning"
                                            style="border-radius:30px; color:#fff" name="iltunread">Okunmadı Olarak İşaretle</button>
                                    <?php } ?>
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
<?php
include 'header.php';;

$iletisimsor = $db->prepare("SELECT * FROM iletisim where iletisim_id!=:id order by situation='0' desc ");
$iletisimsor->execute(
    array(
        'id' => 0
    )
);


?>
<head>
  <title>Gelen Mailler</title>
</head>

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">Gelen Mailler</strong>
                                <?php

                                if ($_GET['dr'] == "1") { ?>
                                    <br><br>
                                    <b style="color:green"> Silme işlemi Başarılı</b>

                                <?php } else if ($_GET['dr'] == "2") { ?>
                                    <br><br> <b style="color:red"> İşlem Başarısız</b>
                                <?php }

                                ?>
                                <a class="float-right small text-muted" href="#!">Hepsini Görüntüle</a>
                            </div>
                            <div class="card-body my-n2">
                                <table class="table table-striped table-hover table-borderless">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ad Soyad</th>
                                            <th>Mail</th>
                                            <th>Telefon</th>
                                            <th>Konu</th>
                                            <th>Mesaj</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php while ($iletisimcek = $iletisimsor->fetch(PDO::FETCH_ASSOC)) { ?>




                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $iletisimcek['iletisim_id'] ?>
                                                </td>
                                                <th scope="col">
                                                    <?php echo $iletisimcek['iname'] ?>
                                                </th>
                                                <td>
                                                    <?php echo $iletisimcek['mail'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $iletisimcek['phone'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $iletisimcek['isubject'] ?>
                                                </td>
                                                <td>
                                                    <?php echo substr($iletisimcek['imessage'], 0, 15);
                                                    echo '...'; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($iletisimcek['situation'] == 0) { ?>

                                                        <button disabled="disabled" style="color:#fff" class="btn btn-warning btn-sm">Okunmadı</button>
                                                    <?php } else { ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">Okundu</button>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <a class="dropdown-item" href="iletisim-detay.php?iletisim_id=<?php echo $iletisimcek['iletisim_id'] ?>">Detaya
                                                                Git</a>
                                                            <a class="dropdown-item" href="process/process.php?iletisim_id=<?php echo $iletisimcek['iletisim_id'] ?>&iletisimsil=1">Sil</a>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>

                                    <?php } ?>
                                </table>
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




<?php
include 'footer.php'
?>
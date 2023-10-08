<?php
include 'header.php';;

$yorumsor = $db->prepare("SELECT * FROM yorum where yorum_id!=:id and raporlama=:raporlama order by tarih desc");
$yorumsor->execute(
    array(
        'id' => 0,
        'raporlama' => 1
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
                                            <th>Cinsiyet</th>
                                            <th>Yorum</th>
                                            <th>Durum</th>
                                            <th>Rapor Durumu</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) { ?>




                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $yorumcek['yorum_id'] ?>
                                                </td>
                                                <th scope="col">
                                                    <?php echo $yorumcek['isim']. ' '. $yorumcek['soyisim'] ?>
                                                </th>
                                            
                                                <td>
                                                    <?php if($yorumcek['cinsiyet']==0){echo 'Belirtilmedi';}else if($yorumcek['cinsiyet']==1){echo 'Erkek';} else{echo 'Kadın';} ?>
                                                </td>
                                                <td>
                                                    <?php echo substr($yorumcek['yorum'], 0, 20);
                                                    echo '...'; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($yorumcek['durum'] == 0) { ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-warning btn-sm">Onay Bekliyor</button>
                                                    <?php }else if($yorumcek['durum'] == 1){ ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">Onaylandı</button>
                                                    <?php } else {?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-danger btn-sm">Reddedildi</button>
                                                   <?php } ?>
                                                </td>
                                                <td><button disabled="disabled" style="color:#fff" class="btn btn-danger btn-sm">Raporlandı</button></td>
                                                <td>
                                                <a class="btn btn-info btn-sm" href="yorum-detay.php?yorum_id=<?php echo $yorumcek['yorum_id'] ?>">Detaya
                                                                Git</a>
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
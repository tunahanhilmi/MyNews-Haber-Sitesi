<?php
include 'header.php';;

$yorumsor = $db->prepare("SELECT * FROM yorum where yorum_id!=:id order by tarih desc ");
$yorumsor->execute(
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
                                <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <label class="sr-only" for="search">Search</label>
                                            <input type="text" class="form-control mb-2" id="search" placeholder="Arama Yap">
                                        </div>
                                    </div>
                                </form>
                                <table id="myTable" class="table table-striped table-hover table-borderless">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ad Soyad</th>
                                            <th>Cinsiyet</th>
                                            <th>Yorum</th>
                                            <th>Durum</th>
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
                                                    <?php echo $yorumcek['isim'] . ' ' . $yorumcek['soyisim'] ?>
                                                </th>

                                                <td>
                                                    <?php if ($yorumcek['cinsiyet'] == 0) {
                                                        echo 'Belirtilmedi';
                                                    } else if ($yorumcek['cinsiyet'] == 1) {
                                                        echo 'Erkek';
                                                    } else {
                                                        echo 'Kadın';
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php echo substr($yorumcek['yorum'], 0, 20);
                                                    echo '...'; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($yorumcek['durum'] == 0) { ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-warning btn-sm">Onay Bekliyor</button>
                                                    <?php } else if ($yorumcek['durum'] == 1) { ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">Onaylandı</button>
                                                    <?php } else { ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-danger btn-sm">Reddedildi</button>
                                                    <?php } ?>
                                                </td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    $("#status").on("change", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tbody tr").filter(function() {
        if (value === "") {
          $(this).show();
        } else {
          $(this).toggle($(this).find("td:nth-child(5)").text().toLowerCase().indexOf(value) > -1)
        }
      });
    });
  });
</script>
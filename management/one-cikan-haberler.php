<?php
include 'header.php';;

$habersor = $db->prepare("SELECT * FROM haber where haber_id!=:id and haber_one_cikan!=:sorgu order by haber_tarih desc");
$habersor->execute(array(
  'id' => 0,
  'sorgu' => 1
));

$onecikanlar = $db -> prepare("SELECT 
haber.haber_id,
haber.haber_seo_url,
haber.haber_ana_foto,
haber.haber_baslik,
haber.haber_durum,
haber.haber_one_cikan,
haber.haber_ana_detay,
haber.haber_tarih,
haber.haber_detay,
kategori.kategori_id,
kategori.kategori_isim,
kategori.kategori_seo,
yazar.name,
yazar.surname
FROM haber INNER JOIN kategori ON haber.kategori_id=kategori.kategori_id INNER JOIN yazar ON haber.yazar_id=yazar.yazar_id where haber.haber_one_cikan=:one_cikan
");
$onecikanlar -> execute(array(
    'one_cikan' => 1
));

?>

<head>
  <title>Haberler</title>
</head>

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">


        <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card shadow">
              <div class="card-header">
                <strong class="card-title">Öne Çıkan Haberler</strong>
              
              </div>
              <div class="card-body my-n2">
                <table  class="table table-striped table-hover table-borderless">

                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Haber Başlığı</th>
                      <th>Yazar</th>
                      <th>Zaman</th>
                      <th>Durum</th>
                      <th>İşlemler</th>
                    </tr>
                  </thead>

                  <?php while ($habercek2 = $onecikanlar->fetch(PDO::FETCH_ASSOC)) { ?>


                    <tbody>
                      <tr>
                        <td><?php echo $habercek2['haber_id'] ?></td>
                        <th scope="col"><?php echo $habercek2['haber_baslik'] ?></th>
                        <td><?php echo $habercek2['name'].' '. $habercek2['surname'] ?></td>
                        <td><?php echo tarih($habercek2['haber_tarih']) ?></td>
                        <td><?php if ($habercek2['haber_durum'] == 0) {
                              echo '<button disabled="disabled" style="color:#fff" class="btn btn-danger btn-sm">pasif</button>';
                              if ($habercek2['haber_one_cikan'] == 1) {
                                echo '<button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">One Çıkarıldı</button>';
                              }
                            } else {
                              echo '<button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">Yayında</button>';
                              if ($habercek2['haber_one_cikan'] == 1) {
                                echo '<button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">One Çıkarıldı</button>';
                              }
                            } ?></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                              <a class="dropdown-item" href="haber-duzenle.php?haber_id=<?php echo $habercek2['haber_id'] ?>">Düzenle</a>
                              <a class="dropdown-item" target=_blank href="../<?php echo "haber-".$habercek2['haber_seo_url'] ?>">Habere Git</a>
                              <a class="dropdown-item" href="process/process.php?haber_id=<?php echo $habercek2['haber_id'] ?>&haber_geri_al=ok">Öne Çıkarmaktan Vazgeç</a>
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

          <div class="col-md-12 col-lg-12">
            <br><br>
            <div class="card shadow">
              <div class="card-header">
                <strong class="card-title">Son Haberler</strong>

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
                      <th>Haber Başlığı</th>
                      <th>Yazar</th>
                      <th>Zaman</th>
                      <th>Durum</th>
                      <th>İşlemler</th>
                    </tr>
                  </thead>

                  <?php while ($habercek = $habersor->fetch(PDO::FETCH_ASSOC)) { 
                    
                    $yazarsor = $db -> prepare("SELECT * FROM yazar where yazar_id=:id");
                    $yazarsor -> execute(array(
                      'id' => $habercek['yazar_id']
                    ));
                     $yazarcek = $yazarsor -> fetch(PDO::FETCH_ASSOC);?>



                    <tbody>
                      <tr>
                        <td><?php echo $habercek['haber_id'] ?></td>
                        <th scope="col"><?php echo $habercek['haber_baslik'] ?></th>
                        <td><?php echo $yazarcek['name'].' '. $yazarcek['surname'] ?></td>
                        <td><?php echo tarih($habercek['haber_tarih']) ?></td>
                        <td><?php if ($habercek['haber_durum'] == 0) {
                              echo '<button disabled="disabled" style="color:#fff" class="btn btn-danger btn-sm">pasif</button>';
                            } else {
                              echo '<button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">Yayında</button>';
                            } ?></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                              <a class="dropdown-item" href="haber-duzenle.php?haber_id=<?php echo $habercek['haber_id'] ?>">Düzenle</a>
                              <a class="dropdown-item" href="process/process.php?haber_id=<?php echo $habercek['haber_id'] ?>&haber_one_cikar=ok">Haberi Öne Çıkar</a>
                              <a class="dropdown-item" target=_blank href="../<?php echo "haber-";
                                                                              echo $habercek['haber_seo_url'] ?>">Habere Git</a>
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


<?php
include 'footer.php'
?>
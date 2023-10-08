<?php
include 'header.php';

$habersor = $db->prepare("SELECT * FROM haber where haber_id!=:id and haber_durum=:durum order by haber_tarih desc limit 5 ");
$habersor->execute(array(
  'id' => 0,
  'durum'=> 1
));


$iletisimsor = $db->prepare("SELECT * FROM iletisim where iletisim_id!=:id order by situation='0' and time desc limit 5 ");
$iletisimsor->execute(
  array(
    'id' => 0
  )
);

$yorumsor = $db->prepare("SELECT * FROM yorum where yorum_id!=:id order by tarih desc limit 5");
$yorumsor->execute(
  array(
    'id' => 0
  )
);

$yorumsor2 = $db->prepare("SELECT * FROM yorum where yorum_id!=:id and durum=:durum ");
$yorumsor2->execute(
  array(
    'id' => 0,
    'durum' => 0
  )
);

$iletisimsor2 = $db->prepare("SELECT * FROM iletisim where iletisim_id!=:id and situation=:durum ");
$iletisimsor2->execute(
  array(
    'id' => 0,
    'durum' => 0
  )
);

?>

<head>
  <title>Ana Sayfa</title>
</head>
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
              <!-- widgets -->
              <div class="row my-4">
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class=" mb-1 d-flex justify-content-center">Onay Bekleyen Yorumlar</small>
                          <h3 class="card-title mb-0 d-flex justify-content-center"><?php echo $yorumsay = $yorumsor2->rowCount(); ?></h3>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="mb-1 d-flex justify-content-center">Okunmamış İleti Sayısı</small>
                          <h3 class="card-title mb-0 d-flex justify-content-center"><?php echo $iletisimsay = $iletisimsor2->rowCount(); ?></h3>
                        </div>
                    
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1 d-flex justify-content-center">Yayındaki Haber Sayısı</small>
                          <h3 class="card-title mb-0 d-flex justify-content-center"><?php echo $habersay = $habersor->rowCount(); ?></h3>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- end section -->
        <div class="row">


          <div class="col-md-12 col-lg-12">
            <div class="card shadow">
              <div class="card-header">
                <strong class="card-title">Son Haberler (5 adet)</strong>
                <a class="float-right small text-muted" href="haberler">Hepsini Görüntüle</a>
              </div>
              <div class="card-body my-n2">
                <table  class="table table-striped table-hover table-borderless">

                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Haber Başlığı</th>
                      <th>Yazar</th>
                      <th>Zaman</th>
                      <th>İşlemler</th>
                    </tr>
                  </thead>

                  <?php while ($habercek = $habersor->fetch(PDO::FETCH_ASSOC)) { 
                    
                    $yazarsor = $db -> prepare("SELECT * FROM yazar where yazar_id=:id");
                    $yazarsor -> execute(array(
                      'id' => $habercek['yazar_id']
                    ));
                     $yazarcek = $yazarsor -> fetch(PDO::FETCH_ASSOC);
                    ?>


                    

                    <tbody>
                      <tr>
                        <td><?php echo $habercek['haber_id'] ?></td>
                        <th scope="col"><?php echo $habercek['haber_baslik'] ?></th>
                        <td><?php echo $yazarcek['name'].' '. $yazarcek['surname'] ?></td>
                        <td><?php echo $habercek['haber_tarih'] ?></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                              <a class="dropdown-item" href="haber-duzenle.php?haber_id=<?php echo $habercek['haber_id'] ?>">Düzenle</a>
                              <a class="dropdown-item" href="process/process.php?haber_id=<?php echo $habercek['haber_id'] ?>&haber_ana_foto=<?php echo $habercek['haber_ana_foto'] ?>&habersil=ok" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
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

          <div class="col-md-12 col-lg-12">
            <br><br>
            <div class="card shadow">
              <div class="card-header">
                <strong class="card-title">Gelen Mailler</strong>
                <a class="float-right small text-muted" href="iletisim">Hepsini Görüntüle</a>
              </div>
              <div class="card-body my-n2">
                <table  class="table table-striped table-hover table-borderless">

                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Ad Soyad</th>
                      <th>Mail</th>
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
                        <td scope="col">
                          <?php echo $iletisimcek['iname'] ?>
                        </td>
                        <td>
                          <?php echo $iletisimcek['mail'] ?>
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
                              <a class="dropdown-item" href="iletisim-detay.php?iletisim_id=<?php echo $iletisimcek['iletisim_id'] ?>">Detaya Git</a>
                              <a class="dropdown-item" href="process/process.php?iletisim_id=<?php echo $iletisimcek['iletisim_id'] ?>&iletisimsil=1" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
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


          <div class="col-md-12 col-lg-6">
            <br>
            <div class="card shadow">
              <div class="card-header">
                <strong class="card-title">Tüm Yorumlar</strong>

                <a class="float-right small text-muted" href="yorumlar">Hepsini Görüntüle</a>
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
                          <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                              <a class="dropdown-item" href="yorum-detay.php?yorum_id=<?php echo $yorumcek['yorum_id'] ?>">Detaya
                                Git</a>

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




          <div class="col-md-12 col-lg-6">
            <br>
            <div class="card shadow">
              <div class="card-header">
                <strong class="card-title">Yroum Yapan Kişi Oranları</strong>
 
              </div>
              <div class="card-body my-n2">
              <canvas id="pieChartjs" width="400" height="225"></canvas>
              </div>
            </div>

          </div> <!-- Striped rows -->
          <

                  

      </div> <!-- .col-12 -->


    </div> <!-- .row-->
  </div> <!-- .col-12 -->
  </div> <!-- .row -->
  </div> <!-- .container-fluid -->

<script>
  
</script>
  <?php include 'sidebar.php' ?>
</main> <!-- main -->
</div> <!-- .wrapper -->







<?php 


include 'footer.php';



$kadın = $db->prepare("SELECT COUNT(cinsiyet) FROM yorum WHERE cinsiyet='2'");
$erkek = $db->prepare("SELECT COUNT(cinsiyet) FROM yorum WHERE cinsiyet='1'");
$belirtilmemis = $db->prepare("SELECT COUNT(cinsiyet) FROM yorum WHERE cinsiyet='0'");

$kadın->execute();
$erkek->execute();
$belirtilmemis->execute();

$kadınCount = $kadın->fetchColumn();
$erkekCount = $erkek->fetchColumn();
$belirtilmemisCount = $belirtilmemis->fetchColumn();

$data = [
  ["label" => "Kadın", "value" => $kadınCount],
  ["label" => "Erkek", "value" => $erkekCount],
  ["label" => "Belirtilmemiş", "value" => $belirtilmemisCount]
];?>
<script>
// JavaScript dosyasında PHP verilerini kullan
var pieChartData = {
    labels: [],
    datasets: [{
        data: [],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
        borderColor: '#ffffff'
    }]
};

<?php
// PHP verilerini JavaScript'e aktar
foreach ($data as $item) {
    echo "pieChartData.labels.push('" . $item['label'] . "');";
    echo "pieChartData.datasets[0].data.push(" . $item['value'] . ");";
}
?>

var pieChartjs = document.getElementById("pieChartjs");
pieChartjs && new Chart(pieChartjs, { 
    type: "pie", 
    data: pieChartData, 
    options: { 
        maintainAspectRatio: false, 
        responsive: true 
    } 
});
</script>
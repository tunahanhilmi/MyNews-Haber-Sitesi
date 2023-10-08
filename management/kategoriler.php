<?php
include 'header.php';


$kategorisor = $db->prepare("SELECT * FROM kategori where kategori_id!=:id order by kategori_durum='1' desc ");
$kategorisor->execute(
    array(
        'id' => 0
    )
);

?>

<head>
    <title>Kategoriler</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">

                    <div class="col-md-9 col-lg-9">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">Kategoriler</strong>
                                <?php

                                if ($_GET['dr'] == "1") { ?>
                                    <br><br>
                                    <b style="color:green"> Yeni Kategori Eklendi!</b>

                                <?php } ?>
                                <?php

                                if ($_GET['dr'] == "2") { ?>
                                    <br><br>
                                    <b style="color:#62CDFF"> Kategori Başarıyla Silindi!</b>

                                <?php } ?>
                                <?php

                                if ($_GET['dr'] == "3") { ?>
                                    <br><br>
                                    <b style="color:gold"> Kategori Silinemedi</b>

                                <?php } ?>
                                <a style="color:#fff" class="float-right btn btn-success btn-sm" href="kategori-ekle">Kategori Ekle</a>
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
                                            <th>Kategori İsim</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>




                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $kategoricek['kategori_id'] ?>
                                                </td>
                                                <td scope="col">
                                                    <?php echo $kategoricek['kategori_isim'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($kategoricek['kategori_durum'] == 0) { ?>

                                                        <button disabled="disabled" style="color:#fff" class="btn btn-danger btn-sm">Pasif</button>
                                                    <?php } else { ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">Aktif</button>
                                                    <?php } ?>

                                                </td>
                                                <td>

                                                    <?php
                                                    if ($kategoricek['kategori_durum'] == 1) { ?>

                                                        <a style="color:#fff" class="btn btn-warning btn-sm" href="process/process.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kpasif=1">Pasif Yap</a>
                                                    <?php } else { ?>
                                                        <a style="color:#fff" class="btn btn-success btn-sm" href="process/process.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kpasif=2">Aktif Yap</a>
                                                    <?php } ?>
                                                    <a style="color:#fff" class="btn btn-danger bg-danger-light btn-sm" href="process/process.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategorisil=1" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
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
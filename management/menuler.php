<?php
include 'header.php';


$menusor = $db->prepare("SELECT * FROM menu where menu_id!=:id order by durum='1' desc ");
$menusor->execute(
    array(
        'id' => 0
    )
);


?>

<head>
    <title>Menüler</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">

                    <div class="col-md-9 col-lg-9">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">Menüler</strong>
                                <?php

                                if ($_GET['dr'] == "1") { ?>
                                    <br><br>
                                    <b style="color:green"> Yeni Menü Eklendi!</b>

                                <?php } ?>
                                <?php

                                if ($_GET['dr'] == "2") { ?>
                                    <br><br>
                                    <b style="color:#62CDFF"> Menü Başarıyla Silindi!</b>

                                <?php } ?>
                                <?php

                                if ($_GET['dr'] == "3") { ?>
                                    <br><br>
                                    <b style="color:gold"> Menü Silinemedi</b>

                                <?php } ?>
                                <a style="color:#fff" class="float-right btn btn-success btn-sm" href="menu-ekle">menu Ekle</a>
                            </div>

                            <div class="card-body my-n2">
                                <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <label class="sr-only" for="search">Ara</label>
                                            <input type="text" class="form-control mb-2" id="search" placeholder="Arama Yap">
                                        </div>
                                    </div>
                                </form>
                                <table id="myTable" class="table table-striped table-hover table-borderless">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Menu İsim</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                   
                                    <?php while ($menucek = $menusor->fetch(PDO::FETCH_ASSOC)) { ?>




                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $menucek['menu_id'] ?>
                                                </td>
                                                <td scope="col">
                                                    <?php echo $menucek['isim'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($menucek['durum'] == 0) { ?>

                                                        <button disabled="disabled" style="color:#fff" class="btn btn-danger btn-sm">Pasif</button>
                                                    <?php } else { ?>
                                                        <button disabled="disabled" style="color:#fff" class="btn btn-success btn-sm">Aktif</button>
                                                    <?php } ?>

                                                </td>
                                                <td>

                                                    <?php
                                                    if ($menucek['durum'] == 1) { ?>

                                                        <a style="color:#fff" class="btn btn-warning btn-sm" href="process/process.php?menu_id=<?php echo $menucek['menu_id'] ?>&mpasif=1">Pasif Yap</a>
                                                    <?php } else { ?>
                                                        <a style="color:#fff" class="btn btn-success btn-sm" href="process/process.php?menu_id=<?php echo $menucek['menu_id'] ?>&mpasif=2">Aktif Yap</a>
                                                    <?php } ?>
                                                    <a style="color:#fff" class="btn btn-danger bg-danger-light btn-sm" href="process/process.php?menu_id=<?php echo $menucek['menu_id'] ?>&menusil=1" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
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
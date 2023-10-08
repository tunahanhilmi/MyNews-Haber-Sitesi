<?php
include 'header.php';;

$adminusersor = $db->prepare("SELECT * FROM adminuser where id!=:id ");
$adminusersor->execute(
    array(
        'id' => 0
    )
);


?>

<head>
    <title>Admin Listesi</title>
</head>

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <strong class="card-title">Adminler</strong>
                                <!--<a class="float-right small text-muted" href="#!">Hepsini Görüntüle</a>-->
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
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Mail</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <?php while ($adminusercek = $adminusersor->fetch(PDO::FETCH_ASSOC)) { ?>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $adminusercek['id'] ?>
                                                </td>
                                                <th scope="col">
                                                    <?php echo $adminusercek['name'] ?>
                                                </th>
                                                <td>
                                                    <?php echo $adminusercek['surname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $adminusercek['mail'] ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" id="dr1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted sr-only">Action</span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dr1">
                                                            <?php if ($kullanicicek['authority'] == 2) { ?>
                                                                <a class="dropdown-item" href="adminuser-duzenle.php?id=<?php echo $adminusercek['id'] ?>">Düzenle</a>
                                                            <?php } ?>
                                                            <?php if ($kullanicicek['authority'] == 2) { ?>
                                                                <a class="dropdown-item" href="process/process.php?id=<?php echo $adminusercek['id'] ?>&adminusersil=1" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                                                            <?php } ?>

                                                            <a class="dropdown-item" target=_blank href="admin-detay?id=<?php echo $adminusercek['id'] ?>">Admine Git</a>
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
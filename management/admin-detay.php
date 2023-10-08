<?php
include 'header.php';
$adminsor = $db->prepare("SELECT * FROM adminuser where id=:id");
$adminsor->execute(
    array(
        'id' => $_GET['id']
    )
);
$say = $adminsor->rowCount();
$admincek = $adminsor->fetch(PDO::FETCH_ASSOC);
?>
<head>
  <title>Admin Detay</title>
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
                                    <strong class="card-title"><?php echo $admincek['name']?> Detay</strong>
                                </div>
                                <div class="card-body my-n2">

                                
                                    <div class="col-md-12">

                                    <!-- 
                                       PROFİL FOTO OLARAK AYARLANACAK 
                                       <div class="form-group mb-3">
                                            <label for="simpleinput">Konu</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="">
                                        </div> -->
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">İsim Soyisim</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $admincek['name'],' ',$admincek['surname'] ?>">
                                        </div>





                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Mail </label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $admincek['mail'] ?>">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Telefon</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $admincek['telNumber'] ?>">
                                        </div>

                                       
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Yetki</label>
                                            <?php if($admincek['authority']==0){ ?>
                                                <input required type="text" id="" class="form-control" disabled
                                                value="Yetkisiz">
                                            <?php } if($admincek['authority']==1){ ?>
                                                <input required type="text" id="" class="form-control" disabled
                                                value="Admin">
                                            <?php } if($admincek['authority']==2){ ?>
                                                <input required type="text" id="" class="form-control" disabled
                                                value="administrator">
                                            <?php }?>

                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Kayıt Tarihi</label>
                                            <input required type="text" id="" class="form-control" disabled
                                                value="<?php echo $admincek['registrationDate'] ?>">
                                        </div>
                                    </div>

                                    <script>
                                        setTimeout(function () {
                                            document.getElementById("msgbox").style.display = "none";
                                        }, 3500);
                                    </script>

                                  
                                </div><!--İnputlar bitiş-->

                                <div class="col-md-12" align="right">

                                       <a href="admins" class="btn mb-2 btn-success"
                                            style="border-radius:30px; color:#fff">Admin listesine Dön</a>
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
<?php
include 'header.php';

if($kullanicicek['authority']!=2){
    header("Location:dashboard");
}
?>

<head>
  <title>Admin Ekle</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">


                    <div class="col-md-12 col-lg-6">
                        <form action="process/process.php" method="POST" autocomplete="off">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title">Admin Ekle</strong>
                                </div>
                                <div class="card-body my-n2">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">İsim</label>
                                            <input required type="text" id="" class="form-control" 
                                                name="name">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Soy İsim</label>
                                            <input required type="text" id="" class="form-control" 
                                                name="surname">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Kullanıcı Adı</label>
                                            <input required type="text" id="" class="form-control" 
                                                name="user_name">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Şifre</label>
                                            <input required type="password" id="" class="form-control" 
                                                name="pass1">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Şifre (Tekrar)</label>
                                            <input required type="password" id="" class="form-control" 
                                                name="pass2">
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Mail</label>
                                            <input required type="email" id="" class="form-control" 
                                                name="mail">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Telefon Numarası</label>
                                            <input required type="number" maxlength="14" id="" class="form-control" 
                                                name="telNumber">
                                        </div>
                                        <div class="form-group mb-3">
                                            <select class="form-control" name="authority" id="">
                                                <option value="0">Yetkisiz</option>
                                                <option value="1">Admin</option>
                                                <option value="2">administrator</option>
                                            </select>
                                        </div>
                                        <?php

                                        if ($_GET['dr'] == "1") { ?>
                                            <div style="color:green" id="msgbox" class="form-group alert alert-success">
                                               Yeni Admin Eklendi!</div>

                                        <?php }if ($_GET['dr'] == "2") { ?>
                                                <div style="color:red" id="msgbox" class="form-group alert alert-danger"> Admin Eklenemedi!</div>
                                        <?php }

                                        ?>
                                        <?php

                                        if ($_GET['dr'] == "3") { ?>
                                            <div id="msgbox" class="form-group alert alert-warning">
                                                Şifreler Eşleşmiyor</div>

                                        <?php }if ($_GET['dr'] == "4") { ?>
                                                <div style="color:red" id="msgbox" class="form-group alert alert-danger"> Şifre En az 6 karakter uzunluğunda olmalıdır!</div>
                                        <?php }

                                        ?>
                                         <?php if ($_GET['dr'] == "5") { ?>
                                                <div style="color:red" id="msgbox" class="form-group alert alert-danger"> Bu kullanıcı adı önceden alınmış!</div>
                                        <?php } ?>
                                    </div>

                                    <script>
                                        setTimeout(function () {
                                            document.getElementById("msgbox").style.display = "none";
                                        }, 3500);
                                    </script>

                                  
                                </div><!--İnputlar bitiş-->

                                <div class="col-md-12" align="right">
                                        <button type="submit" class="btn mb-2 btn-success"
                                            style="border-radius:30px; color:#fff" name="adminekle">Admin Ekle</button>
                                   
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
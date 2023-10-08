<?php include 'layout/header.php'; ?>

<head>
    <title>İletişime Geç</title>
</head>
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-envelope-open-o bg-primary"></i> Bizimle İletişime Geçin </h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Ana Sayfa</a></li>
                    <li class="breadcrumb-item active">İletişim</li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <div class="row">
                        <div class="col-lg-5">
                            <?php echo $askset['iletisim_bilgi'] ?>
                        </div>
                        <div class="col-lg-7">
                            <form class="form-wrapper" autocomplete=" off">

                                <input type="text" name="iname" class="form-control" required placeholder="İsminiz">

                                <input type="email" name="mail" class="form-control" required placeholder="Email Adresiniz">

                                <input type="tel" name="phone" maxlength="14" class="form-control" placeholder="Telefon">

                                <input type="text" name="isubject" class="form-control" required placeholder="Konu">

                                <textarea class="form-control" name="imessage" placeholder="Mesajınız"></textarea>
                                <?php
                                if ($_GET['dr'] == "1") { ?>

                                    <div id="msgbox" class="col-12 p-0">
                                        <p class="alert alert-success">Mesajınız başarıyla gönderilmiştir!</p>
                                    </div>
                                <?php }
                                if ($_GET['dr'] == "2") { ?>
                                    <div id="msgbox" class="col-12 p-0" >
                                        <p class="alert alert-danger">Mesajınız gönderilemedi. Lütfen tekrar deneyiniz!</p>
                                    </div>
                                <?php } ?>
                                <!--<button disabled type="submit" class="btn btn-primary" name="iletisimkaydet"
                                    style="border-radius:30px">Gönder <i class="fa fa-envelope-open-o"></i></button>-->

                                    <div id="msgbox2" class="col-12 p-0" style="display: none;" >
                                        <p class="alert alert-danger">Geçici süreliğine devre dışı bırakıldı!</p>
                                    </div>
                            </form>
                            <button onclick="alert()" class="btn btn-primary" style="border-radius:30px">Gönder <i class="fa fa-envelope-open-o"></i></button>


                            <script>
                                function alert(){
                                    document.getElementById("msgbox2").style.display = "";
                                    setTimeout(function() {
                                    document.getElementById("msgbox2").style.display = "none";
                                }, 3500);
                                }
                                setTimeout(function() {
                                    document.getElementById("msgbox").style.display = "none";
                                }, 3500);
                            </script>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<?php include 'layout/footer.php' ?>
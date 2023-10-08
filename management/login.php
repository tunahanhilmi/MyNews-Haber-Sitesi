<?php ?>
<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Admin Giriş Sayfası</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="light ">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="post" action="process/process.php">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                    <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                        <g>
                            <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                            <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                            <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                        </g>
                    </svg>
                </a>
                <h1 class="h6 mb-3">Giriş Yap</h1>

                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Kullanıcı Adı</label>
                    <input name="user_name" type="text" id="inputEmail" class="form-control form-control-lg" style="border-radius: 30px" placeholder="Kullanıcı Adı" required autofocus>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Şifre</label>
                    <input name="passwordd" type="password" id="inputPassword" class="form-control form-control-lg" style="border-radius: 30px" placeholder="Şifre" required>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Oturumu Açık Tut</label>
                </div>
                <div class="form-group">
                    <?php if ($_GET['durum'] == 'ok') { ?>
                        <div id="msgbox" class="alert alert-success">
                            Çıkış Başarılı!
                        </div>
                    <?php  } ?>
                    <?php if ($_GET['durum'] == 'no') { ?>
                        <div id="msgbox" class="alert alert-danger">
                            Kullanıcı adı veya şifre hatalı!
                        </div>
                    <?php  } ?>
                    <?php if ($_GET['durum'] == 'izinsiz') { ?>
                        <div id="msgbox" class="alert alert-danger">
                            İzinsiz giriş denemesi!
                        </div>
                    <?php  } ?>
                </div>
                <button name="adminlogin" class="btn btn-lg btn-primary btn-block " style="border-radius: 30px" type="submit">Giriş Yap</button>
                <p class="mt-5 mb-3 text-muted">© 2022 - Created by <a href="https://tunahanhilmi.me" target="_blank">
                        Tunahan Hilmi</a></p>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
        setTimeout(function() {
            document.getElementById("msgbox").style.display = "none";
        }, 3500);
    </script>

</body>

</html>
</body>

</html>
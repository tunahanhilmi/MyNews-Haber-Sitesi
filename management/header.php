<?php require_once 'process/connect.php';
require_once 'process/function.php';
ob_start();

$kullanicisor = $db->prepare("SELECT * FROM adminuser where user_name=:user");
$kullanicisor->execute(
  array(
    'user' => $_SESSION['user']
  )
);

$set = $kullanicisor->rowCount();
if ($set == 0) {
  header('Location:login?durum=izinsiz');
}

$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);


$siteayar = $db->prepare("SELECT 
site_ayar.logo,
site_ayar.favicon
 FROM site_ayar
Where id=:id
");

$siteayar->execute(
    array(
        'id' => 1
    )
);
$siteayarcek = $siteayar->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo $siteayarcek['favicon'] ?>" type="image/x-icon">

  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="css/simplebar.css">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="css/feather.css">
  <link rel="stylesheet" href="css/select2.css">
  <link rel="stylesheet" href="css/dropzone.css">
  <link rel="stylesheet" href="css/uppy.min.css">
  <link rel="stylesheet" href="css/jquery.steps.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/quill.snow.css">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="css/daterangepicker.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
  <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
  <script src="ckeditor/build/ckeditor.js"></script>
</head>

<body class="vertical  light  ">
  <div class="wrapper">
    <nav class="topnav navbar navbar-light">
      <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
      </button>
      <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Bir Şeyler Yaz..." aria-label="Ara">
      </form>
      <ul class="nav">
        <li class="nav-item">
          <p class="nav-link my-2"><?php echo $kullanicicek['name'] ?></p>
        </li>
        <li class="nav-item">
          <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
            <i class="fe fe-sun fe-16"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
            <span class="fe fe-grid fe-16"></span>
          </a>
        </li>
        <li class="nav-item nav-notif">
          <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
            <span class="fe fe-bell fe-16"></span>
            <span class="dot dot-md bg-success"></span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
              <?php if (strlen($kullanicicek['photo']) > 0) { ?>
                <img style="object-fit:cover; width:100%; padding:0; max-width:35px; max-height:35px;" src="process/<?php echo $kullanicicek['photo'] ?>" alt="" class="form-control">
              <?php } else { ?>
                <img src="process/images/no-pp.png" style="object-fit:cover;width:100%;padding:0;max-width:35px; max-height:35px;" alt="" class="form-control">
              <?php  } ?>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="profile">Profilim</a>
            <a class="dropdown-item" href="pp-guncelle">Fotoğraf Güncelle</a>
            <a class="dropdown-item" href="sifre-degistir">Şifre Değiştir</a>
            <a class="dropdown-item" href="logout">Çıkış Yap</a>
          </div>
        </li>
      </ul>
    </nav>
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
      <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
      </a>
      <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100  d-flex">
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="dashboard">
            <img src="<?php echo $siteayarcek['logo'] ?>" alt="logo" width="50" >
            
            <p class="mt-4">
            MyNews Admin Panel
            </p>
          </a>
          
        </div>
        <p class="text-muted nav-heading mt-4 mb-1">
          <span>Bileşenler</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
          <li class="nav-item dropdown">
            <a href="#ui-elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-box fe-16"></i>
              <span class="ml-3 item-text">Site Ayarları</span>
            </a>
            <ul class="collapse list-unstyled pl-4 w-100" id="ui-elements">
              <li class="nav-item">
                <a class="nav-link pl-3" href="ayar"><span class="ml-1 item-text">Genel Ayarlar</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="logo-ayar"><span class="ml-1 item-text">Logo ve Favicon Ayarları</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="iletisim-ayar"><span class="ml-1 item-text">İletişim Sayfası Ayarları</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link pl-3" href="duyurular"><span class="ml-1 item-text">Duyuru Ayarı</span></a>
              </li>
              
          </li>


        </ul>


        <li class="menu-header">Menu Ayarları</li>
        <li class="nav-item w-100">
          <a class="nav-link pl-3" href="menuler"><i class="fe fe-edit-3 fe-16"></i><span class="ml-1"> Menüler</span></a>
        </li>



        <li class="menu-header">Haber</li>
        <li class="nav-item w-100">
          <a class="nav-link pl-3" href="haber-yaz"><i class="fe fe-edit-3 fe-16"></i><span class="ml-1"> Haber
              Yaz</span></a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link pl-3" href="haberler"><i class="fe fe-list fe-16"></i><span class="ml-1"> Haberleri
              Listele</span></a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link pl-3" href="one-cikan-haberler"><i class="fe fe-rss fe-16"></i><span class="ml-1"> Öne Çıkan Haberler</span></a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link pl-3" href="sidebar-duzenle"><i class="fe fe-sidebar fe-16"></i><span class="ml-1"> Afiş Düzenle</span></a>
        </li>





        <li class="menu-header">Admin</li>
        <li class="nav-item w-100">
          <a class="nav-link pl-3" href="admins"><i class="fe fe-list fe-16"></i><span class="ml-1">Admin
              Listesi</span></a>
        </li>
        <?php if ($kullanicicek['authority'] == 2) { ?>
          <li class="nav-item w-100">
            <a class="nav-link pl-3" href="admin-ekle"><i class="fe fe-user fe-16"></i><span class="ml-1">Admin
                Ekle</span></a>
          </li>

        <?php } ?>




        <li class="menu-header">İletişim</li>
        <li class="nav-item w-100">
          <a class="nav-link" href="iletisim">
            <i class="fe fe-mail fe-16"></i>
            <span class="ml-3 item-text">İletişim</span>
          </a>
        </li>


        <li class="menu-header">Kategoriler</li>
        <li class="nav-item w-100">
          <a class="nav-link" href="kategoriler">
            <i class="fe fe-list fe-16"></i>
            <span class="ml-3 item-text">Kategori Listesi</span>
          </a>
        </li>

        <li class="menu-header">Yorumlar</li>
        <li class="nav-item w-100">
          <a class="nav-link" href="onaylanan-yorumlar">
            <i class="fe fe-check fe-16"></i>
            <span class="ml-3 item-text">Onaylanan Yorumlar</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link" href="onay-bekleyen-yorumlar">
            <i class="fe fe-loader fe-16"></i>
            <span class="ml-3 item-text">Onay Bekleyen Yorumlar</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link" href="reddedilen-yorumlar">
            <i class="fe fe-minus-circle fe-16"></i>
            <span class="ml-3 item-text">Reddedilen Yorumlar</span>
          </a>
        </li>
        <li class="nav-item w-100">
          <a class="nav-link" href="yorumlar">
            <i class="fe fe-message-square fe-16"></i>
            <span class="ml-3 item-text">Tüm Yorumlar</span>
          </a>
        </li>
        









      </nav>
    </aside>
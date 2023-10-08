<?php require_once 'management/process/connect.php';
require_once 'management/process/function.php';

//belirli işlem sorgulama
$checkset = $db -> prepare("SELECT * FROM site_ayar where id=:id");
     $checkset -> execute(array(
       'id' => 1
     ));
     $askset = $checkset -> fetch(PDO::FETCH_ASSOC);
     
     ?>

<!DOCTYPE html>
<html lang="TR">

    <!-- standart -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <!-- mobil -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- meta tagları -->
    <meta name="keywords" content="<?php echo $askset['keywords'] ?>">
    <meta name="description" content="<?php echo $askset['description'] ?>">
    <meta name="author" content="<?php echo $askset['author'] ?>">
    
    <!-- Site Iconları -->
    <link rel="shortcut icon" href="management/<?php echo $askset['favicon'] ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" href="management/<?php echo $askset['favicon'] ?>">
    
    <!-- Font ekleme -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> 

    <!-- Bootstrap css ekleme -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome iconları -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Fontawesome 2--->
    <link rel="stylesheet" href="css/boxicons.css">

    <!-- özel csss -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive css -->
    <link href="css/responsive.css" rel="stylesheet">

    <!-- renk için css -->
    <link href="css/colors.css" rel="stylesheet">

    <!-- Version Tech CSS for this template -->
    <link href="css/version/tech.css" rel="stylesheet">

 
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>
<body>
<?php 
$menusor = $db -> prepare("SELECT * FROM menu where durum=:durum");
$menusor-> execute(array(
    'durum'=> 1
));
?>
    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="index"><img style="width: 50px;"src="management/<?php echo $askset['logo'] ?>" alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <?php while ($menucek = $menusor -> fetch(PDO::FETCH_ASSOC)){?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $menucek['seo_url'] ?>"><?php echo $menucek['isim'] ?></a>
                            </li>
                            <?php }?>
                            
                        </ul>

                        <ul class="navbar-nav mr-2">
                       
 <!--
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa-solid fa-link"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa-brands fa-github"></i></a>
                            </li>
                            -->
                        </ul>
                    </div>
                   
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->
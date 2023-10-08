<?php 
include 'layout/header.php';
$duyurusor = $db -> prepare("SELECT * FROM duyuru where id=:id");
$duyurusor -> execute(array(
    'id' => 1
));
$duyuru = $duyurusor -> fetch(PDO::FETCH_ASSOC);
?>

<head>
    <title>Duyurular</title>
</head>
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-envelope-open-o bg-primary"></i> Duyurular </h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Ana Sayfa</a></li>
                    <li class="breadcrumb-item active">Duyurular</li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->
<section class="section">
    <br>
    <div class="container ">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                

                <?php echo $duyuru['icerik'] ?>

                
                </div><!-- end col -->



            <?php include 'layout/sidebar.php'; ?>
        </div><!-- end row -->

    </div><!-- end container -->

</section>

<?php 
include 'layout/footer.php';
?>
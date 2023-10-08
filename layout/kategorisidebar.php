
<?php

$sidebarsor = $db->prepare("SELECT * FROM sidebar where sidebar_id=:id");
$sidebarsor->execute(
    array(
        'id' => 1
    )
);
$sidebarcek = $sidebarsor->fetch(PDO::FETCH_ASSOC);
?>
<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
<form class="example" action="arama" method="get" autocomplete="off">
        <input type="text" placeholder="Arama Yapın.." minlength="3" name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <style>
        * {
            box-sizing: border-box;
        }

        form.example input[type=text] {
            padding: 3px 13px;
            font-size: 14px;
            border: 1px solid grey;
            float: left;
            width: 80%;
            background: transparent;
            border-radius: 30px;
        }

        /* Style the submit button */
        form.example button {
            float: right;
            width: 16%;
            padding: 8px 0;
            margin-left: 1px;
            background: #2196F3;
            color: white;
            font-size: 16px;
            border: 1px solid grey;
            border-left: none;
            /* Prevent double borders */
            cursor: pointer;
            border-radius: 50px;
        }

        form.example button:hover {
            background: #0b7dda;
        }

        /* Clear floats */
        form.example::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
    <div class="widget">
        <h3 style="color: gray;" class="widget-title">Kategoriler</h2>
        <div class="blog-list-widget">
            <div class="list-group m-1">
            <a href="kategori"  class="mb-1"><i class="fa fa-angle-right"></i> Tüm Kategoriler</a>
                <?php 
                $kategorisor2 = $db -> prepare("select * from kategori where kategori_id!=:id");
                $kategorisor2 -> execute(array(
                    'id' => 0
                ));
                
                while( $kategoricek2 = $kategorisor2->fetch(PDO::FETCH_ASSOC)) { ?>

                     <a href="kategori-<?php echo $kategoricek2['kategori_seo'] ?>"  class="mb-1"><i class="fa fa-angle-right"></i> <?php echo $kategoricek2['kategori_isim']?> </a>
                <?php } ?>
                     
            </div>
        </div><!-- end blog-list -->
        <br><br>


        <div class="sidebar">
            <div class="widget">
                <div class="banner-spot clearfix">
                    <div class="banner-img">
                    <img id="pp2" src="management/process/<?php echo $sidebarcek['afis'] ?>" alt="" class="form-control p-0">
                    </div><!-- end banner-img -->
                </div><!-- end banner -->
            </div><!-- end widget -->
        </div><!-- end sidebar -->
    </div><!-- end col -->
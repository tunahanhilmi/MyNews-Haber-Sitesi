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
    <br>
    <style>
        * {
            box-sizing: border-box;
        }

        form.example input[type=text] {
            padding: 3px 13px;
            font-size: 14px;
            border: 1px dashed grey;
            float: left;
            width: 80%;
            background: transparent;
            border-radius: 30px;
        }

        /* Style the submit button */
        form.example button {
            float: right;
            width: 16%;
            padding: 4px 0;
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



    <div class="sidebar">
        <div class="widget">
            <div class="banner-spot clearfix">
                <div class="banner-img">
                    <img id="pp2" src="management/process/<?php echo $sidebarcek['afis'] ?>" alt=""
                        class="form-control p-0">
                    <!--<img src="https://sinop.edu.tr/wp-content/uploads/2021/12/YARISMA.jpg"  alt="" class="img-fluid">-->
                </div><!-- end banner-img -->
            </div><!-- end banner -->
        </div><!-- end widget -->


    </div><!-- end sidebar -->
</div><!-- end col -->
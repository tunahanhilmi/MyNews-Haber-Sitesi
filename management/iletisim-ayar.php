<?php
include 'header.php';

if ($kullanicicek['authority'] != 2) {
    header("Location:dashboard");
}

$siteayar = $db->prepare("SELECT 
site_ayar.id,
site_ayar.title,
site_ayar.description,
site_ayar.keywords,
site_ayar.author,
site_ayar.iletisim_bilgi FROM site_ayar
Where id=:id
");

$siteayar->execute(
    array(
        'id' => 1
    )
);
$siteayarcek = $siteayar->fetch(PDO::FETCH_ASSOC);
?>
<style>
            .ck-editor__editable_inline {
              height: 500px;
            }
          </style>
<head>
    <title>İletişim Sayfası Ayarları</title>
</head>
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">


                <div class="row">


                    <div class="col-md-12 col-lg-6">
                        <form action="" method="POST" autocomplete="off">
                            <div class="card shadow">
                                <div class="card-header">
                                    <strong class="card-title">İletişim sayfası ayarı</strong>
                                </div>
                                <div class="card-body my-n2">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Detay</label>
                                            
                                            <textarea name="iletisim_bilgi" id="editor1"cols="30" rows="10"><?php echo $siteayarcek['iletisim_bilgi'] ?></textarea>
                                            
                                        </div>
                                        
                                    </div>
                                </div><!--İnputlar bitiş-->

                                <div class="col-md-12" align="right">
                                    <button type="submit" class="btn mb-2 btn-success"
                                        style="border-radius:30px; color:#fff" name="submit">Güncelle</button>

                                </div>

                        </form>
                        <?php
                        if (isset($_POST['submit'])) {

                            $save = $db -> prepare("UPDATE site_ayar SET
                            iletisim_bilgi=:iletisim_bilgi where id=1
                            ");

                            $update = $save -> execute(array(
                            'iletisim_bilgi' => $_POST['iletisim_bilgi']
                            ));

                            if($update)
                                echo '
                                <div style="color:green" id="msgbox" class="form-group alert alert-success m-3">Ayarlar güncellendi, lütfen bekleyiniz!</div>';
                            else
                            echo '<div style="color:red" id="msgbox" class="form-group alert alert-danger m-3">Ayarlar güncellenmedi!</div>';

                            header("Refresh:2");
                        }
                        ?>


                    </div>
                </div>
            </div> <!-- Striped rows -->
        </div> <!-- .row-->
    </div> <!-- .col-12 -->

    <script>
        setTimeout(function () {
            document.getElementById("msgbox").style.display = "none";
        }, 3500);
    </script>
    </div> <!-- .row-->
    </div> <!-- .col-12 -->
    </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <script>
              ClassicEditor
                .create(document.querySelector('#editor1'), {
                 
                  simpleUpload: {
                    
                    uploadUrl: 'upload/upload.php',
                    // Yalnızca belirli türlerdeki dosyaların yüklenmesine izin veren dosya türleri listesi
                    allowedFileTypes: ['jpeg', 'jpg', 'png', 'gif']
                  },
                  // İçerik düzenleyici ayarları

                  
                  
                  language: 'tr'
                })
                .catch(error => {
                  console.error(error);
                });
                
            </script>

    <?php include 'sidebar.php' ?>
</main> <!-- main -->
</div> <!-- .wrapper -->

<?php include 'footer.php' ?>
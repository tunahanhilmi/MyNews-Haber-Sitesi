<?php
include 'header.php';
$kategorisor = $db->prepare("SELECT * FROM kategori where kategori_id!=:id and kategori_durum=:durum");
$kategorisor->execute(
  array(
    'id' => 0,
    'durum' => 1
  )
);
?>

<head>
  <title>Haber Ekle</title>
</head>
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">


        <div class="row">

          <style>
            .ck-editor__editable_inline {
              height: 500px;
            }
          </style>

          <div class="col-md-12 col-lg-9">
            <form action="process/process.php" method="POST" enctype="multipart/form-data">
              <div class="card shadow">
                <div class="card-header">
                  <strong class="card-title">Haber Yaz</strong>

                  <?php if ($_GET['durum'] == "no") { ?>
                    <b style="color:red"> İşlem Başarısız</b>
                  <?php }

                  ?>
                </div>
                <div class="card-body my-n2">

                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <label for="simpleinput">Haber Başlık</label>
                      <input required type="text" name="haber_baslik" class="form-control">
                    </div>


                    <div class="form-group mb-3">
                      <label for="simpleinput">Haber Ana Foto</label>
                      <input required type="file" name="haber_ana_foto" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                      <label for="simpleinput">Haber Ana Sayfa Detay (Kısa)</label>
                      <input required type="text" id="" name="haber_ana_detay" class="form-control">
                    </div>


                    <div class="editor">
                      <label for="simpleinput">Haber Detayı</label>
                      <textarea name="haber_detay" id="editor1">

                            </textarea>
                      <br>
                    </div>
                    <div class="form-group mb-3">
                      <label for="simpleinput">Anahtar kelimeler (Aralarına virgül koyarak yazınız)</label>
                      <input required type="text" id="" name="haber_anahtar_kelimeler" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                      <label for="simpleinput">Kategori</label>
                      <select required name="kategori_id" id="heard" class="form-control" requried>


                        <?php
                        $value = 0;
                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $kategoricek['kategori_id'] ?>"> <?php echo $kategoricek['kategori_isim'] ?></option>
                        <?php }
                        ?>
                      </select>
                    </div>

                    <div class="form-group mb-3">
                      <label for="simpleinput">Url</label>
                      <input type="text" id="simpleinput" name="haber_url" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                      <label required for="simpleinput">Durum</label>
                      <select name="haber_durum" id="heard" class="form-control" requried>
                        <option value="1"> Aktif</option>
                        <option value="0"> Pasif</option>

                      </select>
                    </div>


                    <input type="hidden" name="haber_id">
                    <input type="hidden" name="yazar_id" value="<?php echo $kullanicicek['id'] ?>">

                  </div><!--İnputlar bitiş-->

                  <div class="col-md-12" align="right">
                    <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff" name="haberkaydet">Haber Oluştur</button>
                  </div>

            </form>


            <script>
              ClassicEditor
                .create(document.querySelector('#editor1'), {
                 
                  simpleUpload: {
                    
                    uploadUrl: 'upload/upload.php',
                    // Yalnızca belirli türlerdeki dosyaların yüklenmesine izin veren dosya türleri listesi
                    allowedFileTypes: ['jpeg', 'jpg', 'png', 'gif']
                  },
                  // İçerik düzenleyici ayarları

                  
                  
                  language: 'en'
                })
                .catch(error => {
                  console.error(error);
                });
            </script>
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
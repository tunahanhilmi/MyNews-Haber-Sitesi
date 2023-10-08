<?php
include 'header.php';
$habersor = $db->prepare("SELECT * FROM haber where haber_id=:id");
$habersor->execute(
  array(
    'id' => $_GET['haber_id']
  )
);
$kategorisor = $db->prepare("SELECT * FROM kategori where kategori_id!=:id and kategori_durum=:durum");
$kategorisor->execute(
  array(
    'id' => 0,
    'durum' => 1
  )
);
$say = $habersor->rowCount();
$habercek = $habersor->fetch(PDO::FETCH_ASSOC);
?>
<head>
  <title>Haber Düzenle</title>
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

          <div class="col-md-12 col-lg-12">
            <form action="process/process.php" method="POST">
              <div class="card shadow">
                <div class="card-header">
                  <strong class="card-title">Haber Yaz</strong>
                  <?php

                  if ($_GET['durum'] == "ok") { ?>
                    <br><br>
                    <b style="color:green"> İşlem Başarılı</b>

                  <?php } else if ($_GET['durum'] == "no") { ?>
                      <br><br>
                      <b style="color:red"> İşlem Başarısız</b>
                  <?php }

                  ?>
                </div>
                <div class="card-body my-n2">

                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <label for="simpleinput">Haber Başlık</label>
                      <input required type="text" id="" name="haber_baslik" class="form-control"
                        value="<?php echo $habercek['haber_baslik'] ?>">
                    </div>




                    <div class="form-group mb-3">
                      <label for="simpleinput">Haber Ana Sayfa Detay (Kısa)</label>
                      <input required type="text" id="" name="haber_ana_detay" class="form-control"
                        value="<?php echo $habercek['haber_ana_detay'] ?>">
                    </div>


                    <div class="editor">
                      <label for="simpleinput">Haber Detayı</label>
                      <textarea name="haber_detay" id="editor">
                            <?php echo $habercek['haber_detay'] ?>
                            </textarea>
                      <br>
                    </div>
                    <div class="form-group mb-3">
                      <label for="simpleinput">Anahtar kelimeler (Aralarına virgül koyarak yazınız)</label>
                      <input required type="text" id="" name="haber_anahtar_kelimeler" class="form-control" value="<?php echo $habercek['haber_anahtar_kelimeler'] ?>">
                    </div>

                    <div class="form-group mb-3">
                      <label for="simpleinput">Kategori</label>
                      <select required name="kategori_id" id="heard" class="form-control" requried>

                      <?php
                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option <?php if($kategoricek['kategori_id']==$habercek['kategori_id']){echo 'selected';} ?> value="<?php echo $kategoricek['kategori_id'] ?>"> <?php echo $kategoricek['kategori_isim'] ?></option>
                        <?php }
                        ?>
                      </select>
                    </div>

                    <div class="form-group mb-3">
                      <label for="simpleinput">Url</label>
                      <input type="text" id="simpleinput" name="haber_url" class="form-control"
                        value="<?php echo $habercek['haber_url'] ?>">
                    </div>

                    <div class="form-group mb-3">
                      <label for="simpleinput">Seo Url(haber yolu)</label>
                      <input disabled type="text" id="simpleinput" name="haber_url" class="form-control"
                        value="<?php echo $habercek['haber_seo_url'] ?>">
                    </div>

                    <div class="form-group mb-3">
                      <label required for="simpleinput">Durum</label>
                      <select name="haber_durum" id="heard" class="form-control" requried>
                        
                        <option <?php if($habercek['haber_durum']==1){ echo 'selected';}?> value="1"> Aktif</option>
                        <option <?php if($habercek['haber_durum']==0){ echo 'selected';}?> value="0"> Pasif</option>

                      </select>
                    </div>

                    <input type="hidden" name="eski_url" value="<?php echo $habercek['haber_url'] ?>">
                    <input type="hidden" name="eski_haber_seo" value="<?php echo $habercek['haber_seo_url'] ?>">
                    <input type="hidden" name="eski_haber_baslik" value="<?php echo $habercek['haber_baslik'] ?>">
                    <input type="hidden" name="haber_id" value="<?php echo $habercek['haber_id'] ?>">

                  </div><!--İnputlar bitiş-->

                  <div class="col-md-12" align="right">
                    <button type="submit" class="btn mb-2 btn-success" style="border-radius:30px; color:#fff"
                      name="haberguncelle">Haberi Güncelle</button>
                  </div>

            </form>


            <script>
              ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                  console.error(error);
                });

              CKEDITOR.replace('editor', {
                filebrowserUploadUrl: 'images/upload.php',
                filebrowserUploadMethod: 'form'
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
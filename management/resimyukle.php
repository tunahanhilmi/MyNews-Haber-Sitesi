<?php
if (isset($_FILES['resim'])) {
    $hata = $_FILES['resim']['error']; //resim inputundan gönderilen hatayı aldık.
    if ($hata != 0) { // hata kontrolü gerçekleştirdik.
        echo 'Resim gönderilirken bir hata gerçekleşti.';
    } else {
        $resimBoyutu = $_FILES['resim']['size']; // resim boyutunu öğrendik
        if ($resimBoyutu > (1024 * 1024 * 2)) {
            //buradaki işlem aslında bayt, kilobayt ve mb formülüdür.
            //2 rakamını mb olarak görün ve kaç yaparsanız o mb anlamına gelir.
            //Örn: (1024 * 1024 * 3) => 3MB / (1024 * 1024 * 4) => 4MB

            echo 'Resim 2MB den büyük olamaz.';
        } else {
            $tip = $_FILES['resim']['type']; //resim tipini öğrendik.
            $resimAdi = $_FILES['resim']['name']; //resmin adını öğrendik.

            $uzantisi = explode('.', $resimAdi); // uzantısını öğrenmek için . işaretinden parçaladık.
            $uzantisi = $uzantisi[count($uzantisi) - 1]; // ve daha sonra 1 den fazla nokta olma ihtimaline karşı en son noktadan sonrasını al dedik.

            $yeni_adi = "upload/" . time() . "." . $uzantisi; // resime yeni isim vereceğimiz için zamana göre yeni bir isim oluşturduk ve yüklemesi gerektiği yeride belirttik.
            //yuklenecek_yer/resim_adi.uzantisi

            if ($tip == 'image/jpeg' || $tip == 'image/png') { //uzantısnın kontrolünü sağladık. sadece .jpg ve .png yükleyebilmesi için.
                if (move_uploaded_file($_FILES["resim"]["tmp_name"], $yeni_adi)) {
                    //tmp_name ile resmi bulduk ve $yeni_adi değişkeninin değerine göre yükleme işlemini gerçekleştirdik.
                    echo "Resim başarılı bir şekilde yüklendi.";
                } else echo 'Resim yüklenirken bir hata oluştu.';
            } else {
                echo 'Yanlızca JPG ve PNG resim gönderebilirsiniz.';
            }
        }
    }
}
?>

<?php
ob_start();

include 'connect.php';
include 'function.php';

//admin login
if (isset($_POST['adminlogin'])) {
    $user_name = $_POST['user_name'];
    $pass = md5($_POST['passwordd']);


    $checkuser = $db->prepare("SELECT * FROM adminuser where user_name=:user and passwordd=:pass");
    $checkuser->execute(
        array(
            'user' => $user_name,
            'pass' => $pass
        )
    );

    $check = $checkuser->rowCount();
    if ($check == 1) {
        $_SESSION['user'] = $user_name;
        header("Location:../dashboard");
    } else {
        header("Location:../login?durum=no");
    }
}

//admin ekle
if (isset($_POST['adminekle'])) {
    $checkuser = $db->prepare("SELECT * FROM adminuser where user_name=:user");
    $checkuser->execute(
        array(
            'user' => $_POST['user_name']
        )
    );

    $check = $checkuser->rowCount();
    if ($check == 1) {
        header("Location:../admin-ekle?dr=5");
    } else {


        if (strlen($_POST['pass1']) < 6) {
            header("Location:../admin-ekle?dr=4");
        } else {
            $pass1 = htmlspecialchars(md5($_POST['pass1']));
            $pass2 = htmlspecialchars(md5($_POST['pass2']));
            if ($pass1 != $pass2) {
                header("Location:../admin-ekle?dr=3");
            } else {
                $adminekle = $db->prepare("INSERT INTO adminuser SET 
                name=:name,
                surname=:surname,
                user_name=:user_name,
                passwordd=:passwordd,
                mail=:mail,
                telNumber=:telNumber,
                authority=:authority
                ");

                $insert = $adminekle->execute(
                    array(
                        'name' => htmlspecialchars($_POST['name']),
                        'surname' => htmlspecialchars($_POST['surname']),
                        'user_name' => htmlspecialchars($_POST['user_name']),
                        'passwordd' => $pass1,
                        'mail' => htmlspecialchars($_POST['mail']),
                        'telNumber' => htmlspecialchars($_POST['telNumber']),
                        'authority' => htmlspecialchars($_POST['authority'])
                    )
                );

                if ($insert) {
                    header("Location:../admin-ekle?dr=1");
                } else {
                    header("Location:../admin-ekle?dr=2");
                }
            }
        }
    }
}




//haber kaydetme
if (isset($_POST['haberkaydet'])) {

    if (isset($_FILES['haber_ana_foto'])) {
        $hata = $_FILES['haber_ana_foto']['error'];
        if ($hata != 0) {
            echo 'Resim gönderilirken bir hata gerçekleşti.';
            echo $hata;
        } else {
            $resimBoyutu = $_FILES['haber_ana_foto']['size'];
            if ($resimBoyutu > (1024 * 1024 * 4)) {
                echo 'Resim 4MB den büyük olamaz.';
            } else {
                $tip = $_FILES['haber_ana_foto']['type'];
                $resimAdi = $_FILES['haber_ana_foto']['name'];

                $uzantisi = explode('.', $resimAdi);
                $uzantisi = $uzantisi[count($uzantisi) - 1];

                $yeni_adi = "images/" . time() . "." . $uzantisi;

                if ($tip == 'image/jpeg' || $tip == 'image/png') {
                    if (move_uploaded_file($_FILES["haber_ana_foto"]["tmp_name"], $yeni_adi)) {

                        echo "Resim başarılı bir şekilde yüklendi.";
                    } else
                        echo 'Resim yüklenirken bir hata oluştu.';
                } else {
                    echo 'Yanlızca JPG ve PNG resim gönderebilirsiniz.';
                }
            }
        }
    }
    $sayi = rand(1, 100000);
    if ($_POST['haber_url'] != null) {

        $url = seo($_POST['haber_url'] . "-" . $sayi);
    } else {

        $url = seo($_POST['haber_baslik'] . "-" . $sayi);
    }

    $ayarekle = $db->prepare("INSERT INTO haber SET
    haber_baslik=:haber_baslik,
    haber_ana_foto=:haber_ana_foto,
    haber_ana_detay=:haber_ana_detay,
    haber_detay=:haber_detay,
    haber_anahtar_kelimeler=:haber_anahtar_kelimeler,
    haber_url=:haber_url,
    kategori_id=:kategori_id,
    yazar_id=:yazar_id,
    haber_seo_url=:haber_seo_url,
    haber_durum=:haber_durum  
    ");

    $insert = $ayarekle->execute(
        array(
            'haber_baslik' => $_POST['haber_baslik'],
            'haber_ana_foto' => $yeni_adi,
            'haber_ana_detay' => $_POST['haber_ana_detay'],
            'haber_detay' => $_POST['haber_detay'],
            'haber_anahtar_kelimeler' => $_POST['haber_anahtar_kelimeler'],
            'haber_url' => seo($_POST['haber_url']),
            'kategori_id' => $_POST['kategori_id'],
            'yazar_id' => $_POST['yazar_id'],
            'haber_seo_url' => $url,
            'haber_durum' => $_POST['haber_durum']
        )
    );



    if ($insert) {
        Header("Location:../haberler?dr=1");
    } else {
        Header("Location:../haberler?dr=2");
    }
}


//haber güncelleme
if (isset($_POST['haberguncelle'])) {
    $haber_id = $_POST['haber_id'];
    $sayi = rand(1, 100000);

    if ($_POST['haber_url'] != null) {
        if ($_POST['haber_url'] == $_POST['eski_url']) {
            $url = $_POST['eski_haber_seo'];
        } else {
            $url = seo($_POST['haber_url'] . "-" . $sayi);
        }
    } else {
        if ($_POST['haber_baslik'] == $_POST['eski_haber_baslik']) {
            $url = $_POST['eski_haber_seo'];
        } else {
            $url = seo($_POST['haber_baslik'] . "-" . $sayi);
        }

    }

    $ayarkaydet = $db->prepare("UPDATE haber SET
        haber_baslik=:haber_baslik,
        haber_ana_detay=:haber_ana_detay,
        haber_detay=:haber_detay,
        haber_anahtar_kelimeler=:haber_anahtar_kelimeler,
        haber_url=:haber_url,
        haber_seo_url=:haber_seo_url,
        kategori_id=:kategori_id,
        haber_durum=:haber_durum
        
        
        WHERE haber_id={$_POST['haber_id']}");


    $update = $ayarkaydet->execute(
        array(
            'haber_baslik' => $_POST['haber_baslik'],
            'haber_ana_detay' => $_POST['haber_ana_detay'],
            'haber_detay' => $_POST['haber_detay'],
            'haber_anahtar_kelimeler' => $_POST['haber_anahtar_kelimeler'],
            'haber_url' => $_POST['haber_url'],
            'haber_seo_url' => $url,
            'kategori_id' => $_POST['kategori_id'],
            'haber_durum' => $_POST['haber_durum']
        )
    );

    if ($update) {
        header("Location: ../haber-duzenle.php?haber_id=$haber_id&durum=ok");
    } else {
        header("Location: ../haber-duzenle.php?haber_id=$haber_id&durum=no");
    }
}


//haber silme
if ($_GET['habersil'] == 'ok') {
    $sil = $db->prepare("DELETE from haber WHERE haber_id=:id");
    $kontrol = $sil->execute(
        array(
            'id' => $_GET['haber_id']
        )
    );

    if ($kontrol) {

        unlink($_GET['haber_ana_foto']);
        header("Location:../haberler.php?durum=ok");
    } else
        header("Location:../haberler.php?durum=no");
}


//iletişim form
if (isset($_POST['iletisimkaydet'])) {

    $ip = $_SERVER["REMOTE_ADDR"];
    $ayarekle = $db->prepare("INSERT INTO iletisim SET

        iname=:iname,
        mail=:mail,
        phone=:phone,
        isubject=:isubject,
        imessage=:imessage,
        ip_adress=:ip_adress 
        ");

    $save = $ayarekle->execute(
        array(
            'iname' => htmlspecialchars($_POST['iname']),
            'mail' => htmlspecialchars($_POST['mail']),
            'phone' => htmlspecialchars($_POST['phone']),
            'isubject' => htmlspecialchars($_POST['isubject']),
            'imessage' => htmlspecialchars($_POST['imessage']),
            'ip_adress' => $ip
        )
    );

    if ($save) {
        header("Location:../../contact?dr=1");
    } else
        header("Location:../../contact.php?dr=2");
}


//iletisim silme
if ($_GET['iletisimsil'] == '1') {
    $sil = $db->prepare("DELETE from iletisim WHERE iletisim_id=:id");
    $kontrol = $sil->execute(
        array(
            'id' => $_GET['iletisim_id']
        )
    );

    if ($kontrol)
        header("Location:../iletisim.php?dr=1");
    else
        header("Location:../iletisiml.php?dr=2");
}

//mail okundu işaretleme

if (isset($_POST['iltread'])) {
    $id = $_POST['iletisim_id'];
    $save = $db->prepare("UPDATE iletisim set
    situation=:situation
    where iletisim_id={$_POST['iletisim_id']}   
    ");

    $update = $save->execute(
        array(
            'situation' => 1

        )
    );

    if ($update) {
        header("Location:../iletisim-detay?iletisim_id=$id&dr=1");
    } else {
        header("Location:../iletisim-detay?iletisim_id=$id&dr=2");
    }
}

//mail okunmadı işaretleme

if (isset($_POST['iltunread'])) {
    $id = $_POST['iletisim_id'];
    $save = $db->prepare("UPDATE iletisim set
    situation=:situation
    where iletisim_id={$_POST['iletisim_id']}   
    ");

    $update = $save->execute(
        array(
            'situation' => 0

        )
    );

    if ($update) {
        header("Location:../iletisim-detay?iletisim_id=$id&dr=3");
    } else {
        header("Location:../iletisim-detay?iletisim_id=$id&dr=4");
    }
}



//kategori pasif yapma
if ($_GET['kpasif'] == '1') {

    $save = $db->prepare("UPDATE kategori SET 
    kategori_durum=:kategori_durum where kategori_id={$_GET['kategori_id']}
    ");

    $update = $save->execute(
        array(
            'kategori_durum' => 0
        )
    );

    if ($update) {
        header("Location:../kategoriler");
    } else
        header("Location:../kategoriler?dr=0");
}

//kategori aktif yapma

if ($_GET['kpasif'] == '2') {

    $save = $db->prepare("UPDATE kategori SET 
    kategori_durum=:kategori_durum where kategori_id={$_GET['kategori_id']}
    ");

    $update = $save->execute(
        array(
            'kategori_durum' => 1
        )
    );

    if ($update) {
        header("Location:../kategoriler");
    } else
        header("Location:../kategoriler?dr=0");
}


// kategori ekleme
if (isset($_POST['kategoriekle'])) {
    $checkkat = $db->prepare("SELECT * FROM kategori where kategori_isim=:isim");
    $checkkat->execute(
        array(
            'isim' => $_POST['kategori_isim']
        )
    );

    $check = $checkkat->rowCount();
    if ($check == 1) {
        header("Location:../kategori-ekle?dr=1");
    } else {

        $kategoriekle = $db->prepare("INSERT INTO kategori SET 
                kategori_isim=:kategori_isim,
                kategori_seo=:kategori_seo
                ");

        $insert = $kategoriekle->execute(
            array(

                'kategori_isim' => htmlspecialchars($_POST['kategori_isim']),
                'kategori_seo' => seo(htmlspecialchars($_POST['kategori_isim']))
            )
        );

        if ($insert) {
            header("Location:../kategoriler?dr=1");
        } else {
            header("Location:../kategori-ekle?dr=2");
        }
    }
}


//kategori silme
if ($_GET['kategorisil'] == '1') {
    $sil = $db->prepare("DELETE from kategori WHERE kategori_id=:id");
    $kontrol = $sil->execute(
        array(
            'id' => $_GET['kategori_id']
        )
    );

    if ($kontrol)
        header("Location:../kategoriler?dr=2");
    else
        header("Location:../kategoriler?dr=3");
}

//admin silme
if ($_GET['adminusersil'] == '1') {
    $sil = $db->prepare("DELETE from adminuser WHERE id=:id");
    $kontrol = $sil->execute(
        array(
            'id' => $_GET['id']
        )
    );

    if ($kontrol)
        header("Location:../admins?dr=1");
    else
        header("Location:../admins?dr=3");
}


//Admin Profil Güncelleme
if (isset($_POST['profilguncelle'])) {
    $save = $db->prepare("UPDATE adminuser set
    name=:name,
    surname=:surname,
    mail=:mail,
    telNumber=:telNumber

        where id={$_POST['id']}   
    ");

    $update = $save->execute(
        array(
            'name' => htmlspecialchars($_POST['name']),
            'surname' => htmlspecialchars($_POST['surname']),
            'mail' => htmlspecialchars($_POST['mail']),
            'telNumber' => htmlspecialchars($_POST['telNumber'])

        )
    );

    if ($update) {
        header("Location:../profile?dr=1");
    } else {
        header("Location:../profile?dr=2");
    }
}

//admin pp güncelleme

if (isset($_POST['ppguncelle'])) {

    if (isset($_FILES['photo'])) {
        $hata = $_FILES['photo']['error'];
        if ($hata != 0) {
            echo 'Resim gönderilirken bir hata gerçekleşti.';
            echo $hata;
        } else {
            $resimBoyutu = $_FILES['photo']['size'];
            if ($resimBoyutu == 0) {
                header("Location:../pp-guncelle?dr=1");
            } else {
                $tip = $_FILES['photo']['type'];
                $resimAdi = $_FILES['photo']['name'];

                $uzantisi = explode('.', $resimAdi);
                $uzantisi = $uzantisi[count($uzantisi) - 1];

                $yeni_adi = "pp/" . time() . "." . $uzantisi;

                if ($tip == 'image/jpeg' || $tip == 'image/png' || $tip == 'image/gif') {
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $yeni_adi)) {

                        echo "Resim başarılı bir şekilde yüklendi.";
                    } else
                        echo 'Resim yüklenirken bir hata oluştu.';
                } else {
                    echo 'Yanlızca JPG ve PNG resim gönderebilirsiniz.';
                }
            }
        }
    }

    $guncelle = $db->prepare("UPDATE adminuser SET
    photo=:photo
    where id={$_POST['id']} ");

    $update = $guncelle->execute(
        array(
            'photo' => $yeni_adi

        )
    );
    if ($update) {
        unlink($_POST['eskipp']);
        header("Location:../pp-guncelle?dr=2");
    } else {
        header("Location:../pp-guncelle?dr=3");
    }
}


//admin sifre değiştirme
if (isset($_POST['sifredegistir'])) {
    $checkpass = $db->prepare("SELECT * FROM adminuser where passwordd=:pass");
    $checkpass->execute(
        array(
            'pass' => htmlspecialchars(md5($_POST['eski']))
        )
    );

    $check = $checkpass->rowCount();
    if ($check == 0) {
        header("Location:../sifre-degistir?dr=1");
    } else {
        if (strlen(htmlspecialchars($_POST['yeni1'])) < 6) {
            header("Location:../sifre-degistir?dr=2");
        } else {
            if (htmlspecialchars($_POST['yeni1']) != htmlspecialchars($_POST['yeni2'])) {
                header("Location:../sifre-degistir?dr=3");
            } else {
                $sifredegistir = $db->prepare("UPDATE adminuser SET
                passwordd=:passwordd
                
                where id={$_POST['id']}
                ");

                $update = $sifredegistir->execute(
                    array(
                        'passwordd' => md5(htmlspecialchars($_POST['yeni1']))
                    )
                );

                if ($update) {
                    header("Location:../sifre-degistir?dr=4");
                } else {
                    header("Location:../sifre-degistir?dr=5");
                }
            }
        }
    }
}




//Yorum Ekleme
if (isset($_POST['yorumyaz'])) {

    $ip = $_SERVER["REMOTE_ADDR"];
    $link = $_POST['link'];
    $ayarekle = $db->prepare("INSERT INTO yorum SET

        isim=:isim,
        cinsiyet=:cinsiyet,
        yorum=:yorum,
        haber_id=:haber_id,
        ip_adress=:ip_adress 
        ");

    $save = $ayarekle->execute(
        array(
            'isim' => htmlspecialchars($_POST['isim']),
            'cinsiyet' => htmlspecialchars($_POST['cinsiyet']),
            'yorum' => htmlspecialchars($_POST['yorum']),
            'haber_id' => htmlspecialchars($_POST['haber_id']),
            'ip_adress' => $ip
        )
    );

    if ($save) {
        header("Location:../../haber-$link?dr=1#yorum");
    } else
        header("Location:../../haber-$link?dr=2#yorum");
}

// yorum onaylama
if (isset($_POST['yorumonay'])) {

    $save = $db->prepare("UPDATE yorum set

    durum=:durum

        where yorum_id={$_POST['yorum_id']}   
    ");

    $update = $save->execute(
        array(
            'durum' => 1
        )
    );

    if ($update) {
        header("Location:../yorum-detay?yorum_id={$_POST['yorum_id']}&dr=1");
    } else {
        header("Location:../yorum-detay?yorum_id={$_POST['yorum_id']}&dr=3");
    }
}
// yorum reddetme
if (isset($_POST['yorumred'])) {

    $save = $db->prepare("UPDATE yorum set

    durum=:durum

        where yorum_id={$_POST['yorum_id']}   
    ");

    $update = $save->execute(
        array(
            'durum' => 2
        )
    );

    if ($update) {
        header("Location:../yorum-detay?yorum_id={$_POST['yorum_id']}&dr=2");
    } else {
        header("Location:../yorum-detay?yorum_id={$_POST['yorum_id']}&dr=3");
    }
}

//yorum silme
if(isset($_POST['yorumsil'])){
    $delete = $db -> prepare("DELETE from yorum where yorum_id=:id");
    $kontrol = $delete ->execute(array(
        'id' => $_POST['yorum_id']
    ));

    if($kontrol) header("Location:../yorumlar?dr=1");
    else header("Location:../yorumlar?dr=2");

}



//afiş güncelleme
if (isset($_POST['afisguncelle'])) {


    if (isset($_FILES['afis'])) {
        $hata = $_FILES['afis']['error'];
        if ($hata != 0) {
            echo 'Resim gönderilirken bir hata gerçekleşti.';
            echo $hata;

        } else {
            $resimBoyutu = $_FILES['afis']['size'];
            if ($resimBoyutu > (1024 * 1024 * 8)) {
                echo 'Resim 8MB den büyük olamaz.';
            } else {
                $tip = $_FILES['afis']['type'];
                $resimAdi = $_FILES['afis']['name'];

                $uzantisi = explode('.', $resimAdi);
                $uzantisi = $uzantisi[count($uzantisi) - 1];

                $yeni_adi = "afis/" . time() . "." . $uzantisi;

                if ($tip == 'image/jpeg' || $tip == 'image/png') {
                    if (move_uploaded_file($_FILES["afis"]["tmp_name"], $yeni_adi)) {

                        echo "Resim başarılı bir şekilde yüklendi.";
                    } else
                        echo 'Resim yüklenirken bir hata oluştu.';
                } else {
                    echo 'Yanlızca JPG ve PNG resim gönderebilirsiniz.';
                }
            }
        }
    }

    $guncelle = $db->prepare("UPDATE sidebar SET
    afis=:afis
    where sidebar_id=1");

    $update = $guncelle->execute(
        array(
            'afis' => $yeni_adi
        )
    );
    if ($update) {
        unlink($_POST['eskiafis']);
        header("Location:../sidebar-duzenle?dr=2");
    } else {
        header("Location:../sidebar-duzenle?dr=3");
    }
}


//menü ekleme
if (isset($_POST['menuekle'])) {
    $checkkat = $db->prepare("SELECT * FROM menu where isim=:isim OR seo_url=:seo");
    $checkkat->execute(
        array(
            'isim' => $_POST['isim'],
            'seo' => seo(htmlspecialchars($_POST['link']))
        )
    );

    $check = $checkkat->rowCount();
    if ($check == 1) {
        header("Location:../menu-ekle?dr=1");
    } else {

        if ($_POST['link'] != null) {
            $seo = seo(htmlspecialchars($_POST['link']));
        } else {
            $seo = seo(htmlspecialchars($_POST['isim']));
        }
        $menuekle = $db->prepare("INSERT INTO menu SET 
                isim=:isim,
                seo_url=:seo_url
                ");

        $insert = $menuekle->execute(
            array(
                'isim' => htmlspecialchars($_POST['isim']),
                'seo_url' => $seo
            )
        );

        if ($insert) {
            header("Location:../menuler?dr=1");
        } else {
            header("Location:../menu-ekle?dr=2");
        }
    }
}

//menü pasif yapma
if ($_GET['mpasif'] == '1') {

    $save = $db->prepare("UPDATE menu SET 
    durum=:durum where menu_id={$_GET['menu_id']}
    ");

    $update = $save->execute(
        array(
            'durum' => 0
        )
    );

    if ($update) {
        header("Location:../menuler");
    } else
        header("Location:../menuler?dr=0");
}

//menü aktif yapma

if ($_GET['mpasif'] == '2') {

    $save = $db->prepare("UPDATE menu SET 
    durum=:durum where menu_id={$_GET['menu_id']}
    ");

    $update = $save->execute(
        array(
            'durum' => 1
        )
    );

    if ($update) {
        header("Location:../menuler");
    } else
        header("Location:../menuler?dr=0");
}

//menu silme
if ($_GET['menusil'] == '1') {
    $sil = $db->prepare("DELETE from menu WHERE menu_id=:id");
    $kontrol = $sil->execute(
        array(
            'id' => $_GET['menu_id']
        )
    );

    if ($kontrol)
        header("Location:../menuler?dr=2");
    else
        header("Location:../menuler?dr=3");
}

//haber önde mi
if (isset($_GET['haber_one_cikar']) == "ok") {

    $kontrol = $db->prepare("SELECT * FROM haber where haber_one_cikan=:sorgu and haber_durum=:durum");
    $kontrol -> execute(array(
        'sorgu' => 1,
        'durum' => 1
    ));
    $count = $kontrol->rowCount();
    if ($count == 3) {
        header("Location:../one-cikan-haberler?dr=2");
    } else {
        $save = $db->prepare("UPDATE haber SET
    haber_one_cikan=:one_cikan where haber_id={$_GET['haber_id']}");
        $update = $save->execute(
            array(
                'one_cikan' => 1
            )
        );
        if ($update) {
            header("Location:../one-cikan-haberler?dr=1");
        } else
            header("Location:../one-cikan-haberler?dr=0");
    }

}

//haber öne çıkarma
if (isset($_GET['haber_geri_al']) == "ok") {


        $save = $db->prepare("UPDATE haber SET
    haber_one_cikan=:one_cikan where haber_id={$_GET['haber_id']}");
        $update = $save->execute(
            array(
                'one_cikan' => 0
            )
        );
        if ($update) {
            header("Location:../one-cikan-haberler?dr=3");
        } else
            header("Location:../one-cikan-haberler?dr=4");
    }


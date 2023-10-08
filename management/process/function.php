<?php 
ob_start();
session_start();


function seo($text) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
    $text = strtolower(str_replace($find, $replace, $text));
    $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    $text = str_replace(' ', '-', $text);

    return $text;
}
  function tarih($tarih) {
    $formatter = new IntlDateFormatter('tr_TR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $timestamp = strtotime($tarih);
    $tarih_duzenle = $formatter->format($timestamp);
    return $tarih_duzenle;
  }



  //saat ayarlama 
  function formatTarih($tarih) {
    $yorumTarihi = new DateTime($tarih);
    $simdikiTarih = new DateTime();
    $fark = $simdikiTarih->diff($yorumTarihi);
  
    if ($fark->y > 0) {
      // 1 yıldan eski yorum
      $yil = $fark->y;
      return $yil === 1 ? "1 yıl önce" : $yil . " yıl önce";
    } else if ($fark->m > 0) {
      // 1 aydan eski yorum
      $ay = $fark->m;
      return $ay === 1 ? "1 ay önce" : $ay . " ay önce";
    } else if ($fark->d > 6) {
      // 1 haftadan eski yorum
      $hafta = floor($fark->d / 7);
      return $hafta === 1 ? "1 hafta önce" : $hafta . " hafta önce";
    } else if ($fark->d > 0) {
      // 1 günden eski yorum
      $gun = $fark->d;
      return $gun === 1 ? "dün" : $gun . " gün önce";
    } else if ($fark->h > 0) {
      // 1 saatten eski yorum
      $saat = $fark->h;
      return $saat === 1 ? "1 saat önce" : 24-$saat . " saat önce";
    } else if ($fark->i > 0) {
      // 1 dakikadan eski yorum
      $dakika = $fark->i;
      return $dakika === 1 ? "1 dakika önce" : 60-$dakika . " dakika önce";
    } else {
      // 1 saniyeden eski yorum
      $saniye = $fark->s;
      return $saniye === 1 ? "1 saniye önce" : 60-$saniye . " saniye önce";
    }
  }                                                                              

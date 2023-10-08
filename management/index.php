<?php
session_start();
if($_SESSION['user']){
    header("Location:dashboard");}
else{
    header("Location:login");}
?>
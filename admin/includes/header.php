<?php session_start(); ?>
<?php include('../config/dbcon.php'); ?>
<?php
    if(!isset($_SESSION['adminlogin']))
    {
        header('Location: login.php');
        exit(0);
        die();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Booking</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/adminlte.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Summernote -->
    <link href="assets/css/summernote.min.css" rel="stylesheet">
    <link href="assets/css/summernote-lite.min.css" rel="stylesheet">
    
    <!-- Alertify -->
    <link rel="stylesheet" href="assets/css/alertify.min.css"/>
    <link rel="stylesheet" href="assets/css/alertifyjs.bootstrap.min.css"/>

    <!-- Datatables -->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css"/>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <?php include('adminnav.php') ?>
    <?php include('sidenav.php') ?>

        <div class="content-wrapper">
        <div class="p-3">
            
        
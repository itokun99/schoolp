<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>KES | Kids Education System</title>
<meta charset="UTF-8">
<meta name="description" content="Kids Education System">
<meta name="keywords" content="KES,School,Kids Education system,School system">
<meta name="author" content="KES Developer">

<meta name="google-signin-client_id" content="238640789322-n9969pmlmol4i605rlce32h0s7r2oofn.apps.googleusercontent.com">

<link rel="icon" href="assets/website/images/icon.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="public/assets/css/app.css?ver=3.2">
<link rel="stylesheet" href="public/assets/css/animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<script src="public/assets/dist/scripts.min.js?ver=3.9"></script>
<script src="public/assets/dist/markerclusterer.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuHae3MvvdGVotQ-VtcUF4SEL05nxk3WE&libraries=places"></script>
<!-- <script src="https://fb.me/react-0.14.3.js"></script>
<script src="https://fb.me/react-dom-0.14.3.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.25/browser.min.js"></script>
<?php if($loginFrom == "")
{
?>
    <script src="assets/website/js/gmail-api.js"></script>
<?php
}
?>

</head>
<body>
<div class="loading" id="loading-screen"><img src="assets/website/images/kes-loader.gif" id="loading-content" alt=""></div>
<?php if($loginFrom == "facebook")
{?>
    <script src="assets/website/js/fb-api.js"></script>
<?php
} else if($loginFrom == "")
{?>
    <script src="assets/website/js/fb-api.js"></script>
<?php
}?>

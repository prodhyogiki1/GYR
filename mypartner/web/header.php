<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if(empty($_SESSION)){echo "Get Your Ride";}else{echo $_SESSION['cname'];};?></title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <?php $rand=rand(0,999);?>
  <link rel="stylesheet" href="<?php echo $base_url; ?>theme/assets/css/styles.min.css?ver=<?php  echo $rand; ?>" />
  
</head>

<body>


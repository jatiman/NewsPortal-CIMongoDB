<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php  echo $title;?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/fontawesome/css/font-awesome.min.css';  ?>">
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css';?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/wa-mediabox/wa-mediabox.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/wa-mediabox/wa-mediabox.min.css" />

  <style type="text/css">
    .warning {
      background:#fff8c4;
      border:1px solid #f2c779;
      padding: 24px;
    }

    ul.enlarge{
    list-style-type:none; /*remove the bullet point*/
    margin-left:0;
    white-space: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    }

    ul.enlarge li {
    position: relative;
    display: inline-block;
    margin-right: 15px;
    margin-left: 15px;

    }
    ul.enlarge li img{
    background-color:#eae9d4;
    padding: 6px;
    -webkit-box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    -moz-box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    box-shadow: 0 0 6px rgba(132, 132, 132, .75);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    }
    /**IE Hacks - see http://css3pie.com/ for more info on how to use CS3Pie and to download the latest version**/
    ul.enlarge img{
    behavior: url(pie/PIE.htc);
    }
    ul.enlarge a i{
      position:absolute; top:0; right:0; 
    }
  </style>
  </head>
  <body>
<!-- Menu -->
      <nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">DOTcom</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <form class="navbar-form navbar-left" action="<?php echo base_url('blog/search')?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search" name="cari">
            </div>
            <button type="submit" class="btn btn-default" name="search">Cari</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url();?>blog">Home</a></li>
            <li><a href="<?php echo base_url();?>blog/sport">Sport</a></li>
            <li><a href="<?php echo base_url();?>blog/tekno">Tekno</a></li>
            <li><a href="<?php echo base_url();?>blog/oto">Otomotif</a></li>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
<!-- Menu -->
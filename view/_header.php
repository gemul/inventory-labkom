<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Inventaris Labkom Yadika</title>

    <!-- Bootstrap Core CSS -->
    <link href="uielement/bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="uielement/bootstrap/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="uielement/bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="uielement/bootstrap/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="uielement/bootstrap/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="uielement/bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="uielement/typeahead/typeahead.bundle.js"></script>
    <script src="uielement/custom/custom.js"></script>
    <link rel=stylesheet href="uielement/typeahead/typeahead.css">
    <script src="uielement/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <link rel=stylesheet href='uielement/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css' />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Aplikasi Labkom Yadika Bangil</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-gear fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="?a=view-dashboard"><i class="fa fa-dashboard fa-fw"></i> Depan</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-suitcase fa-fw"></i> Master Barang<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?a=view-kategori-barang">Kategori Barang</a>
                                </li>
                                <li>
                                    <a href="?a=view-data-barang">Data Barang</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text fa-fw"></i> Stok<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?a=view-stok-masuk">Transaksi Masuk</a>
                                </li>
                                <li>
                                    <a href="?a=view-stok-keluar">Transaksi Keluar</a>
                                </li>
                                <li>
                                    <a href="?a=view-rekap-transaksi">Rekap Transaksi</a>
                                </li>
                                <li>
                                    <a href="?a=view-rekap-stok">Rekap Stok</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?a=view-jurnal-lab"><i class="fa fa-file-text-o fa-fw"></i> Jurnal Laboratorium</a>
                        </li>
                        <li>
                            <a href="?a=view-peminjaman-barang"><i class="fa fa-users fa-fw"></i> Peminjaman Barang</a>
                        </li>
                        <li>
                            <a href="?a=view-peminjaman-proyektor"><i class="fa fa-ticket fa-fw"></i> Peminjaman Proyektor</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

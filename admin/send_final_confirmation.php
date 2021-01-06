<?php

include "parts/connect.php";

 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="admin") {
    # code...
    header("location: ../index.php");
}

$id = $_GET['id'];

$del_qry = "SELECT FNAME, MNAME, LNAME,EMAIL,COMPANY FROM delegate WHERE ID=$id";
$del_result = $con->query($del_qry);
$del_rows = $del_result->fetch_assoc();

$name = str_replace('\\', '', $del_rows['FNAME']).' '.str_replace('\\', '',$del_rows['MNAME']).' '.str_replace('\\', '',$del_rows['LNAME']);

$company = str_replace('\\', '', $del_rows['COMPANY']);
$email = $del_rows['EMAIL'];



?>
<?php include 'header_css.php' ;?>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Start Left menu area -->
        <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.php"><img class="main-logo" src="img/logo/philLogoNs.png" alt="" /></a>
                <strong><a href="index.php"><img src="img/logo/philLogo.png" alt="" /></a></strong>
            </div>s
            <?= include "parts/menu.php";?>
        </nav>
    </div>
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.php"><img class="main-logo" src="img/logo/philLogoNs.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="educate-icon educate-nav"></i>
                                                </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                                                    
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <?php include "parts/mobile_menu.php"?>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single pro tab review Start-->
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title text-uppercase">Final Confirmation of Delegate</h3>
                           
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="../send_confirmation_final.php">                                   
<!--                                 <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                                <input type="hidden" name="udept" value="<?php echo $udept; ?>">
                                <input type="hidden" name="ucode" value="<?php echo $ucode; ?>"> -->

                                        <div class="form-group">
                                        <label>Fullname</label>
                                            <input type="hidden" name="delegate_id" value="<?php echo $id; ?>">
                                          <!--   <input type="hidden" name="package" value="<?php echo $package; ?>"> -->
                                            <input type="name" style="text-transform: uppercase" class="form-control" name="fullname" value="<?php echo $name; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" style="text-transform: uppercase" class="form-control" name="company" value="<?php echo $company; ?>" readonly>
                                        </div>
                                        <input type="submit" class="btn btn-danger" name='submit' value="SEND">
                                        <input type="button" class="btn btn-danger btn-m" value="Cancel" onclick="window.location.href='view-delegate.php?id=<?php echo $id; ?>'">
                                </form> 
        
                        </div>
                    </div>
                </div>      
        <!-- Single pro tab review End-->
   
        <div class="padding-top: 60px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer_css.php' ;?>
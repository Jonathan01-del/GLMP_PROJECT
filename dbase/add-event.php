<?php

include "parts/connect.php";

 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="database") {
    # code...
    header("location: ../index.php");
}



?>
<?php include "header_css.php";?>
        <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.php"><img class="main-logo" src="img/logo/logosn.png" alt="" /></a>
                <strong><a href="index.php"><img src="img/logo/logo.png" alt="" /></a></strong>
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
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">ADD EVENT / SHOW'S :</h3>
                            <!-- <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span> -->
                        </div>
                        <div class="panel-body">
                            <form name="myForm" method="POST" action="execute/add_event_execute.php" enctype="multipart/form-data" autocomplete="off">
                                <div class="card-body col-md-offset-1" align="left">
                                    <div class="form-group row">                                        
                                        <div class="col-md-6">
                                            <!-- <label for="exhibitor_name" class="text-primary">EXHIBITOR NAME:</label> -->
                                            <input type="text" id="event_name" style="text-transform: uppercase" class="form-control" name="event_name" placeholder="Add event or show name here! ">
                                        </div>
                                        <div class="col-md-3">
                                            <input data-provide="datepicker" data-date-format='yyyy-mm-dd' name="start" placeholder="YYYY-MM-DD">
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <input data-provide="datepicker" data-date-format='yyyy-mm-dd' name="end" placeholder="YYYY-MM-DD">
                                            
                                        </div>                                        
                                    </div>

<!--                                     <div class="form-group row">                                        
                                        <div class="col-md-3">
                                            <label for="selected_show" class="text-primary">SHOW' JOINED:</label>
                                            <select name="selected_show" class="form-control" id="selected_show">
                                                <option selected>Choose...</option>
                                                <?php 
                                                $sql = "SELECT show_name, show_id FROM tbl_show"; 
                                                $result = mysqli_query($con, $sql);
                                                while ($row = mysqli_fetch_array($result)){
                                                #echo ...                                       
                                                    echo '<option value="'. $row['show_id'].'">'. $row['show_name'].'</option>';
                                                }
                                                ?>
                                </select>
                                        </div>
                                    </div>  -->                                   



                                    <div class="form-group row">
                                        <label class="col-md-6"><input type="submit" name="submit" class="btn btn-primary btn-m btn-block" value="SUBMIT"></label>
                                        <div class="col-md-6">
                                            <input type="button" class="btn btn-danger btn-m text-uppercase btn-block" value="Cancel" onclick="window.location.href='index.php'" >
                                        </div>
                                    </div>  
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>

                <!-- Activity Tracks End -->                        
        <!-- Single pro tab review End-->
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
<!--                             <h3 class="panel-title">SELECTED TRACKS</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span> -->
                        </div>
                        <div class="panel-body">

                            <?php include 'parts/data-table-show.php';?>
  
                        </div>
                    </div>
                </div>        
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

  <?php include "footer_css.php";?>
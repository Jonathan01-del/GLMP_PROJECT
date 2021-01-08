<?php

include "parts/connect.php";

 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="database") {
    # code...
    header("location: ../index.php");
}

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}

?>
<?php include 'header_css.php' ;?>
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Start Left menu area -->
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
                        <a href="index.php"><img class="main-logo" src="img/logo/logosn.png" alt="" /></a>
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
                            <h3 class="panel-title">IMPORT ASSOCIATION</h3>
                        </div>
                        <div class="panel-body">
                                <div class="col-md-12 head">
                                    <div class="float-center">
                                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> OPEN FILE</a>
                                    </div>
                                </div>                               
                                <div class="col-md-12" id="importFrm" style="display: none;">
                                    <form action="importDays_data.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group row"> 

                                        <div class="col-md-6">
                                             <br>
                                            <label for="association" class="text-primary">ASSOCIATION:</label>
                                            <select name="association" class="form-control" id="exhibitor">
                                                <option selected>Choose...</option>
                                                <?php 
                                                $sql_assoc = "SELECT tbl_assoc_id, association FROM tbl_association"; 
                                                $result_assoc = mysqli_query($con, $sql_assoc);
                                                while ($row_assoc = mysqli_fetch_array($result_assoc)){
                                                #echo ...                                       
                                                    echo '<option value="'. $row_assoc['tbl_assoc_id'].'">'. $row_assoc['association'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div> 

                                        <div class="col-md-3">
                                             <br>
                                            <label for="industry" class="text-primary">INDUSTRIES:</label>
                                            <select name="industry" class="form-control" id="exhibitor">
                                                <option selected>Choose...</option>
                                                <?php 
                                                $sql_ind = "SELECT ind_id, industry FROM tbl_industry"; 
                                                $result_ind = mysqli_query($con, $sql_ind);
                                                while ($row_ind = mysqli_fetch_array($result_ind)){
                                                #echo ...                                       
                                                    echo '<option value="'. $row_ind['ind_id'].'">'. $row_ind['industry'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                             <br>
                                            <label for="encoder" class="text-primary">ENCODER:</label>
                                            <select name="encoder" class="form-control" id="exhibitor">
                                                <option selected>Choose...</option>
                                                <?php 
                                                $sql_end = "SELECT encoder_id, encoder_name FROM tbl_encoder"; 
                                                $result_end = mysqli_query($con, $sql_end);
                                                while ($row_end = mysqli_fetch_array($result_end)){
                                                #echo ...                                       
                                                    echo '<option value="'. $row_end['encoder_id'].'">'. $row_end['encoder_name'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>                                         
                                    </div>
                                    <input type="file"  class="btn btn-primary btn-lg btn-block" name="file" />
                                    <br>
                                    <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                                    </form>
                                </div>                                
  
                        </div>
                    </div>
                </div>
                <!-- calling the table  -->
                
                <!-- End of table -->
        <!-- Single pro tab review End-->
   
<!--         <div class="padding-top: 60px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>     
<?php include 'footer_css.php' ;?>
<?php

include "parts/connect.php";

 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="admin") {
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
                            <h3 class="panel-title">Import Days Data :</h3>
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
                                            <label for="days" class="text-primary">DAY'S VISIT:</label>
                                            <select name="days" class="form-control" id="days">
                                                <option selected>Choose...</option>
                                                <option value="Day 1">Day 1</option>
                                                <option value="Day 2">Day 2</option>
                                                <option value="Day 3">Day 3</option>
                                                <option value="Day 4">Day 4</option>
                                                <option value="Day 5">Day 5</option>
                                                <option value="Day 6">Day 6</option>
                                                <option value="Day 7">Day 7</option>

                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                             <br>
                                            <label for="exhibitor" class="text-primary">EXHIBITOR:</label>
                                            <select name="exhibitor" class="form-control" id="exhibitor">
                                                <option selected>Choose...</option>
                                                <?php 
                                                $sql_ex = "SELECT exhibitor_id, Exhibitor_name FROM tbl_exhibitor"; 
                                                $result_ex = mysqli_query($con, $sql_ex);
                                                while ($row_ex = mysqli_fetch_array($result_ex)){
                                                #echo ...                                       
                                                    echo '<option value="'. $row_ex['exhibitor_id'].'">'. $row_ex['Exhibitor_name'].'</option>';
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
                <?php include 'parts/days_table.php';?>
                <!-- End of table -->
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
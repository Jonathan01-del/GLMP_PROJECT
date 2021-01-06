<?php

include "parts/connect.php";

 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="admin") {
    # code...
    header("location: ../index.php");
}

$view_id = $_GET['id'];

    $view_delegate_qry = "SELECT ID, FULLNAME, COMPANY, JOBTITLE, ADDRESS, TELEPHONE, MOBILE, EMAIL, DATE_FORMAT(DATE_CREATED, '%b %d, %Y') AS DATE_REGISTERED, COUNT_TRACK, AMOUNT, VAT,TOTAL,STATUS,OR_NO, REMARKS, SUM(VAT + AMOUNT) AS GRAND_AMOUNT, DATE_FORMAT(DATE_UPDATED, '%b %d, %Y') AS DATE_PAID
        FROM group_request WHERE ID=$view_id";

    $view_delegate_result = $con->query($view_delegate_qry);
    $view_delegate_row = $view_delegate_result->fetch_assoc();



    $id_reg = $view_delegate_row['ID'];
    $company = str_replace('\\', '', $view_delegate_row['COMPANY']);
    $pack_amount = number_format($view_delegate_row['AMOUNT'],2);
    $tracks_count =number_format($view_delegate_row['COUNT_TRACK']);
    $vat = number_format($view_delegate_row['VAT'],2);
    $amount = number_format($view_delegate_row['GRAND_AMOUNT'], 2);
    $status = str_replace('\\', '', $view_delegate_row['STATUS']);
    $remarks = $view_delegate_row['REMARKS'];
    $date_registered = $view_delegate_row['DATE_REGISTERED'];
    $or = $view_delegate_row['OR_NO'];
    $date_paid = $view_delegate_row['DATE_PAID'];
?>
<?php include 'header_css.php';?>
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
            <div class="col-sm-12 col-md-12" id="content">
                <h2><?php echo $company; ?></h2>
                <hr/>

                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Package Details</h3>
                            <!-- <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span> -->
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form action="update_group_submit.php" method="POST">   
                            
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="15%"><b>Billing No.:</b></td>
                                        <td width="25%"><?php echo $id_reg; ?></td>
                                        <td width="13%"><b>Status:</b></td>
                                        <td width="47%">
                                            <select class="form-control" name="status" required>
                                                <option disabled="disabled">Please select...</option>    
                                                <option value="PAID" <?php if($status == "PAID") {echo 'selected="true"';} ?>>PAID</option>
                                                <option value="UNPAID" <?php if($status == "UNPAID") {echo 'selected="true"';} ?> >UNPAID</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Date Registered:</b></td>
                                        <td><?php echo $date_registered; ?></td>
                                        <td><b>Date Paid:</b></td>
                                        <td><input type="date" name="date_paid" width="100%" <?php if($status == "PAID") {echo 'value="'.$date_paid.'"';} ?> required placeholder="Aug 30, 2020"/></td>
                                    </tr>
                                    <tr>
                                        <td><b>Count of tracks:</b></td>
                                        <td><?php echo $tracks_count; ?></td>
                                        <td><b>OR #:</b></td>
                                        <td><input type="text" name="or_no" class="form-control" <?php if($status == "PAID") {echo 'value="'.$or.'"';} ?>>
                                            <input type="hidden" name="company" value="<?php echo $company;?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Amount:</b></td>
                                        <td><?php echo $pack_amount;?></td>
                                        <td><b>Remarks:</b></td>
                                        <td><input type="text" name="remarks" class="form-control" value="<?php echo $remarks; ?>" ></td>
                                        <input type="hidden" name="delegate_id" value="<?php echo $view_id; ?>">
                                    </tr>
                                    <tr>
                                        <td><b>12% VAT:</b></td>
                                        <td><?php echo '+ '.$vat; ?></td>
                                        <td><input type="submit" name="submit" class="btn btn-primary btn-m" value="SUBMIT"></td>
                                        <td><input type="button" class="btn btn-danger btn-m" value="Cancel" onclick="window.location.href='view-group.php?id=<?php echo $view_id; ?>'">
                                            </td>
                                    </tr>
                                    <tr>
                                        <td class="text-danger"><b>Total Price:</b></td>
                                        <td class="text-danger"><b><?php echo '₱ '.$amount; ?></b></td>
                                    </tr>
                                </table>
                            </form> 
                            </div>  
                        </div>
                    </div>
                </div>


            </div>  
                                  <!-- Activity Tracks Start-->
<!--                 <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">SELECTED TRACKS</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">

                            <?php include 'parts/track_table.php';?>
  
                        </div>
                    </div>
                </div> -->
                <!-- Activity Tracks End -->
        <!-- Single pro tab review End-->
   

    </div>

<?php include 'footer_css.php' ;?>
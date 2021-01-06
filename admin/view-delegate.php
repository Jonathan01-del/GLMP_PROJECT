<?php

include "parts/connect.php";

 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="admin") {
    # code...
    header("location: ../index.php");
}

$id = $_GET['id'];

    $registered_delegate = "SELECT  d.ID, 
    d.FNAME, d.MNAME, d.LNAME, d.COMPANY, d.JOB_TITLE, d.ADDRESS1, d.ADDRESS2, d.CITY, d.STATE, d.ZIP, d.TELEPHONE, d.EMAIL, 
    d.MOBILE, d.FAX, d.PACKAGE, d.VAT, d.TOTAL_AMOUNT, d.PACKAGE_AMOUNT, d.TRACK_COUNT, d.STATUS,  d.OR_NO, d.REMARKS, 
    d.CHANGE_NAME, COUNT(t.TRACK_CODE) AS CNT_TRACKS, COUNT(t.TRACK_CODE) * d.PACKAGE_AMOUNT AS BEFORE_VAT,
    (COUNT(t.TRACK_CODE) * d.PACKAGE_AMOUNT) * .12 AS VATS,
    (COUNT(t.TRACK_CODE) * d.PACKAGE_AMOUNT) + ((COUNT(t.TRACK_CODE) * d.PACKAGE_AMOUNT) * .12)  AS GRAND_AMOUNT,  
    DATE_FORMAT(d.DATE_CREATED, '%b %d, %Y') AS DATE_REGISTERED, 
    DATE_FORMAT(d.DATE_UPDATED, '%b %d, %Y') AS DATE_PAID, 
    DATE_FORMAT(d.DATE_SENT, '%b %d, %Y') AS DATE_SENT 
    FROM delegate AS d 
    INNER JOIN selected_track AS t ON d.ID = t.DELEGATE_ID 
    LEFT JOIN list_track as l ON t.TRACK_CODE = l.CODE
    WHERE d.ID=$id AND l.STATUS !='Free' ";

        $del_result = $con->query($registered_delegate);
        $del_rows = $del_result->fetch_assoc();

        $name = str_replace('\\', '', $del_rows['FNAME']).' '.str_replace('\\', '',$del_rows['MNAME']).' '.str_replace('\\', '',$del_rows['LNAME']);

        $company = str_replace('\\', '', $del_rows['COMPANY']);
        $job_title = str_replace('\\', '', $del_rows['JOB_TITLE']);
        $address = str_replace('\\', '', $del_rows['ADDRESS1']).', '.str_replace('\\', '',$del_rows['ADDRESS2']).', '.str_replace('\\', '',$del_rows['CITY']).', '.str_replace('\\', '',$del_rows['STATE']).' '.str_replace('\\', '',$del_rows['ZIP']);;
        $telephone = $del_rows['TELEPHONE'];
        $email = $del_rows['EMAIL'];
        $mobile = $del_rows['MOBILE'];
        $fax = $del_rows['FAX'];
        $remarks = $del_rows['REMARKS'];
        $package = $del_rows['PACKAGE'];
        $vat = number_format($del_rows['VATS'],2);
        $amount = number_format($del_rows['GRAND_AMOUNT'], 2);    
        $pack_amount = number_format($del_rows['PACKAGE_AMOUNT'],2);
        $tracks_count =number_format($del_rows['CNT_TRACKS']);
        $status = str_replace('\\', '', $del_rows['STATUS']);
        // $remarks = $del_rows['REMARKS'];
        $change_name = $del_rows['CHANGE_NAME'];
        $or_no = $del_rows['OR_NO'];

        $date_registered = $del_rows['DATE_REGISTERED'];
        $date_paid = $del_rows['DATE_PAID'];
        $date_sent = $del_rows['DATE_SENT'];




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
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main" >
            <div class="col-sm-12 col-md-12" id="content">
                <h2><?php echo $name; ?></h2>
                <hr/>
                <div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Contact Details</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">

                                    <tr>
                                        <td width="4%"><b>Company Name: </b></td>
                                        <td width="32%" class="text-left"><?php echo $company;?></td>                                       
                                    </tr>
                                    <tr>
                                        <td><b>Designation:</b></td>
                                        <td class="text-left"><?php echo $job_title;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address:</b></td>
                                        <td class="text-left"><?php echo $address;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Telephone:</b></td>
                                        <td class="text-left"><?php echo $telephone;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile:</b></td>
                                        <td class="text-left"><?php echo $mobile;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td class="text-left"><?php echo $email;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Remarks:</b></td>
                                        <td class="text-left"><?php echo $remarks;?></td>
                                    </tr>

                                    <tr>
                                    <td><input type="button" value="CHANGE DELEGATE PROFILE" onclick="window.location.href='edit-delegate.php?id=<?php echo $id;?>'" class="btn btn-primary btn-sm"></td>
                                    <td><input type="button" value="RE-SEND CONFIRMATION LETTER" onclick="window.location.href='send_1st_confirmation.php?id=<?php echo $id;?>'" class="btn btn-primary btn-sm"></td>
                                        
                                    </tr>

                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payment/Package Details</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="18%"><b>Billing No.:</b></td>
                                        <td width="32%"><?php echo $id;?></td>
                                        <td width="13%"><b>Status:</b></td>
                                        <td width="37%"><?php echo $status;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Date Registered:</b></td>
                                        <td><?php echo $date_registered; ?></td>
                                        <td><b>Date Paid:</b></td>
                                        <td><?php echo $date_paid;?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Package:</b></td>
                                        <td><?php echo "$package";?></td>
                                        <td><b>Request ID:</b></td>
                                        <td><?php echo $or_no; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Price / Tracks:</b></td>
                                        <td><?php echo $pack_amount;?> X <?php echo $tracks_count ;?></td>
                                        <td><b>Remarks:</b></td>
                                        <td><?php echo $remarks; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>12% VAT:</b></td>
                                        <td><?php echo '+ '.$vat; ?></td>
                                        <?php 
                                            if($status == "UNPAID"){
                                                echo '<td rowspan="2"><a href="update-delegates.php?id='.$id.'" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> UPDATE PAYMENT</a></td>';
                                                
                                            }else if ($status == "PAID") {
                                                # code...
                                                echo '<td rowspan="2"><a href="update-delegates.php?id='.$id.'" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> UPDATE PAYMENT</a></td>';
                                            }else {
                                                echo '<td rowspan="2"> <input type=\'button\' class=\'btn btn-danger btn-m text-uppercase\' value=\'PRE-PAID DELEGATE\'></td>';
                                            }

                                            if($status == 'PAID'){
                                                    echo '<td rowspan="2"><a href="send_final_confirmation.php?id='.$id.'" class="btn btn-info btn-sm"><i class="fa fa-envelope"></i> SEND RE-CONFIRMATION LETTER</a></td>';
                                            }
                                            
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="text-danger"><b>Total Price:</b></td>
                                        <td class="text-danger"><b><?php echo '₱ '.$amount; ?></b></td>
                                    </tr>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
                <!-- Activity Tracks Start-->
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">SELECTED TRACKS</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body">

                            <?php include 'parts/track_table.php';?>
  
                        </div>
                    </div>
                </div>
                <!-- Activity Tracks End -->
                <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">              
                      <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <img src="" class="imagepreview" style="width: 100%;" >
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
        </div>
            </div>

<?php include 'footer_css.php';?>
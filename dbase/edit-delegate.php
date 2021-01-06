<?php

include "parts/connect.php";

 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="admin") {
    # code...
    header("location: ../index.php");
}

$id = $_GET['id'];

$view_delegate_qry = "SELECT d.ID, d.FNAME, d.MNAME, d.LNAME, d.COMPANY, d.JOB_TITLE, d.ADDRESS1, d.ADDRESS2, d.CITY, d.STATE, d.ZIP, d.TELEPHONE, d.EMAIL, d.MOBILE, d.FAX, d.PACKAGE, d.VAT, d.TOTAL_AMOUNT,d.PACKAGE_AMOUNT,d.TRACK_COUNT, d.STATUS,  d.OR_NO, d.REMARKS, DATE_FORMAT(d.DATE_CREATED, '%b %d, %Y') AS DATE_REGISTERED, DATE_FORMAT(d.DATE_UPDATED, '%b %d, %Y') AS DATE_PAID
                      FROM delegate AS d
                      WHERE d.ID = '$id'";

    $view_delegate_result = $con->query($view_delegate_qry);
    $view_delegate_row = $view_delegate_result->fetch_assoc();

    $id_reg = $view_delegate_row['ID'];
    $name = str_replace('\\', '', $view_delegate_row['FNAME']).' '.str_replace('\\', '',$view_delegate_row['MNAME']).' '.str_replace('\\', '',$view_delegate_row['LNAME']);
    $fname = str_replace('\\', '', $view_delegate_row['FNAME']);
    $mname = str_replace('\\', '', $view_delegate_row['MNAME']);
    $lname = str_replace('\\', '', $view_delegate_row['LNAME']);
    $company = str_replace('\\', '', $view_delegate_row['COMPANY']);
    $job_title = str_replace('\\', '', $view_delegate_row['JOB_TITLE']);
    $address = str_replace('\\', '', $view_delegate_row['ADDRESS1']).', '.str_replace('\\', '',$view_delegate_row['ADDRESS2']).', '.str_replace('\\', '',$view_delegate_row['CITY']).', '.str_replace('\\', '',$view_delegate_row['STATE']).' '.str_replace('\\', '',$view_delegate_row['ZIP']);;
    $address1 = str_replace('\\', '', $view_delegate_row['ADDRESS1']);
    $address2 = str_replace('\\', '', $view_delegate_row['ADDRESS2']);
    $city = str_replace('\\', '', $view_delegate_row['CITY']);
    $state = str_replace('\\', '', $view_delegate_row['STATE']);
    $zip = str_replace('\\', '', $view_delegate_row['ZIP']);
    $telephone = $view_delegate_row['TELEPHONE'];
    $email = $view_delegate_row['EMAIL'];
    $mobile = $view_delegate_row['MOBILE'];
    $fax = $view_delegate_row['FAX'];
    $package = $view_delegate_row['PACKAGE'];
    $pack_amount = number_format($view_delegate_row['PACKAGE_AMOUNT'],2);
    $tracks_count =number_format($view_delegate_row['TRACK_COUNT']);
    $vat = number_format($view_delegate_row['VAT'],2);
    $amount = number_format($view_delegate_row['TOTAL_AMOUNT'], 2);
    $status = str_replace('\\', '', $view_delegate_row['STATUS']);
    $remarks = $view_delegate_row['REMARKS'];
    $or_no = $view_delegate_row['OR_NO'];
    // $image = $view_delegate_row['STUDENT_ID'];
    $date_registered = $view_delegate_row['DATE_REGISTERED'];
    $date_paid = $view_delegate_row['DATE_PAID'];

?>
<?php include "header_css.php";?>
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
<!--                                                 <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <img src="img/product/pro4.jpg" alt="" />
                                                            <span class="admin-name">Prof.Anderson</span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic"></span>My Account</a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-money author-log-ic"></span>User Billing</a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li> -->

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
                            <h3 class="panel-title">Change Delegate Profile</h3>
                            <!-- <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span> -->
                        </div>
                        <div class="panel-body">
                            <form name="myForm" method="POST" action="edit_submit.php" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="delegate_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="old_name" value="<?php echo $name; ?>">
                                <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                                <input type="hidden" name="udept" value="<?php echo $udept; ?>">
                                <input type="hidden" name="ucode" value="<?php echo $ucode; ?>">
                                <div class="card-body col-md-offset-1" align="left">
                                    <div class="form-group row">
                                        <label class="col-md-2">Full Name: </label>
                                        <div class="col-md-3">
                                            <label for="fname" class="text-primary">First Name</label>
                                            <input type="text" id="fname" style="text-transform: uppercase" class="form-control" name="fname" value="<?php echo $fname; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="mname" class="text-primary">Middle Name</label>
                                            <input type="text" id="mname" style="text-transform: uppercase" class="form-control" name="mname" value="<?php echo $mname; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="lname" class="text-primary">Last Name</label>
                                            <input type="text" id="lname" style="text-transform: uppercase" class="form-control" name="lname" value="<?php echo $lname; ?>">
                                        </div>
                                    </div>
                                    <?php
                                        if($package == 'SMART'){
                                            echo '
                                            <div class="form-group row smart_div">
                                                <label class="col-md-2">School Name: </label>
                                                <div class="col-md-9">
                                                    <input type="text" id="school" style="text-transform: uppercase" class="form-control" name="company" value="'.$company.'">
                                                </div>
                                            </div>
                                            <div class="form-group row smart_div">
                                                <label class="col-md-2">Educational Stage:</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="jobtitle" class="form-control" name="jobtitle" value="'.$job_title.'">
                                                </div>
                                            </div>';
                                        }    
                                        else{    
                                            echo '
                                            <div class="form-group row cc_div">
                                                <label class="col-md-2">Company Name: </label>
                                                <div class="col-md-9">
                                                    <input type="text" id="companyname" style="text-transform: uppercase" class="form-control" name="company" value="'.$company.'">
                                                </div>
                                            </div>
                                            <div class="form-group row cc_div">
                                                <label class="col-md-2">Job Title: </label>
                                                <div class="col-md-9">
                                                    <input type="text" id="jobtitle" class="form-control" name="jobtitle" value="'.$job_title.'">
                                                </div>
                                            </div>
                                            ';
                                        }
                                    ?>
                                    <div class="form-group row">
                                        <label class="col-md-2">Complete Address:</label>
                                        <div class="col-md-3">
                                            <label for="address1" class="text-primary">Home no., Street</label>
                                            <input type="text" id="address1" class="form-control" name="address1" oninput="typing_function()" value="<?php echo $address1; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="address2" class="text-primary">Barangay</label>
                                            <input type="text" id="address2" class="form-control" name="address2" oninput="typing_function()" value="<?php echo $address2; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city" class="text-primary">City</label>
                                            <input type="text" id="city" class="form-control" name="city" oninput="typing_function()" value="<?php echo $city; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">&nbsp;</label>
                                        <div class="col-md-3">
                                            <label for="state" class="text-primary">State / Province</label>
                                            <select class="form-control" id="state" name="state">
                                                <?php
                                                $types = array('Abra', 'Agusan del Norte', 'Agusan del Sur', 'Aklan', 'Albay', 'Antique', 'Apayao', 'Aurora', 'Basilan', 'Bataan', 'Batanes', 'Batangas', 'Benguet', 'Biliran', 'Bohol', 'Bukidnon', 'Bulacan', 'Cagayan', 'Camarines Norte', 'Camarines Sur', 'Camiguin', 'Capiz', 'Catanduanes', 'Cavite', 'Cebu', 'Cotabato', 'Davao de Oro', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental', 'Dinagat Islands', 'Eastern Samar', 'Guimaras', 'Ifugao', 'Ilocos Norte', 'Ilocos Sur', 'Iloilo', 'Isabela', 'Kalinga', 'La Union', 'Laguna', 'Lanao del Norte', 'Lanao del Sur', 'Leyte', 'Maguindanao', 'Marinduque', 'Masbate', 'Metro Manila', 'Misamis Occidental', 'Misamis Oriental', 'Mountain Province', 'Negros Occidental', 'Negros Oriental', 'Northern Samar', 'Nueva Ecija', 'Nueva Vizcaya', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Pampanga', 'Pangasinan', 'Quezon', 'Quirino', 'Rizal', 'Romblon', 'Samar', 'Sarangani', 'Siquijor', 'Sorsogon', 'South Cotabato', 'Southern Leyte', 'Sultan Kudarat', 'Sulu', 'Surigao del Norte', 'Surigao del Sur', 'Tarlac', 'Tawi-Tawi', 'Zambales', 'Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay');
                                                $type = $state && in_array($state,$types)?$state:'Article';

                                                foreach($types as $option) {
                                                     echo '<option value="'.$option.'"'.(strcmp($option,$type)==0?' selected="selected"':'').'>'.$option.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="zip" class="text-primary">Zip Code</label>
                                            <input type="text" id="zip" class="form-control" name="zip" oninput="typing_function()" value="<?php echo $zip; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country" class="text-primary">Country</label>
                                            <select class="form-control" id="country" name="country">
                                                <option value="PH" selected="selected">Philippines</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Telephone:</label>
                                        <div class="col-md-4">
                                            <input type="text" id="telephone" class="form-control" name="telephone" value="<?php echo $telephone; ?>">
                                        </div>
                                        <label class="col-md-1">Mobile:</label>
                                        <div class="col-md-4">
                                            <input type="text" id="mobile" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                                        </div>
                                    </div>
                                           
                                    <div class="form-group row">
                                        <label class="col-md-2">E-Mail: </label>
                                        <div class="col-md-9">
                                            <input type="text" id="email" class="form-control" name="email" value="<?php echo $email; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12 text-danger" align="center">
                                            <b><i>NOTE: After clicking submit button, delegate's profile will be overwritten.</i></b>
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label class="col-md-2"><input type="submit" name="submit" class="btn btn-primary btn-m btn-block" value="SUBMIT"></label>
                                        <div class="col-md-9">
                                            <input type="button" class="btn btn-danger btn-m text-uppercase" value="Cancel" onclick="window.location.href='view-delegate.php?id=<?php echo $id; ?>'" >
                                        </div>
                                    </div>  
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Package Details</h3>
                           <!--  <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span> -->
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="18%"><b>Billing No.:</b></td>
                                        <td width="32%"><?php echo $id_reg; ?></td>
                                        <td width="13%"><b>Status:</b></td>
                                        <td width="37%"><?php echo $status; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Date Registered:</b></td>
                                        <td><?php echo $date_registered; ?></td>
                                        <td><b>Date Paid:</b></td>
                                        <td><?php echo $date_paid; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Package:</b></td>
                                        <td><?php echo $package; ?></td>
                                        <td><b>OR No.:</b></td>
                                        <td><?php echo $or_no; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Price / Track:</b></td>
                                        <td><?php echo $pack_amount;?>&nbsp; X <?php echo $tracks_count ?></td>
                                        <td><b>Remarks:</b></td>
                                        <td><?php echo $remarks; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>12% VAT:</b></td>
                                        <td><?php echo '+ '.$vat; ?></td>
                                                                                <?php 
                                            if($status == "UNPAID"){
                                                echo '<td rowspan="2"><a href="update-delegates.php?id='.$id.'" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> UPDATE PAYMENT</a></td>';

                                                if($status != 'UNPAID'){
                                                    echo '<td rowspan="2"><a href="send_eticket.php?id='.$id.'" class="btn btn-danger btn-sm"><i class="fa fa-envelope"></i> SEND RE-CONFIRMATION LETTER</a></td>';
                                                }
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

  <?php include "footer_css.php";?>
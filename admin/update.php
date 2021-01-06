<?php include 'parts/connect.php';

$view_id = $_GET['id'];

$view_delegate_qry = "SELECT d.ID, d.FNAME, d.MNAME, d.LNAME, d.COMPANY, d.JOB_TITLE, d.ADDRESS1, d.ADDRESS2, d.CITY, d.STATE, d.ZIP, d.TELEPHONE, d.EMAIL, d.MOBILE, d.FAX, d.PACKAGE, d.ORIGINAL_RATE, d.DISCOUNT_VALUE, d.VAT, d.DISCOUNT_AVAILED, d.TOTAL_AMOUNT, d.STATUS, d.STUDENT_ID, d.OR_NO, d.REMARKS, DATE_FORMAT(d.DATE_CREATED, '%b %d, %Y') AS DATE_REGISTERED, DATE_FORMAT(d.DATE_UPDATED, '%b %d, %Y') AS DATE_PAID
	                  FROM delegate AS d
	                  WHERE d.EVENT_NAME = 'EWMS 2020' AND d.ID = '$view_id'";

	$view_delegate_result = $con->query($view_delegate_qry);
	$view_delegate_row = $view_delegate_result->fetch_assoc();

	$id_reg = $view_delegate_row['ID'];
	$name = str_replace('\\', '', $view_delegate_row['FNAME']).' '.str_replace('\\', '',$view_delegate_row['MNAME']).' '.str_replace('\\', '',$view_delegate_row['LNAME']);
	$company = str_replace('\\', '', $view_delegate_row['COMPANY']);
	$job_title = str_replace('\\', '', $view_delegate_row['JOB_TITLE']);
	$address = str_replace('\\', '', $view_delegate_row['ADDRESS1']).', '.str_replace('\\', '',$view_delegate_row['ADDRESS2']).', '.str_replace('\\', '',$view_delegate_row['CITY']).', '.str_replace('\\', '',$view_delegate_row['STATE']).' '.str_replace('\\', '',$view_delegate_row['ZIP']);;
	$telephone = $view_delegate_row['TELEPHONE'];
	$email = $view_delegate_row['EMAIL'];
	$mobile = $view_delegate_row['MOBILE'];
	$fax = $view_delegate_row['FAX'];
	$package = $view_delegate_row['PACKAGE'];
	$org_price = number_format($view_delegate_row['ORIGINAL_RATE'],2);
	$dis_value = number_format($view_delegate_row['DISCOUNT_VALUE'],2);
	//$dis_avail = round($view_delegate_row['DISCOUNT_AVAILED'] * 100);
	$vat = number_format($view_delegate_row['VAT'],2);
	$amount = number_format($view_delegate_row['TOTAL_AMOUNT'], 2);
	$status = str_replace('\\', '', $view_delegate_row['STATUS']);
	$remarks = $view_delegate_row['REMARKS'];
	$or_no = $view_delegate_row['OR_NO'];
	$image = $view_delegate_row['STUDENT_ID'];
	$date_registered = $view_delegate_row['DATE_REGISTERED'];
	$date_paid = $view_delegate_row['DATE_PAID'];

?>

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
										<td width="18%"><b>Job Title:</b></td>
										<td width="32%"><?php echo $job_title; ?></td>
										<?php
											if($package == 'SMART'){
							                	$school_id = '<a href="#" class="pop"><img src="../student_id/'.$image.'" width="200" height="200"></a>';
							                } else {
							                	$school_id = '';
							                }
										?>
										<td rowspan="7"><?php echo $school_id; ?></td>
									</tr>
									<tr>
										<td><b>Company:</b></td>
										<td><?php echo $company; ?></td>
									</tr>
									<tr>
										<td><b>Address:</b></td>
										<td><?php echo $address; ?></td>
									</tr>
									<tr>
										<td><b>Telephone:</b></td>
										<td><?php echo $telephone; ?></td>
									</tr>
									<tr>
										<td><b>Fax:</b></td>
										<td><?php echo $fax; ?></td>
									</tr>
									<tr>
										<td><b>Mobile:</b></td>
										<td><?php echo $mobile; ?></td>
									</tr>
									<tr>
										<td><b>Email:</b></td>
										<td><?php echo $email; ?></td>
									</tr>
									<?php
										echo '<tr><td rowspan="2"><a href="edit.php?id='.$view_id.'&'.$auth.'" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> CHANGE DELEGATE PROFILE</a></td></tr>';
									?>
								</table>
							</div>	
						</div>
					</div>
				</div>
		    	<div class="col-md-12">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Package Details</h3>
							<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
							<form action="update_submit.php" method="POST">
								<input type="hidden" name="uid" value="<?php echo $uid; ?>">
								<input type="hidden" name="udept" value="<?php echo $udept; ?>">
								<input type="hidden" name="ucode" value="<?php echo $ucode; ?>">
								<table class="table table-borderless">
									<tr>
										<td width="15%"><b>Billing No.:</b></td>
										<td width="25%"><?php echo $id_reg; ?></td>
										<td width="13%"><b>Status:</b></td>
										<td width="47%">
											<select class="form-control" name="status" required>
												<option disabled="disabled">Please select...</option>    
												<option value="UNPAID" <?php if($status == "PRE-PAID") {echo 'selected="true"';} ?> >PRE-PAID</option>
												<option value="PAID" <?php if($status == "PAID") {echo 'selected="true"';} ?>>PAID</option>
												<option value="UNPAID" <?php if($status == "UNPAID") {echo 'selected="true"';} ?> >UNPAID</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><b>Date Registered:</b></td>
										<td><?php echo $date_registered; ?></td>
										<td><b>Date Paid:</b></td>
										<td><input id="datepicker" name="date_paid" width="100%" <?php if($status == "PAID") {echo 'value="'.$date_paid.'"';} ?> required/></td>
									</tr>
									<tr>
										<td><b>Package:</b></td>
										<td><?php echo $package; ?></td>
										<td><b>Request ID:</b></td>
										<td><input type="text" name="or_no" class="form-control" value="<?php echo $or_no; ?>" required></td>
									</tr>
									<tr>
										<td><b>Original Price:</b></td>
										<td><?php echo '₱ '.$org_price; ?></td>
										<td><b>Remarks:</b></td>
										<td><input type="text" name="remarks" class="form-control" value="<?php echo $remarks; ?>" ></td>
										<input type="hidden" name="delegate_id" value="<?php echo $view_id; ?>">
									</tr>
									<tr>
										<td><b>Discount Availed:</b></td>
										<td><!-- <?php echo '- '.$dis_value.' ('.$dis_avail.'%)'; ?> --></td>
										<td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-primary btn-m" value="SUBMIT">&nbsp; &nbsp;<a href="view.php?id=<?php echo $view_id.'&'.$auth; ?>" class="btn btn-danger btn-m">Cancel</a></td>
									</tr>
									<tr>
										<td><b>12% VAT:</b></td>
										<td><?php echo '+ '.$vat; ?></td>
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





<?php include 'includes/footer.php';?>



<script type="text/javascript">
/* date picker */ 
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap'
    });
/* date picker */   
</script>
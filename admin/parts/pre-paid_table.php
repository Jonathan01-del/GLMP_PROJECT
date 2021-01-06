<?php 
include 'connect.php';

$registered_delegate_qry = "SELECT ID, COMPANY, FNAME, LNAME, PACKAGE, TOTAL_AMOUNT, STATUS,DATE_FORMAT(DATE_CREATED, '%b %d, %Y') AS DATECREATED FROM delegate WHERE STATUS='PRE-PAID'";
$registered_delegate_result = $con->query($registered_delegate_qry);

?>        
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>PRE-PAID <span class="table-project-n">&nbsp;DELEGATES</span> LIST</h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead class="bg-primary  text-dark text-uppercase">
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="company" data-editable="false">Company</th>
                                                <th data-field="name" data-editable="false">Fullname</th>
                                                <th data-field="amount" data-editable="false">amount</th>
                                                <th data-field="status" data-editable="false">status</th>
                                                <th>view</th>
                                                <th data-field="date">date created</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($registered_row = $registered_delegate_result->fetch_assoc()) {
                                                # code...
                                                $id = $registered_row['ID'];
                                                $company = $registered_row['COMPANY'];
                                                $name = str_replace('\\', '', $registered_row['FNAME']).' '.str_replace('\\', '',$registered_row['LNAME']);
                                                $status = $registered_row['STATUS'];
                                                $amount = number_format($registered_row['TOTAL_AMOUNT'], 2);
                                                $date_created = $registered_row['DATECREATED'];
                                                $view =  '<a href="view-delegate.php?id='.$id.'" title="Update Status"><i class="fa fa-bars fa-2x"></i></a>';
                                                $edit =  '<a href="update-delegates.php?id='.$id.'" title="Update Status"><i class="fa fa-toggle-off fa-2x"></i></a>';

                                               // if($status == 'UNPAID'){
                                                //     $status_label = '<span class="text-danger"><b>'.$status.'</b></span>';
                                                //     $update_status = '<a href="update.php?id='.$id.'" title="Update Status"><i class="fa fa-toggle-off fa-2x"></i></a>';
                                                //      $send = "<a onclick=\"alert('Delegate is not yet paid!')\" title='Delegate is not yet paid'><i class='fa fa-send-o fa-2x'></i></a>";
                                                // } else {
                                                //     $status_label = $status;
                                                //     $update_status = '<a href="update.php?id='.$id.'" title="Update Status"><i class="fa fa-toggle-on fa-2x"></i></a>';
                                                //      $send = '<a href="send_eticket.php?id='.$id.'" title="Send e-Ticket"><i class="fa fa-send fa-2x"></i></a>';
                                                // }

                                                echo '
                                                <tr>
                                                <td></td>
                                                <td>'.$id.'</td>
                                                <td>'.$company.'</td>
                                                <td>'.$name.'</td>
                                                <td>'.$amount.'</td>
                                                <td>'.$status.'</td>
                                                <td>'.$view.'</td>
                                                <td>'.$date_created.'</td>
                                                </tr>
                                                ';
                                            }


                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
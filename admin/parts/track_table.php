<?php 
include 'connect.php';

// $registered_delegate_qry = "SELECT ID, COMPANY, FNAME, LNAME, PACKAGE, TOTAL_AMOUNT, STATUS FROM delegate WHERE STATUS='PAID'";
// $registered_delegate_result = $con->query($registered_delegate_qry);
$id = $_GET['id'];
$track_sql = "SELECT 
 d.STATUS AS PAID_STAT,
 l.DATE_SCHED AS SCHEDULE_DATE, 
 l.TIME_SCHED AS SCHEDULE_TIME, 
 l.ACTIVITY SCHEDULE_ACTIVIITY, 
 l.PRESENTER AS SPEAKER, 
 l.STATUS AS STATUS, 
 t.ID AS TRACSID,
 t.TCK_NEW AS TCK_NEW,
 d.ID AS IDS 
 FROM delegate AS d 
 INNER JOIN selected_track AS t ON d.ID = t.DELEGATE_ID 
 LEFT JOIN list_track as l ON t.TRACK_CODE = l.CODE 
 WHERE d.ID = $id ORDER BY l.STATUS DESC";

$track_res = $con->query($track_sql);
// $track_row = $track_res->fetch_assoc();



?>        
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">

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
                                                <th data-field="activity" data-editable="false">Activity</th>
                                                <th data-field="speaker">speaker</th>
                                                <th data-field="date" data-editable="false">date</th>
                                                <th data-field="time" data-editable="false">time</th>
                                                <th data-field="status" data-editable="false">status</th>
                                                <th data-field="url">Option </th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($track_row = $track_res->fetch_assoc()) {
                                                # code...

                                                $sked_date = $track_row['SCHEDULE_DATE'];
                                                $sked_time= $track_row['SCHEDULE_TIME'];
                                                $sked_activity = $track_row['SCHEDULE_ACTIVIITY'];
                                                $speaker = $track_row['SPEAKER'];
                                                $sked_status =$track_row['STATUS'];
                                                $paid_stat = $track_row['PAID_STAT'];  
                                                $track_id = $track_row['TRACSID']; 
                                                $ids = $track_row['IDS']; 
                                                $tck =$track_row['TCK_NEW'];                                           

                                                 
                                               if($paid_stat == 'UNPAID'){
                                                    $update_status = '<button data-toggle="tooltip" name="submit" title="Trash" onclick="window.location.href=\'parts/delete_item.php?id='.$track_id.'&ids='.$ids.'\'" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';                                                
                                                 
                                                } else if ($paid_stat == 'PAID') {
                                                    # code...
                                                    $update_status = '<button data-toggle="tooltip" title="Cant Delete Paid Delegate" class="pd-setting-ed"><i class="fa fa-close" aria-hidden="true"></i></button>';                                                
                                                } else {
                                                    # code...
                                                    $update_status = 'PREPAID';
                                                }


                                                if ($sked_status == 'Free') {
                                                    # code...
                                                    $stat = 'Free Seminar';
                                                } else {
                                                    # code ...
                                                    $stat = 'Paid Seminar';
                                                }
                                                 

                                                echo '
                                                <tr>
                                                <td></td>
                                                <td>'.$sked_activity.'</td>
                                                <td>'.$speaker.'</td>
                                                <td>'.$sked_date.'</td>
                                                <td>'.$sked_time.'</td>
                                                <td>'.$stat.'</td>
                                                <td>'.$update_status.'</td>
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
                    <div class="sparkline13-hd text-center">
                        <div class="main-sparkline13-hd ">
                                <?php

                                if (@$paid_stat == 'PAID') {
                                    # code...
                                   echo "<input type='button' class='btn btn-danger btn-m text-uppercase' value='paid already'>";
                                
                                }else if (@$paid_stat == 'UNPAID') {
                                    # code...
                                   echo "<input type='button' class='btn btn-danger btn-m text-uppercase' value='Add Tracks' onClick=\"location.href='track_table_edit.php?id=$ids'\">
                                   ";                                    
                                }else{
                                   echo "<input type='button' class='btn btn-danger btn-m text-uppercase' value='PRE-PAID DELEGATE'>";
                                };

                                ?>
                                <input type="button" onclick="javascript: window.location='update_delegate_tracks_info.php?id=<?php echo $ids;?>';" value="update me!!" class='btn btn-primary btn-m text-uppercase'>

                        </div>
                    </div>
            </div>
        </div>
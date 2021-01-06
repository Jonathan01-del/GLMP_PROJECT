<?php 
include 'connect.php';

$qry = "SELECT 
l.ID AS ID, 
l.ACTIVITY AS ACTIVITY, 
s.TRACK_CODE AS TRACKS,
l.TRACK_NO AS TRACK,
l.STATUS AS STATUS,
l.PRESENTER AS SPEAKER, COUNT(s.CNT) AS QTY 
FROM selected_track AS s INNER JOIN list_track as l ON s.TRACK_CODE=l.CODE 
INNER JOIN delegate AS d ON s.DELEGATE_ID=d.ID 
GROUP BY s.TRACK_CODE
ORDER BY l.STATUS DESC";

$qry_res = $con->query($qry);

?>        
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                     <h1>Track<span class="table-project-n"></span> List</h1>
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
                                                <th data-field="type" data-editable="false">Type</th>
                                                <th data-field="tracks" data-editable="false">tracks</th>
                                                <th data-field="activity" data-editable="false">Activity</th>
                                                <th data-field="Presenter" data-editable="false">Presenter</th>
                                                <th data-field="Quantity" data-editable="false">QTY</th>
                                                <th data-field="option" data-editable="false">option</th>
                                         
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                while ($qry_row = $qry_res->fetch_assoc()) {
                                                # code...
                                                $id = $qry_row['ID'];
                                                $activity = $qry_row['ACTIVITY'];
                                                $qty =$qry_row['QTY'];
                                                $speaker = $qry_row['SPEAKER'];
                                                $trak = $qry_row['TRACK'];
                                                $stat = $qry_row['STATUS'];
                                                $trk_code = $qry_row['TRACKS'];

                                                if ($stat == "Free") {
                                                    # code...
                                                    $stat_display="FREE SEMINAR";
                                                }else{
                                                    #code ..
                                                    $stat_display="PAID SEMINAR";
                                                }
                                                
                                                # Display Option
                                                if ($stat == "Free") {
                                                    # code...
                                                    $stat_option='<button data-toggle="tooltip" name="submit" title="Trash" onclick="window.location.href=\'exp/export_free-delegate.php?track='.$trk_code.'\'" class="pd-setting-ed"><i class="fa fa-cloud-download" aria-hidden="true"></i></button>';
                                                    
                                                }else{
                                                    #code ..
                                                    $stat_option='<button data-toggle="tooltip" name="submit" title="Trash" onclick="#" class="pd-setting-ed"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>';
                                                }
                                                // '<button data-toggle="tooltip" name="submit" title="Trash" onclick="window.location.href=\'parts/delete_item.php?id='.$track_id.'&ids='.$ids.'\'" class="pd-setting-ed"><i class="fas fa-cloud-download-alt" aria-hidden="true"></i></button>';


                                                echo '
                                                <tr>
                                                <td></td>
                                                <td>'.$stat_display.'</td>
                                                <td>'.$trak.'</td>
                                                <td>'.$activity.'</td>
                                                <td>'.$speaker.'</td>
                                                <td>'.$qty.'</td>
                                                <td>'.$stat_option.'</td>
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
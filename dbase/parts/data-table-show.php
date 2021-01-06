<?php 
include 'connect.php';

$event_query  = "SELECT event_key,event_name,event_description, date_start, date_end, DATE_FORMAT(date_created, '%b %d, %Y') AS DATECREATED FROM tbl_event";
$event_query_result = $con->query($event_query);

?>        
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <br>
                                <div class="main-sparkline13-hd">
                                    <h1>EVENT/SHOW'S <span class="table-project-n">&nbsp;SUMMARY</span>&nbsp;LIST</h1>
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
                                                <th data-field="event_name" data-editable="false">event / show name</th>
                                                <th data-field="" data-editable="false">start date</th>
                                                <th data-field="" data-editable="false">end date</th>
                                                <th data-field="date">date created</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($event_row = $event_query_result->fetch_assoc()) {
                                                # code...
                                                $id =$event_row['event_key'];
                                                $events_name =$event_row['event_name'];
                                                $event_desc = $event_row['event_description'];
                                                $start=$event_row['date_start'];
                                                $end =$event_row['date_end'];
                                                $date_created =$event_row['DATECREATED'];




                                                echo '
                                                <tr>
                                                <td></td>
                                                <td>'.$id.'</td>
                                                <td>'.$events_name.'</td>
                                                <td>'.$start.'</td>
                                                <td>'.$end.'</td>
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
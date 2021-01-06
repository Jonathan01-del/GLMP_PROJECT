<?php 
include 'connect.php';

$industry_query  = "SELECT ind_id,industry, DATE_FORMAT(date_created, '%b %d, %Y') AS DATECREATED FROM tbl_industry";
$ind_query_result = $con->query($industry_query);

?>        
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <br>
                                <div class="main-sparkline13-hd">
                                    <h1>INDUSTRY<span class="table-project-n">&nbsp;SUMMARY</span>&nbsp;LIST</h1>
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
                                                <th data-field="company" data-editable="false">industry name</th>
                                                <th data-field="date">date created</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($industry_row = $ind_query_result->fetch_assoc()) {
                                                # code...
                                                $id = $industry_row['ind_id'];
                                                $ind_name = $industry_row['industry'];
                                                $date_created =$industry_row['DATECREATED'];




                                                echo '
                                                <tr>
                                                <td></td>
                                                <td>'.$id.'</td>
                                                <td>'.$ind_name.'</td>                                                
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
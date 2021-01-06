<?php 
include 'connect.php';

$registered_delegate_qry = "SELECT tlb_sum_id, company, firstname, lastname, phone,fullname,DATE_FORMAT(date_created, '%b %d, %Y') AS DATECREATED FROM tbl_summary";
$registered_delegate_result = $con->query($registered_delegate_qry);

?>        
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>VISITOR<span class="table-project-n">&nbsp;SUMMARY</span>&nbsp;LIST</h1>
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
                                                <th data-field="date">date created</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($registered_row = $registered_delegate_result->fetch_assoc()) {
                                                # code...
                                                $id = $registered_row['tlb_sum_id'];
                                                $company = $registered_row['company'];
                                                $fullname = $registered_row['fullname'];           
                                                $date_created = $registered_row['DATECREATED'];

                                                echo '
                                                <tr>
                                                <td></td>
                                                <td>'.$id.'</td>
                                                <td>'.$company.'</td>
                                                <td>'.$fullname.'</td>
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
<?php 
include 'connect.php';

$directory_query  = "SELECT d.directory_id, d.directory, c.category_name, DATE_FORMAT(d.date_created, '%b %d, %Y') AS DATECREATED FROM tbl_directory AS d INNER JOIN tbl_category AS c ON d.cat_id=c.cat_id ";
$directory_query_result = $con->query($directory_query);

?>        
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <br>
                                <div class="main-sparkline13-hd">
                                    <h1>DIRECTORY<span class="table-project-n">&nbsp;SUMMARY</span>&nbsp;LIST</h1>
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
                                                <th data-field="industry" data-editable="false">Directory name</th>
                                                <th data-field="category" data-editable="false">Category</th>
                                                <th data-field="date">date created</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($directory_row = $directory_query_result->fetch_assoc()) {
                                                # code...
                                                $id = $directory_row['directory_id'];
                                                $dir_name = $directory_row['directory'];
                                                $cat_name = $directory_row['category_name'];
                                                $date_created =$directory_row['DATECREATED'];




                                                echo '
                                                <tr>
                                                <td></td>
                                                <td>'.$id.'</td>
                                                <td>'.$dir_name.'</td>
                                                <td>'.$cat_name.'</td>
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
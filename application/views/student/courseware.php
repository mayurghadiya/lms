<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title><?php echo $title; ?></h4>
                            <div class="panel-controls panel-controls-right">
                                <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                                <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                                <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                            </div>
                        </div>-->

            <div class="panel-body table-responsive">
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th><div>#</div></th>			
                            <th><div><?php echo ucwords("topic name"); ?></div></th>
                            <th><div><?php echo ucwords("branch"); ?></div></th>
                            <th><div><?php echo ucwords("attachment"); ?></div></th>
                            <th><div><?php echo ucwords("description"); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($courseware as $row) {
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['topic']; ?></td>
                                <td><?php echo $row['c_name']; ?></td>
                                <td id="downloadedfile"><a href="<?= base_url() ?>uploads/courseware/<?php echo $row['attachment']; ?>" download="" title="<?php echo $row['attachment']; ?>"><i class="fa fa-download"></i></a></td>	
                                <td><?php echo $row['description']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('#data-tables1').dataTable();
    })

</script>
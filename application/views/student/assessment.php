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
            <div class=panel-body>
                <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="datatable-list">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div>Instructions & guidance</div></th>
                            <th><div>Feedback</div></th>
                            <th><div>Submissions</div></th>
                            <th><div>Marks</div></th>
                            <th><div>Assessment By</div></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($assessments as $row):
                            ?><tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row->instruction; ?></td>
                                <td><?php echo $row->submissions; ?></td>
                                <td><?php echo $row->feedback_tutor; ?></td>
                                <td><?php echo $row->marks; ?></td>
                                <td><?php
                                    $get = roleuserdatacomment($row->user_role, $row->user_role_id);
                                    if ($row->user_role == "admin") {
                                        echo $get[0]['name'];
                                    } else {
                                        echo $row->user_role . " " . $get[0]['name'];
                                    }
                                    ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $('#data-tables1').dataTable();
    })

</script>
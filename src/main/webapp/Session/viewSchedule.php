<?php
    session_start();
    include_once ("../../config.php");
    include "../../classes/common.php";
    if(Common::ModelControllerFileExist('Fitness'))
    {
        $obj = new FitnessController();
    }

    $curDate    = date("Y-m-d");

    $query = "SELECT tsd.sch_id, tsd.sch_date, tc.name, tst.session, TIME_FORMAT(tst.start_time, \"%h:%i\") as start_time, TIME_FORMAT(tst.end_time, \"%h:%i\") as end_time FROM (SELECT sd.sch_id, sd.cust_id, CASE WHEN re_schedule > 0 THEN (SELECT re_sch_date FROM tbl_re_schedule_details WHERE re_sch_id=re_schedule) ELSE sd.sch_date END as sch_date, CASE WHEN re_schedule > 0 THEN (SELECT session_timing FROM tbl_re_schedule_details WHERE re_sch_id=re_schedule) ELSE sd.session_timing END as session_timing FROM tbl_schedule_details as sd) as tsd LEFT OUTER JOIN tbl_customer as tc ON (tsd.cust_id = tc.cust_id) LEFT OUTER JOIN tbl_session_timings as tst ON (tsd.session_timing = tst.id) WHERE tsd.sch_date= '".$curDate."';";
    $schedule     = json_decode($obj->commonExecuteQuery($query));
?>
<html>
    <head>
        <?php include_once (VIEW_DIR."menu/Header.php"); ?>
        <script src="<?php echo SITE_PATH; ?>js/scheduleScript.js"></script>
    </head>
    <body>
        <?php include_once (VIEW_DIR."menu/menuBar.php"); ?>

        <!-- Main -->
        <div id="main" class="container">
            <div class="row">
                <div class="12u 12u$(medium)">
                    <h3>View Scheduling</h3>
                    <div class="row">
                        <div class="3u 12u$(xsmall)">
                                <input type="date" id="schDate" name="schDate" value="<?php echo date("Y-m-d"); ?>" onchange="viewSchedule(this.value);" >
                        </div>
                    </div>
                     <div class="row uniform">
                        <div class="12u 12u$(xsmall)">
                            <table id="scheduleTable" class="alt">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Session</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody id="scheduleTableBody">
                                    <?php
                                        for($i=0;$i<count($schedule);$i++){
                                    ?>
                                        <tr>
                                            <td><?php echo $schedule[$i]->sch_date; ?></td>
                                            <td><?php echo $schedule[$i]->name; ?></td>
                                            <td><?php echo $schedule[$i]->session; ?></td>
                                            <td><?php echo $schedule[$i]->start_time; ?></td>
                                            <td><?php echo $schedule[$i]->end_time; ?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr />
                </div>   
            </div>
        </div>
        <!-- Footer -->
        <footer id="footer">
            <?php include_once (VIEW_DIR."menu/Footer.php"); ?>
        </footer>
    </body>
</html>

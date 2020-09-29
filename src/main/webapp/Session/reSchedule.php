<?php
    session_start();
    include_once ("../../config.php");
    include "../../classes/common.php";
    if(Common::ModelControllerFileExist('Fitness'))
    {
        $obj = new FitnessController();
    }


    $query = "SELECT cust_id, name FROM tbl_customer ORDER BY name ASC;";
    $customer     = json_decode($obj->commonExecuteQuery($query));
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
                    <h3>Re Scheduling</h3>
                    <div class="row">
                        <div class="3u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="customer" id="customer" onchange="loadSchedule(this.value);">
                                    <option value="">- Customer -</option>
                                    <?php
                                        for($i=0;$i<count($customer);$i++){
                                    ?>
                                        <option value="<?php echo $customer[$i]->cust_id; ?>"><?php echo $customer[$i]->name; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="row uniform">
                        <div class="12u 12u$(xsmall)">
                            <table id="scheduleTable" class="alt">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Session</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="scheduleTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr />
                </div>   
            </div>
        </div>

        <!-- Modal -->
        <!-- The Modal -->
        <div id="reScheduleModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="row">
                        <div class="2u 12u$(xsmall)">
                            <input type="date" id="reSchDate" name="reSchDate" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date('Y-m-d', strtotime(date("Y-m-d"). ' + 30 days'));
                            ?>" >
                        </div>
                        <div class="3u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="session" id="session" onchange="loadAvailTiming(this.value);">
                                    <option value="">- Session -</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="2u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="time" id="time">
                                    <option value="">- Time -</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="scheduleId" name="scheduleId">
                        <div class="2u 12u$(xsmall)">
                            <a href="javascript:void(0);" onclick="assignReSchedule();" class="button special">Assign</a>
                        </div>
                    </div>
            </div>
        </div>
<script>

    window.onclick = function(event) {
        var modal = document.getElementById("reScheduleModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
        <!-- Footer -->
        <footer id="footer">
            <?php include_once (VIEW_DIR."menu/Footer.php"); ?>
        </footer>
    </body>
</html>

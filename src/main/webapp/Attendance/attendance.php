<?php
    session_start();
    include_once ("../../config.php");
    include "../../classes/common.php";
    if(Common::ModelControllerFileExist('Fitness'))
    {
        $obj = new FitnessController();
    }

    $query = "SELECT id, TIME_FORMAT(start_time, \"%h:%i\") as start_time, TIME_FORMAT(end_time, \"%h:%i\") as end_time FROM tbl_session_timings WHERE session='Morning' ORDER BY id ASC;";
    $session_timing     = json_decode($obj->commonExecuteQuery($query));

    $query = "SELECT cust_id, name FROM tbl_customer ORDER BY name ASC;";
    $customer     = json_decode($obj->commonExecuteQuery($query));

    $query = "SELECT tca.date, tc.name, tst.session, TIME_FORMAT(tst.start_time, \"%h:%i\") as start_time, TIME_FORMAT(tst.end_time, \"%h:%i\") as end_time FROM tbl_customer_attendance as tca LEFT OUTER JOIN tbl_customer as tc ON (tca.cust_id=tc.cust_id) LEFT OUTER JOIN tbl_session_timings as tst ON (tca.session_timing = tst.id) WHERE tca.date=CURDATE();";
    $attendance     = json_decode($obj->commonExecuteQuery($query));

?>
<html>
    <head>
        <?php include_once (VIEW_DIR."menu/Header.php"); ?>
        <script src="<?php echo SITE_PATH; ?>js/attendanceScript.js"></script>
    </head>
    <body>
        <?php include_once (VIEW_DIR."menu/menuBar.php"); ?>

        <!-- Main -->
        <div id="main" class="container" style="min-height: 65%;">
            <div class="row">
                <div class="12u 12u$(medium)">
                    <h3>Mark Attendance</h3>
                    <div class="row">
                        <div class="2u 12u$(xsmall)">
                            <input type="date" id="date" name="date" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="3u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="session" id="session" onchange="loadTiming(this.value);">
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
                                    <?php
                                        for($i=0;$i<count($session_timing);$i++){
                                    ?>
                                        <option value="<?php echo $session_timing[$i]->id; ?>"><?php echo $session_timing[$i]->start_time." - ".$session_timing[$i]->end_time; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="3u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="customer" id="customer">
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
                        <div class="2u 12u$(xsmall)">
                            <a href="javascript:void(0);" onclick="markAttendance();" class="button special">Mark</a>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="12u 12u$(medium)">
                    <h3>Attendance Report</h3>
                    <div class="row">
                        <div class="3u 12u$(xsmall)">
                            <input type="date" id="reportDate" name="reportDate" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="3u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="reportMonth" id="reportMonth">
                                    <option value="">- Month -</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="3u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="reportCustomer" id="reportCustomer">
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
                        <div class="3u 12u$(xsmall)">
                            <a href="javascript:void(0);" onclick="searchAttendance();" class="button special">Search</a>
                        </div>
                    </div>

                    <div class="row uniform">
                        <div class="12u 12u$(xsmall)">
                            <table id="attendanceTable" class="alt">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Session</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceTableBody">
                                    <?php
                                        for($i=0;$i<count($attendance);$i++){
                                    ?>
                                    <tr>
                                        <td><?php echo $attendance[$i]->date; ?></td>
                                        <td><?php echo $attendance[$i]->name; ?></td>
                                        <td><?php echo $attendance[$i]->session; ?></td>
                                        <td><?php echo $attendance[$i]->start_time; ?></td>
                                        <td><?php echo $attendance[$i]->end_time; ?></td>
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
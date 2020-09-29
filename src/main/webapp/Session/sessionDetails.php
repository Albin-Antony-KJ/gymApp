<?php
    session_start();
    include_once ("../../config.php");
?>
<html>
    <head>
        <?php include_once (VIEW_DIR."menu/Header.php"); ?>
        <script src="<?php echo SITE_PATH; ?>js/sessionScript.js"></script>
    </head>
    <body style="height: 100%; ">
        <?php include_once (VIEW_DIR."menu/menuBar.php"); ?>

        <!-- Main -->
        <div id="main" class="container" style="min-height: 65%;">
            <div class="row">
                <div class="12u 12u$(medium)">
                    <h3>Session Details</h3>
                    <div class="row">
                        <!--<div class="3u 12u$(xsmall)">
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
                        </div>-->
                        <div class="3u 12u$(xsmall)">
                            <div class="select-wrapper">
                                <select name="day" id="day" onchange="searchSession();">
                                    <option value="">- Day -</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                        </div>
                        <!--<div class="3u 12u$(xsmall)">
                            <a href="javascript:void(0);" onclick="searchSession();" class="button special">Search</a>
                        </div>-->
                    </div>

                    <div class="row uniform">
                        <div class="12u 12u$(xsmall)">
                            <table id="sessionTable" class="alt">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Name</th>
                                        <th>Session</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                    </tr>
                                </thead>
                                <tbody id="sessionTableBody">
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
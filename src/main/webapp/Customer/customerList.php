<?php
    session_start();
    include_once ("../../config.php");
    include "../../classes/common.php";
    if(Common::ModelControllerFileExist('Fitness'))
    {
        $obj = new FitnessController();
    }
    //$query = "SELECT tc.*, tcs.* FROM tbl_customer tc LEFT OUTER JOIN tbl_customer_session tcs ON (tc.cust_id = tcs.cust_id) ORDER BY name ASC;";

    $query = "SELECT cust_id, name, gender, phone, email FROM tbl_customer ORDER BY name ASC;";
    $customer     = json_decode($obj->commonExecuteQuery($query));
?>
<html>
    <head>
        <?php include_once (VIEW_DIR."menu/Header.php"); ?>

        <script>
            $(document).ready(function() {
                if("<?php echo $_GET['save']; ?>" == "success"){
                    new PNotify({
                        title: 'SUCCESS',
                        text: 'Added Customer Successfully',
                        type: 'success',
                        styling: 'fontawesome'
                    });
                }
            });
        </script>
    </head>
    <body>
        <?php include_once (VIEW_DIR."menu/menuBar.php"); ?>

        <!-- Main -->
        <div id="main" class="container" style="height: 65%;">
            <div class="row">
                <div class="12u 12u$(medium)">
                    <h3>Customer List</h3>

                    <div class="row uniform">
                        <div class="12u 12u$(xsmall)">
                            <table id="attendanceTable" class="alt">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody id="customerTableBody">
                                    <?php
                                        for($i=0;$i<count($customer);$i++){
                                    ?>
                                    <tr>
                                        <td><?php echo $customer[$i]->cust_id; ?></td>
                                        <td><?php echo $customer[$i]->name; ?></td>
                                        <td><?php echo $customer[$i]->gender; ?></td>
                                        <td><?php echo $customer[$i]->phone; ?></td>
                                        <td><?php echo $customer[$i]->email; ?></td>
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

<?php
	session_start();
	include_once ("../../config.php");
?>
<html>
	<head>
		<?php include_once (VIEW_DIR."menu/Header.php"); ?>
		<script src="<?php echo SITE_PATH; ?>js/sessionScript.js"></script>
	</head>
	<body>
		<?php include_once (VIEW_DIR."menu/menuBar.php"); ?>

		<!-- Main -->
		<div id="main" class="container">
			<div class="row">
				<form method="post" action="saveSession.php">
					<div class="row">
						<div class="3u 12u$(xsmall)">
							<label>Duration</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="radio" id="month1" name="duration" value="1" checked>
							<label for="month1">1 Month</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="radio" id="month2" name="duration" value="2">
							<label for="month2">2 Month</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="radio" id="month3" name="duration" value="3">
							<label for="month3">3 Month</label>
						</div>
					</div>
					<div class="row">
						<div class="3u 12u$(xsmall)">
							<label>Sessions</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="radio" id="3days" name="days" value="3" checked>
							<label for="3days">3/Week</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="radio" id="4days" name="days" value="4">
							<label for="4days">4/Week</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="radio" id="5days" name="days" value="5">
							<label for="5days">5/Week</label>
						</div>
					</div>
					<div class="row uniform">
						<div class="12u 12u$(xsmall)">
							<h4><span id="addSessionMsg">Add 3 Sessions</span></h4>
						</div>
					</div>
					<div class="row">
						<div class="2u 12u$(xsmall)">
							<div class="select-wrapper">
								<select name="day" id="day">
									<option value="">- Day -</option>
									<option value="Monday">Monday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Wednessday">Wednessday</option>
									<option value="Thursday">Thursday</option>
									<option value="Friday">Friday</option>
									<option value="Saturday">Saturday</option>
								</select>
							</div>
						</div>
						<div class="2u 12u$(xsmall)">
							<div class="select-wrapper">
								<select name="session" id="session">
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
									<option value="1">Manufacturing</option>
									<option value="1">Shipping</option>
									<option value="1">Administration</option>
									<option value="1">Human Resources</option>
								</select>
							</div>
						</div>
						<div class="2u 12u$(xsmall)">
							<a href="javascript:void(0);" onclick="addSession();" class="button special">Add</a>
						</div>
					</div>
					<div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<table id="sessionTable" class="alt">
								<thead>
									<tr>
										<th>Day</th>
										<th>Session</th>
										<th>Time</th>
										<th class="hide"></th>
									</tr>
								</thead>
								<tbody id="sessionTableBody">
									<tr>
										<td>Monday</td>
										<td>Morning</td>
										<td>6:00 - 6:30</td>
										<td class="hide"></td>
									</tr>
									<tr>
										<td>Wednessday</td>
										<td>Morning</td>
										<td>7:30 - 8:00</td>
										<td class="hide"></td>
									</tr>
									<tr>
										<td>Saturday</td>
										<td>Evening</td>
										<td>7:00 - 7:30</td>
										<td class="hide"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="12u$">
							<ul class="actions">
								<li><input type="submit" value="Save" class="alt" /></li>
							</ul>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Footer -->
		<footer id="footer">
			<?php include_once (VIEW_DIR."menu/Footer.php"); ?>
		</footer>
	</body>
</html>
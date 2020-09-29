<html>
	<head>
		<jsp:include page="/include/header.jsp" />
		<script src="js/sessionScript.js"></script>
	</head>
	<body>
		<jsp:include page="/include/menu.jsp" />

		<!-- Main -->
			<div id="main" class="container">
				<form method="post" action="registerFun.php">
					<div class="row 200%">
						<div class="6u 12u$(medium)">
							<!-- Form -->
							<h3>Registration</h3>
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<input type="text" id="name" name="name" placeholder="Name" required />
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="radio" id="male" name="gender" value="male" checked>
									<label for="male">Male</label>
								</div>
								<div class="3u$ 12u$(xsmall)">
									<input type="radio" id="female" name="gender" value="female">
									<label for="female">Female</label>
								</div>
								<div class="6u 12u$(xsmall)">
									<input type="text" id="phone" name="phone" placeholder="Phone" />
								</div>
								<div class="6u$ 12u$(xsmall)">
									<input type="email" id="email" name="email" placeholder="Email"/>
								</div>
								<!-- Break -->
								<div class="12u$">
									<textarea id="address" name="address" placeholder="Enter Your Address"></textarea>
								</div>
								<!-- Break -->
							</div>
						</div>
						<div class="6u 12u$(medium)">
							<h3>Fitness Stat</h3>
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<input type="text" id="height" name="height" class="number-field" placeholder="Height(cm)" required />
								</div>
								<div class="6u 12u$(xsmall)">
									<input type="text" id="weight" name="weight" class="number-field" placeholder="Weight(kg)" required />
								</div>
								<!-- Break -->
								<div class="12u$">
									<textarea id="prevInjury" name="prevInjury" placeholder="Enter Your Previous Injuries"></textarea>
								</div>
								<!-- Break -->
								<div class="12u$">
									<textarea id="medHistory" name="medHistory" placeholder="Enter Your Medical History"></textarea>
								</div>
							</div>
						</div>
					</div>
					<hr />
					<div class="row 200%">
						<div class="10u 12u$(medium)">
							<h3>Session Details</h3>
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
									<input type="radio" id="3days" name="days" value="3" onchange="checkSession(this.value);" checked>
									<label for="3days">3/Week</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="radio" id="4days" name="days" value="4" onchange="checkSession(this.value);">
									<label for="4days">4/Week</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="radio" id="5days" name="days" value="5" onchange="checkSession(this.value);">
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
											<option value="Wednesday">Wednesday</option>
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
										</select>
									</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<a href="javascript:void(0);" onclick="addSession();" class="button special">Add</a>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
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
											
										</tbody>
									</table>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="Register" class="alt" /></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

		<!-- Footer -->
			<footer id="footer">
				<jsp:include page="/include/footer.jsp" />
			</footer>
	</body>
</html>

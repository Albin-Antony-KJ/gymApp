<!-- Header -->
<header id="header">
	<div class="logo"><a href="\home">Fit App <span>for TEST</span></a></div>
	<a href="#menu">Menu</a>
</header>

<!-- Nav -->
<nav id="menu">
	<ul class="links">
		<li><a href="\home">Home</a></li>
		<li>
			<a onclick="showsub(this);">Customer</a>
			<div class="sublinks slide slideClose" style="transition: max-height 0.3s ease-in-out !important;">
				<ul>
					<li><a href="/Customer/new">Registration</a></li>
					<li><a href="Customer/customerList.php">View Customer</a></li>
				</ul>
		</li>
		<li><a href="Attendance/attendance.php">Attendance</a></li>
		<li><a href="Session/sessionDetails.php">Session</a></li>
		<li>
			<a onclick="showsub(this);">Scheduling</a>
			<div class="sublinks slide slideClose" style="transition: max-height 0.3s ease-in-out !important;">
				<ul>
					<li><a href="Session/viewSchedule.php">View Scheduling</a></li>
					<li><a href="Session/reSchedule.php">Re Scheduling</a></li>
				</ul>
		</li>
	</ul>
</nav>
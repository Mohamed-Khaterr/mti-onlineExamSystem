


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Live Exam</h1>
					<ul class="breadcrumb">
						<li>
							<a href="<?= base_url('Admin') ?>">Dashboard</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Admin') ?>">Home</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="<?= base_url('Admin/current-exam') ?>">Current Exams</a>
						</li>
						
						<li><i class='bx bx-chevron-right' ></i></li>
						
						<li>
							<a class="active" href="">Live Exam</a>
						</li>
					</ul>
				</div>
				
			</div>









			<ul class="box-info">
				
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<p>Students No.</p>
						<h3>15</h3>
					</span>
				</li>

				<li>
					<i class='bx bx-layer'></i>
					<span class="text">
						<p>Courses</p>
						<h3><?= $courseTitle ?></h3>
					</span>
				</li>

				<li>
					<i class='bx bxs-calendar-check' ></i>

					<span class="text">
						<p>Exam Title</p>
						<h3><?= $examTitle ?></h3>
					</span>
				</li>
			</ul>










			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Sudents</h3>
						<!--<i class='bx bx-search' ></i>-->
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<!--<th> Details </th>-->
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
								<tr>
									<td>
										<img src="<?=base_url() ?>/module/admin/img/people.png">
										<p>Mohamed Khater</p>
									</td>
									<!--<td> <button> See </button></td>-->
									<td><span class="status completed">Not Cheating</span></td>
								</tr>

							
							<tr>
								<td>
									<img src="<?=base_url() ?>/module/admin/img/people.png">
									<p>Fady victor</p>
								</td>
								
								<td><span class="status pending">Cheating</span></td>
							</tr>
							
							
						</tbody>
					</table>
				</div>
				
				<div class="todo">
					<div class="head">
						<h3>Time Remaning</h3>
					</div>
					<br />
					<h2 id="time" style="text-align: center;"></h2>
					<h1 id="endTime"></h1>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	
	<script>
		const endTime = new Date("<?= $endTime ?>").getTime();
		
		setInterval(function () {
			
			
			var now = new Date().getTime();
			var timeleft = endTime - now;
			
			var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
			
			if (seconds >= 0){
				document.getElementById('time').innerHTML = hours + ":" + minutes + ":" + seconds;
			}else{
				document.getElementById('time').innerHTML = "Exam End";
				clearInterval();
				
			}	
		}, 
		1000);
		
		
		/* Web Socket */
		
		var conn = new WebSocket("ws://192.168.1.4:8080?access_token=" );
	
		// Start Connection
		conn.onopen = function(e) {
			console.log("Admin is in Connection :)");
		};
		
	</script>
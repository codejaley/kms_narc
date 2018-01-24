<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
					</div>
					<div class="pull-right">
						
						<ul class="stats">							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big"><?php echo date("M d, Y");?></span>
									<span><?php echo date("D");?>, <?php echo date("H:i");?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="#">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row-fluid">
<div class="span12">
						<ul class="tiles">
							<li class="orange high long">
								<a href="{{ Request::root() }}/admin/your_books"><span class='count'><i class="icon-folder-open-alt"></i> </span><span class='name'>Your Items</span></a>
							</li>
																					
							<li class="green">
								<a href="#"><span class='count'><i class="glyphicon-stats"></i> </span><span class='name'>Statistics</span></a>
							</li>																					
																																												
						</ul>
					</div>									
					
				</div>

			</div>
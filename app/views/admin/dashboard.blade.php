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
							<a href="{{ Request::root() }}">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="{{ Request::root() }}">Dashboard sdfsdf</a>
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
								<a href="{{ Request::root() }}/admin/books"><span class='count'><i class="icon-folder-open-alt"></i> </span><span class='name'>Items</span></a>
							</li>
<?php 
	if (Auth::User()->role_id == 1 || Auth::User()->role_id == 2) {
?>							
							<li class="blue">
								<a href="{{ Request::root() }}/admin/categories"><span><i class="icon-folder-close-alt"></i></span><span class='name'>Categories</span></a>
							</li>
<?php } ?>	

<?php 
	if (Auth::User()->role_id == 1) {
?>							
							<li class="green">
								<a href="{{ Request::root() }}/admin/users"><span class='count'><i class="icon-user"></i> </span><span class='name'>Users</span></a>
							</li>
<?php } ?>							
							

<?php 
	if (Auth::User()->role_id == 1 || Auth::User()->role_id == 2) {
?>								
							<li class="blue">
								<a href="{{ Request::root() }}/admin/settings"><span><i class="icon-cogs"></i></span><span class="name">General Settings</span></a>
							</li>	
<?php } ?>																																												
						</ul>
					</div>									
					
				</div>

			</div>
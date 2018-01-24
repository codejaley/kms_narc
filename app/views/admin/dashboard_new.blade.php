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
							<a href="{{ Request::root() }}/admin">Home</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="{{ Request::root() }}/admin">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row-fluid">
<?php 
	$item_link = (Auth::User()->role_id == 3)?'admin/your_items' : 'admin/books';
?>
<div class="span12">
	<div class="box">
    	<div class="box-title"><h3><i class="glyphicon-unshare"></i> Shortcuts</h3></div>
        <div class="box-content nopadding">
			<ul class="tiles narc-dashboard">
							<li class="default high long">
								<a href="{{ Request::root() }}/{{ $item_link }}"><img style="padding-top:5px;" src="{{Request::root()}}/images/dashboard-item.png"/><span class='name'>Items</span></a>
							</li>
<?php 
	if (Auth::User()->role_id == 1 || Auth::User()->role_id == 2) {
?>								
							<li class="default high long">
								<a href="{{ Request::root() }}/admin/categories"><img src="{{Request::root()}}/images/dashboard-category.png"/><span class='name'>Categories</span></a>
							</li>
<?php } ?>

							<?php
							if (Auth::User()->role_id == 1 || Auth::User()->role_id == 2) {
							?>
							<li class="default high long">
								<a href="{{ Request::root() }}/admin/publications"><img src="{{Request::root()}}/admin_root/img/publication.jpg"/><span class='name'>Nature of Publications</span></a>
							</li>
							<?php } ?>

							<?php
							if (Auth::User()->role_id == 1 || Auth::User()->role_id == 2) {
							?>
							<li class="default high long">
								<a href="{{ Request::root() }}/admin/subjects"><img src="{{Request::root()}}/admin_root/img/subjects.jpg"/><span class='name'>Subjects</span></a>
							</li>
							<?php } ?>


							<?php
	if (Auth::User()->role_id == 1) {
?>						<div>&nbsp;</div>
					
							<li class="default high long">
								<a href="{{ Request::root() }}/admin/users"><img src="{{Request::root()}}/images/dashboard-user.png"/><span class='name'>Users</span></a>
							</li>
<?php } ?>		

																										
<?php 
	if (Auth::User()->role_id == 1 || Auth::User()->role_id == 2) {
?>								
							<li class="default high long">
								<a href="{{ Request::root() }}/admin/settings"><img src="{{Request::root()}}/images/dashboard-settings.png"/><span class="name">General Settings</span></a>
							</li>
<?php } ?>																																													
						</ul>
        </div>                
    </div>                    
</div>									
					
				</div>

			</div>
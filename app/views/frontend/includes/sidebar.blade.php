<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>NARC Digital Repository preserves and enables easy and open access to all types of digital content including text, images, moving images, mpegs and data sets.</p>
          </div>
          
		<div class="sidebar-module">
            <h4>User Panel</h4>
            <ol class="list-unstyled">
             <?php if(Auth::check()) { ?>
			 	 <li><a href="{{ Request::root() }}/admin/logout">Logout</a></li>
			<?php } else { ?>	 
				<li><a href="{{ Request::root() }}/admin/login">Login</a></li>
			<?php } ?>
			  <li><a href="{{ Request::root() }}/sign_up">Register New User</a></li>
            </ol>
          </div>		  
		    <?php if(Auth::check()) { ?>
<?php
	$query = "SELECT 
					users.id,
					users.firstname,
					count(book_users.id) as total_books
			FROM 
				users 
			LEFT JOIN book_users On(users.id=book_users.user_id)
			LEFT JOIN books ON(book_users.book_id=books.id)
			WHERE 1=1
				AND users.role_id='4'
			GROUP BY 
				users.firstname
			ORDER BY 
				total_books DESC";
	$results = DB::select(DB::raw($query));							
?>			 
			  <div class="sidebar-module">
				<h4>Browse By Authors</h4>
				<ol class="list-unstyled">
				  	<?php foreach($results as $result) { ?>
				  		<li><a href="{{ Request::root() }}/browse/author/{{ $result->id }}">{{ $result->firstname }}</a> ({{ $result->total_books }})</li> 
					<?php } ?>
				</ol>
					<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Filter By <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
					<li><a href="{{ Request::root() }}/browse/author">Alphabetically</a></li>
					<li><a href="{{ Request::root() }}/browse/author">Most popular</a></li>
					<li><a href="{{ Request::root() }}/browse/author">Most Uploaded</a></li>
				  </ul>
				</div>			
			  </div>
          	<?php } ?>
			  <?php if(Auth::check()) { ?>
				<!--<div class="sidebar-module">
					<h4>Browse By Subject</h4>
					<ol class="list-unstyled">
					  <li><a href="#">Plant production</a> (7)</li>
					  <li><a href="#">Plant production::Cropping patter</a> (6)</li>
					  <li><a href="#">Education, extension, and advisor...</a> (4)</li>
					  <li><a href="#">Natural resources</a> (4)</li>
					  <li><a href="#">Animal production</a> (4)</li>
					  <li><a href="#">Aquatic sciences and fisheries</a> (4)</li>	 
					</ol>	
					<div class="btn-group">
						  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Filter By <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu">
							<li><a href="#">Alphabetically</a></li>
							<li><a href="#">Most popular</a></li>
							<li><a href="#">Most Uploaded</a></li>
						  </ul>
						</div>			 
				 </div>-->			
			<?php } ?>			
        </div>
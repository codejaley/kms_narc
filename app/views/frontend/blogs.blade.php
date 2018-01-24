<div class="container main_container conainer_aboutpage">

    <!-- Marketing Icons Section -->
    <div class="row">
        <section class="os-animation" >
<div class="col-md-12"> <div class="breadcrumb_wrapper">
    <ol class="breadcrumb">
        <li><a href="{{ Request::root() }}"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">Blogs</li>
    </ol>
    <hr>
</div></div>


            <div class="col-md-8">

             <?php foreach($blogs as $blog) { ?>   
					<div class="row project_list">
						<div class="col-md-12"> <h3>{{ $blog->title }}</h3></div>
	
						<?php if ($blog->photo != '') { ?>
							<div class="col-md-3 project_img">
								<a href="#">
									<img alt="" src="{{ Request::root() }}/blog/th_{{ $blog->photo }}" class="img-responsive">
								</a>
							</div>						
						<?php } ?>
						
						<div class="col-md-9">
	
						<?php
							$description = strip_tags($blog->description);
							echo substr($description, 0,200) . '...';
						?>
						<br />
							<a class="btn btn-default readmore hover-shadow readmore_box" href="{{ Request::root() }}/blog/{{ $blog->slug }}">Read More</a>
						</div>
						<hr>
	
					</div>
			
			<?php } ?>
					{{ $blogs->links() }}
            </div>





        </section>
        <section class="os-animation">



    <div class="col-md-4 blog_box">
        <div class="panel panel-default pannel_content">
            <div class="panel-heading from_blog">
                <h3>
                    FROM THE BLOG</h3>
            </div>
            <div class="panel-body panel_body_blog">
                <ul>
                <?php foreach($blogs_recent as $blog) { ?>
				    <li><a href="{{ Request::root() }}/blog/{{ $blog->slug }}">{{ $blog->title }}</a></li>
				<?php } ?>
                </ul>
               
            </div>
        </div>
    </div>
</section>
    </div>
    <!-- /.row -->
</div>


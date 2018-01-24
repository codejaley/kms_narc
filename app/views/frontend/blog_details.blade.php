<div class="container main_container">

    <!-- Marketing Icons Section -->

        <div class="row inner-bread">
            <ul class="breadcrumb">
                <li><a href="{{ Request::root() }}"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="{{ Request::root() }}/blogs">Blogs</a></li>
                <li class="active">Blog Details</li>
            </ul>
            <hr>
        </div>
        
        
 	
        	<div class="col-md-8">
              <div class="content_wrapper"> 
                    <div class="content_header"><h3>{{ $blog[0]->title }}</h3></div>
                    
				<div class="content_header">
					<?php if ($blog[0]->photo != '') { ?>
						<img src="{{ Request::root() }}/blog/th_{{ $blog[0]->photo }}" />
					<?php } ?>
					{{ $blog[0]->description }}
               </div>
				</div>
                <div class="well blog_leave_comment">
                    
					<div>
				<!-- success message starts -->
						@if(Session::has('success_message'))
							<div class="alert alert-success" style="padding-top:5px;">{{ Session::get('success_message') }}</div>
						@endif					
				<!-- success message ends -->	
				
				<!-- error message starts -->
						@if(Session::has('error_message'))
							<div class="alert alert-error" style="padding-top:5px;">{{ Session::get('error_message') }}</div>
						@endif					
				<!-- error message ends -->						
				
				<!-- Validation error starts -->
					@if(count($errors->all())>0)
						<div class="alert alert-error">  
						{{implode("<br />",$errors->all())}}
						</div>  
					@endif	
					</div>
					
					
					<h4>LEAVE A COMMENT</h4>

                    <form role="form" method="post" action="{{ Request::root() }}/blog/post_comment">


						{{ Form::hidden('blog_id', $blog[0]->id) }}
						
                        <div class="form-group col-md-6">
							 {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}	
                        </div>

                        <div class="form-group col-md-6">
                           {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email')) }}	
                        </div>

                        <div class="form-group col-md-12">
						{{ Form::textarea('comment', null, array('class'=>'form-control','placeholder'=>'Comment', 'size' => '30x3')) }}
                        </div>


                        <div class="form-group col-md-12">  
						<button class="btn btn-primary readmore hover-shadow readmore_box" type="submit">Submit</button></div>

                    </form>
                </div>
                
                
               <?php 				  
				  if ($comments->count() > 0) {
				 ?>
			<div class="media">
					
					<h3>Comments</h3>
					
                    
                </div>				 
				 <?php 
				   foreach($comments as $comment) { ?> 
						<div class="media">
		
							<div class="media-body">
								<h4 class="media-heading">{{ $comment->name }}
									<small>{{ $comment->email }}</small>
								</h4>
								{{ $comment->comment }}
							</div>
						</div>
	
				<?php } 
				}
				?>
            </div>    
            
      	<div class="col-md-4 blog_box">
                <div class="panel panel-default pannel_content">
                    <div class="panel-heading from_blog">
                        <h3>
                            FROM THE BLOG</h3>
                    </div>
                    <div class="panel-body panel_body_blog">
                        <ul>
                            <?php foreach($latest_blogs as $latest_blog) { ?>
                                <li><a href="{{ Request::root()  }}/blog/{{ $latest_blog->slug }}">{{ $latest_blog->title }}</a></li>
                            <?php } ?>
                        </ul>
                        <a href="{{ Request::root() }}/blogs" class="btn btn-default readmore hover-shadow">View All</a>
                    </div>
                </div>
    	</div>

</div>
   

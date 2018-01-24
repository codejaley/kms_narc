<div class="col-md-9">




<div class="breadcrumb_wrapper">
    <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">Our Clients</li>
    </ol>
    <hr>
</div>
				


				<!-- Client listing -->
<div class="content_wrapper">
    
	  <div class="client_page_box">
		{{ $setting_text[0]->value }} 
	  </div>	
	
	<div class="our team"> 
        
        <?php foreach($clients as $client) { ?>
        
        
        
       <!-- <div class="col-md-6" style="min-height:180px;">-->
        	
			<div class="row team_container">
				<?php if ($client->logo != '') { ?>
				<div class="col-md-5 foto-container">
					
						<a target="_blank" href="{{ $client->url }}">
							<img alt="team" src="{{ Request::root() }}/clients/th_{{ $client->logo }}" class="img-responsive team_member">
						</a>				
				</div>
				<?php } ?>	
	
				<div class="col-md-7">
					<h3>{{ $client->name }}</h3>
	
					<?php if ($client->description != '') { ?>
						{{ $client->description }}
					<?php } ?>
					<p><a href="{{ Request::root() }}/projects?client_id={{ $client->id }}">View Projects</a></p>
					
				</div>
			</div>
            
           
            
           <!-- </div>--><hr />
          
		<?php } ?>
		
      </div>
   	{{ $clients->links() }}
    </div>				
				<!-- client listing ends -->
				

                </div>

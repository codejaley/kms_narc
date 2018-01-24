<?php 
	$constant_video = Constant::where('title', '=', 'home_youtube_video')->get(); 
	
?>
<section class="banner_image ">
    <div class="container shadow bg_white inner_container">
        <div class="row">
            <div class="col-md-7">
                {{ $constant_video[0]->content_english }}
            </div>
            <div class="col-md-5">
                <div class="about-details">


                    <ul class="about-list">
                        <li>
                            <span><i class="fa fa-location-arrow"></i>
</span>
<?php
	$data_page_content =  Page::where('slug', '=','getting-started')->get();
?>
                            <h3><a href="{{ Request::root() }}/page/{{ $data_page_content[0]->slug }}">{{ $data_page_content[0]->title }}</a></h3>
                            <p>{{ $data_page_content[0]->intro_text }}</p>


                        </li>
                        <!--<li>
                            <span><i class="fa fa-cogs"></i>
</span>
                            <h3><a href="#">How It Works</a></h3>
                            <p>This is space for the sample content.</p>


                        </li>-->
                        <li>
                            <span><i class="fa fa-info-circle"></i>
</span>
<?php
	$data_page_content =  Page::where('slug', '=','about-knowledge-management-system')->get();
?>
                             <h3><a href="{{ Request::root() }}/page/{{ $data_page_content[0]->slug }}">{{ $data_page_content[0]->title }}</a></h3>
                             <p>{{ $data_page_content[0]->intro_text }}</p>


                        </li>

                    </ul>

                </div>

 </div>

        </div>
        </div>



</section>
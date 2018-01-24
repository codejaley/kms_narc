<?php if(!Auth::check()) {?>
	@include('frontend.home-login')
	@include('frontend.home-video-panel')		
<?php } ?>	

<?php if(Auth::check()) {?>
	@include('frontend.home-top-search')	
	<?php /*?>@include('frontend.home-slider-panel')<?php */?>
	@include('frontend.home-category-listing-panel')
	@include('frontend.home-video-panel')	
<?php } ?>
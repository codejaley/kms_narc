<!doctype html>
<html>
 @include('admin.includes.header')
<body>	
	 @include('admin.includes.navigation_new')
		<div class="container-fluid" id="content">
			 @include('admin.includes.left-container')
			<div id="main">
				
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
						<a class="close" data-dismiss="alert">X</a>  
						{{implode("<br />",$errors->all())}}
						</div>  
					@endif					
				<!-- validation error ends -->
				 {{$content}}
			</div>
		</div>
       {{-- @include('admin.includes.footer')	--}}
			<!-- jQuery -->
	</body>
</html>


<?php
	$constant_location 	= Constant::where('title','=', 'narc_location')->get();
	$constant_phone 	= Constant::where('title','=', 'phone_numbers')->get();
	$constant_email		= Constant::where('title','=', 'narc_email')->get();
	$site_copyright		= Constant::where('title','=', 'site_copyrights_text')->get();
    $data_title = Constant::where('title', '=','site_title')->get();
?>
<footer>
    <div class="container footer-distributed">
        <div class="row">
            <div class="col-md-4"> <div class="footer-left">

                <h1>{{$data_title[0]->content_english}}</h1>

                <p class="footer-links">
                    <a href="{{ Request::root() }}">Home</a>
                    -


                    <a href="{{ Request::root() }}/page/about">About</a>
                    -

                    <a href="{{ Request::root() }}/page/contact">Contact</a>
                </p>

                <p class="footer-company-name">{{ $site_copyright[0]->content_english }} &copy; {{ date('Y') }}</p>
            </div></div>
            <div class="col-md-4"><div class="footer-center">

                <div>
                    <i class="fa fa-map-marker"></i>
                    <p>{{ $constant_location[0]->content_english }}</p>
                </div>

                <div>
                    <i class="fa fa-phone"></i>
                    <p>{{ $constant_phone[0]->content_english }}</p>
                </div>

                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:{{ $constant_email[0]->content_english }}">{{ $constant_email[0]->content_english }}</a></p>
                </div>

            </div></div>
            <div class="col-md-4"> <div class="footer-right">
<?php
	$about_content = Page::where('slug','=', 'about')->get();
?>
                <p class="footer-company-about">
                    <span>About NARC</span>
                   {{ $about_content[0]->intro_text }}
                </p>

                <!--<div class="footer-icons">

                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>

                </div>-->

            </div></div>
        </div>
    </div>
</footer>
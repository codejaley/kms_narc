<section>

    <div class="container shadow banner_main">
        <div class="row">
            <div class="col-md-7 col-sm-7"> <div class="search_form"><h2>Search Our Knowledgebase</h2>
                <hr>

                <form name="search_frm" method="post" action="{{ Request::root() }}/search">
                <div class="form-group">

                    <input type="text" name="search_box" class="form-control search-input" id="search_box" placeholder="Hint : Use short keyword for better result">
                </div>

                <button type="submit" id="btn_submit" class="btn btn-default custom-button"><i class="fa fa-search"></i>
                     Search Now
				</button>
				
                <div class="form-group">
                       <br />
					   <br />
					    <select id="advance_option" class="selectpicker show-menu-arrow form-control" multiple data-max-options="1">
                            <option value="1">Advanced Search</option>
                            <option value="2">Published Date</option>
                            <option value="3">Author</option>
                        </select>
                </div>				
				
            </form>

            </div>


            </div>
<?php
	$about_content = Page::where('slug','=', 'about')->get();
?>           
		    <div class="col-md-4 col-sm-4 side-box"  >
                <h2>About <span>NARC</span></h2>
                <hr>
           		<p>{{ $about_content[0]->intro_text }}</p>


            </div>
        </div>



    </div>

</section>
<script>
$(document).ready(function() {
	$( "#btn_submit" ).click(function() {
		var search_text_length = $('#search_box').val().length;
	  	if(search_text_length > 2) {
			return true;	
		}		
		$('#search_box').focus();
		return false;
	});	
	
	$('#advance_option').on('change', function (e) {
		var optionSelected = $("option:selected", this);
		if (optionSelected.val() == 1) {
			location.href='{{ Request::root() }}/search/advance';
		} else if(optionSelected.val() == 2) {
			location.href='{{ Request::root() }}/items/browse/date';
		} else if(optionSelected.val() == 3) {
			location.href='{{ Request::root() }}/browse/authors';
		}
	});
});
</script>
<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>{{ $page[0]->title }}</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}">Home</a></li>
                        <li class="active">{{ $page[0]->title }}</li>
                    </ol>
                </div>

                <div class="row table_item_listing">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                         
                            <table class="table">
                                
                                <tbody>
                                <tr>
                                    <td>{{ $page[0]->description }}</td>
                                </tr>

                                </tbody>
                            </table>

                    </div>
                </div>


            </div>
            
        </div>
		
		@include('frontend.includes.sidebar_static_pages')	
		
    </div>

</section>
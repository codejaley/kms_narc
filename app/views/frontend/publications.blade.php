<section>

    <div class="container bg_grey shadow inner_container">
        <div class="row">
            <div class="col-md-8"><h2>Nature of Publications</h2>
                <div class="row">
                    <ol class="breadcrumb main_breadcrumbs">
                        <li><a href="{{ Request::root() }}">{{ Config::get('front-constants.HOME_CAPTION') }}</a></li>
                        <li class="active">Nature of Publications</li>
                    </ol>
                    <img src="{{Request::root()}}/images/publication.jpg">
                </div>

                <div class="row table_item_listing">
                    <div data-example-id="panel-without-body-with-table" class="bs-example">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Listed Items</div>
                            <table id="datatable" class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
								 <?php foreach($publications as $publication) { ?>
                                <tr>
                                    <td>
                                        <a href="{{ Request::root() }}/browse/publication/{{ $publication->id }}">{{ $publication->name }}</a>
                                        <?php if ($publication->nepali_name != '') {?>
                                            ({{$publication->nepali_name}})
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
            @include('frontend.includes.new_inner_pages_sidebar')
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable( {
            "order": [[ 0, "asc" ]],
            "pageLength": 20,
            "oLanguage": {
                "sSearch": "Quick Search: "
            }
        } );
    } );
</script>
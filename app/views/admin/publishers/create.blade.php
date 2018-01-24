<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>
<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>Publishers</h1>
        </div>

    </div>
    <!-- Breadcrumb starts	-->
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="#">Home</a>
                <i class="icon-angle-right"></i>
            </li>
        </ul>
    </div>
    <!-- Breadcrumb ends -->

    <!-- main container starts -->
    <div class="row-fluid">
        <div class="span12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="icon-edit"></i> Add new publisher</h3>
                </div>
                <div class="box-content">
                    {{ Form::open(array('route' => 'admin.publishers.store', 'files' => true,'class' => 'form-vertical')) }}
                    <div class="control-group">
                        <label for="textfield" class="control-label">Name</label>
                        <div class="controls">
                            {{ Form::text('name', null, array('class'=>'input-xxlarge', 'style'=>'width:1000px')) }}

                        </div>
                    </div>


                    <div class="control-group">
                        <label for="textfield" class="control-label">Description</label>
                        <div class="controls">
                            {{ Form::textarea('description', null, array('class'=>'ckeditor', 'size' => '30x6')) }}
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a href="{{ Request::root() }}/admin/publishers" class="btn">Cancel</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- main container ends -->

</div>
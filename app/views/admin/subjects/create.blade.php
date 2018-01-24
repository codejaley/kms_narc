<script src="/admin_root/js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script src="/admin_root/js/plugins/ckeditor/ckeditor.js"></script>
<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>Subjects</h1>
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
                    <h3><i class="icon-edit"></i> Add new</h3>
                </div>
                <div class="box-content">
                    {{ Form::open(array('route' => 'admin.subjects.store', 'files' => true,'class' => 'form-horizontal')) }}
                    <div class="control-group">
                        <label for="textfield" class="control-label">Name</label>
                        <div class="controls">
                            {{ Form::text('name', null, array('class'=>'input-xxlarge', 'style'=>'width:700px')) }}

                        </div>
                    </div>


                    <div class="control-group">
                        <label for="textfield" class="control-label">Nepali Caption</label>
                        <div class="controls">
                            {{ Form::text('name_nepali', null, array('class'=>'input-xxlarge', 'style'=>'width:700px')) }}

                        </div>
                    </div>

                    <div class="control-group">
                        <label for="select" class="control-label">Status</label>
                        <div class="controls">
                            {{ Form::select('is_active', array('1' => 'Yes', '0' => 'No'), '1');}}
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a href="{{ Request::root() }}/admin/subjects" class="btn">Cancel</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- main container ends -->

</div>
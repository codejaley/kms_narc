<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>Publishers</h1>
        </div>

    </div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="#">Home</a>
                <i class="icon-angle-right"></i>
            </li>
        </ul>

    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="icon-table"></i>
                        Publisher Listing
                    </h3>
                    <nav align="right">
                        <ul>
                            <li>
                                <a href="{{ Request::root() }}/admin/publishers/create" class="btn btn-primary">Add new</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="box-content nopadding">
                    <table class="table table-hover dataTable table-nomargin table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($publishers as $entry) { ?>
                        <tr>
                            <td><?php echo $entry->name; ?></td>
                            <td>
                                <?php
                                if($entry->is_active == 1) {
                                ?>
                                <p style="color:#99CC33">Active</p> <a href="{{ Request::root() }}/admin/publishers/change_status/d/{{ $entry->id }}"><i class="icon-remove"></i> Deactivate</a>
                                <?php } else { ?>
                                <p style="color:#FF0000">Deactive</p> <a href="{{ Request::root() }}/admin/publishers/change_status/a/{{ $entry->id }}"><i class="icon-reply"></i> Activate Now</a>
                                <?php } ?>
                            </td>
                            <td><a href="{{ Request::root() }}/admin/publishers/{{ $entry->id }}/edit"><i class="icon-edit"></i> Edit</a></td>
                            <td><a onclick="return confirm('Are you sure?');" href="{{ Request::root() }}/admin/delete/publishers/{{ $entry->id }}"><i class="icon-remove-sign"></i> Delete</a></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
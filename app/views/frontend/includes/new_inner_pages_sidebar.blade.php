<?php
$publications 	= Publication::where('is_active', '=', '1')->take(5)->get();
$subjects 		= Subject::where('is_active', '=', '1')->take(5)->get();
?>
<div class="col-md-4"> <h2>Browse By Nature of Publication</h2>



    <?php if (count($publications) > 0) { ?>
    <ul class="browse_repo">
        <?php foreach($publications as $publication) { ?>
        <li class="col-md-12 col-sm-6">
            <a href="{{ Request::root() }}/browse/publication/{{ $publication->id }}">{{ $publication->name }}</a>
        </li>
        <?php } ?>
    </ul>

    <div class="form-group">
        <a href="{{Request::root()}}/all/publications" class="btn btn-primary">Show All</a>
    </div>
    <?php } ?>
</div>

<div class="col-md-4"> <h2>Browse By Subject</h2>



    <?php if (count($subjects) > 0) { ?>
    <ul class="browse_repo">
        <?php foreach($subjects as $subject) { ?>
        <li class="col-md-12 col-sm-6">
            <a href="{{ Request::root() }}/browse/subject/{{ $subject->id }}">{{ $subject->name }}</a>
        </li>
        <?php } ?>
    </ul>
    <div class="form-group">
        <a href="{{Request::root()}}/all/subjects" class="btn btn-primary">Show All</a>
    </div>
    <?php } ?>
</div>

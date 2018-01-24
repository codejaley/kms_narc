<?php if (count($list_of_category) > 0) { ?>
    <ul>
    <?php foreach ($list_of_category as $category) { ?>
        @include('admin.partials.category', $category)
    <?php }  ?>
    </ul>
  <?php  } ?>
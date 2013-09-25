<a href="<?php eh(url('thread/login')) ?>">
	&larr; Logout
</a>
<h1>All threads</h1>
<ul>
  <?php foreach ($threads as $v): ?>
    <li>
		<a href="<?php eh(url('thread/view', array('thread_id' => $v->id, 'us' => $user))) ?>">
		<?php eh($v->title) ?>
		</a>
    </li>
  <?php endforeach ?>
</ul>

<div class="div-pagination">
    <div class="pagerfanta">
        <?php echo $html ?>
    </div>
</div>
<a class="btn btn-large btn-primary" href="<?php eh(url('thread/create', array('us'=>$user))) ?>">Create</a>

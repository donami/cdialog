<hr>

<h2>Comments</h2>

<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
<h4>Comment #<?=$id?></h4>
<p><?=dump($comment)?></p>
<?php endforeach; ?>
</div>

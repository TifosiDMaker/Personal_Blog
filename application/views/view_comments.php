<h4>评论区</h4>
<?php foreach ($comments as $row): ?>
	<div class="single-comment">
		<p class="comment-content">
			<?php echo nl2br(html_escape(html_entity_decode($row->comment))); ?>
		</p>
		<p class="comment-meta text-right">
			<?php echo $row->user; ?> 于 <?php echo $row->time; ?>
		</p>
	</div>
<?php endforeach; ?>

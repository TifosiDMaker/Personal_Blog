<h4>评论区</h4>
<?php foreach ($comments as $row): ?>
	<div class="single-comment">
		<p class="comment-content">
			<?php echo nl2br(html_escape(html_entity_decode($row->comment))); ?>
		</p>
		<p>
			<span class="comment-author">
				<?php echo $row->user; ?>
			</span>
			<span class="comment-time">
				<?php echo $row->time; ?>
			</span>
		</p>
	</div>
<?php endforeach; ?>

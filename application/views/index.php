<div id="bolg" class="container-fluid">
	<h1 class="text-center">Tifosi's Blog</h2>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10">
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<?php foreach ($article as $row): ?>
				<div class="single-article">
				<h3><?php echo anchor('article/'.$row->id, $row->post_title); ?></h3>
				<p class="post-meta">
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?php echo $row->post_date; ?>
					<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>  <?php echo anchor('#', $this->tifosi_model->get_term($row->id, 2)->term_name); ?>
					<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
					<?php foreach ($this->tifosi_model->get_term($row->id, 1) as $row_2)
					{
						if (!$row_2->term_name)
						{
							echo '';
						}
						else
						{
							echo anchor('#', $row_2->term_name).' | ';
						}
					} ?>
				</p>
				<p class="article-content">
					<?php echo nl2br(html_escape(html_entity_decode($row->post_content))); ?>
				</p>
				</div>
			<?php endforeach; ?>

			<?php echo $links; ?>
			<?php /*
			<nav aria-label="Page navigation">
				<ul class="pagination">
					<?php if ($page == 1): ?>
						<li class="disabled">
							<span>
								<span aria-hidden="true">&laquo;</span>
							</span>
						</li>
					<?php else: ?>
						<li>
							<a href="index.php?/<?php echo $page - 1; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
					<?php endif ?>
					<?php for ($i = 1; $i <= ceil($this->db->count_all('posts')/10); $i++)
					{
						if ($i == $page)
						{
							echo '<li class="active"><a href="index.php?/'.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
						}
						else
						{
							echo '<li>'.anchor($i, $i).'</li>';
						}
					} ?>
					<li>
						<a href='#' aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
			*/ ?>
		</div>

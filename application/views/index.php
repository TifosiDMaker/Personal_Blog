<div class="text-right top-row">
	<p>
		<?php echo anchor('admin/login', '登录'); ?> | <?php echo anchor('admin/signup', '注册'); ?>
	</p>
</div>
<h1 class="text-center">Tifosi's Blog</h2>
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
				<h3><?php echo anchor('#', $row->post_title); ?></h3>
				<p class="post-meta">
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?php echo $row->post_date; ?>
					<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>  分类
					<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>  标签
				</p>
				<p class="article-content">
					<?php echo $row->post_content; ?>
				</p>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="col-md-2">
			<h5 class="sub-title-right">分类</h5>
			<ul style="margin:0px; padding:0px 0px 0px 20px">
				<?php foreach ($category as $row): ?>
					<li>
					<?php echo anchor('#', $row->name); ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<h5 class="sub-title-right">标签</h5>
				<p>
					<?php foreach ($tag as $row): ?>
						<span class="tags">
						<?php echo anchor('#', $row->name); ?>
						</span>
					<?php endforeach; ?>
				</p>
			<h5 class="sub-title-right">About me</h5>
	</div>
</div>

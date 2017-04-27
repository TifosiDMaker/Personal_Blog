<div class="col-md-9">
	<h3>所有文章</h3>
	<br />
	<p>
		<?php echo anchor('admin/all_articles/all', '全部').' ('.$count['all'].') | '; ?>
		<?php echo anchor('admin/all_articles/public', '公开').' ('.$count['public'].') | '; ?>
		<?php echo anchor('admin/all_articles/private', '私密').' ('.$count['private'].') | '; ?>
		<?php echo anchor('admin/all_articles/draft', '草稿').' ('.$count['draft'].') | '; ?>
		<?php echo anchor('admin/all_articles/trash', '垃圾桶').' ('.$count['trash'].') | '; ?>
	</p>
	<table class="table">
		<thead>
			<tr>
				<th width="600">标题</th>
				<th>分类</th>
				<th>标签</th>
				<th>时间</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($article as $row): ?>
			<tr height="68">
				<td>
					<?php echo anchor('article/'.$row->id, $row->post_title); ?>
					<br />
					<p class="hover_display"><small>
						<a href="#" class="edit_article">编辑文章</a>
						<span style="color:grey"> | </span>
						<span>
						<a href="#" class="red_link">移入垃圾桶</a>
						</span>
					</small></p>
				</td>
				<td><?php echo anchor($this->tifosi_model->get_term($row->id, 2)->term_id.'/0', $this->tifosi_model->get_term($row->id, 2)->term_name); ?></td>
				<td>
					<?php foreach ($this->tifosi_model->get_term($row->id, 1)as $row_2)
					{
						if (!$row_2->term_name)
						{
							echo '';
						}
						else
						{
							echo anchor($row_2->term_id.'/0', $row_2->term_name).'、';
						}
					} ?>
				</td>
				<td><?php echo $row->post_date; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<?php echo $links; ?>
</div>

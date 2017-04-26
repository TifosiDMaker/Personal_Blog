<div class="col-md-9">
	<h3>所有文章</h3>
	<table class="table">
		<thead>
			<tr>
				<th>标题</th>
				<th>分类</th>
				<th>标签</th>
				<th>时间</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($article as $row): ?>
			<tr>
				<td><?php echo anchor('article/'.$row->id, $row->post_title); ?></td>
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

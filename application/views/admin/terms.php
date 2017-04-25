<div class="col-md-3">
	<?php echo '<h3>'.$header.'</h4>'; ?>
	<?php echo form_open('admin/terms/'.$header); ?>
	<?php echo validation_errors(); ?>
		<div class="form-group">

			<?php echo form_hidden('term', $term); ?>
			<?php echo '<label for="name">添加新'.$header.'</label>'; ?>
			<input class="form-control" name="name">
		</div>
		<button type="submit" class="btn btn-primary">提交</button>
	</form>
</div>
<div class="col-md-5" style="margin-top:50px">
	<table class="table table-stroped">
		<thead>
			<tr>
				<th>名称</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($terms as $row): ?>
			<tr>
				<?php echo '<td>'.$row->term_name.'</td>'; ?>
				<td>
					<a href="<?php echo '#'; ?>" class="blue_link">编辑</a>
					<span style="color:grey"> | </span><span>
						<a href="javascript:confirmIt('<?php echo site_url().'/admin/delete_term/'.$row->term_id; ?>')" class="red_link">删除</a>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
</div>

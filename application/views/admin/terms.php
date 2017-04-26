<div class="col-md-3">
	<?php echo '<h3>'.$header.'</h3>'; ?>
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
				<th class="table_term_id">ID</th>
				<th>名称</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($terms as $row): ?>
			<tr>
				<?php echo '<td class="table_term_id">'.$row->term_id.'</td>'; ?>
				<?php echo '<td class="table_term_name">'.$row->term_name.'</td>'; ?>
				<td>
					<a href="#" class="blue_link">编辑</a>
					<span style="color:grey"> | </span><span>
						<a href="javascript:confirmIt('<?php echo site_url().'/admin/delete_term/'.$row->term_id; ?>')" class="red_link">删除</a>
					</span>
				</td>
			</tr>
			<tr class="no_border edit_form">
			<td colspan="2">
				<?php echo form_open('admin/edit_term', 'class="form-inline"'); ?>
					<div class="form-group">
						<label class="sr-only" for="term_name">term name</label>
						<input name="term_id" type="hidden" class="form-control" value="<?php echo $row->term_id; ?>">
						<input name="term_name" class="form-control" value="<?php echo $row->term_name; ?>">
					</div>
					<button class="btn btn-default cancle_button">取消</button>
					<button type="submit" class="btn btn-primary">提交</button>
				</form>
			</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
</div>

<?php $hidden = array('id' => $id);
	echo form_open('index/comment', '', $hidden); ?>
	<div class="form-group">
		<label for="comment">评论</label>
		<textarea class="form-control" rows=5 name="comment" required></textarea>
	</div>
	<button type="submit" class="btn btn-primary">提交</button>
</form>
</div>

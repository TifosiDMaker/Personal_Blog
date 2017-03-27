<div class="container" style="margin-top:100px">
	<div class="row farme">
		<div class="col-md-4 col-md-offset-4">
			<?php echo form_open('admin/signup'); ?>
				<div class="form-group">
					<label for="username">用户名</label>
					<input class="form-control" id="username">
				</div>
				<div class="form-group">
					<label for="password">密码</label>
					<input class="form-control" id="password">
				</div>
				<div class="form-group">
					<label for="confirm">确认密码</label>
					<input class="form-control" id="confirm">
				</div>
				<button type="submit" class="btn btn-primary">注册</button>
			</form>
		</div>
	</div>
</div>

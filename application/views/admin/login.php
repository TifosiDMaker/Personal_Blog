<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<div class="container">
		<div class="row farme">
		<div class="col-md-4 col-md-offset-4">
			<?php echo form_open('admin/login'); ?>
			<div class="form-group">
				<label for="username">用户名</label>
				<input class="form-control" id="username">
			</div>
			<div class="form-group">
				<label for"password">密码</label>
				<input class="form-control" id="password">
			</div>
			<button type="submit" class="btn btn-primary">登录</button>
			</form>
		</div>
		</div>
		</div>
	</body>
</html>

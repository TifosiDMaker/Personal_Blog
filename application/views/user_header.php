</head>
<body>
<div class="row top-row">
	<div class="col-md-6">
		<?php echo anchor('', '首页'); ?>
	</div>
	<div class="col-md-6 text-right">
	<?php echo '欢迎您'.anchor('admin/write_article', $_SESSION['username']).'，'.anchor('admin/logout', '登出'); ?>
	</div>
</div>

<html>
	<head>
		<title>Management</title>
		<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	</head>
	<body>
		<div class="text-right top-row" style="margin:3px 10px 0px 0px">
			<?php echo anchor('admin/logout', '登出'); ?>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<nav class="navbar navbar-default navbar-fixed-side">
						<ul class="nav sidebar-nav">
							<li><a href="#">文章</a></li>
							<li class="sidebar-menu-item open">
								<ul class="sidebar-submenu">
									<li class="sidebar-menu-item"><a href="#">所有文章</a></li>
									<?php echo '<li class="sidebar-menu-item">'.anchor('admin/write_article', '写文章').'</li>'; ?>
									<?php echo '<li class="sidebar-menu-item">'.anchor('admin/terms/category', '分类').'</li>'; ?>
									<?php echo '<li class="sidebar-menu-item">'.anchor('admin/terms/tag', '标签').'</li>'; ?>
								</ul>
							<li><a href="#">评论</a></li>
						</ul>
					</nav>
				</div>
				

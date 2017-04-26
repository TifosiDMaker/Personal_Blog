		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<nav class="navbar navbar-default navbar-fixed-side">
						<ul class="nav sidebar-nav">
							<li><a href="#">文章</a></li>
							<li class="sidebar-menu-item open">
								<ul class="sidebar-submenu">
									<li class="sidebar-menu-item"><?php echo anchor('admin/all_articles', '所有文章'); ?></li>
									<?php echo '<li class="sidebar-menu-item">'.anchor('admin/write_article', '写文章').'</li>'; ?>
									<?php echo '<li class="sidebar-menu-item">'.anchor('admin/terms/category', '分类').'</li>'; ?>
									<?php echo '<li class="sidebar-menu-item">'.anchor('admin/terms/tag', '标签').'</li>'; ?>
								</ul>
							<li><a href="#">评论</a></li>
						</ul>
					</nav>
				</div>
				

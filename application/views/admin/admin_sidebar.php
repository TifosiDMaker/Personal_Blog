<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <nav class="navbar navbar-default navbar-fixed-side">
                <ul class="nav sidebar-nav">
                    <li class="sidebar-menu-item except1"><a href="#">文章</a></li>
                    <div class="hide1 nav sidebar-nav">
                    <li class="sidebar-menu-item hide1"><?php echo anchor('admin/allArticles', '所有文章'); ?></li>
                    <li class="sidebar-menu-item hide1"><?php echo anchor('admin/writeArticle', '写文章'); ?></li>
                    <li class="sidebar-menu-item hide1"><?php echo anchor('admin/terms/category', '分类'); ?></li>
                    <li class="sidebar-menu-item hide1"><?php echo anchor('admin/terms/tag', '标签'); ?></li>
                    </div>
                    <li><a href="#">评论</a></li>
                    <li class="sidebar-menu-item except2"><a href="#">用户</a></li>
                    <div class="hide2 nav sidebar-nav">
                    <li class="sidebar-menu-item"><a href="#">账户管理</a></li>
                    <li class="sidebar-menu-item"><a href="#">用户管理</a></li>
                    </div>
                </ul>
            </nav>
        </div>

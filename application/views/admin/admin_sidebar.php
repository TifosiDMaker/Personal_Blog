<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
            <nav class="navbar navbar-default navbar-fixed-side">
                <ul class="nav sidebar-nav">
                    <li class="sidebar-menu-item except1"><a href="#">文章</a></li>
                    <div class="hide1 nav sidebar-nav">
                    <li class="sidebar-menu-item hide1"><? echo anchor('admin/allArticles', '所有文章'); ?></li>
                    <li class="sidebar-menu-item hide1"><? echo anchor('admin/writeArticle', '写文章'); ?></li>
                    <li class="sidebar-menu-item hide1"><? echo anchor('admin/terms/category', '分类'); ?></li>
                    <li class="sidebar-menu-item hide1"><? echo anchor('admin/terms/tag', '标签'); ?></li>
                    </div>
                    <li><? echo anchor('admin/comments/all', '评论'); ?></a></li>
                    <li class="sidebar-menu-item except2"><a href="#">用户</a></li>
                    <div class="hide2 nav sidebar-nav">
                    <li class="sidebar-menu-item"><? echo anchor('admin/account', '账户管理'); ?></li>
                    <li class="sidebar-menu-item"><? echo anchor('admin/roleManagement', '用户管理'); ?></li>
                    </div>
                </ul>
            </nav>
        </div>

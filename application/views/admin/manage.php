<div class="col-md-9 col-md-offset-1">
    <h3>用户管理</h3>
    <br />
    <table class="table">
        <thead>
            <tr>
                <th>用户名</th>
                <th>角色</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $row): ?>
            <tr>
                <td><?php echo $row->username; ?></td>
                <td><?php echo $row->role_name; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br />
    <br />
    <div id="roleManage">
    <h3>
        角色管理
        <small>
            <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
        </small>
    </h3>
    </div>
    <br />
    <div class="hidden-part form-group" id="needHide">
        <label>角色名称  
            <input list="roles" name="viewRoles" />
        </label>
        <datalist id="roles">
            <? foreach ($roles as $row) {
                echo '<option value="'.$row->role_name.'">';
            }
            ?>
        </datalist>
        <br />
        <br />
        <table>
            <tr>
                <td>
                    <p>写文章 </p>
                    <label class="radio-inline">
                        <input type="radio" name="writeArticle" value=1>是
                        <input type="radio" name="writeArticle" value=0>否
                    </label>
                </td>
                <td>
                    <p>编辑所有文章</p>
                    <label class="radio-inline">
                        <input type="radio" name="writeAllArticle" value=1>是
                        <input type="radio" name="writeAllArticle" value=0>否
                    </label>
                </td>
            </tr>
    </div>
</div>
                

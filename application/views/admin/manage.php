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
    <h3>
        角色管理
        <small>
            <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
        </small>
    </h3>
    <br />
    <div class="hidden-part form-group">
        <label for="role">角色名称</label>
        <select class="form-control" name="category">
            <? foreach ($role as $row) {
                echo '<option>'.$row->role_name.'</option>';
            }
                echo '<option>--新建--</option>';
            ?>
        </select>
    </div>
</div>
                

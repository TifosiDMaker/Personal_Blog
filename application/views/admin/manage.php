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
                <td><?php echo $row->permission; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
                

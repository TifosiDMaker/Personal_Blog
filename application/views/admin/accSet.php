<div class="col-md-9 col-md-offset-1">
    <h3><?php echo $_SESSION['username']; ?> 账户设置</h3>
    <br />
    <h4>修改密码</h4>
    <br />
    <br />
    <form id="changePassword">
        <div class="form-group">
            <label for="currentPassword">原密码</label>
            <input class="form-control shortFiled" id="currentPassword" type="password" name="currentPassword">
        </div>
        <div class="form-group">
            <label for="newPassword">新密码</label>
            <input class="form-control shortFiled" id="newPassword" type="password" name="newPassword">
        </div>
        <div class="form-group">
            <label for="confirmPassword">确认新密码</label>
            <input class="form-control shortFiled" id="confirmPassword" type="password" name="confirmPassword">
        </div>
        <button type="submit" class="btn btn-primary" action="#">确认</button>
    </form>
</div>

<div class="col-md-9 col-md-offset-1">
    <h3><?php echo $_SESSION['username']; ?>，账户设置</h3>
    <br />
    <h4>修改密码</h4>
    <form>
        <div class="form-group">
            <input class="form-control" id="oldPassword" value="<? echo $this->tifosi_model->passwordQuery; ?>">
        <div class="form-group">
            <label for="currentPassword">原密码</label>
            <input class="form-control" id="currentPassword" type="password">
        </div>
        <div class="form-group">
            <label for="newPassword">新密码</label>
            <input class="form-control" id="newPassword" type="password">
        </div>
        <div class="form-group">
            <label for="confirmPassword">确认新密码</label>
            <input class="form-control" id="confirmPassword" type="password">
        </div>
        <button type="submit" class="btn btn-primary" action="#">确认</button>
    </form>
</div>

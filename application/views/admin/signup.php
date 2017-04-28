<div class="container" style="margin-top:100px">
    <div class="row farme">
        <div class="col-md-4 col-md-offset-4">
            <?php echo validation_errors(); ?>
            <?php echo form_open('admin/signup'); ?>
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input class="form-control" name="username" aria-describedby="helpBlock">
                    <span class="help-block">请输入三个字符以上的用户名</span>
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input class="form-control" name="password" type="password" aria-describedby="helpBlock">
                    <span class="help-block">密码最低位数为 8 位</span>
                </div>
                <div class="form-group">
                    <label for="confirm">确认密码</label>
                    <input class="form-control" name="confirm" type="password">
                </div>
                <button type="submit" class="btn btn-primary">注册</button>
            </form>
        </div>
    </div>
</div>

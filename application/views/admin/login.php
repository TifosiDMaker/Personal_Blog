<div class="container" style="margin:100px 400px 100px 400px">
    <div class="row farme">
        <div class="col-md-4 col-md-offset-4">
            <?php echo validation_errors(); ?>
            <?php echo form_open('login'); ?>
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input class="form-control" name="password" type="password">
                </div>
                <button type="submit" class="btn btn-primary">登录</button>
                <br />
                <br />
                <?php echo anchor('signup', '注册'); ?>
            </form>
        </div>
    </div>
</div>

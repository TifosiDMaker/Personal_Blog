<h3>写文章</h3>
<?php echo form_open('admin/write_article'); ?>
<?php echo validation_errors(); ?>
    <div class="col-md-8">
        <div class="form-group">
            <label for="articleTitle">标题</label>
            <input class="form-control" name="articleTitle">
        </div>
        <div class="form-group">
            <label for="article">正文</label>
            <textarea class="form-control" rows=20 name="article"></textarea>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="tags">标签</label>
            <input class="form-control" name="tags" placeholder="多个标签请用英文逗号分隔">
        </div>
        <p class="help-block">常用标签</p>
        <br />
        <label for="status">文章类型</label>
        <label class="radio-inline">
            <input type="radio" name="status" value="public"> 公开
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" value="private"> 私密
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" value="draft"> 草稿 
        </label>
        <br />
        <br />
        <label for="category">分类</label>
        <select class="form-control" name="category">
            <?php foreach ($term as $row) {
                    echo '<option>'.$row->term_name.'</option>';
                }
            ?>
        </select>
        <br />
        <button type="submit" class="btn btn-primary">提交</button> 
    </div>
</form>

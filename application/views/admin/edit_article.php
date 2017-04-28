<h3>写文章</h3>
<?php echo form_open('admin/writeArticle'); ?>
<?php echo validation_errors(); ?>
    <div class="col-md-8">
        <div class="form-group">
            <label for="articleTitle">标题</label>
            <input class="form-control" name="articleTitle" value="<?php echo $post_title; ?>">
        </div>
        <div class="form-group">
            <label for="article">正文</label>
            <textarea class="form-control" rows=20 name="article"><?php echo $post_content; ?></textarea>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="tags">标签</label>
            <input class="form-control" name="tags" value="<?php echo $post_tag; ?>">
        </div>
        <p class="help-block">常用标签</p>
        <br />
        <label for="status">文章类型</label>
        <label class="radio-inline">
        <?php if ($post_status == 'public') {
            echo '<input type="radio" name="status" value="public" checked="checked"> 公开';
        } else {
    echo '<input type="radio" name="status" value="public"> 公开';
} ?>
        </label>
        <label class="radio-inline">
        <?php if ($post_status == 'private') {
            echo '<input type="radio" name="status" value="private" checked="checked"> 私密';
        } else {
    echo '<input type="radio" name="status" value="private"> 私密';
} ?>
        </label>
        <label class="radio-inline">
        <?php if ($post_status == 'draft') {
            echo '<input type="radio" name="status" value="draft" checked="checked"> 草稿 ';
        } else {
    echo '<input type="radio" name="status" value="draft"> 草稿 ';
} ?>
        </label>
        <br />
        <br />
        <label for="category">分类</label>
        <select class="form-control" name="category">
            <?php foreach ($term as $row) {
                if ($row->term_name == $post_category) {
                    echo '<option selected="slected">'.$row->term_name.'</option>';
                } else {
                    echo '<option>'.$row->term_name.'</option>';
                }
            }
            ?>
        </select>
        <br />
        <button type="submit" class="btn btn-primary">提交</button>
    </div>
</form>

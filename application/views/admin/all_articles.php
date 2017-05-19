<div class="col-md-9 col-md-offset-1">
    <h3>所有文章</h3>
    <br />
    <p>
        <?php echo anchor('admin/allArticles/all', '全部').' ('.$count['all'].') | '; ?>
        <?php echo anchor('admin/allArticles/public', '公开').' ('.$count['public'].') | '; ?>
        <?php echo anchor('admin/allArticles/private', '私密').' ('.$count['private'].') | '; ?>
        <?php echo anchor('admin/allArticles/draft', '草稿').' ('.$count['draft'].') | '; ?>
        <?php echo anchor('admin/allArticles/trash', '垃圾桶').' ('.$count['trash'].') | '; ?>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th width="600">标题</th>
                <th>分类</th>
                <th>标签</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($article as $row): ?>
            <tr height="68">
                <td>
                    <?php echo anchor('article/'.$row->id, $row->post_title); ?>
                    <br />
                    <p class="hover_display"><small>
                        <?php if($filter == 'trash'): ?>
                            <?php echo anchor('admin/outOfTrash/'.$row->id, '还原至公开'); ?>
                            <span style="color:gery"> | </span>
                            <span>
                            <?php echo anchor('admin/deleteArticle/'.$row->id, '彻底删除', 'class="red_link"'); ?>
                            </span>
                        <?php else: ?>
                        <?php echo anchor('admin/writeArticle/'.$row->id, '编辑文章', 'class="edit_article"'); ?>
                        <span style="color:grey"> | </span>
                        <span>
                        <?php echo anchor('admin/moveToTrash/'.$row->id, '移入垃圾桶', 'class="red_link"'); ?>
                        </span>
                        <?php endif; ?>
                    </small></p>
                </td>
                <td><?php echo anchor($this->tifosi_model->getTerm($row->id, 2)->term_id.'/0', $this->tifosi_model->getTerm($row->id, 2)->term_name); ?></td>
                <td>
                    <?php foreach ($this->tifosi_model->getTerm($row->id, 1)as $row_2)
                    {
                        if (!$row_2->term_name) {
                            echo '';
                        } else {
                            echo anchor($row_2->term_id.'/0', $row_2->term_name).' | ';
                        }
                    } ?>
                </td>
                <td><?php echo $row->post_date; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php echo $links; ?>
</div>

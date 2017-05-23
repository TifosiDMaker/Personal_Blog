<div class="col-md-9 col-md-offset-1">
    <h3>评论</h3>
    <br />
    <p>
        <?php echo anchor('admin/comments/all', '全部').' ('.$count['all'].') | '; ?>
        <?php echo anchor('admin/comments/checked', '已批准').' ('.$count['checked'].') | '; ?>
        <?php echo anchor('admin/comments/uncheck', '待审核').' ('.$count['uncheck'].') | '; ?>
        <?php echo anchor('admin/comments/trash', '垃圾桶').' ('.$count['trash'].') | '; ?>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th>作者</th>
                <th>评论</th>
                <th></th>
                <th>回复至</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($comment as $row): ?>
            <tr height="68">
                <td>
                    <?php echo $row->user; ?>
                </td>
                <td>
                    <?php echo $row->comment; ?>
                    <br />
                    <p class="hover_display"><small>
                        <?php if($filter == 'trash'): ?>
                            <?php echo anchor('admin/outOfTrash/comments/'.$row->id, '恢复'); ?>
                            <span style="color:gery"> | </span>
                            <span>
                            <?php echo anchor('admin/deleteItem/comments/'.$row->id, '彻底删除', 'class="red_link"'); ?>
                            </span>
                        <?php elseif($filter != 'trash'): ?>
                        <?php echo anchor('admin/writeArticle/'.$row->id, '编辑', 'class="edit_article"'); ?>
                        <span style="color:grey"> | </span>
                        <span>
                        <?php echo anchor('admin/moveToTrash/comments/'.$row->id, '移入垃圾桶', 'class="red_link"'); ?>
                        </span>
                        <?php endif; ?>
                    </small></p>
                </td>
                <td>
                <?php if ($row->status == 'uncheck'): ?>
                    <p><small style="color:rgb(255,102,0)">未审核</small></p>
                <?php endif; ?>
                </td>
                <td>
                    <?php echo anchor('article/'.$row->pid, $row->post_title); ?>
                </td>
                <td>
                    <?php echo $row->time; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php echo $links; ?>
</div>

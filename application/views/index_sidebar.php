        <div class="col-md-2">
            <h5 class="sub-title-right">分类</h5>
            <ul style="margin:0px; padding:0px 0px 0px 20px">
                <?php foreach ($category as $row): ?>
                    <li>
                    <?php echo anchor($row->term_id.'/0', $row->term_name); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h5 class="sub-title-right">标签</h5>
                <p>
                    <?php foreach ($tag as $row): ?>
                        <span class="tags">
                        <?php if (!$row->term_name) {
                            echo '';
                        } else {
    echo anchor($row->term_id.'/0', $row->term_name);
                        } ?>
                        </span>
                    <?php endforeach; ?>
                </p>
            <h5 class="sub-title-right">About me</h5>
    </div>
</div>

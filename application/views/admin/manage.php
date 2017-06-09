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
                <td><?php echo $row->role_name; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br />
    <br />
    <div id="roleManage">
    <h3>
        角色管理
        <small>
            <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
        </small>
    </h3>
    </div>
    <br />
    <div class="hidden-part form-group" id="needHide">
        <label>角色名称  
            <input list="roles" name="viewRoles" />
        </label>
        <datalist id="roles">
            <? foreach ($roles as $row) {
                echo '<option value="'.$row->role_name.'">';
            }
            ?>
        </datalist>
        <br />
        <br />
        <table>
            <tr>
                <td class="nameCol">
                    <b>写文章 </b>
                </td>
                <td class="valueCol">
                    <label class="radio-inline">
                        <input type="radio" name="write_article" value=1>是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="write_article" value=0>否
                    </label>
                </td>
                <td class="nameCol">
                    <b>编辑所有文章 </b>
                </td>
                <td class="valueCol">
                    <label class="radio-inline">
                        <input type="radio" name="write_all_article" value=1>是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="write_all_article" value=0>否
                    </label>
                </td>
            </tr>
            <tr>
                <td class="nameCol">
                    <b>评论 </b>
                </td>
                <td class="valueCol">
                    <label class="radio-inline">
                        <input type="radio" name="write_comment" value=1>是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="write_comment" value=0>否
                    </label>
                </td>
                <td class="nameCol">
                    <b>审核评论 </b>
                </td>
                <td class="valueCol">
                    <label class="radio-inline">
                        <input type="radio" name="check_comment" value=1>是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="check_comment" value=0>否
                    </label>
                </td>
            </tr>
            <tr>
                <td class="nameCol">
                    <b>编辑标签 </b>
                </td>
                <td class="valueCol">
                    <label class="radio-inline">
                        <input type="radio" name="edit_tag" value=1>是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="edit_tag" value=0>否
                    </label>
                </td>
                <td class="nameCol">
                    <b>角色权重 </b>
                </td>
                <td class="valueCol">
                    <label>
                    <select class="form-control">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="nameCol">
                    <b>访问后台</b>
                </td>
                <td class="valueCol">
                    <label class="radio-inline">
                        <input type="radio" name="permission" value=1>是 
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="permission" value=0>否
                    </label>
                </td>
                <td class="nameCol">
                    <button type="submit" class="btn btn-primary">提交</button>
                <td>
            </tr>
        </table>
    </div>
</div>
                

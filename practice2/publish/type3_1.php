<script>
    function step3_add(btn) {
        var tr = $(btn).parents('tr');
        if($(btn).attr('data-val') == "add")
        {
            var newTr = tr.clone();
            newTr.find(":button").html("del");
            newTr.find(":button").attr('data-val','del');
            newTr.find(":button").removeClass("layui-btn-normal");
            newTr.find(":button").addClass("layui-btn-danger");
            newTr.find("input[name='step3_keywords[]']").val('');
            newTr.find("input[name='step3_num[]']").val('');
            $("#addTr").after(newTr);
        }
        else{
            tr.remove();
        }
    }
</script>
<table class="layui-table" lay-skin="line">
    <thead>
    <tr style="background-color:#66CCFF;color:black;">
        <th>
            <input type="radio" name="step3_type" value="1" lay-verify="required"
                <?php if($info['step3_type'] == 1){ echo "checked='checked'";}?>
            >
            普通好评任务(默认为5星无评价内容,如需评价请备注,但不可规定评价内容)
        </th>
    </tr>
    </thead>
    <tbody>
    <?php if($info['step3_type'] == 1 || !empty($info['step3_keywords']) || !empty($info['step3_num'])){
    $step3_num=json_decode($info['step3_num'],true);
    $step3_keywords=json_decode($info['step3_keywords'],true);
    $num=count($step3_num);
    for($i=1;$i<=$num;$i++){?>
    <tr id="addTr">
        <td>
            <div class="layui-form-item" style="margin-bottom:0px;">
                <label class="layui-form-label" style="width:115px;padding:9px 0px;">搜索关键词:</label>
                <div class="layui-input-inline" style="width:70%;">
                    <input type="text" name="step3_keywords[]" value="<?php echo $step3_keywords[$i-1];?>" class="layui-input" style="width:230px;display:inline;">
                    添加垫付
                    <input type="text" name="step3_num[]" value="<?php echo $step3_num[$i-1];?>" class="layui-input" style="width:100px;display:inline;">单
                    <?php if($i == 1){?>
                        <button type="button" class="layui-btn layui-btn-normal layui-btn-radius" onclick="step3_add(this);" data-val="add">add</button>
                    <?php }else{?>
                        <button type="button" class="layui-btn layui-btn-danger layui-btn-radius" onclick="step3_add(this);" data-val="del">del</button>
                    <?php }?>
                </div>
            </div>
        </td>
    </tr>
    <?php }?>
    <?php }else{?>
    <tr id="addTr">
        <td>
            <div class="layui-form-item" style="margin-bottom:0px;">
                <label class="layui-form-label" style="width:115px;padding:9px 0px;">搜索关键词:</label>
                <div class="layui-input-inline" style="width:70%;">
                    <input type="text" name="step3_keywords[]" class="layui-input" style="width:230px;display:inline;">
                    添加垫付
                    <input type="text" name="step3_num[]" class="layui-input" style="width:100px;display:inline;">单
                    <button type="button" class="layui-btn layui-btn-normal layui-btn-radius" onclick="step3_add(this);" data-val="add">add</button>
                </div>
            </div>
        </td>
    </tr>
    <?php }?>
    </tbody>
</table>
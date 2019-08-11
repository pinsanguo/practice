<table class="layui-table" lay-skin="line">
    <thead>
    <tr style="background-color:#66CCFF;color:black;">
        <th>
            <input type="radio" name="step3_type" value="2" lay-verify="required"
                <?php if($info['step3_type'] == 2){ echo "checked='checked'";}?>
            >
            指定文字好评任务(文字好评任务佣金+3金/单)
        </th>
    </tr>
    </thead>
    <tbody>
    <script>
        jQuery(function(){
            jQuery("input[name='step3_words_num']").change(function(){
                var num=$('input[name="step3_words_num"]').val();
                var tr=$('#step3_2_add');
                tr.siblings().remove('.type3_cont2');
                for(var i=num;i>=2;i--){
                    var newTr = tr.clone();
                    newTr.find('input[name="step3_words_con[]"]').html('');
                    newTr.find('.num').html(i);
                    newTr.find('.num2').html(i);
                    $("#step3_2_add").after(newTr);
                }
            });
        });
    </script>
    <tr>
        <td>
            设置指定文本好评内容
            <div class="layui-form-item" style="margin-bottom:0px;">
                <label class="layui-form-label" style="width:115px;padding:9px 0px;">指定图片好评:</label>
                <div class="layui-input-inline" style="width:70%;">
                    <input type="text" name="step3_words_num" class="layui-input" style="width:230px;display:inline;" value="<?php echo $info['step3_words_num'];?>">单
                </div>
            </div>
        </td>
    </tr>
    <?php if($info['step3_type'] == 2 || !empty($info['step3_words_num'])){
        $step3_words_con=json_decode($info['step3_words_con'],true);
        for($i=1;$i<=$info['step3_words_num'];$i++){?>
            <tr id="step3_2_add" class="type3_cont2">
                <td>
                    <span style="color:#009DDA;font-size:35px;" class="num"><?php echo $i;?></span>设置第<span class="num2">1</span>单的文字
                    <div class="layui-form-item layui-form-text">
                        <div class="layui-input-block">
                            <textarea placeholder="可填写完整的评价内容，最多99个字" name="step3_words_con[]" class="layui-textarea"><?php echo $step3_words_con[$i-1];?></textarea>
                        </div>
                    </div>
                </td>
            </tr>
        <?php }?>
    <?php }else{?>
        <tr id="step3_2_add">
            <td>
                <span style="color:#009DDA;font-size:35px;" class="num">①</span>设置第<span class="num2">1</span>单的文字
                <div class="layui-form-item layui-form-text">
                    <div class="layui-input-block">
                        <textarea placeholder="可填写完整的评价内容，最多99个字" name="step3_words_con[]" class="layui-textarea"></textarea>
                    </div>
                </div>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
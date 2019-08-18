<?php
//saleExcel.php  导出excel
session_start();
require_once('./public/conf.php');
if(!empty($_POST['info'])){
    $_info=$_POST['info'];
    print_r($_info);die();

}
$a='[{"id":16,"sale_name":"启灵科技","userId":33,"number":20,"amount":"4000.00","status":1,"is_first":1,"benren":23,"parent":30,"userName":"lian1","userTitle":"合伙人","meTitle":"董事","userParent":"zong","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":30,"dong1":18,"dong2":19,"dong3":20},{"id":15,"sale_name":"启灵科技","userId":30,"number":6,"amount":"1200.00","status":1,"is_first":0,"benren":23,"parent":28,"userName":"zong","userTitle":"总裁","meTitle":"董事","userParent":"chengxu5","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":14,"sale_name":"启灵科技","userId":30,"number":200,"amount":"40000.00","status":1,"is_first":0,"benren":23,"parent":28,"userName":"zong","userTitle":"总裁","meTitle":"董事","userParent":"chengxu5","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":13,"sale_name":"启灵科技","userId":31,"number":200,"amount":"40000.00","status":2,"is_first":0,"benren":23,"parent":30,"userName":"zong1","userTitle":"总裁","meTitle":"董事","userParent":"zong","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":12,"sale_name":"启灵科技","userId":31,"number":200,"amount":"40000.00","status":2,"is_first":1,"benren":23,"parent":30,"userName":"zong1","userTitle":"总裁","meTitle":"董事","userParent":"zong","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":11,"sale_name":"启灵科技","userId":30,"number":150,"amount":"30000.00","status":1,"is_first":null,"benren":23,"parent":28,"userName":"zong","userTitle":"总裁","meTitle":"董事","userParent":"chengxu5","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":10,"sale_name":"启灵科技","userId":30,"number":80,"amount":"16000.00","status":1,"is_first":1,"benren":23,"parent":28,"userName":"zong","userTitle":"总裁","meTitle":"董事","userParent":"chengxu5","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":9,"sale_name":"启灵科技","userId":30,"number":200,"amount":"40000.00","status":1,"is_first":1,"benren":23,"parent":28,"userName":"zong","userTitle":"总裁","meTitle":"董事","userParent":"chengxu5","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":7,"sale_name":"启灵科技","userId":18,"number":3,"amount":"450.00","status":2,"is_first":null,"benren":23,"parent":19,"userName":"admin2","userTitle":"董事","meTitle":"董事","userParent":"张三","userParTitle":"董事","sale_price":"150.00","userChild":"20","zong1":"无","dong1":"无","dong2":"无","dong3":"无"},{"id":6,"sale_name":"启灵科技","userId":27,"number":2,"amount":"400.00","status":2,"is_first":null,"benren":23,"parent":26,"userName":"chengxu4","userTitle":"合伙人","meTitle":"董事","userParent":"chengxu3","userParTitle":"联合创始人","sale_price":"200.00","userChild":"20","zong1":24,"dong1":18,"dong2":19,"dong3":20},{"id":5,"sale_name":"启灵科技","userId":26,"number":1,"amount":"200.00","status":2,"is_first":null,"benren":23,"parent":24,"userName":"chengxu3","userTitle":"联合创始人","meTitle":"董事","userParent":"chengxu","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":24,"dong1":18,"dong2":19,"dong3":20},{"id":4,"sale_name":"启灵科技","userId":25,"number":2,"amount":"400.00","status":2,"is_first":null,"benren":23,"parent":24,"userName":"chengxu2","userTitle":"联合创始人","meTitle":"董事","userParent":"chengxu","userParTitle":"总裁","sale_price":"200.00","userChild":"20","zong1":24,"dong1":18,"dong2":19,"dong3":20},{"id":3,"sale_name":"启灵科技","userId":24,"number":3,"amount":"600.00","status":2,"is_first":null,"benren":23,"parent":18,"userName":"chengxu","userTitle":"总裁","meTitle":"董事","userParent":"admin2","userParTitle":"董事","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":2,"sale_name":"启灵科技","userId":24,"number":2,"amount":"400.00","status":2,"is_first":null,"benren":23,"parent":18,"userName":"chengxu","userTitle":"总裁","meTitle":"董事","userParent":"admin2","userParTitle":"董事","sale_price":"200.00","userChild":"20","zong1":"无","dong1":18,"dong2":19,"dong3":20},{"id":1,"sale_name":"启灵科技","userId":18,"number":3,"amount":"600.00","status":1,"is_first":null,"benren":23,"parent":19,"userName":"admin2","userTitle":"董事","meTitle":"董事","userParent":"张三","userParTitle":"董事","sale_price":"200.00","userChild":"20","zong1":"无","dong1":"无","dong2":"无","dong3":"无"}]';
$info=json_decode($a,true);
$data=[];
foreach($info as $k=>$v){
    $_data['sale_name']=$v['sale_name'];
    $_data['userName']=$v['userName'];
    $_data['userTitle']=$v['userTitle'];
    $_data['userParent']=$v['userParent'];
    $_data['sale_price']=$v['sale_price'];
    $_data['number']=$v['number'];
    $_data['amount']=$v['amount'];
    $_data['rebate']='';
    $_data['status']=$v['status']==1?'待审核':'已通过';
    $data[]=$_data;
}
$list=$data;
$indexKey=['sale_name','userName','userTitle','userParent','sale_price','number','amount','rebate','status'];
$title=['商品名称','用户信息','职称','上级推荐人','进货单价','进货数量','进货总价','返利','状态'];
$filename='进货管理';
$a=exportExcel($title,$list, $filename, './', true);
var_dump($a);
/**
 * 数据导出
 * @param array $title   标题行名称
 * @param array $data   导出数据
 * @param string $fileName 文件名
 * @param string $savePath 保存路径
 * @param $type   是否下载  false--保存   true--下载
 * @return string   返回文件全路径
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 */
function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){
    error_reporting(0);
    require_once dirname(__FILE__).'/public/PHPExcel/Classes/PHPExcel.php';
    $obj = new PHPExcel();

    //横向单元格标识
    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

    $obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称
    $_row = 1;   //设置纵向单元格标识
    if($title){
        $_cnt = count($title);
        $obj->getActiveSheet(0)->mergeCells('A'.$_row.':'.$cellName[$_cnt-1].$_row);   //合并单元格
        $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, '数据导出：'.date('Y-m-d H:i:s'));  //设置合并后的单元格内容
        $_row++;
        $i = 0;
        foreach($title AS $v){   //设置列标题
            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);
            $i++;
        }
        $_row++;
    }

    //填写数据
    if($data){
        $i = 0;
        foreach($data AS $_v){
            $j = 0;
            foreach($_v AS $_cell){
                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);
                $j++;
            }
            $i++;
        }
    }

    //文件名处理
    if(!$fileName){
        $fileName = uniqid(time(),true);
    }

    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');

    if($isDown){   //网页下载
        header('pragma:public');
        header("Content-Disposition:attachment;filename=$fileName.xls");
        $objWrite->save('php://output');exit;
    }

    $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码
    $_savePath = $savePath.$_fileName.'.xlsx';
    $objWrite->save($_savePath);
    return $savePath.$fileName.'.xlsx';
}
?>
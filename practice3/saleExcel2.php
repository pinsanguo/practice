<?php
session_start();
require_once('./public/conf.php');
$userId=$_SESSION['shopUserID'];
$benren=$userId;
$user1=$mysql->field('*')
    ->where('id="'.$userId.'"')
    ->select('user');
$organ=[];
$_userAll=getAllChild($userId);
$userAll=array_merge($_userAll,$user1);
$userIdArr=array_unique(array_column($userAll,'id'));
$userIdStr=implode(',',$userIdArr);
//筛选搜索条件
$file=$_GET['file'];
$file2=json_decode($file,true);
$where='';
$where.=' userId in ('.$userIdStr.') ';
if(!empty($file2['username'])){
    $userName=$file2['username'];
    $user2=$mysql->field('id')
        ->where('username="'.$userName.'"')
        ->select('user');
    if(!empty($user2)){
        $where.=' and userId = ('.$user2['0']['id'].') ';
    }
}
//title
if(!empty($file2['title'])){
    $userTitle=$file2['title'];
    $user3=$mysql->field('id')
        ->where('title="'.$userTitle.'"')
        ->select('user');
    if(!empty($user3)){
        $userIdArr3=[];
        foreach($user3 as $k3=>$v3){
            $userIdArr3[]=$v3['id'];
        }
        $userIdStr3=implode(',',$userIdArr3);
        $where.=' and userId in ('.$userIdStr3.') ';
    }
}
//tiemType
if(!empty($file2['tiemType'])){
    $tiemType=$file2['tiemType'];
    $startTime=$file2['startTime'];
    $endTime=$file2['endTime'];
    if($tiemType == 1){
        $where.=' and addtime >= ("'.$startTime.'") ';
        $where.=' and addtime <= ("'.$endTime.'") ';
    }else if($tiemType == 2){
        $where.=' and settletime >= ("'.$startTime.'") ';
        $where.=' and settletime <= ("'.$endTime.'") ';
    }
}
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
    ->where($where)
    ->select('sale');
$userAll2=deal_with_arr($userAll,'id');
$userChil=getChildId($userId);
//print_r($userChil);die();
$arr=[];
foreach($res as $k=>$v){
    $parId=$userAll2[$v['userId']]['parent'];
    $userTitle=!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['title']:'无';
    $arr[]=[
        'id'=>$v['id'],//id
        'sale_name'=>$v['sale_name'],//商品名称
        'userId'=>$v['userId'],//本条记录的用户ID
        'number'=>$v['number'],//数量
        'amount'=>$v['amount'],//总金额
        'status'=>$v['status'],//状态
        'is_first'=>$v['is_first'],//是否首次购买
        'benren'=>$benren,//当前登录账户的ID
        'parent'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['parent']:'无',
        //当前账户的父级ID
        'userName'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['username']:'无',
        //购买该条记录账户的用户名
        'userTitle'=>$userTitle,
        //购买该条记录用户职称
        'meTitle'=>!empty($userAll2[$benren])?$userAll2[$benren]['title']:'无',
        //当前用户职称
        'userParent'=>!empty($userAll2[$parId])?$userAll2[$parId]['username']:'无',
        'userParTitle'=>!empty($userAll2[$parId])?$userAll2[$parId]['title']:'无',
        //购买该条记录用户父级账户名
        'sale_price'=>$v['sale_price'],//价格
        'userChild'=>$userChil,
        'zong1'=>get_zong1($parId,$userTitle),
        'dong1'=>get_dong1($parId,$userTitle),
        'dong2'=>get_dong2($parId,$userTitle),
        'dong3'=>get_dong3($parId,$userTitle),
    ];
}
$data=[];
foreach($arr as $k=>$v){
    $_data['sale_name']=$v['sale_name'];
    $_data['userName']=$v['userName'];
    $_data['userTitle']=$v['userTitle'];
    $_data['userParent']=$v['userParent'];
    $_data['sale_price']=$v['sale_price'];
    $_data['number']=$v['number'];
    $_data['amount']=$v['amount'];
    $_data['rebate']=get_rebate($v);
    $_data['status']=$v['status']==1?'待审核':'已通过';
    $data[]=$_data;
}
$list=$data;
$indexKey=['sale_name','userName','userTitle','userParent','sale_price','number','amount','rebate','status'];
$title=['商品名称','用户信息','职称','上级推荐人','进货单价','进货数量','进货总价','返利','状态'];
$filename='进货管理';
$a=exportExcel($title,$list, $filename, './', true);
function get_rebate($v){
    if($v['userId'] == $v['benren']){
        return "无返利";
    }
    if($v['parent'] == $v['benren']){
        if($v['meTitle'] == '董事' && $v['userTitle'] == '董事' && $v['is_first'] == 1){
            if($v['number'] >= 200){
                return $v['number']*30;
            }else{
                return $v['number']*15;
            }
        }elseif(($v['meTitle'] == '董事' && $v['userTitle'] == '董事' && $v['is_first'] != 1)){
            return $v['number']*5;
        }elseif(($v['meTitle'] == '董事' && $v['userTitle'] == '总裁' && $v['is_first'] == 1)){
            if($v['number'] >= 200){
                return $v['number']*30;
            }else{
                return $v['number']*15;
            }
        }elseif(($v['meTitle'] == '董事' && $v['userTitle'] == '总裁' && $v['is_first'] != 1)){
            return $v['number']*15;
        }elseif(($v['meTitle'] == '总裁' && $v['userTitle'] == '总裁' && $v['is_first'] == 1)){
            if($v['number'] >= 200){
                return $v['number']*15;
            }else{
                return $v['number']*5;
            }
        }elseif(($v['meTitle'] == '总裁' && $v['userTitle'] == '总裁' && $v['is_first'] != 1)){
            return $v['number']*5;
        }else{
            return $v['number']*5;
        }
    }elseif(($v['zong1'] == $v['benren'] && $v['userTitle'] != '总裁')){
        return $v['number']*15;
    }elseif(($v['dong1'] == $v['benren'] && $v['userTitle'] != '董事')){
        return $v['number']*15;
    }elseif(($v['dong2'] == $v['benren'] && $v['userTitle'] != '董事')){
        return $v['number']*5;
    }elseif(($v['dong3'] == $v['benren'] && $v['userTitle'] != '董事')){
        return $v['number']*3;
    }else{
        return '无返利';
    }
}
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
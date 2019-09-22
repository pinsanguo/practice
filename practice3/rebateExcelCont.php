<?php
require_once('./public/conf.php');
require_once('./rebateExcelCont.php');
function get_rebate_cont($userId,$file2){
    $benren=$userId;
    require_once('./public/conf.php');
    $mysql = getMysql();
    $user1=$mysql->field('*')
        ->where('id="'.$userId.'"')
        ->select('user');
    $benrenName=!empty($user1['0'])?$user1['0']['username']:'';
    $organ=[];
    $_userAll=getAllChild($userId);
    $userAll=array_merge($_userAll,$user1);
    $userIdArr=array_unique(array_column($userAll,'id'));
    $userIdStr=implode(',',$userIdArr);
    //筛选搜索条件
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
        $_data['rebate_name']=$benrenName;
        $_data['status']=$v['status']==1?'待审核':'已通过';
        $data[]=$_data;
    }
    return $data;
}
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
?>
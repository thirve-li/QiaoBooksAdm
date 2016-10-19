<?php
/**
 * Created by PhpStorm.
 * User: LiXin
 * Date: 16/7/5
 * Time: 17:13
 */

namespace Home\Model;
use Think\Model\RelationModel;;

class UserModel extends RelationModel{

    protected $_link = array(
        'Profile'=>array(
            'mapping_type'  => self::HAS_ONE,
            'class_name'    => 'UserProfile',
            'foreign_key'   => 'id',
           // 'as_fields' => 'email,nickname',
        ),
    );

}
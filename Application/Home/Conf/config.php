<?php

const BASE_PATH = '/index.php';//本地环境
//const BASE_PATH = '';//正式环境

return array(

	'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称
	'QS_BASE_PATH'   => BASE_PATH,//
    'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(
		// 'login' => array('user/ral','flg=0')
	)

);
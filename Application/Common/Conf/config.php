<?php
return array(
	'MULTI_MODULE'          =>  true,
	'MODULE_ALLOW_LIST'     =>  array('Home'),
	'APP_SUB_DOMAIN_DEPLOY' =>  true,
	'APP_SUB_DOMAIN_RULES'  =>  array(
		'adm.qiaobooks.com' => 'Home'
	),
	/**/
	'URL_DENY_SUFFIX'       =>  'ico|png|gif|jpg', // URL禁止访问的后缀设置
	'URL_HTML_SUFFIX'       =>  'html|bmp',  // URL伪静态后缀设置
	'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
// 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

    //正式
//    'DB_HOST' => 'qiaoshu001.mysql.rds.aliyuncs.com',
//    'DB_NAME' => 'qiaoshu01',
//    'DB_USER'   => 'qiaoshu01', // 用户名
//    'DB_PWD'    => 'k!Ua#jie@2015', // 密码


    // 本地
    'DB_HOST' => '192.168.1.106',
    'DB_NAME' => 'qiaoshu01',
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'f', // 密码

    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_PREFIX' => 'qs_', // 数据库表前缀
    'DB_PORT'  => '3306',
	/* Cookie设置 */
    'COOKIE_EXPIRE'         =>  3600,       // Cookie有效期
    //'COOKIE_DOMAIN'         =>  '.qiaobooks.com',      // Cookie有效域名
    'COOKIE_PATH'           =>  '/',     // Cookie路径
    'COOKIE_PREFIX'         =>  'qs_',      // Cookie前缀 避免冲突
    'COOKIE_SECURE'         =>  false,   // Cookie安全传输
    'COOKIE_HTTPONLY'       =>  '',      // Cookie httponly设置
    //'SESSION_OPTIONS'       =>  array('domain'=>'.qiaobooks.com','expire'=>0),
    /* 数据缓存设置 */
    'DATA_CACHE_TIME'       =>  0,      // 数据缓存有效期 0表示永久缓存
    'DATA_CACHE_COMPRESS'   =>  false,   // 数据缓存是否压缩缓存
    'DATA_CACHE_CHECK'      =>  false,   // 数据缓存是否校验缓存
    'DATA_CACHE_PREFIX'     =>  'qs_',     // 缓存前缀
    'DATA_CACHE_TYPE'       =>  'Db',  // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
    'DATA_CACHE_TABLE'		=> 'qs_cache',
    'DATA_CACHE_PATH'       =>  TEMP_PATH,// 缓存路径设置 (仅对File方式缓存有效)
    'DATA_CACHE_KEY'        =>  '',	// 缓存文件KEY (仅对File方式缓存有效)
    'DATA_CACHE_SUBDIR'     =>  true,    // 使用子目录缓存 (自动根据缓存标识的哈希创建子目录)
    'DATA_PATH_LEVEL'       =>  2,        // 子目录缓存级别
    'ALI_SMS_APPKEY'		=> 23315444,
    'ALI_SMS_SECRET'		=> '2cb3fa9d36fdd0a6a047c261a1ed5087',
    'APP_NAME'				=> '巧书',
    'PASS_FIX'				=> "qiao",
    'DEFAULT_GROUP_ID'		=> 1,
    //geetest
    'CAPTCHA_ID'			=>'bae0133478e87442db541dce1dbaa464',
    'PRIVATE_KEY'			=>'e04fcffbc51e5d7cfe1a885233ee16ac',
    //第三方登录
    'QQ'					=> array('appid'=>'101310904','appkey'=>'4e22392e4a074d505b5e4ecdc7d94684','callback'=>'http://www.qiaobooks.com/ologin'),
    'Weibo'					=> array('appid'=>'197649834','appkey'=>'01d7df5732cb6b2d83a97e2e8c456e41','callback'=>'http://www.qiaobooks.com/ologin'),
	'Weixin'				=> array('appid'=>'wxe1227cdd5c728d66','appkey'=>'0b9c48b0b433309ea8d5efe90b142deb','callback'=>'http://www.qiaobooks.com/ologin'),
    'PASS_FIX'				=> "qiao",

    'alipay_config'=>array(
            //合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
         'partner' 		=> '2088121403316829',

        //收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
         'seller_id'   => '2088121403316829',

        // MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'key' 			=> 'fl9gay29bywo9youklhffe786gmcfys1',
        // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
         'notify_url'  => "http://www.qiaobooks.com/Alipay/notifyUrl",

        // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
         'return_url'  => "http://www.qiaobooks.com/Alipay/returnUrl",

        //签名方式
         'sign_type'    => strtoupper('MD5'),

        //字符编码格式 目前支持utf-8
         'input_charset' => strtolower('utf-8'),

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
         'cacert'     => getcwd().'\\cacert.pem',

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
         'transport'    => 'http',

        // 支付类型 ，无需修改
         'payment_type'  => "1",

        // 产品类型，无需修改
         'service'  => "alipay.wap.create.direct.pay.by.user",

        // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
        'anti_phishing_key'  => "",

        // 客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
        'exter_invoke_ip'  => ""
    )

);
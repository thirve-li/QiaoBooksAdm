<?php
namespace OSS;
use OSS\Core\OssUtil;
use OSS\Core\MimeTypes;
use OSS\Http\RequestCore;
use OSS\Http\ResponseCore;
use OSS\Result\PutSetDeleteResult;
use OSS\Result\ExistResult;
use OSS\Result\AppendResult;
use OSS\Model\ObjectListInfo;
use OSS\Result\BodyResult;

/**
 * Class OssClient
 *
 * Object Storage Service(OSS) 的客户端类，封装了用户通过OSS API对OSS服务的各种操作
 */
 
class OssClient
{
	
    /**
     * 构造函数
     *
     * 构造函数有几种情况：
     * 1. 一般的时候初始化使用 $ossClient = new OssClient($id, $key, $endpoint)
     * 2. 如果使用CNAME的，比如使用的是www.testoss.com，在控制台上做了CNAME的绑定，
     * 初始化使用 $ossClient = new OssClient($id, $key, $endpoint, true)
     * 3. 如果使用了阿里云SecurityTokenService(STS)，获得了AccessKeyID, AccessKeySecret, Token
     * 初始化使用  $ossClient = new OssClient($id, $key, $endpoint, false, $token)
     * 4. 如果用户使用的endpoint是ip
     * 初始化使用 $ossClient = new OssClient($id, $key, “1.2.3.4:8900”)
     *
     * @param string $accessKeyId 从OSS获得的AccessKeyId
     * @param string $accessKeySecret 从OSS获得的AccessKeySecret
     * @param string $endpoint 您选定的OSS数据中心访问域名，例如oss-cn-hangzhou.aliyuncs.com
     * @param boolean $isCName 是否对Bucket做了域名绑定，并且Endpoint参数填写的是自己的域名
     * @param string $securityToken
     * @throws OssException
     */
     // 域名类型
    
    public function __construct($accessKeyId, $accessKeySecret, $endpoint, $isCName = false, $securityToken = NULL){
        $accessKeyId = trim($accessKeyId);
        $accessKeySecret = trim($accessKeySecret);
        $endpoint = trim(trim($endpoint), "/");

        if (empty($accessKeyId)) {
            exit("access key id is empty");
        }
        if (empty($accessKeySecret)) {
            exit("access key secret is empty");
        }
        if (empty($endpoint)) {
            exit("endpoint is empty");
        }
        $this->hostname = $this->checkEndpoint($endpoint, $isCName);
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
        $this->securityToken = $securityToken;
        self::checkEnv();
    }
	
	 /**
     * 上传内存中的内容
     *
     * @param string $bucket bucket名称
     * @param string $object objcet名称
     * @param string $content 上传的内容
     * @param array $options
     * @return null
     */
    public function putObject($bucket, $object, $content, $options = NULL){
        $this->precheckCommon($bucket, $object, $options);

        OssUtil::validateContent($content);
        $options[self::OSS_CONTENT] = $content;
        $options[self::OSS_BUCKET] = $bucket;
        $options[self::OSS_METHOD] = self::OSS_HTTP_PUT;
        $options[self::OSS_OBJECT] = $object;

        if (!isset($options[self::OSS_LENGTH])) {
            $options[self::OSS_CONTENT_LENGTH] = strlen($options[self::OSS_CONTENT]);
        } else {
            $options[self::OSS_CONTENT_LENGTH] = $options[self::OSS_LENGTH];
        }

        if (!isset($options[self::OSS_CONTENT_TYPE])) {
            $options[self::OSS_CONTENT_TYPE] = $this->getMimeType($object);
        }
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }
	
	/**
     * 删除某个Object
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param array $options
     * @return null
     */
    public function deleteObject($bucket, $object, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        $options[self::OSS_BUCKET] = $bucket;
        $options[self::OSS_METHOD] = self::OSS_HTTP_DELETE;
        $options[self::OSS_OBJECT] = $object;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 删除同一个Bucket中的多个Object
     *
     * @param string $bucket bucket名称
     * @param array $objects object列表
     * @param array $options
     * @return ResponseCore
     * @throws null
     */
    public function deleteObjects($bucket, $objects, $options = null)
    {
        $this->precheckCommon($bucket, NULL, $options, false);
        if (!is_array($objects) || !$objects) {
            throw new OssException('objects must be array');
        }
        $options[self::OSS_METHOD] = self::OSS_HTTP_POST;
        $options[self::OSS_BUCKET] = $bucket;
        $options[self::OSS_OBJECT] = '/';
        $options[self::OSS_SUB_RESOURCE] = 'delete';
        $options[self::OSS_CONTENT_TYPE] = 'application/xml';
        $quiet = 'false';
        if (isset($options['quiet'])) {
            if (is_bool($options['quiet'])) { //Boolean
                $quiet = $options['quiet'] ? 'true' : 'false';
            } elseif (is_string($options['quiet'])) { // string
                $quiet = ($options['quiet'] === 'true') ? 'true' : 'false';
            }
        }
        $xmlBody = OssUtil::createDeleteObjectsXmlBody($objects, $quiet);
        $options[self::OSS_CONTENT] = $xmlBody;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 获得Object内容
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param array $options 该参数中必须设置ALIOSS::OSS_FILE_DOWNLOAD，ALIOSS::OSS_RANGE可选，可以根据实际情况设置；如果不设置，默认会下载全部内容
     * @return string
     */
    public function getObject($bucket, $object, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        $options[self::OSS_BUCKET] = $bucket;
        $options[self::OSS_METHOD] = self::OSS_HTTP_GET;
        $options[self::OSS_OBJECT] = $object;
        if (isset($options[self::OSS_LAST_MODIFIED])) {
            $options[self::OSS_HEADERS][self::OSS_IF_MODIFIED_SINCE] = $options[self::OSS_LAST_MODIFIED];
            unset($options[self::OSS_LAST_MODIFIED]);
        }
        if (isset($options[self::OSS_ETAG])) {
            $options[self::OSS_HEADERS][self::OSS_IF_NONE_MATCH] = $options[self::OSS_ETAG];
            unset($options[self::OSS_ETAG]);
        }
        if (isset($options[self::OSS_RANGE])) {
            $range = $options[self::OSS_RANGE];
            $options[self::OSS_HEADERS][self::OSS_RANGE] = "bytes=$range";
            unset($options[self::OSS_RANGE]);
        }
        $response = $this->auth($options);
        $result = new BodyResult($response);
        return $result->getData();
    }
	
	/**
     * 上传本地文件
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param string $file 本地文件路径
     * @param array $options
     * @return null
     * @throws OssException
     */
    public function uploadFile($bucket, $object, $file, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        OssUtil::throwOssExceptionWithMessageIfEmpty($file, "file path is invalid");
        $file = OssUtil::encodePath($file);
        if (!file_exists($file)) {
            throw new OssException($file . " file does not exist");
        }
        $options[self::OSS_FILE_UPLOAD] = $file;
        $file_size = filesize($options[self::OSS_FILE_UPLOAD]);
        $is_check_md5 = $this->isCheckMD5($options);
        if ($is_check_md5) {
            $content_md5 = base64_encode(md5_file($options[self::OSS_FILE_UPLOAD], true));
            $options[self::OSS_CONTENT_MD5] = $content_md5;
        }
        if (!isset($options[self::OSS_CONTENT_TYPE])) {
            $options[self::OSS_CONTENT_TYPE] = $this->getMimeType($object, $file);
        }
        $options[self::OSS_METHOD] = self::OSS_HTTP_PUT;
        $options[self::OSS_BUCKET] = $bucket;
        $options[self::OSS_OBJECT] = $object;
        $options[self::OSS_CONTENT_LENGTH] = $file_size;
        $response = $this->auth($options);
        $result = new PutSetDeleteResult($response);
        return $result->getData();
    }

    /**
     * 检测Object是否存在
     * 通过获取Object的Meta信息来判断Object是否存在， 用户需要自行解析ResponseCore判断object是否存在
     *
     * @param string $bucket bucket名称
     * @param string $object object名称
     * @param array $options
     * @return bool
     */
    public function doesObjectExist($bucket, $object, $options = NULL)
    {
        $this->precheckCommon($bucket, $object, $options);
        $options[self::OSS_BUCKET] = $bucket;
        $options[self::OSS_METHOD] = self::OSS_HTTP_HEAD;
        $options[self::OSS_OBJECT] = $object;
        $response = $this->auth($options);
        $result = new ExistResult($response);
        return $result->getData();
    }
	
	/**
     * 检查endpoint的种类
     * 如有有协议头，剥去协议头
     * 并且根据参数 is_cname 和endpoint本身，判定域名类型，是ip，cname，还是专有域或者官网域名
     *
     * @param string $endpoint
     * @param boolean $isCName
     * @return string 剥掉协议头的域名
     */
    private function checkEndpoint($endpoint, $isCName)
    {
        $ret_endpoint = null;
        if (strpos($endpoint, 'http://') === 0) {
            $ret_endpoint = substr($endpoint, strlen('http://'));
        } elseif (strpos($endpoint, 'https://') === 0) {
            $ret_endpoint = substr($endpoint, strlen('https://'));
            $this->useSSL = true;
        } else {
            $ret_endpoint = $endpoint;
        }

        if ($isCName) {
            $this->hostType = self::OSS_HOST_TYPE_CNAME;
        } elseif (OssUtil::isIPFormat($ret_endpoint)) {
            $this->hostType = self::OSS_HOST_TYPE_IP;
        } else {
            $this->hostType = self::OSS_HOST_TYPE_NORMAL;
        }
        return $ret_endpoint;
    }
	
	 
	 /**
     * 用来检查sdk所以来的扩展是否打开
     *
     * @throws OssException
     */
    public static function checkEnv(){
        if (function_exists('get_loaded_extensions')) {
            //检测curl扩展
            $enabled_extension = array("curl");
            $extensions = get_loaded_extensions();
            if ($extensions) {
                foreach ($enabled_extension as $item) {
                    if (!in_array($item, $extensions)) {
                        exit("Extension {" . $item . "} is not installed or not enabled, please check your php env.");
                    }
                }
            } else {
                exit("function get_loaded_extensions not found.");
            }
        } else {
            exit('Function get_loaded_extensions has been disabled, please check php config.');
        }
    }
	
	/**
     * 获取mimetype类型
     *
     * @param string $object
     * @return string
     */
    private function getMimeType($object, $file = null)
    {
        if (!is_null($file)) {
            $type = MimeTypes::getMimetype($file);
            if (!is_null($type)) {
                return $type;
            }
        }

        $type = MimeTypes::getMimetype($object);
        if (!is_null($type)) {
            return $type;
        }

        return self::DEFAULT_CONTENT_TYPE;
    }
	
	/**
     * 验证并且执行请求，按照OSS Api协议，执行操作
     *
     * @param array $options
     * @return ResponseCore
     * @throws OssException
     * @throws RequestCore_Exception
     */
    private function auth($options){
        OssUtil::validateOptions($options);
        //验证bucket，list_bucket时不需要验证
        $this->authPrecheckBucket($options);
        //验证object
        $this->authPrecheckObject($options);
        //Object名称的编码必须是utf8
        $this->authPrecheckObjectEncoding($options);
        //验证ACL
        $this->authPrecheckAcl($options);
        // 获得当次请求使用的协议头，是https还是http
        $scheme = $this->useSSL ? 'https://' : 'http://';
        // 获得当次请求使用的hostname，如果是公共域名或者专有域名，bucket拼在前面构成三级域名
        $hostname = $this->generateHostname($options);
        $string_to_sign = '';
        $headers = $this->generateHeaders($options, $hostname);
        $signable_query_string_params = $this->generateSignableQueryStringParam($options);
        $signable_query_string = OssUtil::toQueryString($signable_query_string_params);
        $resource_uri = $this->generateResourceUri($options);
        //生成请求URL
        $conjunction = '?';
        $non_signable_resource = '';
        if (isset($options[self::OSS_SUB_RESOURCE])) {
            $conjunction = '&';
        }
        if ($signable_query_string !== '') {
            $signable_query_string = $conjunction . $signable_query_string;
            $conjunction = '&';
        }
        $query_string = $this->generateQueryString($options);
        if ($query_string !== '') {
            $non_signable_resource .= $conjunction . $query_string;
            $conjunction = '&';
        }
        $this->requestUrl = $scheme . $hostname . $resource_uri . $signable_query_string . $non_signable_resource;

        //创建请求
        $request = new RequestCore($this->requestUrl);
        $request->set_useragent($this->generateUserAgent());
        // Streaming uploads
        if (isset($options[self::OSS_FILE_UPLOAD])) {
            if (is_resource($options[self::OSS_FILE_UPLOAD])) {
                $length = null;

                if (isset($options[self::OSS_CONTENT_LENGTH])) {
                    $length = $options[self::OSS_CONTENT_LENGTH];
                } elseif (isset($options[self::OSS_SEEK_TO])) {
                    $stats = fstat($options[self::OSS_FILE_UPLOAD]);
                    if ($stats && $stats[self::OSS_SIZE] >= 0) {
                        $length = $stats[self::OSS_SIZE] - (integer)$options[self::OSS_SEEK_TO];
                    }
                }
                $request->set_read_stream($options[self::OSS_FILE_UPLOAD], $length);
            } else {
                $request->set_read_file($options[self::OSS_FILE_UPLOAD]);
                $length = $request->read_stream_size;
                if (isset($options[self::OSS_CONTENT_LENGTH])) {
                    $length = $options[self::OSS_CONTENT_LENGTH];
                } elseif (isset($options[self::OSS_SEEK_TO]) && isset($length)) {
                    $length -= (integer)$options[self::OSS_SEEK_TO];
                }
                $request->set_read_stream_size($length);
            }
        }
        if (isset($options[self::OSS_SEEK_TO])) {
            $request->set_seek_position((integer)$options[self::OSS_SEEK_TO]);
        }
        if (isset($options[self::OSS_FILE_DOWNLOAD])) {
            if (is_resource($options[self::OSS_FILE_DOWNLOAD])) {
                $request->set_write_stream($options[self::OSS_FILE_DOWNLOAD]);
            } else {
                $request->set_write_file($options[self::OSS_FILE_DOWNLOAD]);
            }
        }

        if (isset($options[self::OSS_METHOD])) {
            $request->set_method($options[self::OSS_METHOD]);
            $string_to_sign .= $options[self::OSS_METHOD] . "\n";
        }

        if (isset($options[self::OSS_CONTENT])) {
            $request->set_body($options[self::OSS_CONTENT]);
            if ($headers[self::OSS_CONTENT_TYPE] === 'application/x-www-form-urlencoded') {
                $headers[self::OSS_CONTENT_TYPE] = 'application/octet-stream';
            }

            $headers[self::OSS_CONTENT_LENGTH] = strlen($options[self::OSS_CONTENT]);
            $headers[self::OSS_CONTENT_MD5] = base64_encode(md5($options[self::OSS_CONTENT], true));
        }

        uksort($headers, 'strnatcasecmp');
        foreach ($headers as $header_key => $header_value) {
            $header_value = str_replace(array("\r", "\n"), '', $header_value);
            if ($header_value !== '') {
                $request->add_header($header_key, $header_value);
            }
            if (
                strtolower($header_key) === 'content-md5' ||
                strtolower($header_key) === 'content-type' ||
                strtolower($header_key) === 'date' ||
                (isset($options['self::OSS_PREAUTH']) && (integer)$options['self::OSS_PREAUTH'] > 0)
            ) {
                $string_to_sign .= $header_value . "\n";
            } elseif (substr(strtolower($header_key), 0, 6) === self::OSS_DEFAULT_PREFIX) {
                $string_to_sign .= strtolower($header_key) . ':' . $header_value . "\n";
            }
        }
        // 生成 signable_resource
        $signable_resource = $this->generateSignableResource($options);
        $string_to_sign .= rawurldecode($signable_resource) . urldecode($signable_query_string);
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $this->accessKeySecret, true));
        $request->add_header('Authorization', 'OSS ' . $this->accessKeyId . ':' . $signature);

        if (isset($options[self::OSS_PREAUTH]) && (integer)$options[self::OSS_PREAUTH] > 0) {
            $signed_url = $this->requestUrl . $conjunction . self::OSS_URL_ACCESS_KEY_ID . '=' . rawurlencode($this->accessKeyId) . '&' . self::OSS_URL_EXPIRES . '=' . $options[self::OSS_PREAUTH] . '&' . self::OSS_URL_SIGNATURE . '=' . rawurlencode($signature);
            return $signed_url;
        } elseif (isset($options[self::OSS_PREAUTH])) {
            return $this->requestUrl;
        }

        if ($this->timeout !== 0) {
            $request->timeout = $this->timeout;
        }
        if ($this->connectTimeout !== 0) {
            $request->connect_timeout = $this->connectTimeout;
        }

        try {
            $request->send_request();
        } catch (RequestCore_Exception $e) {
            throw(new OssException('RequestCoreException: ' . $e->getMessage()));
        }
        $response_header = $request->get_response_header();
        $response_header['oss-request-url'] = $this->requestUrl;
        $response_header['oss-redirects'] = $this->redirects;
        $response_header['oss-stringtosign'] = $string_to_sign;
        $response_header['oss-requestheaders'] = $request->request_headers;

        $data = new ResponseCore($response_header, $request->get_response_body(), $request->get_response_code());
        //retry if OSS Internal Error
        if ((integer)$request->get_response_code() === 500) {
            if ($this->redirects <= $this->maxRetries) {
                //设置休眠
                $delay = (integer)(pow(4, $this->redirects) * 100000);
                usleep($delay);
                $this->redirects++;
                $data = $this->auth($options);
            }
        }

        $this->redirects = 0;
        return $data;
    }

	/**
     * 获得档次请求使用的域名
     * bucket在前的三级域名，或者二级域名，如果是cname或者ip的话，则是二级域名
     *
     * @param $options
     * @return string 剥掉协议头的域名
     */
    private function generateHostname($options)
    {
        if ($this->hostType === self::OSS_HOST_TYPE_IP) {
            $hostname = $this->hostname;
        } elseif ($this->hostType === self::OSS_HOST_TYPE_CNAME) {
            $hostname = $this->hostname;
        } else {
            // 专有域或者官网endpoint
            $hostname = ($options[self::OSS_BUCKET] == '') ? $this->hostname : ($options[self::OSS_BUCKET] . '.') . $this->hostname;
        }
        return $hostname;
    }
	
	/**
     *  生成用于签名resource段
     *
     * @param mixed $options
     * @return string
     */
    private function generateSignableResource($options)
    {
        $signableResource = "";
        $signableResource .= '/';
        if (isset($options[self::OSS_BUCKET]) && '' !== $options[self::OSS_BUCKET]) {
            $signableResource .= $options[self::OSS_BUCKET];
            // 如果操作没有Object操作的话，这里最后是否有斜线有个trick，ip的域名下，不需要加'/'， 否则需要加'/'
            if ($options[self::OSS_OBJECT] == '/') {
                if ($this->hostType !== self::OSS_HOST_TYPE_IP) {
                    $signableResource .= "/";
                }
            }
        }
        //signable_resource + object
        if (isset($options[self::OSS_OBJECT]) && '/' !== $options[self::OSS_OBJECT]) {
            $signableResource .= '/' . str_replace(array('%2F', '%25'), array('/', '%'), rawurlencode($options[self::OSS_OBJECT]));
        }
        if (isset($options[self::OSS_SUB_RESOURCE])) {
            $signableResource .= '?' . $options[self::OSS_SUB_RESOURCE];
        }
        return $signableResource;
    }
	
	/**
     * 生成请求用的UserAgent
     *
     * @return string
     */
    private function generateUserAgent()
    {
        return self::OSS_NAME . "/" . self::OSS_VERSION . " (" . php_uname('s') . "/" . php_uname('r') . "/" . php_uname('m') . ";" . PHP_VERSION . ")";
    }
	
	/**
     * 生成query_string
     *
     * @param mixed $options
     * @return string
     */
    private function generateQueryString($options)
    {
        //请求参数
        $queryStringParams = array();
        if (isset($options[self::OSS_QUERY_STRING])) {
            $queryStringParams = array_merge($queryStringParams, $options[self::OSS_QUERY_STRING]);
        }
        return OssUtil::toQueryString($queryStringParams);
    }
	
	/**
     * 初始化headers
     *
     * @param mixed $options
     * @param string $hostname hostname
     * @return array
     */
    private function generateHeaders($options, $hostname)
    {
        $headers = array(
            self::OSS_CONTENT_MD5 => '',
            self::OSS_CONTENT_TYPE => isset($options[self::OSS_CONTENT_TYPE]) ? $options[self::OSS_CONTENT_TYPE] : self::DEFAULT_CONTENT_TYPE,
            self::OSS_DATE => isset($options[self::OSS_DATE]) ? $options[self::OSS_DATE] : gmdate('D, d M Y H:i:s \G\M\T'),
            self::OSS_HOST => $hostname,
        );
        if (isset($options[self::OSS_CONTENT_MD5])) {
            $headers[self::OSS_CONTENT_MD5] = $options[self::OSS_CONTENT_MD5];
        }
        //添加stsSecurityToken
        if ((!is_null($this->securityToken)) && (!$this->enableStsInUrl)) {
            $headers[self::OSS_SECURITY_TOKEN] = $this->securityToken;
        }
        //合并HTTP headers
        if (isset($options[self::OSS_HEADERS])) {
            $headers = array_merge($headers, $options[self::OSS_HEADERS]);
        }
        return $headers;
    }
	
	/**
     * 获得当次请求的资源定位字段
     *
     * @param $options
     * @return string 资源定位字段
     */
    private function generateResourceUri($options)
    {
        $resource_uri = "";

        // resource_uri + bucket
        if (isset($options[self::OSS_BUCKET]) && '' !== $options[self::OSS_BUCKET]) {
            if ($this->hostType === self::OSS_HOST_TYPE_IP) {
                $resource_uri = '/' . $options[self::OSS_BUCKET];
            }
        }

        // resource_uri + object
        if (isset($options[self::OSS_OBJECT]) && '/' !== $options[self::OSS_OBJECT]) {
            $resource_uri .= '/' . str_replace(array('%2F', '%25'), array('/', '%'), rawurlencode($options[self::OSS_OBJECT]));
        }

        // resource_uri + sub_resource
        $conjunction = '?';
        if (isset($options[self::OSS_SUB_RESOURCE])) {
            $resource_uri .= $conjunction . $options[self::OSS_SUB_RESOURCE];
        }
        return $resource_uri;
    }
	
	/**
     * 生成signalbe_query_string_param, array类型
     *
     * @param array $options
     * @return array
     */
    private function generateSignableQueryStringParam($options)
    {
        $signableQueryStringParams = array();
        $signableList = array(
            self::OSS_PART_NUM,
            'response-content-type',
            'response-content-language',
            'response-cache-control',
            'response-content-encoding',
            'response-expires',
            'response-content-disposition',
            self::OSS_UPLOAD_ID,
            self::OSS_CNAME_COMP,
            self::OSS_POSITION
        );

        foreach ($signableList as $item) {
            if (isset($options[$item])) {
                $signableQueryStringParams[$item] = $options[$item];
            }
        }

        if ($this->enableStsInUrl && (!is_null($this->securityToken))) {
            $signableQueryStringParams["security-token"] = $this->securityToken;
        }

        return $signableQueryStringParams;
    }
	
	
	
	
	
	
	/**
     * 检查bucket名称格式是否正确，如果非法抛出异常
     *
     * @param $options
     * @throws OssException
     */
    private function authPrecheckBucket($options)
    {
        if (!(('/' == $options[self::OSS_OBJECT]) && ('' == $options[self::OSS_BUCKET]) && ('GET' == $options[self::OSS_METHOD])) && !OssUtil::validateBucket($options[self::OSS_BUCKET])) {
            exit('"' . $options[self::OSS_BUCKET] . '"' . 'bucket name is invalid');
        }
    }

    /**
     *
     * 检查object名称格式是否正确，如果非法抛出异常
     *
     * @param $options
     * @throws OssException
     */
    private function authPrecheckObject($options)
    {
        if (isset($options[self::OSS_OBJECT]) && $options[self::OSS_OBJECT] === '/') {
            return;
        }

        if (isset($options[self::OSS_OBJECT]) && !OssUtil::validateObject($options[self::OSS_OBJECT])) {
            exit('"' . $options[self::OSS_OBJECT] . '"' . ' object name is invalid');
        }
    }
	
	/**
     * 检查object的编码，如果是gbk或者gb2312则尝试将其转化为utf8编码
     *
     * @param mixed $options 参数
     */
    private function authPrecheckObjectEncoding(&$options)
    {
        $tmp_object = $options[self::OSS_OBJECT];
        if (OssUtil::isGb2312($options[self::OSS_OBJECT])) {
            $options[self::OSS_OBJECT] = iconv('GB2312', "UTF-8//IGNORE", $options[self::OSS_OBJECT]);
        } elseif (OssUtil::checkChar($options[self::OSS_OBJECT], true)) {
            $options[self::OSS_OBJECT] = iconv('GBK', "UTF-8//IGNORE", $options[self::OSS_OBJECT]);
        }
        $options[self::OSS_OBJECT] = $tmp_object;
    }
	
	/**
     * 检测md5
     *
     * @param array $options
     * @return bool|null
     */
    private function isCheckMD5($options)
    {
        return $this->getValue($options, self::OSS_CHECK_MD5, false, true, true);
    }
	
	
	/**
     * 检查ACL是否是预定义中三种之一，如果不是抛出异常
     *
     * @param $options
     * @throws OssException
     */
    private function authPrecheckAcl($options)
    {
        if (isset($options[self::OSS_HEADERS][self::OSS_ACL]) && !empty($options[self::OSS_HEADERS][self::OSS_ACL])) {
            if (!in_array(strtolower($options[self::OSS_HEADERS][self::OSS_ACL]), self::$OSS_ACL_TYPES)) {
                exit($options[self::OSS_HEADERS][self::OSS_ACL] . ':' . 'acl is invalid(private,public-read,public-read-write)');
            }
        }
    }
	
	/**
     * 校验object参数
     *
     * @param string $object
     * @throws OssException
     */
    private function precheckObject($object)
    {
        OssUtil::throwOssExceptionWithMessageIfEmpty($object, "object name is empty");
    }
	
	 /**
     * 校验bucket,options参数
     *
     * @param string $bucket
     * @param string $object
     * @param array $options
     * @param bool $isCheckObject
     */
    private function precheckCommon($bucket, $object, &$options, $isCheckObject = true)
    {
        if ($isCheckObject) {
            $this->precheckObject($object);
        }
        $this->precheckOptions($options);
        $this->precheckBucket($bucket);
    }
	/**
     * 校验bucket参数
     *
     * @param string $bucket
     * @param string $errMsg
     * @throws OssException
     */
    private function precheckBucket($bucket, $errMsg = 'bucket is not allowed empty')
    {
        OssUtil::throwOssExceptionWithMessageIfEmpty($bucket, $errMsg);
    }
	/**
     * 检测options参数
     *
     * @param array $options
     * @throws OssException
     */
    private function precheckOptions(&$options)
    {
        OssUtil::validateOptions($options);
        if (!$options) {
            $options = array();
        }
    }

    /**
     * 获取value
     *
     * @param array $options
     * @param string $key
     * @param string $default
     * @param bool $isCheckEmpty
     * @param bool $isCheckBool
     * @return bool|null
     */
    private function getValue($options, $key, $default = NULL, $isCheckEmpty = false, $isCheckBool = false)
    {
        $value = $default;
        if (isset($options[$key])) {
            if ($isCheckEmpty) {
                if (!empty($options[$key])) {
                    $value = $options[$key];
                }
            } else {
                $value = $options[$key];
            }
            unset($options[$key]);
        }
        if ($isCheckBool) {
            if ($value !== true && $value !== false) {
                $value = false;
            }
        }
        return $value;
    }




    // 生命周期相关常量
    const OSS_LIFECYCLE_EXPIRATION = "Expiration";
    const OSS_LIFECYCLE_TIMING_DAYS = "Days";
    const OSS_LIFECYCLE_TIMING_DATE = "Date";
    //OSS 内部常量
    const OSS_BUCKET = 'bucket';
    const OSS_OBJECT = 'object';
    const OSS_HEADERS = OssUtil::OSS_HEADERS;
    const OSS_METHOD = 'method';
    const OSS_QUERY = 'query';
    const OSS_BASENAME = 'basename';
    const OSS_MAX_KEYS = 'max-keys';
    const OSS_UPLOAD_ID = 'uploadId';
    const OSS_PART_NUM = 'partNumber';
    const OSS_CNAME_COMP = 'comp';
    const OSS_POSITION = 'position';
    const OSS_MAX_KEYS_VALUE = 100;
    const OSS_MAX_OBJECT_GROUP_VALUE = OssUtil::OSS_MAX_OBJECT_GROUP_VALUE;
    const OSS_MAX_PART_SIZE = OssUtil::OSS_MAX_PART_SIZE;
    const OSS_MID_PART_SIZE = OssUtil::OSS_MID_PART_SIZE;
    const OSS_MIN_PART_SIZE = OssUtil::OSS_MIN_PART_SIZE;
    const OSS_FILE_SLICE_SIZE = 8192;
    const OSS_PREFIX = 'prefix';
    const OSS_DELIMITER = 'delimiter';
    const OSS_MARKER = 'marker';
    const OSS_CONTENT_MD5 = 'Content-Md5';
    const OSS_SELF_CONTENT_MD5 = 'x-oss-meta-md5';
    const OSS_CONTENT_TYPE = 'Content-Type';
    const OSS_CONTENT_LENGTH = 'Content-Length';
    const OSS_IF_MODIFIED_SINCE = 'If-Modified-Since';
    const OSS_IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';
    const OSS_IF_MATCH = 'If-Match';
    const OSS_IF_NONE_MATCH = 'If-None-Match';
    const OSS_CACHE_CONTROL = 'Cache-Control';
    const OSS_EXPIRES = 'Expires';
    const OSS_PREAUTH = 'preauth';
    const OSS_CONTENT_COING = 'Content-Coding';
    const OSS_CONTENT_DISPOSTION = 'Content-Disposition';
    const OSS_RANGE = 'range';
    const OSS_ETAG = 'etag';
    const OSS_LAST_MODIFIED = 'lastmodified';
    const OS_CONTENT_RANGE = 'Content-Range';
    const OSS_CONTENT = OssUtil::OSS_CONTENT;
    const OSS_BODY = 'body';
    const OSS_LENGTH = OssUtil::OSS_LENGTH;
    const OSS_HOST = 'Host';
    const OSS_DATE = 'Date';
    const OSS_AUTHORIZATION = 'Authorization';
    const OSS_FILE_DOWNLOAD = 'fileDownload';
    const OSS_FILE_UPLOAD = 'fileUpload';
    const OSS_PART_SIZE = 'partSize';
    const OSS_SEEK_TO = 'seekTo';
    const OSS_SIZE = 'size';
    const OSS_QUERY_STRING = 'query_string';
    const OSS_SUB_RESOURCE = 'sub_resource';
    const OSS_DEFAULT_PREFIX = 'x-oss-';
    const OSS_CHECK_MD5 = 'checkmd5';
    const DEFAULT_CONTENT_TYPE = 'application/octet-stream';

    //私有URL变量
    const OSS_URL_ACCESS_KEY_ID = 'OSSAccessKeyId';
    const OSS_URL_EXPIRES = 'Expires';
    const OSS_URL_SIGNATURE = 'Signature';
    //HTTP方法
    const OSS_HTTP_GET = 'GET';
    const OSS_HTTP_PUT = 'PUT';
    const OSS_HTTP_HEAD = 'HEAD';
    const OSS_HTTP_POST = 'POST';
    const OSS_HTTP_DELETE = 'DELETE';
    const OSS_HTTP_OPTIONS = 'OPTIONS';
    //其他常量
    const OSS_ACL = 'x-oss-acl';
    const OSS_OBJECT_ACL = 'x-oss-object-acl';
    const OSS_OBJECT_GROUP = 'x-oss-file-group';
    const OSS_MULTI_PART = 'uploads';
    const OSS_MULTI_DELETE = 'delete';
    const OSS_OBJECT_COPY_SOURCE = 'x-oss-copy-source';
    const OSS_OBJECT_COPY_SOURCE_RANGE = "x-oss-copy-source-range";
    //支持STS SecurityToken
    const OSS_SECURITY_TOKEN = "x-oss-security-token";
    const OSS_ACL_TYPE_PRIVATE = 'private';
    const OSS_ACL_TYPE_PUBLIC_READ = 'public-read';
    const OSS_ACL_TYPE_PUBLIC_READ_WRITE = 'public-read-write';
    const OSS_ENCODING_TYPE = "encoding-type";
    const OSS_ENCODING_TYPE_URL = "url";

    // 域名类型
    const OSS_HOST_TYPE_NORMAL = "normal";//http://bucket.oss-cn-hangzhou.aliyuncs.com/object
    const OSS_HOST_TYPE_IP = "ip";  //http://1.1.1.1/bucket/object
    const OSS_HOST_TYPE_SPECIAL = 'special'; //http://bucket.guizhou.gov/object
    const OSS_HOST_TYPE_CNAME = "cname";  //http://mydomain.com/object
    //OSS ACL数组
    static $OSS_ACL_TYPES = array(
        self::OSS_ACL_TYPE_PRIVATE,
        self::OSS_ACL_TYPE_PUBLIC_READ,
        self::OSS_ACL_TYPE_PUBLIC_READ_WRITE
    );
    // OssClient版本信息
    const OSS_NAME = "aliyun-sdk-php";
    const OSS_VERSION = "2.0.7";
    const OSS_BUILD = "20160617";
    const OSS_AUTHOR = "";
    const OSS_OPTIONS_ORIGIN = 'Origin';
    const OSS_OPTIONS_REQUEST_METHOD = 'Access-Control-Request-Method';
    const OSS_OPTIONS_REQUEST_HEADERS = 'Access-Control-Request-Headers';
	//是否使用ssl
    private $useSSL = false;
    private $maxRetries = 3;
    private $redirects = 0;
	//
    private $hostname;
	private $requestUrl;
	private $accessKeyId;
	private $accessKeySecret;
	private $securityToken;
	private $hostType = self::OSS_HOST_TYPE_NORMAL;
	private $enableStsInUrl = false;
    private $timeout = 0;
    private $connectTimeout = 0;

}
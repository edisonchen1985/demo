<?php
//FOR TEST ONLY
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
	public function __construct() {
        parent::__construct();
        vendor('phpCAS.CAS');
    }
	public function login(){

		// Full Hostname of your CAS Server 服务器主机
		$cas_host = 'cc.nomalis.com';
 
		// Context of the CAS Server  
		$cas_context = '/cas';
 
		// Port of your CAS server. Normally for a https server it's 443
		$cas_port = 443;



		//直接引入库文件需要实例化类
        $phpCAS = new \phpCAS();
        // Uncomment to enable debugging
        $phpCAS->setDebug();
        
        // Initialize phpCAS
        $phpCAS->client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
 
        // For quick testing you can disable SSL validation of the CAS server. 
        // THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION. 
        // VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL! 
        $phpCAS->setNoCasServerValidation();
 
        //这里会检测服务器端的退出的通知，就能实现php和其他语言平台间同步登出了
        $phpCAS->handleLogoutRequests();
 
        //访问CAS的验证通过后，跳转到网页
        if($phpCAS->forceAuthentication()){ 
 			dump($phpCAS->getUser());
        	echo "CAS 验证通过";
 
        }else{
        	echo "CAS 验证失败";
        }

		
	}
    
 
}

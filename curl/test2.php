<?php    
/**   
* Curl ģ���¼ discuz ����   
* ��δʵ�ֿ�����֤��ĵ���̳��¼����   
*/   
   
!extension_loaded('curl') && die('The curl extension is not loaded.');    
   
$discuz_url = 'http://www.lxvoip.com';//��̳��ַ    
$login_url = $discuz_url .'/logging.php?action=login';//��¼ҳ��ַ    
$get_url = $discuz_url .'/my.php?item=threads'; //�ҵ�����    
   
$post_fields = array();    
//���������Ҫ�޸�    
$post_fields['loginfield'] = 'username';    
$post_fields['loginsubmit'] = 'true';    
//�û��������룬������д    
$post_fields['username'] = 'lxvoip';    
$post_fields['password'] = '88888888';    
//��ȫ����    
$post_fields['questionid'] = 0;    
$post_fields['answer'] = '';    
//@todo��֤��    
$post_fields['seccodeverify'] = '';    
   
//��ȡ��FORMHASH    
$ch = curl_init($login_url);    
curl_setopt($ch, CURLOPT_HEADER, 0);    
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$contents = curl_exec($ch);    
curl_close($ch);    
preg_match('/<input\s*type="hidden"\s*name="formhash"\s*value="(.*?)"\s*\/>/i', $contents, $matches);    
if(!empty($matches)) {    
    $formhash = $matches[1];    
} else {    
    die('Not found the forumhash.');    
}    
   
//POST���ݣ���ȡCOOKIE    
$cookie_file = dirname(__FILE__) . '/cookie.txt';    
//$cookie_file = tempnam('/tmp');    
$ch = curl_init($login_url);    
curl_setopt($ch, CURLOPT_HEADER, 0);    
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
curl_setopt($ch, CURLOPT_POST, 1);    
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);    
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);    
curl_exec($ch);    
curl_close($ch);    
   
//��������õ���COOKIE��ȡ��Ҫ��¼����ܲ鿴��ҳ������    
$ch = curl_init($get_url);    
curl_setopt($ch, CURLOPT_HEADER, 0);    
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);    
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);    
$contents = curl_exec($ch);    
curl_close($ch);    
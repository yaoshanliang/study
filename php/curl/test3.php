<?php
define ( 'IS_PROXY', false ); //�Ƿ����ô���
/* cookie�ļ� */
$cookie_file = dirname ( __FILE__ ) . "/cookie_" . md5 ( basename ( __FILE__ ) ) . ".txt"; // ����Cookie�ļ�����·�����ļ���
/*ģ�������*/
$user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; .NET CLR 1.1.4322)";

function vlogin($url, $data) { // ģ���¼��ȡCookie����
	$curl = curl_init (); // ����һ��CURL�Ự
	if (IS_PROXY) {
		//���´������ô��������
		//�����������ַ
		curl_setopt ( $curl, CURLOPT_PROXY, $GLOBALS ['proxy'] );
	}
	curl_setopt ( $curl, CURLOPT_URL, $url ); // Ҫ���ʵĵ�ַ
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // ����֤֤����Դ�ļ��
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 1 ); // ��֤���м��SSL�����㷨�Ƿ����
	curl_setopt ( $curl, CURLOPT_USERAGENT, $GLOBALS ['user_agent'] ); // ģ���û�ʹ�õ������
	@curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // ʹ���Զ���ת
	curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // �Զ�����Referer
	curl_setopt ( $curl, CURLOPT_POST, 1 ); // ����һ�������Post����
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data ); // Post�ύ�����ݰ�
	curl_setopt ( $curl, CURLOPT_COOKIEJAR, $GLOBALS ['cookie_file'] ); // ���Cookie��Ϣ���ļ�����
	curl_setopt ( $curl, CURLOPT_COOKIEFILE, $GLOBALS ['cookie_file'] ); // ��ȡ�����������Cookie��Ϣ
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 ); // ���ó�ʱ���Ʒ�ֹ��ѭ��
	curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // ��ʾ���ص�Header��������
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // ��ȡ����Ϣ���ļ�������ʽ����
	$tmpInfo = curl_exec ( $curl ); // ִ�в���
	if (curl_errno ( $curl )) {
		echo 'Errno' . curl_error ( $curl );
	}
	curl_close ( $curl ); // �ر�CURL�Ự
	return $tmpInfo; // ��������
}

function vget($url) { // ģ���ȡ���ݺ���
	$curl = curl_init (); // ����һ��CURL�Ự
	if (IS_PROXY) {
		//���´������ô��������
		//�����������ַ
		curl_setopt ( $curl, CURLOPT_PROXY, $GLOBALS ['proxy'] );
	}
	curl_setopt ( $curl, CURLOPT_URL, $url ); // Ҫ���ʵĵ�ַ
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // ����֤֤����Դ�ļ��
	// curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 1 ); // ��֤���м��SSL�����㷨�Ƿ����
	curl_setopt ( $curl, CURLOPT_USERAGENT, $GLOBALS ['user_agent'] ); // ģ���û�ʹ�õ������
	@curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // ʹ���Զ���ת
	curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // �Զ�����Referer
	curl_setopt ( $curl, CURLOPT_HTTPGET, 1 ); // ����һ�������Post����
	curl_setopt ( $curl, CURLOPT_COOKIEFILE, $GLOBALS ['cookie_file'] ); // ��ȡ�����������Cookie��Ϣ
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 120 ); // ���ó�ʱ���Ʒ�ֹ��ѭ��
	curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // ��ʾ���ص�Header��������
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // ��ȡ����Ϣ���ļ�������ʽ����
	$tmpInfo = curl_exec ( $curl ); // ִ�в���
	if (curl_errno ( $curl )) {
		echo 'Errno' . curl_error ( $curl );
	}
	curl_close ( $curl ); // �ر�CURL�Ự
	return $tmpInfo; // ��������
}

function vpost($url, $data) { // ģ���ύ���ݺ���
	$curl = curl_init (); // ����һ��CURL�Ự
	if (IS_PROXY) {
		//���´������ô��������
		//�����������ַ
		curl_setopt ( $curl, CURLOPT_PROXY, $GLOBALS ['proxy'] );
	}
	curl_setopt ( $curl, CURLOPT_URL, $url ); // Ҫ���ʵĵ�ַ
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // ����֤֤����Դ�ļ��
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 1 ); // ��֤���м��SSL�����㷨�Ƿ����
	curl_setopt ( $curl, CURLOPT_USERAGENT, $GLOBALS ['user_agent'] ); // ģ���û�ʹ�õ������
	@curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // ʹ���Զ���ת
	curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // �Զ�����Referer
	curl_setopt ( $curl, CURLOPT_POST, 1 ); // ����һ�������Post����
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data ); // Post�ύ�����ݰ�
	curl_setopt ( $curl, CURLOPT_COOKIEFILE, $GLOBALS ['cookie_file'] ); // ��ȡ�����������Cookie��Ϣ
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 120 ); // ���ó�ʱ���Ʒ�ֹ��ѭ��
	curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // ��ʾ���ص�Header��������
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // ��ȡ����Ϣ���ļ�������ʽ����
	$tmpInfo = curl_exec ( $curl ); // ִ�в���
	if (curl_errno ( $curl )) {
		echo 'Errno' . curl_error ( $curl );
	}
	curl_close ( $curl ); // �ؼ�CURL�Ự
	return $tmpInfo; // ��������
}

function delcookie($cookie_file) { // ɾ��Cookie����
	unlink ( $cookie_file ); // ִ��ɾ��
}
?>

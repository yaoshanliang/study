<?// �����õ�URL
$urls = array(
    "http://www.cnn.com",
    "http://www.mozilla.com",
    "http://www.facebook.com"
);
// �����õ��������Ϣ
$browsers = array(
    "standard" => array (
        "user_agent" => "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6 (.NET CLR 3.5.30729)",
        "language" => "en-us,en;q=0.5"
        ),
    "iphone" => array (
        "user_agent" => "Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1A537a Safari/419.3",
        "language" => "en"
        ),
    "french" => array (
        "user_agent" => "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; GTB6; .NET CLR 2.0.50727)",
        "language" => "fr,fr-FR;q=0.5"
        )
);
foreach ($urls as $url) {
    echo "URL: $url\n";
    foreach ($browsers as $test_name => $browser) {
        $ch = curl_init();
        // ���� url
        curl_setopt($ch, CURLOPT_URL, $url);
        // ������������ض�header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "User-Agent: {$browser['user_agent']}",
                "Accept-Language: {$browser['language']}"
            ));
        // ҳ���������ǲ�����Ҫ
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        // ֻ�践��HTTP header
        curl_setopt($ch, CURLOPT_HEADER, 1);
        // ���ؽ���������������
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        // ���ض����HTTPͷ��Ϣ��?
        if (preg_match("!Location: (.*)!", $output, $matches)) {
            echo "$test_name: redirects to $matches[1]\n";
        } else {
            echo "$test_name: no redirection\n";
        }
    }
    echo "\n\n";
}
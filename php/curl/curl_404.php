<?php
// 1. ��������
$mh = curl_multi_init();
// 2. ���������������URL
for ($i = 0; $i < $max_connections; $i++) {
    add_url_to_multi_handle($mh, $url_list);
}
// 3. ��ʼ����
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
// 4. ��ѭ��
while ($active && $mrc == CURLM_OK) {
    // 5. �л����
    if (curl_multi_select($mh) != -1) {
        // 6. �ɻ�
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        // 7. ����Ϣ��
        if ($mhinfo = curl_multi_info_read($mh)) {
            // ��ζ�Ÿ�������������
            // 8. ��curl�����ȡ��Ϣ
            $chinfo = curl_getinfo($mhinfo['handle']);
            // 9. ����ô��
            if (!$chinfo['http_code']) {
                $dead_urls []= $chinfo['url'];
            // 10. 404��?
            } else if ($chinfo['http_code'] == 404) {
                $not_found_urls []= $chinfo['url'];
            // 11. ������
            } else {
                $working_urls []= $chinfo['url'];
            }
            // 12. �Ƴ����
            curl_multi_remove_handle($mh, $mhinfo['handle']);
            curl_close($mhinfo['handle']);
            // 13. ������URL���ɻ�
            if (add_url_to_multi_handle($mh, $url_list)) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }
    }
}
// 14. ����
curl_multi_close($mh);
echo "==Dead URLs==\n";
echo implode("\n",$dead_urls) . "\n\n";
echo "==404 URLs==\n";
echo implode("\n",$not_found_urls) . "\n\n";
echo "==Working URLs==\n";
echo implode("\n",$working_urls);
// 15. �������������url
function add_url_to_multi_handle($mh, $url_list) {
    static $index = 0;
    // �����ʣurlû��
    if ($url_list[$index]) {
        // �½�curl���
        $ch = curl_init();
        // ����url
        curl_setopt($ch, CURLOPT_URL, $url_list[$index]);
        // ����������ص�����
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // �ض����Ķ����Ǿ�ȥ�Ķ�
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // ����Ҫ�����壬�ܹ���Լ�����ʱ��
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        // ���뵽����������
        curl_multi_add_handle($mh, $ch);
        // ��һ�¼��������´ε��øú������������һ��url��
        $index++;
        return true;
    } else {
        // û���µ�URL��Ҫ������
        return false;
    }
}
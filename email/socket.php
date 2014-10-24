<?php
class smtp_mail
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $debug = false;
    private $sock;//连接句柄
    private $mail_format = 0;

    function smtp_mail($host, $port = 25, $username, $password, $mail_format = 1, $debug = 1)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = base64_encode($username);
        $this->password = base64_encode($password);
        $this->mail_format = $mail_format;
        $this->debug = $debug;

        //连接到SMTP服务器
        $this->sock = fsockopen($this->host, $this->port,  $errno,  $errstr, 10);
        if(!$this->sock)
            exit("Error number: $errno, Error message: $errstr\n");
        $response = fgets($this->sock);//获取服务器信息
        if(strstr($response, "220") === false)
            exit("server error: $response\n");
    }

    //显示debug
    private function show_debug($message)
    {
        if($this->debug)
            echo "<p>Debug: $message</p>\n";
    }

    //把命令发送到服务器执行，取得服务器消息
    private function do_command($cmd, $return_code)
    {
        fwrite($this->sock, $cmd);
        $response = fgets($this->sock);
        echo "$response";
        if(strstr($response, "$return_code") === false)
        {
            $this->show_debug($response);
            return false;
        }
        return true;
    }

    //验证邮箱地址
    private function is_email($email)
    {
        //$pattern = "/^[^_][\w]*@[\w.]+[\w]*[^_]$/";
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
        if(preg_match($pattern, $email, $matches))
            return true;
        return false;
    }

    //具体的send_mail
    public function send_mail($from, $to, $subject, $body)
    {
        if((!$this->is_email($from)) || (!$this->is_email($to)))
        {
            $this->show_debug("Please enter vaild email");
            return false;
        }
        if(empty($subject) || empty($body))
        {
            $this->show_debug("Please enter subject/body");
            return false;
        }
        $detail = "From: $from"."\r\n";
        $detail .= "To: $to"."\r\n";
        $detail .= "Subject: $subject"."\r\n";
        if($this->mail_format == 1)
            $detail .= "Content-Type: text/html;\r\n";
        else
            $detail .= "Content-Type: text/plain;\r\n";
        $detail .= "charset = UTF-8\r\n\r\n";
        $detail .= $body;

        $this->do_command("HELO smtp.163.com\r\n", 250);
        $this->do_command("AUTH LOGIN\r\n", 334);
        $this->do_command($this->username . "\r\n", 334);
        $this->do_command($this->password . "\r\n", 235);
        $this->do_command("MAIL FROM: <" . $from .">\r\n", 250);
        $this->do_command("RCPT TO: <" . $to .">\r\n", 250);
        $this->do_command("DATA\r\n", 354);
        $this->do_command($detail . "\r\n.\r\n", 250);
        $this->do_command("QUIT\r\n", 221);
    }
}


$host = "smtp.163.com";
$port = 25;
$username = "iatboy@163.com";
$password = "ysl88842412";
$from = "iatboy@163.com";
$to = "1329517386@qq.com";
$subject = "Hello";
$content = "World";

$mail = new smtp_mail($host, $port, $username, $password);
//$mail->send_mail("<iatboy@163.com>","<iat.net.cn@gmail.com>", $subject, $content);
$mail->send_mail($from, $to, $subject, $content);

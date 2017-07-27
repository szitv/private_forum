<?php
require __DIR__ . '/../../public/vendor/phpMailer/PHPMailerAutoload.php';

/*
 * 邮件发送类
 */

class MailerController extends ControllerBase
{
    public function sendEmail($article_id, $article_real) {
        if ($article_id != '') {
            $article_model = new Article();
            $get_article = $article_model->findFirst(array('article_id = ' . $article_id));
            $article_real = $get_article->article_real;
        }
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 3;                               // 调试用，可注释
        $mail->isSMTP();
        $mail->Host = 'smtp.exmail.qq.com';  // SMTP服务器，我个人是用腾讯企业邮箱的，所以用这个。
        $mail->SMTPAuth = true;                               // 是否允许加密
        $mail->Username = 'admin@example.com';                 // 用户名
        $mail->Password = 'xxxxxxxx';                           // 密码
        $mail->SMTPSecure = 'ssl';                            // SMTP加密方式
        $mail->Port = 465;                                    // 端口号

        $mail->setFrom('admin@example.com', 'szitv'); //来源显示
        $mail->addAddress('aaa@example.com', 'aaa'); //抄送给谁，可多个
        $mail->addAddress('bbb@example.com', 'bbb');
        $mail->addAddress('ccc@example.com', 'ccc');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // 上传附件
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // 给附件加别名
        $mail->isHTML(true);                                  // 是否将格式转换为html
        $mail->CharSet ='UTF-8';
        $mail->Subject = '此处写主题';
        $mail->Body = '<!DOCTYPE html><html><head></head><body>';
        $mail->Body .= $article_real;
        $mail->Body .= '</body></html>';

        if(!$mail->send()) {
            return true;
        } else {
            return false;
        }
    }

}


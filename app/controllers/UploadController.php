<?php

/*
 * 文件上传类
 */

class UploadController extends ControllerBase
{
    /*
     * 上传图片
     */

    public function imageAction() {
        $image = $this->request->getRawBody();
        $last_position = strpos($image, ';');
        $first_position = strpos($image, ':');
        $extension = str_replace('image/', '', substr($image, ($first_position + 1), ($last_position - $first_position - 1)));
        $image_source = base64_decode(substr($image, strpos($image, ',') + 1));
        $file_name = (microtime(true) * 10000).'.'.$extension;
        file_put_contents('img/'.$file_name, $image_source);
        $ret['code'] = 1;
        $ret['msg'] = '上传图片成功';
        $ret['name'] = $file_name;
        $ret['path'] = 'http://' . $_SERVER['HTTP_HOST'] . '/img/' . $file_name;
        return json_encode($ret);
    }

    public function downloadAction($file_name) {
        $file = @fopen('article/'.$file_name, "r");
        if (!$file) {
            die('找不到文件');
        } else {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . $file_name);
            echo fread($file, filesize('article/'.$file_name));
            fclose($file);
            exit;
        }
    }

}


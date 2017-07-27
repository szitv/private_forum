<?php

class ArticleController extends ControllerBase
{
    /*
     * 文章列表
     */
    public function indexAction($module_id) {
        $this->common();
        $article_list = array();
        $article_model = new Article();
        $get_article_list = $article_model->find(array('module_id = ' . $module_id . ' and status = 1'));
        foreach($get_article_list as $key => $value) {
            $article_list[$key]->article_id = $value->article_id;
            $article_list[$key]->module_id = $value->module_id;
            $article_list[$key]->type = $value->type;
            $article_list[$key]->type_status = $value->type_status;
            $article_list[$key]->uid = $value->uid;
            $article_list[$key]->like_times = $value->like_times;
        }
        $this->view->article_list = $article_list;
        $this->view->module_id = $module_id;
        $this->view->page = 'article-list';
        $this->view->setMainView('article-list');
    }

    /*
     * 文章详情
     */
    public function infoAction($article_id) {
        $this->common();
        $member_model = false;
        $user_info = false;
        $comment_list = array();
        $article_model = new Article();
        $article_info = $article_model->findFirst(array('article_id = '.$article_id . ' and status = 1'));
        $nick_name = '';
        $have_author = 0;
        if ($article_info) {
            if ($this->checkNetWork()) {
                $member_model = new UserInfo();
            }
            if ($article_info->uid != 0) {
                $have_author = 1;
                if ($this->checkNetWork() && $member_model) {
                    $user_info = $member_model->findFirst(array('uId = ' . $article_info->uid));
                } else {
                    $nick_name = $this->getRandomNickName();
                }
            } else {
                $nick_name = $this->getRandomNickName();
            }


            $comment_model = new Comment();
            $get_comment_list = $comment_model->find(
                array(
                    'article_id = ' . $article_id . ' and status = 1 and parent_id = 0',
                )
            );
            foreach ($get_comment_list as $key => $value) {
                $uid = $value->uid;
                $comment_list[$key]->uid = $uid;
                if ($uid != 0) {
                    if ($this->checkNetWork() && $member_model) {
                        $comment_user_info = $member_model->findFirst(array('uId = ' . $uid));
                        $comment_list[$key]->nick_name = $comment_user_info->nickName . '（实名）';
                        $comment_list[$key]->portrait = $comment_user_info->portrait;
                    } else {
                        $comment_list[$key]->nick_name = '实名用户';
                        $comment_list[$key]->portrait = '/images/commenter.png';
                    }
                } else {
                    $comment_list[$key]->nick_name = $this->getRandomNickName() . '（匿名）';
                    $comment_list[$key]->portrait = '/images/commenter.png';
                }
                $comment_list[$key]->content = $value->content;
                $comment_list[$key]->comment_id = $value->comment_id;
                $comment_list[$key]->parent_id = $value->parent_id;
                $comment_list[$key]->create_at = date('Y-m-d H:i', strtotime($value->create_at));
                $comment_list[$key]->children_list = $this->getCommentChildrenList($comment_model, $member_model, $value->comment_id);
            }
        }
        $this->view->article_info = $article_info;
        $this->view->article_id = $article_id;
        $this->view->comment_list = $comment_list;
        $this->view->user_info = $user_info;
        $this->view->nick_name = $nick_name;
        $this->view->have_author = $have_author;
        $this->view->comment_list = $comment_list;
        $this->view->page = 'article';
        $this->view->setMainView('article');
    }

    /*
     * 评论文章
     */
    public function commentAction($article_id) {
        $uid = $this->session->get('uid');
        $post = $this->request->getJsonRawBody();
        $content = isset($post->comment) ? $post->comment : '';
        $comment_id = isset($post->comment_id) ? $post->comment_id : '';
        $now_date = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $article_model = new Article();
        $check_article_exist = $article_model->findFirst(array('article_id = ' . $article_id . ' and status = 1'));
        if ($check_article_exist) {
            $comment = new Comment();
            $comment->article_id = $article_id;
            $comment->uid = $uid;
            $comment->content = $content;
            $comment->create_at = $now_date;
            if ($comment_id != 0) {
                //回复评论
                $comment->parent_id = $comment_id;
            }
            $comment->save();
            if ($uid != '') {
                $article_model = new Article();
                $article = $article_model->findFirst(array('article_id = ' . $article_id));
                if ($article) {
                    $article->type_status = 1;
                    $article->save();
                }
            }

            $ret['code'] = 1;
            $ret['msg'] = '发布评论成功';
            return json_encode($ret);
        } else {
            $ret['code'] = 0;
            $ret['msg'] = '文章不存在或已被屏蔽';
            return json_encode($ret);
        }
    }

    /*
     * 文章点赞
     */
    public function likeAction($article_id) {
        $article_model = new Article();
        $like = $article_model->findFirst(array('article_id = ' . $article_id));
        if ($like) {
            $like->like_times += 1;
            $like->save();
            $ret['code'] = 1;
            $ret['msg'] = '点赞成功';
            return json_encode($ret);
        }
        $ret['code'] = 0;
        $ret['msg'] = '点赞失败';
        return json_encode($ret);
    }

    /*
     * 写文章的页面
     */
    public function writeAction() {
        $this->common();
        $module_list = array();
        $init_model = new Module();
        $get_module_list = $init_model->find(array('id <> 4'));
        foreach($get_module_list as $key => $value) {
            $module_list[$key]->id = $value->id;
            $module_list[$key]->name = $value->name;
            $module_list[$key]->description = $value->description;
        }
        $this->view->module_list = $module_list;
        $this->view->page = 'write-article';
        $this->view->setMainView('write-article');
    }

    /*
     * 写文章的api接口
     */
    public function writeApiAction() {
        $uid = $this->session->get('uid');
        $article = $this->request->getJsonRawBody();
        $module = $this->request->getHeader('module');
        $type = $this->request->getHeader('type');
        $now_date = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $article_model = new Article();
        $article_model->article_init = $article->article_init;
        $article_model->article_real = $article->article_real;
        $article_model->create_at = $now_date;
        $article_model->uid = $uid;
        $article_model->type = $type;
        $article_model->module_id = $module;
        $article_model->update_at = $now_date;
        $article_model->save();

        if ($module == '1') {
            $mailer = new MailerController();
            $mailer->sendEmail('', $article->article_real);
        }
        $ret['code'] = 1;
        $ret['msg'] = '发布文章成功';
        return json_encode($ret);
    }

    /*
     * 下载接口
     */
    public function downloadAction() {
        $article = '<!DOCTYPE html><html><head></head><body>';
        $article .= $this->request->getRawBody();
        $article .= '</body></html>';
        $file_name = (microtime(true) * 10000).'.html';
        file_put_contents('article/'.$file_name, $article);
        $ret['code'] = 1;
        $ret['file_name'] = $file_name;
        return json_encode($ret);
    }

    /*
     * 获取评论的评论
     */
    private function getCommentChildrenList($comment_model, $member_model, $parent_id) {
        $comment_list = array();
        if ($parent_id != 0) {
            $get_comment_list = $comment_model->find(array('parent_id = ' . $parent_id, ' and status=1'));
            foreach ($get_comment_list as $key => $value) {
                $uid = $value->uid;
                $comment_list[$key]->uid = $uid;
                if ($uid != 0) {
                    if ($this->checkNetWork() && $member_model) {
                        $comment_user_info = $member_model->findFirst(array('uId = ' . $uid));
                        $comment_list[$key]->nick_name = $comment_user_info->nickName . '（实名）';
                        $comment_list[$key]->portrait = $comment_user_info->portrait;
                    } else {
                        $comment_list[$key]->nick_name = '实名用户';
                        $comment_list[$key]->portrait = '/images/commenter.png';
                    }
                } else {
                    $comment_list[$key]->nick_name = $this->getRandomNickName() . '（匿名）';
                    $comment_list[$key]->portrait = '/images/commenter.png';
                }
                $comment_list[$key]->content = $value->content;
                $comment_list[$key]->comment_id = $value->comment_id;
                $comment_list[$key]->parent_id = $value->parent_id;
                $comment_list[$key]->create_at = date('Y-m-d H:i', strtotime($value->create_at));
            }
        }
        return $comment_list;
    }
}


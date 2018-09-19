<?php
namespace app\admin\logic;

class Index{
    public function __construct() {
        $this->error = ''; //失败提示的信息
        $this->success = '';   //成功提示的信息
    }
    /**
     * 后台登录
     * @author Leimon <6230200@qq.com>
     * @copyright: 137团队
     * @date：2018-6-23
     * @version：1.0
     */
    public function admin_login($data = []){
        $username = $data['username'];
        $password = $data['password'];
        $code = $data['code'];
        if (!checkVerify(strtolower( $code))) {
           $this->error ='验证码不正确';
           return false;
          }
        $admin_info = model('admin')->where(['username'=>$username])->find();
        if(!$admin_info){
            $this->error ='用户名或密码错误1';
            return false;
        }
        $password = md5(md5($password.$admin_info['secret']).$admin_info['secret']);
        if($password!=$admin_info['password']){
            $this->error ='用户名或密码错误2';
            return false;
        }
        //生成登录识别码
        $login_hash = md5(random(8));
         /* 写入登陆数据 */
         $updateAdminData = array (
            'login_hash'        => $login_hash,
            'lastloginip'       => $_SERVER["REMOTE_ADDR"],
            'logincount'        => $admin_info['logincount'] + 1
        );
        if (!model('admin')->where(['id'=>$admin_info['id']])->update($updateAdminData, FALSE)) {
          $this->error='登录异常，请稍候尝试.';
            return  false;
        }
        /* 标识登录状态 */
        // 写入SESSION
        session('admin_userid', $admin_info['id']);
        session('type', $admin_info['type']);
        cookie('FROMHASH', $login_hash ); //重新生成FROMHASH校验值
        cookie('admin_username',$admin_info['username']);
        cookie('admin_userid', $admin_info['id']);
        return $this->success='登陆成功';

    }

    /**
     * 返回错误
     * @author Leimon <6230200@qq.com>
     * @copyright: 137团队
     * @date：2018-6-23
     * @version：1.0
     */
    public function getError(){
        return $this->error;
    }
    /**
     * 返回成功
     * @author Leimon <6230200@qq.com>
     * @copyright: 137团队
     * @date：2018-6-23
     * @version：1.0
     */
    public function getSuccess(){
        return $this->success;
    }

}
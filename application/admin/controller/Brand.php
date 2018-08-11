<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 8:49
 */
namespace app\admin\controller;
use think\Controller;

class Brand extends Controller
{
   public function lst()
   {
       $brandRes =db('brand')->order('id desc')->paginate(8);
       $this->assign([
           'brandRes'=>$brandRes,
       ]);
       return view();
   }
   public function add()
   {
       if(request()->isPost()){
           $data=input('post.');
           //处理图片上传
           if($_FILES['brand_img']['tmp_name']){
               $data['brand_img']=$this->upload();
           }
          $add =db('brand')->insert($data);
          if($add)
          {
              $this->success('添加品牌成功!','lst');
              }else {
             $this->error('添加品牌失败!');
          }

       }
       return view();
   }
   public function edit()
   {
       return view();
   }
   public function del($id)
   {
       $del=db('brand')->delete($id);
       if($del) {
           $this->success('删除成功');
       }else {
           $this->error('删除失败!');
       }
       return view();
   }

   //上传图片
public function upload(){
  // 获取表单上传文件
    $file = request()->file('brand_img');
    if($file){
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS .'static'. DS . 'uploads');
        if($info){
           // 成功上传后 获取上传信息
             return $info->getSaveName();
        }else{
            // 上传失败获取错误信息
             echo $file->getError();
             die;
        }
    }
   }



}
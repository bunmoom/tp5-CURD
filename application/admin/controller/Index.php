<?php

namespace app\admin\controller;
use think\Db;
use think\Request;

class Index
{
  public function index()
  {
    dump(config());
  }

  public function list()
  {
    $data = Db::Query('select * from user');
    return json_encode($data);
  }

  public function add(Request $request)
  {
    $name = $request->get('name');
    if ($name == null || $name == '') {
      $result = [
        'code'  =>  '-1',
        'meg'   =>  'name不能为空'
      ];
      return json_encode($result);
    }
    $data = Db::execute('insert into user (name) values (?)', [$name]);
    if ($data == '1') {
      $result = [
        'code'  =>  '200',
        'meg'   =>  '添加成功'
      ];
    }
    return json_encode($result);
  }

  public function edit(Request $request)
  {
    $id = $request->get('id');
    $name = $request->get('name');
    if ($id == null || $id == '') {
      return json_encode([
        'code'  =>  '-1',
        'meg'   =>  '修改失败，id不能为空'
      ]);
    }
    if ($name == null || $name == '') {
      return json_encode([
        'code'  =>  '-1',
        'meg'   =>  '修改失败，name不能为空'
      ]);
    }
    $data = Db::table('user')->where('id', $id)->update(['name' =>  $name]);
    if ($data == 1) {
      return json_encode([
        'code'  =>  '200',
        'meg'   =>  '修改成功'
      ]);
    } else {
      return json_encode([
        'code'  =>  '200',
        'meg'   =>  '修改失败'
      ]);
    }
  }

  public function del(Request $request)
  {
    $id = $request->get('id');
    if ($id == null || $id == '') {
      return json_encode([
        'code'  =>  '-1',
        'meg'   =>  '删除失败，id不能为空'
      ]);
    }
    $data = Db::table('user')->delete($id);
    if ($data == 1) {
      return json_encode([
        'code'  =>  '200',
        'meg'   =>  '删除成功'
      ]);
    } else {
      return json_encode([
        'code'  =>  '-1',
        'meg'   =>  '添加失败'
      ]);
    }
  }
}
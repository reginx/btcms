<?php
namespace re\rgx;

/**
 * 分类接口
 * @author reginx
 */
class admin_category_iface extends admin_base_iface {


    /**
     * 分类类型ID
     * @var integer
     */
    public $type_id = 0;

    /**
     * 构造方法
     * @param [type] $mod   [description]
     * @param [type] $data  [description]
     * @param [type] $login [description]
     */
    public function __construct ($params = []) {
        parent::__construct($params);
        if (!isset(category_helper::$type[$this->type_id])) {
            $this->failure('无效的类型');
        }
    }

    /**
     * 获取分类详情
     * @return [type] [description]
     */
    public function get_action () {
        $this->data['id'] = intval($this->data['id']);
        $out = OBJ('category_table')->fields([
            'cat_id', 'cat_name', 'cat_parent', 'cat_type', 'cat_sort', 'cat_route'
        ])->get(
            (int)$this->data['id']
        );
        if ($this->data['parent']) {
            $out['parent_options'] = category_helper::get_options($this->type_id, 0, $this->data['id']);
            array_unshift($out['parent_options'], [
                'cat_id'    => 0, 
                'cat_name'  => '作为一级分类', 
                'cat_level' => 0, 
                'space'     => '作为一级分类'
            ]);
        }
        $out['cat_parent'] = intval($out['cat_parent']);
        $out['status_options'] = category_helper::$status;
        $this->success('', $out);
    }

    /**
     * 添加分类接口
     */
    public function save_action () {
        $this->check_login();
        $this->data['cat_type'] = $this->type_id;
        $tab = OBJ('category_table');
        $this->data['cat_paths'] = '#0#';
        $this->data['cat_level'] = 0;
        $this->data['cat_parent'] = (int)$this->data['cat_parent'];
        $this->data['cat_sort'] = (int)$this->data['cat_sort'];
        if ($this->data['cat_parent'] > 0) {
            $parent = $tab->get((int)$this->data['cat_parent']);
            if (empty($parent)) {
                $this->failure('无效的父级分类');
            }
            if ($this->data['cat_id'] == $this->data['cat_parent']) {
                $this->failure('父级分类不能是自己');
            }
            $this->data['cat_paths'] = $parent['cat_paths'] . "{$parent['cat_id']}#";
            $this->data['cat_level'] = $parent['cat_level'] + 1;
        }

        if ($tab->load($this->data) && $tab->save()['code'] === 0) {
            $this->success('操作成功');
        }
        $this->failure($tab->get_error_desc());
    }

    /**
     * 列表
     */
    public function list_action () {
        $out = array_values(category_helper::to_tree(
            OBJ('category_table')->order('cat_level asc, cat_sort desc')->get_all([
                'cat_type'  =>  $this->type_id
            ]), 1)
        );
        foreach ((array)$out as $k => $v) {
            $out[$k]['class'] = 'category_before category_before_' . $v['cat_level'];
            $out[$k]['status'] = category_helper::$status[$v['cat_status']] ?: '默认';
        }
        $options = category_helper::get_options($this->type_id, 0, 0);
        array_unshift($options, [
            'cat_id'    => 0, 
            'cat_name'  => '作为一级分类', 
            'cat_level' => 0, 
            'space'     => '作为一级分类'
        ]);
        $this->success('', [
            'rows'      => $out,
            'options'   => $options
        ]);
    }

    /**
     *  删除
     */
    public function del_action () {
        $id  = intval($this->data['id']);
        $tab = OBJ('category_table');
        $cat = $tab->get($id);
        if (empty($cat)) {
            $this->failure('该分类不存在');
        }

        if ($tab->where([
                "cat_parent"    => $cat['cat_id']
            ])->count() > 0) {
            $this->failure('请先删除下属分类');
        }
        // 删除
        if ($tab->delete(['cat_id' => $id])['code'] === 0) {
            $this->success('删除成功');
        }
        $this->failure('请先删除子类别');
    }

}

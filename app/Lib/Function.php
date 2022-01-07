<?php

if (!function_exists('listToTreeWithLevel')) {
    /**
     * 二维数组转树形结构
     * @param array $list
     * @param int $pid
     * @param int $level
     * @return array
     */
    function listToTreeWithLevel(array $list, int $pid = 0, int $level = 1)
    {
        $out = [];
        foreach ($list as $node) {
            if ($node['pid'] == $pid) {
                $node['level'] = $level;
                $children = listToTreeWithLevel($list, $node['id'], $level + 1);
                $node['children'] = $children;
                $out[] = $node;
            }
        }
        return $out;
    }
}

if(!function_exists('treeToList')) {
    /**
     * 树形结构转二维数组
     * @param array $tree
     * @return array
     */
    function treeToList(array $tree)
    {
        $queen = $out = [];

        $queen = array_merge($queen, $tree);
        $count = count($queen);
        while ($count > 0) {
            $first = array_shift($queen);
            $queen = array_merge($queen, $first['children']);
            unset($first['children']);
            $out[] = $first;
            $count = count($queen);
        }

        return $out;
    }
}

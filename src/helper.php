<?php
declare (strict_types=1);

use Think\Component\Container\Container;
use Think\Component\Cache\Facade\CacheFacade;

if (!function_exists('cache')) {
    /**
     * 缓存管理
     * @param string|null $name 缓存名称
     * @param mixed $value 缓存值
     * @param mixed $options 缓存参数
     * @param null $tag 缓存标签
     * @return mixed
     */
    function cache(?string $name = null, $value = '', $options = null, $tag = null)
    {
        if (is_null($name)) {
            return Container::getInstance()->get('cache');
        }

        if ('' === $value) {
            // 获取缓存
            return str_starts_with($name, '?') ? CacheFacade::has(substr($name, 1)) : CacheFacade::get($name);
        } elseif (is_null($value)) {
            // 删除缓存
            return CacheFacade::delete($name);
        }

        // 缓存数据
        if (is_array($options)) {
            $expire = $options['expire'] ?? null; //修复查询缓存无法设置过期时间
        } else {
            $expire = $options;
        }

        if (is_null($tag)) {
            return CacheFacade::set($name, $value, $expire);
        } else {
            return CacheFacade::tag($tag)->set($name, $value, $expire);
        }
    }
}
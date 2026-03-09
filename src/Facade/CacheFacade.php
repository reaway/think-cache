<?php
declare(strict_types=1);

namespace Think\Component\Cache\Facade;

use Think\Component\Cache\Driver;
use Think\Component\Cache\TagSet;
use Think\Component\Facade\Facade;
use Think\Component\Cache\Cache;

/**
 * @see Cache
 * @package Think\Component\Cache\Facade
 * @mixin Cache
 * @method static string|null getDefaultDriver() 默认驱动
 * @method static mixed getConfig(null|string $name = null, mixed $default = null) 获取缓存配置
 * @method static array getStoreConfig(string $store, string $name = null, null $default = null) 获取驱动配置
 * @method static Driver store(string $name = null) 连接或者切换缓存
 * @method static bool clear() 清空缓冲池
 * @method static mixed get(string $key, mixed $default = null) 读取缓存
 * @method static bool set(string $key, mixed $value, int|\DateInterval|\DateTimeInterface $ttl = null) 写入缓存
 * @method static bool delete(string $key) 删除缓存
 * @method static iterable getMultiple(iterable $keys, mixed $default = null) 读取缓存
 * @method static bool setMultiple(iterable $values, null|int|\DateInterval|\DateTimeInterface $ttl = null) 写入缓存
 * @method static bool deleteMultiple(iterable $keys) 删除缓存
 * @method static bool has(string $key) 判断缓存是否存在
 * @method static TagSet tag(string|array $name) 缓存标签
 */
class CacheFacade extends Facade
{
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return Cache::class;
    }
}

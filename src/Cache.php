<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace Think\Component\Cache;

use Psr\SimpleCache\CacheInterface;
use think\helper\Arr;
use Think\Component\Manager\Manager;
use Think\Component\Cache\Exception\InvalidArgumentException;
use Think\Component\Cache\Driver;
use Think\Component\Cache\TagSet;
use Think\Component\Config\Config;

/**
 * 缓存管理类
 */
class Cache extends Manager implements CacheInterface
{
    protected $namespace = 'Think\\Component\\Cache\\Driver\\';

    /**
     * 配置参数
     * @var array
     */
    protected $config = [
        // 默认缓存驱动
        'default' => 'file',

        // 缓存连接方式配置
        'stores' => [
            'file' => [
                // 驱动方式
                'type' => 'File',
                // 缓存保存目录
                'path' => '',
                // 缓存前缀
                'prefix' => '',
                // 缓存有效期 0表示永久缓存
                'expire' => 0,
                // 缓存标签前缀
                'tag_prefix' => 'tag:',
                // 序列化机制 例如 ['serialize', 'unserialize']
                'serialize' => [],
            ],
            // 更多的缓存连接
        ],
    ];

    public static function __make(Config $config)
    {
        return new static($config->get('cache'));
    }

    /**
     * 默认驱动
     * @return string|null
     */
    public function getDefaultDriver()
    {
        return $this->getConfig('default');
    }

    /**
     * 获取驱动配置
     * @param string $store
     * @param string $name
     * @param null $default
     * @return array
     */
    public function getStoreConfig(string $store, string $name = null, $default = null)
    {
        if ($config = $this->config['stores'][$store] ?? null) {
            return Arr::get($config, $name, $default);
        }

        throw new \InvalidArgumentException("Store [$store] not found.");
    }

    protected function resolveType(string $name)
    {
        return $this->getStoreConfig($name, 'type', 'file');
    }

    protected function resolveConfig(string $name)
    {
        return $this->getStoreConfig($name);
    }

    /**
     * 连接或者切换缓存
     * @access public
     * @param string $name 连接配置名
     * @return Driver
     */
    public function store(string $name = null)
    {
        return $this->driver($name);
    }

    /**
     * 清空缓冲池
     * @access public
     * @return bool
     */
    public function clear(): bool
    {
        return $this->store()->clear();
    }

    /**
     * 读取缓存
     * @access public
     * @param string $key 缓存变量名
     * @param mixed $default 默认值
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->store()->get($key, $default);
    }

    /**
     * 写入缓存
     * @access public
     * @param string $key 缓存变量名
     * @param mixed $value 存储数据
     * @param int|\DateTime $ttl 有效时间 0为永久
     * @return bool
     */
    public function set($key, $value, $ttl = null): bool
    {
        return $this->store()->set($key, $value, $ttl);
    }

    /**
     * 删除缓存
     * @access public
     * @param string $key 缓存变量名
     * @return bool
     */
    public function delete($key): bool
    {
        return $this->store()->delete($key);
    }

    /**
     * 读取缓存
     * @access public
     * @param iterable $keys 缓存变量名
     * @param mixed $default 默认值
     * @return iterable
     * @throws InvalidArgumentException
     */
    public function getMultiple($keys, $default = null): iterable
    {
        return $this->store()->getMultiple($keys, $default);
    }

    /**
     * 写入缓存
     * @access public
     * @param iterable $values 缓存数据
     * @param null|int|\DateInterval $ttl 有效时间 0为永久
     * @return bool
     */
    public function setMultiple($values, $ttl = null): bool
    {
        return $this->store()->setMultiple($values, $ttl);
    }

    /**
     * 删除缓存
     * @access public
     * @param iterable $keys 缓存变量名
     * @return bool
     * @throws InvalidArgumentException
     */
    public function deleteMultiple($keys): bool
    {
        return $this->store()->deleteMultiple($keys);
    }

    /**
     * 判断缓存是否存在
     * @access public
     * @param string $key 缓存变量名
     * @return bool
     */
    public function has($key): bool
    {
        return $this->store()->has($key);
    }

    /**
     * 缓存标签
     * @access public
     * @param string|array $name 标签名
     * @return TagSet
     */
    public function tag($name): TagSet
    {
        return $this->store()->tag($name);
    }
}
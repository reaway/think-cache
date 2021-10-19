# think-cache

## 安装
```bash
composer require reaway/think-cache
```

## 用法
```php
use Think\Component\Cache\Facade\Cache;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Cache::setConfig([
    'default' => 'file',
    'stores' => [
        'file' => [
            'type' => 'File',
            // 缓存保存目录
            'path' => __DIR__ . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR,
            // 缓存前缀
            'prefix' => '',
            // 缓存有效期 0表示永久缓存
            'expire' => 0,
        ],
        'redis' => [
            'type' => 'redis',
            'host' => '127.0.0.1',
            'port' => 6379,
            'prefix' => '',
            'expire' => 0,
        ],
    ],
]);

Cache::set('key', 'value');
Cache::get('key');
```
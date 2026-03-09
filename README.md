# think-cache

## 安装
```bash
composer require reaway/think-cache
```

## 用法
```php
use Think\Component\Cache\Facade\CacheFacade;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

CacheFacade::setConfig([
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

CacheFacade::set('key', 'value');
CacheFacade::get('key');
```

## 文档

详细参考 [缓存处理](https://www.kancloud.cn/manual/thinkphp6_0/1037634)
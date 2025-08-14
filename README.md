# ThinkPHP Filesystem Baidu BOS
Baidu BOS storage for ThinkPHP, 百度对象存储作为ThinkPHP文件存储。

[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE)
[![Build Status](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos/badges/build.png?b=master)](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/xinningsu/thinkphp-filesystem-baidu-bos)

# 安装

```
composer require xinningsu/thinkphp-filesystem-baidu-bos

```

# 配置

在 `config/filesystems.php` 中添加配置：

```php
return [
    // 默认磁盘
    'default' => 'bos', // 默认使用百度对象存储，或操作时指定 Filesystem::disk('bos')
    // 磁盘列表
    'disks'   => [
        // ...
        // 百度对象存储
        'bos' => [
            'type'       => 'bos',
            'access_key' => 'your_access_key',
            'secret_key' => 'your_secret_key',
            'region'     => 'your_region',
            'bucket'     => 'your_bucket',
        ],
        // ...
    ],
];
```

# 例子

```php
use think\facade\Filesystem;

// Write a new file.
Filesystem::write('file.txt', 'contents');

// If the default disk is not BOS, you can specify bos disk
Filesystem::disk('bos')->write('file.txt', 'contents');

// Write a new file using a stream.
Filesystem::writeStream('file.txt', fopen('/resource.txt', 'r'));

// Create a file or update if exists.
Filesystem::put('file.txt', 'contents');

// Create a file or update if exists using a stream.
Filesystem::putStream('file.txt', fopen('/resource.txt', 'r'));

// Update an existing file.
Filesystem::update('file.txt', 'contents');

// Update an existing file using a stream.
Filesystem::updateStream('file.txt', fopen('/resource.txt', 'r'));

// Read a file.
$content = Filesystem::read('file.txt');

// Retrieves a read-stream for a path.
$stream = Filesystem::readStream('file.txt');

// Check whether a file exists.
$has = Filesystem::has('file.txt');

// Copy a file.
Filesystem::copy('file.txt', 'file2.txt');

// Rename a file.
Filesystem::rename('file.txt', 'file2.txt');

// Delete a file.
Filesystem::delete('file.txt');

// Get a file's metadata.
$meta = Filesystem::getMetadata('file.txt');

// Get a file's size.
$size = Filesystem::getSize('file.txt');

// Get a file's mime-type.
$mimeType = Filesystem::getMimetype('file.txt');

// Get a file's timestamp.
$ts = Filesystem::getTimestamp('file.txt');

// Set the visibility for a file.
Filesystem::setVisibility('file.txt', 'public');

// Get a file's visibility.
$visibility = Filesystem::getVisibility('file.txt');

// Delete a directory.
Filesystem::deleteDir('test/');

// Create a directory.
Filesystem::createDir('test/');

// List contents of a directory.
$lists = Filesystem::listContents('test/', true);
```

# Reference

- [https://github.com/xinningsu/flysystem-baidu-bos](https://github.com/xinningsu/flysystem-baidu-bos)
- [https://github.com/thephpleague/flysystem](https://github.com/thephpleague/flysystem)
- [https://github.com/xinningsu/baidu-bos](https://github.com/xinningsu/baidu-bos)
- [https://cloud.baidu.com/doc/BOS/index.html](https://cloud.baidu.com/doc/BOS/index.html)

# License

[MIT](./LICENSE)

<?php

declare(strict_types=1);

namespace think\filesystem\driver;

use League\Flysystem\FilesystemAdapter;
use Sulao\BaiduBos\Client;
use Sulao\Flysystem\BaiduBos\BaiduBosAdapter;
use think\filesystem\Driver;

class Bos extends Driver
{
    protected $config = [];

    protected function createAdapter(): FilesystemAdapter
    {
        $config = $this->config + [
            'disable_asserts' => true,
            'case_sensitive' => true,
            'options' => [],
        ];

        $client = new Client([
            'access_key' => $config['access_key'],
            'secret_key' => $config['secret_key'],
            'bucket' => $config['bucket'],
            'region' => $config['region'],
            'options' => $config['options']
        ]);

        return new BaiduBosAdapter($client);
    }

    public function url(string $path): string
    {
        if (isset($this->config['url'])) {
            return $this->concatPathToUrl($this->config['url'], $path);
        }

        return $this->concatPathToUrl(
            "https://{$this->config['bucket']}.{$this->config['region']}.bcebos.com",
            $path
        );
    }
}

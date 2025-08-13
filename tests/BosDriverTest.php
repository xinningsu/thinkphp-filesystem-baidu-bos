<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use PHPUnit\Framework\TestCase;
use think\App;
use think\facade\Filesystem;

class BosDriverTest extends TestCase
{
    public function testBos()
    {
        $config = [
            'default' => 'bos',
            'disks'   => [
                'bos' => [
                    'type'       => 'bos',
                    'access_key' => getenv('BOS_KEY'),
                    'secret_key' => getenv('BOS_SECRET'),
                    'region'     => 'gz',
                    'bucket'     => 'xinningsu',
                ],
            ],
        ];

        $app = new App();
        $app->config->set($config, 'filesystem');
        $app->boot();

        Filesystem::write(
            'think_bos_test.txt',
            'think bos test',
            ['request' => ['connect_timeout' => 10]]
        );

        $this->assertTrue(Filesystem::fileExists('think_bos_test.txt'));

        $this->assertEquals(
            'think bos test',
            Filesystem::read('think_bos_test.txt')
        );

        $this->assertEquals(
            'https://xinningsu.gz.bcebos.com/think_bos_test.txt',
            Filesystem::url('think_bos_test.txt')
        );

        $app = new App();
        $app->config->set(
            [
                ... $config,
                'disks' => [
                    ...$config['disks'],
                    'bos' => [
                        ...$config['disks']['bos'],
                        'url' => 'https://bj.bcebos.com',
                    ],
                ],
            ],
            'filesystem',
        );
        $app->boot();
        $this->assertEquals(
            'https://bj.bcebos.com/think_bos_test.txt',
            Filesystem::url('think_bos_test.txt')
        );

        Filesystem::delete('think_bos_test.txt');
        $this->assertFalse(Filesystem::fileExists('think_bos_test.txt'));
    }

    protected function getApp()
    {
        $app = new App();
        $app->config->set(
            [
                'default' => 'bos',
                'disks'   => [
                    'bos' => [
                        'type'       => 'bos',
                        'access_key' => getenv('BOS_KEY'),
                        'secret_key' => getenv('BOS_SECRET'),
                        'region'     => 'gz',
                        'bucket'     => 'xinningsu',
                    ],
                ],
            ],
            'filesystem',
        );

        return $app;
    }
}

<?php

use PHPUnit\Framework\TestCase;

use Core\View;

final class MvcViewSampleTest extends TestCase
{
    private static $autoloaderFilePath = __DIR__.'/../vendor/autoload.php';

    public static function setUpBeforeClass(): void
    {
        require_once self::$autoloaderFilePath;
    }

    public function testViewRender()
    {
        $expectedResult = <<<EOT
        <!DOCTYPE html>
        <html>
        <head>
            <title>Index</title>
        </head>
        <body>
            <p>Hello, World!</p>
        </body>
        </html>
        EOT;
        $this->assertEquals(
            $expectedResult,
            View::render('index', ['message' => 'Hello, World!'])
        );
    }
}

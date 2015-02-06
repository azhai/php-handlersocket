<?php
namespace PHSTest;
use \PHPUnit_Framework_TestCase as TestCase;
use \HandlerSocket;


class DBFixture extends TestCase
{
    // 只实例化 hs 一次，供测试的清理和基境读取使用。
    protected static $hs = null;

    public static function setUpBeforeClass()
    {
        if (self::$hs == null) {
            self::$hs = new HandlerSocket($GLOBALS['DB_NAME']);
            self::$hs->open($GLOBALS['DB_TABLE'], $GLOBALS['DB_FIELDS']);
        }
    }
    
    public function tearDown()
    {
        $this->truncate();
    }

    protected function truncate()
    {
        self::$hs->truncate(range(1,8));
    }

    protected function insertRows($count = 8)
    {
        $names = explode(',', $GLOBALS['DB_FIELDS']);
        $rows = $this->provider();
        for ($i = 0; $i < $count; $i ++) {
            self::$hs->insert(array_combine($names, $rows[$i]));
        }
    }

    public function provider()
    {
        $now = date('Y-m-d H:i:s');
        return array(
            array(1, '', 90, $now, true),
            array(2, 'Alice', 100, $now, false),
            array(3, 'Bob', 90, $now, true),
            array(4, 'Candy', 100, $now, false),
            array(5, 'David', 75, $now, true),
            array(6, 'Emily', 80, $now, true),
            array(7, 'Frank', 90, $now, false),
            array(8, 'Grace', 100, $now, false),
        );
    }
}


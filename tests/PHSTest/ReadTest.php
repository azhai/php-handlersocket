<?php
namespace PHSTest;


class ReadTest extends DBFixture
{
    public function setUp()
    {
        $this->truncate();
        $this->insertRows();
    }
    
    public function test01Connect()
    {
        $this->assertInstanceOf('\\HandlerSocket', self::$hs);
        $this->assertNotNull(self::$hs);
    }

    public function test02GetByID()
    {
        $david = self::$hs->get(5);
        $this->assertEquals('David', $david['username']);
        $this->assertEquals(75, intval($david['score']));
    }

    public function test03GetByName()
    {
        $candy = self::$hs->get('username', 'Candy');
        $this->assertEquals('Candy', $candy['username']);
        $this->assertEquals(100, intval($candy['score']));
    }

    public function test04Find()
    {
        $users = self::$hs->all(null, '>=', 2, 3, 1);
        $this->assertEquals(3, count($users));
        $this->assertEquals('David', $users[1]['username']);
        $this->assertEquals(75, intval($users[1]['score']));
    }

    public function test05In()
    {
        $users = self::$hs->in('username', 'Alice', 'David');
        $this->assertEquals(2, count($users));
        $this->assertEquals('David', $users[1]['username']);
        $this->assertEquals(75, intval($users[1]['score']));
    }
}


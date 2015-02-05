<?php
namespace PHSTest;


class WriteTest extends DBFixture
{
    public function setUp()
    {
        $this->truncate();
    }
    
    /**
     * @dataProvider provider
     */
    public function test01Insert($id, $username, $score, $is_active)
    {
        $names = explode(',', $GLOBALS['DB_FIELDS']);
        $row = func_get_args();
        $success = self::$hs->insert(array_combine($names, $row));
        $user = self::$hs->get($id);
        $this->assertTrue($success);
        $this->assertEquals($username, $user['username']);
    }

    /**
     * @depends test01Insert
     */
    public function test02Update()
    {
        $now = date('Y-m-d H:i:s');
        self::$hs->update(array('David', 60, $now, true), null, 5);
        $david = self::$hs->get(5);
        $this->assertEquals('David', $david['username']);
        $this->assertEquals(75, intval($david['score']));
    }

    /**
     * @depends test02Update
     */
    public function test03Delete()
    {
        self::$hs->delete(null, '>', 5);
        $users = self::$hs->all(null, '>=', 2, 3, 1);
        $this->assertEquals(2, count($users));
    }
}


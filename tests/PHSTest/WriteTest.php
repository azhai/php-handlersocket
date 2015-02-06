<?php
namespace PHSTest;


class WriteTest extends DBFixture
{
    /**
     * @dataProvider provider
     */
    public function test01Insert($id, $username, $score, $modified_at, $is_active)
    {
        $names = explode(',', $GLOBALS['DB_FIELDS']);
        $row = func_get_args();
        $data = array_combine($names, $row);
        $success = self::$hs->insert($data);
        $user = self::$hs->get($id);
        $this->assertTrue($success);
        $this->assertEquals($username, $user['username']);
    }

    public function test02Update()
    {
        $this->insertRows();
        $now = date('Y-m-d H:i:s');
        self::$hs->update(array(5, 'David', 60, $now, true), null, 5);
        $david = self::$hs->get(5);
        $this->assertEquals('David', $david['username']);
        $this->assertEquals(60, intval($david['score']));
    }
    
    /**
     * @depends test02Update
     */
    public function test03Delete()
    {
        $this->insertRows();
        self::$hs->delete(6);
        self::$hs->delete(7);
        self::$hs->delete(8);
        $users = self::$hs->all(null, '>', 2, 3, 1);
        $this->assertEquals(2, count($users));
        $this->assertEquals('David', $users[1]['username']);
        $this->assertEquals(75, intval($users[1]['score']));
    }
}


<?php
// +----------------------------------------------------------------------
// | GetTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Test\Models;

use Test\App\Models\User;
use Test\App\Models\User2;
use \UnitTestCase;
use Xin\DB;

/**
 * Class UnitTest
 */
class MoreSchemaTest extends UnitTestCase
{
    public function testSaveAndGetCase()
    {
        $user = new User2();
        $user->schema = 'phalcon';
        $username = $user->getSchema() . uniqid();
        $user->username = $username;
        $user->email = 'test@test.com';
        $user->role_id = 1;
        $user->password = md5('123456');
        $res = $user->save();
        $this->assertTrue($res);

        $res = DB::query('SELECT * FROM phalcon.user WHERE username=?', [$username]);
        $this->assertTrue(count($res) > 0);

        $user = new User2();
        $user->schema = 'phalcon_test';
        $username = $user->getSchema() . uniqid();
        $user->username = $username;
        $user->email = 'test@test.com';
        $user->role_id = 1;
        $user->password = md5('123456');
        $res = $user->save();
        $this->assertTrue($res);

        $res = DB::query('SELECT * FROM phalcon_test.user WHERE username=?', [$username]);
        $this->assertTrue(count($res) > 0);

        $user = new User2();
        $user->schema = 'phalcon_test';
        $res = $user->get([
            'conditions' => 'username = ?0',
            'bind' => [$username],
            'tables' => 'phalcon_test.user',
        ]);
    }
}
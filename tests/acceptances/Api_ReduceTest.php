<?php
/**
 * 验收测试用例 Api Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-12-12
 */
namespace Tests\TestCase\Acceptance;

use Tests\TestCase;
use YafUnit\Request\Http;

class Api_ReduceTest extends TestCase {

    /**
     * @test
     */
    public function assgin_reduce_disk() {
        $request = new Http("/api/reduce/disk");

        $this->getApplication()->getDispatcher()->dispatch($request);
        $response = $this->getView()->response;
        $this->assertEquals(['disk' => '2000MB'], $response[0]);
        $this->assertEquals(1,                    $response[1]);
    }

    /**
     * @test
     */
    public function response_ajax_format() {
        $request = new Http("/api/reduce/ajaxresponse");

        $this->getApplication()->getDispatcher()->dispatch($request);
        $response = $this->getView()->response;
        $this->assertEquals('Successfully',       $response[0]);
        $this->assertEquals(['disk' => '2000MB'], $response[1]);
    }

    /**
     * @test
     */
    public function throw_exception_on_memory() {
        $this->setExpectedException('\Exception', 'Memory not exist.', '0');
        $request = new Http("/ajax/reduce/memory");

        $this->getApplication()->getDispatcher()->dispatch($request);
    }
}
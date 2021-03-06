<?php

namespace DarkMatter\Tests\Unit\Responder;

use DarkMatter\Components\Templating\PhtmlRenderer;
use DarkMatter\Http\Response;
use DarkMatter\Responder\HtmlResponder;
use PHPUnit\Framework\TestCase;

class HtmlResponderTest extends TestCase
{
    public $configData;

    public $config;

    public function setUp(): void
    {
        $this->config = include SC_TESTS . '/Fixtures/config.php';
    }

    public function testGetSetResponder()
    {
        $responder = new HtmlResponder($this->config);
        $responder->setResponse(new Response);
        $this->assertInstanceOf(Response::class, $responder->getResponse());
    }

    public function testFound()
    {
        $responder = new HtmlResponder($this->config);
        $response = $responder->found([
            'body' => 'bar',
        ]);
        $this->assertEquals('bar', $response->getBody());
    }

    public function testBadRequest()
    {
        $responder = new HtmlResponder($this->config);
        $response = $responder->badRequest();
        $this->assertEquals(400, $response->getStatus());
    }

    public function testNotFound()
    {
        $responder = new HtmlResponder($this->config);
        $response = $responder->notFound();
        $this->assertEquals(404, $response->getStatus());
    }

    public function testMethodNotAllowed()
    {
        $responder = new HtmlResponder($this->config);
        $response = $responder->methodNotAllowed();
        $this->assertEquals(405, $response->getStatus());
    }

    public function testError()
    {
        $responder = new HtmlResponder($this->config);
        $response = $responder->error(['foo' => 'testing error']);
        $this->assertEquals(500, $response->getStatus());
        $this->assertStringContainsString('testing error', $response->getBody());
    }
}

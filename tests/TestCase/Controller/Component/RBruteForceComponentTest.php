<?php
namespace RBruteForce\Test\TestCase\Controller\Component;

use Cake\Event\Event;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use RBruteForce\Controller\Component\RBruteForceComponent;
use Cake\TestSuite\TestCase;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\Controller\Controller;

class RBruteForceComponentTest extends TestCase {

    public $component = null;
    public $controller = null;
    
   	public $fixtures = ['plugin.r_brute_force.rbruteforces'];

    public function setUp() {
        parent::setUp();
        // Setup our component and fake test controller
        $request = new ServerRequest();
        $response = new Response();
        $this->controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();
        $registry = new ComponentRegistry($this->controller);
        $this->component = new RBruteForceComponent($registry);
        new Event('Controller.startup', $this->controller);
    }

    public function testGetCountNoUrlCheck() {
        $this->component->request = new Request(
            ['environment' => ['REMOTE_ADDR' => '188.189.190.191'],]
        );
        $this->component->check(['checkUrl' => false]);
        $actual = $this->component->getCount();
        $expected = 3;
        $this->assertEquals($expected, $actual);        
    }

    public function testGetCountWithUrlCheck() {
        $this->component->request = new Request(
            [
                'environment' => ['REMOTE_ADDR' => '188.189.190.191'],
                'url' => 'users/login'
            ]
        );
        $this->component->check(['checkUrl' => true]);
        $actual = $this->component->getCount();
        $expected = 2;
        $this->assertEquals($expected, $actual);
    }
    
    public function tearDown() {
        parent::tearDown();
        // Clean up after we're done
        unset($this->component, $this->controller);
    }
}
?>

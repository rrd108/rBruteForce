<?php
namespace RBruteForce\Test\TestCase\Controller\Component;

use RBruteForce\Controller\Component\RBruteForceComponent;
use Cake\TestSuite\TestCase;
use Cake\Controller\Controller;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\Network\Response;

class RBruteForceComponentTest extends TestCase {

    public $component = null;
    public $controller = null;
    
   	public $fixtures = ['plugin.r_brute_force.rbruteforces'];

    public function setUp() {
        parent::setUp();
		$controller = $this->getMock('Cake\Controller\Controller', ['redirect']);
		$this->registry = new ComponentRegistry($controller);
		$this->component = new RBruteForceComponent($this->registry);
    }

   /* public function testIncrementExpire() {
        $actual = $this->component->incrementExpire();
        $expected = '3 minutes';
        $this->assertEquals($expected, $actual);

        $this->component->check(['expire' => '10 minutes']);
        $actual = $this->component->incrementExpire();
        $expected = '10 minutes';
        $this->assertEquals($expected, $actual);
    }
*/
    public function testGetCountNoUrlCheck() {
        $this->component->request = new Request(
                                        [
                                         'environment' => ['HTTP_HOST' => '188.189.190.191'],
                                         ]);
        $this->component->check(['checkUrl' => false]);
        $actual = $this->component->getCount();
        $expected = 2;
        $this->assertEquals($expected, $actual);        
    }

    public function testGetCountWithUrlCheck() {
        $this->component->request = new Request(
                                        [
                                         'environment' => ['HTTP_HOST' => '188.189.190.191'],
                                         'url' => 'users/login'
                                         ]);
       
        $this->component->check(['checkUrl' => true]);
        $actual = $this->component->getCount();
        $expected = 1;
        $this->assertEquals($expected, $actual);
    }
    
    public function tearDown() {
        parent::tearDown();
        // Clean up after we're done
        unset($this->component, $this->controller);
    }
}
?>
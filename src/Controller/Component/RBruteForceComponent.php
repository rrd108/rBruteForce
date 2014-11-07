<?php
namespace RBruteForce\Controller\Component;

use Cake\Controller\Component;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;

class RBruteForceComponent extends Component {

	private $options = [
                        'maxAttempts' => 4,			//max failed attempts before banning
                        'expire' => '3 minutes',	//expiration time
                        'dataLog' => false,			//log the user submitted data
  						'attemptLog' => 'all',//all|beforeBan
  						'checkUrl' => true,			//check url or not
  						'cleanupAttempts' => 1000	//delete all old entries from attempts database if there are more rows that this. This should be bigger than maxAttempts
                        ];
	
	private $isBanned = true;
	
/**
 * Initialize properties.
 *
 * @param array $config The config data.
 * @return void
 */
	public function initialize(array $config) {
		$this->controller = $this->_registry->getController();
		$this->request = $this->controller->request;
		$this->response = $this->controller->response;
		//$this->session = $this->controller->request->session();
        
        $this->RBruteForce = TableRegistry::get('RBruteForce.Rbruteforces');
	}

    //email bekérés
	//userLock
	//cleanup
    public function check($options = []){
		$this->options = array_merge($this->options, $options);

		$this->incrementExpire();

		if($this->getCount() < $this->options['maxAttempts']){
			$this->isBanned = false;
		}

        if($this->options['attemptLog'] == 'all' ||
				($this->options['attemptLog'] == 'beforeBan' && !$this->isBanned)){
			$attempt = ['ip' => $this->request->env('HTTP_HOST'),
						'url' => $this->request->url,
						'expire' => strtotime('+' . $this->options['expire']),
						];
			$attempt = $this->RBruteForce->newEntity($attempt);
			$this->RBruteForce->save($attempt);
		}
        
        if($this->options['dataLog']){
			$this->dataLog($this->request->data);
        }
        
		if($this->isBanned){
			$this->delay();
			$this->controller->redirect('/r_brute_force/rbruteforces/failed');
		}

		$this->RBruteForce->cleanupAttempts($this->options['cleanupAttempts']);
    }

/**
 * Incrementing expire on every bad attempts
 *
 * so if expire is set to 5 minutes than after 3 attempts expre will be 8 minutes
 */
	public function incrementExpire(){
		$expire = explode(' ', $this->options['expire']);
		$this->options['expire'] = $expire[0] + $this->getCount() . ' ' . $expire[1];
		return $this->options['expire'];
	}

/**
 * Delay the rendering of the error page
 *
 * Human users will see a few seconds delay on the response from the server
 * but automated brute force attacks could get long server response delays
 */
	public function delay(){
		sleep($this->getCount());
	}
	
	public function getCount(){
		$count = $this->RBruteForce->find()
				->where(['ip' => $this->request->env('HTTP_HOST')])
				->andWhere(['expire >= ' => time()])
				->andWhere(['expire <= ' => strtotime('+' . $this->options['expire'])]);
		if($this->options['checkUrl']){
			$count = $count->andWhere(['url' => $this->request->url]);
		}
		$count = $count->count();
		return $count;
	}
	
	public function dataLog($data){
        $dataLog = TableRegistry::get('rbruteforcelogs');
        $data = $dataLog->newEntity(['data' => serialize($data)]);
        if($dataLog->save($data)){
			return true;
		}
		return false;
	}
}
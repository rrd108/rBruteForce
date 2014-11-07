<?php
namespace RBruteForce\Controller;

use RBruteForce\Controller\AppController;
use Cake\Event\Event;

/**
 * Rbruteforces Controller
 *
 * @property RBruteForce\Model\Table\RbruteforcesTable $Rbruteforces
 */
class RbruteforcesController extends AppController {

	public function beforeFilter(Event $event){
        parent::beforeFilter($event);
	    $this->Auth->allow(['failed']);
	}

	public function failed(){
	}
	
/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('rbruteforces', $this->paginate($this->Rbruteforces));
		$attempts = $this->Rbruteforces->find()
			->select(['ip', 'attempts' => 'count(*)'])
			->group(['ip'])
			->order(['attempts' => 'DESC'])
			->limit(20);
		$this->set('attempts', $attempts);
	}


/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$rbruteforce = $this->Rbruteforces->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Rbruteforces->delete($rbruteforce)) {
			$this->Flash->success('The rbruteforce has been deleted.');
		} else {
			$this->Flash->error('The rbruteforce could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

	public function deleteall($ip) {
		if ($this->Rbruteforces->deleteAll([])) {
			$this->Flash->success('All rbruteforce has been deleted.');
		} else {
			$this->Flash->error('All rbruteforce could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}

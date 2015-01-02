<?php
namespace RBruteForce\Controller;

use RBruteForce\Controller\AppController;

/**
 * Rbruteforcelogs Controller
 *
 * @property RBruteForce\Model\Table\RbruteforcelogsTable $Rbruteforcelogs
 */
class RbruteforcelogsController extends AppController {

	public function isAuthorized($user = null) {
        return true;
    }

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('rbruteforcelogs', $this->paginate($this->Rbruteforcelogs));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$rbruteforcelog = $this->Rbruteforcelogs->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Rbruteforcelogs->delete($rbruteforcelog)) {
			$this->Flash->success('The rbruteforcelog has been deleted.');
		} else {
			$this->Flash->error('The rbruteforcelog could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

	public function deleteall() {
		if ($this->Rbruteforcelogs->deleteAll([])) {
			$this->Flash->success('All rbruteforcelog has been deleted.');
		} else {
			$this->Flash->error('All rbruteforcelog could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}

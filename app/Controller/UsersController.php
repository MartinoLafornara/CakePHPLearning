<?php
// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public function beforeFilter() {
      parent::beforeFilter();
      // Allow users to register and logout.
      $this->Auth->allow('signup','logout','login','check_domain','check_duplicate');
    }

    public function beforeRender(){
        parent::beforeRender();
        if(in_array($this->action, array('signup'))) {
            $this->layout = 'front_layout';
        }
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        //$this->set('prova', $this->User->find('all',array('recursive' => 1)));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function signup() {
        if ($this->request->is('post')) {
            pr($this->request->data); exit;
            if($this->User->find('count', array('conditions' => array('username =' => $this->request->data['User']['username']))) != 0)
            {
              // Username già esistente
              return $this->Session->setFlash(__('Username già esistente.'),'Flash/error');
            }
            $this->User->create();
            $this->request->data['User']['role'] = 'author';
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Registrato correttamente!'),'Flash/success');
                return $this->redirect(array('controller'=>'pages','action' => 'home'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Dati utente modificati!'),'Flash/success');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('L\'utente non può essere modificato'),'Flash/error');
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Utente rimosso.'),'Flash/success');
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Errore, utente non eliminato!'),'Flash/error');
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
      if ($this->request->is('post')) {
          if ($this->Auth->login()) {
              return $this->redirect($this->Auth->redirectUrl());
          }
          $this->Session->setFlash(__('Credenziali errate! Riprova.'),'Flash/error');
      }
      $this->redirect($this->referer());
    }

    public function logout() {
      return $this->redirect($this->Auth->logout());
    }

}

?>

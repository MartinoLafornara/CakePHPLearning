<?php
// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $components = array('Paginator');

    public $paginate = array(
        'User' => array (
            'fields' => array('User.first_name','User.last_name', 'User.email' ,'User.created'
            ),
            'maxLimit' => 5,
            'order' => array(
                'User.created' => 'desc'
            )
        )
    );

    public function beforeFilter() {
      parent::beforeFilter();
      // Allow users to register and logout.
      $this->Auth->allow('signup','logout','login','check_domain','check_duplicate');
      $this->Auth->deny('index','view');
    }

    public function beforeRender(){
        parent::beforeRender();
        if(in_array($this->action, array('signup'))) {
            $this->layout = 'front_layout_2';
        }
    }

    public function index() {
        $this->User->recursive = 0;

        /*Paginator*/
        $this->Paginator->settings = $this->paginate;
        $this->set('users', $this->Paginator->paginate('User'));

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
            //pr($this->request->data); exit;
            // if($this->User->find('count', array('conditions' => array('email =' => $this->request->data['User']['email']))) != 0)
            // {
            //   // Email già esistente
            //   $this->Session->setFlash(__('Email già registrata'),'Flash/error');
            //   return $this->redirect(array('controller'=>'users','action' => 'signup'));
            // }
            $this->User->create();
            $this->request->data['User']['role'] = 'author';
            if ($this->User->save($this->request->data)) {
                //pr($this->User->find('all', array('conditions' => array('email =' => $this->request->data['User']['email'])))); exit;
                $this->Session->setFlash(__('Registrato correttamente!'),'Flash/success');
                return $this->redirect(array('controller'=>'pages','action' => 'home'));
            }
        }
    }

    public function edit($id = null) {
        //$this->User->id = $id;
        $this->User->read(null, $id);
        $this->User->set(array(
            'email' => $this->request->data('User.email'),
            'password' => $this->request->data('User.password')
        ));
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save()) {
                $this->Session->setFlash(__('Dati utente modificati!'),'Flash/success');
                return $this->redirect(array('action' => 'index'));
            }
            var_dump($this->User->invalidFields()); exit;
            $this->Session->setFlash(__('L\'utente non può essere modificato'),'Flash/error');
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        //$this->User->id = $id;
        $this->User->id = $this->request->data('deleteuserid');
        //pr(!$this->User->exists()); exit;
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

    public function check_domain(){
        if($this->request->is('ajax')) {

            $email = $this->request->query('email');
            $check = preg_match('|^[a-zA-Z0-9.-_]+@[a-zA-Z0-9._]+\.[a-zA-Z0-9]+$|',$email);
            $hostname = explode('@', $email);
            if(count($hostname) > 1){
                if($check){
                    $risposta = file_get_contents('https://dns-api.org/MX/'.$hostname[1]);
                    if (!(array_key_exists('error',json_decode($risposta,true)))){
                        echo json_encode(array("valid" => true)); exit;
                    }
                }
            }
            echo json_encode(array("valid" => false)); exit;
            //$this->request->query('data.User.email') se non trova il dato restituisce null
            //$this->request->query['data']['User']['email'] genera un'eccezione se non trova il dato
        }
    }

    public function check_duplicate() {
        if($this->User->find('count', array('conditions' => array('User.email' => $this->request->query('email')))) != 0) {
            echo json_encode(array("valid" => true)); exit;
        }
        echo json_encode(array("valid" => false)); exit;
    }

}

?>

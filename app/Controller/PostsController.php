<?php

class PostsController extends AppController {
    public $helpers = array('Html', 'Form');
    //public $uses = array('User');

    public function index() {

        //$this->loadModel('User');
        $conditions = [];
        //$var = [];
        if($this->Auth->user('role') != 'admin'){
            $conditions = ['Post.user_id' => $this->Auth->user('id')];
            //$var=['User.id' => $this->Auth->user('id')];
        }
        $this->set('posts',$this->Post->find('all', array('conditions' => $conditions)));
        //$this->set('utenti',$this->User->find('all', array('conditions' => $var)));

    }


    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->deny('index');
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Post Invalido'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Post Invalido'));
        }
        $this->set('post', $post);  //$post è la variabile settata per la view 'view.ctp'
    }


    public function isAuthorized($user) {

        // parent::isAuthorized($user);
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // All registered users can access to posts/index
        if(isset($user) && $this->action ==='index'){
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function add() {
        if ($this->request->is('post')) {
            //Added this line
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Il tuo post è stato inserito correttamente!'), 'Flash/success');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Operazione non eseguita correttamente!'), 'Flash/error');
        }
    }


    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Post Invalido'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Post Invalido'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Il tuo post è stato modificato correttamente!'), 'Flash/success');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Operazione non consentita!'), 'Flash/error');
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('Il post %s è stato eliminato.',h($id)), 'Flash/success');
        } else {
            $this->Session->setFlash(__('Il post %s non può essere eliminato.',h($id)), 'Flash/error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}

?>

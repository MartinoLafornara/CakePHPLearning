<?php

// Load of AppController
App::uses('AppController', 'Controller');

class PostsController extends AppController {

    /**
     * $helpers => Indico gli Helper da poter utilizzare nelle view del controller.
     * Gli Helper Html e Form possono essere anche omessi (Vengono settati di default).
     *
     */

    public $helpers = array('Html', 'Form');
    //public $uses = array('User');

    /**
     * Componenti Utilizzati da PostsController
     * - Componenti di AppController
     * - Paginator per realizzare la paginazione dei posts.
     */

    public $components = array('Paginator');

    /**
     * Setup del Paginator
     */

    public $paginate = array(
        'Post' => array (
            'fields' => array(
                'Post.id','Post.title','Post.created','User.first_name','User.last_name'
            ),
            'maxLimit' => 3, // Numero massimo di elementi per pagina.
            'order' => array(
                'Post.created' => 'desc'
            )
        )
    );

    /**
     * index
     *
     * Verifica se l'utente loggato è admin o meno.
     * Se Admin vede i post appartenenti a tutti gli utenti.
     * Se Author vede solamente i suoi post.
     */

    public function index() {
        //$this->loadModel('User');
        //$conditions = [];
        //$var = [];
        if($this->Auth->user('role') != 'admin'){
            //$conditions = ['Post.user_id' => $this->Auth->user('id')];
            //$var=['User.id' => $this->Auth->user('id')];
            $this->paginate['Post']['conditions'] = array('Post.user_id' => $this->Auth->user('id'));
        }
        //$this->set('posts',$this->Post->find('all', array('conditions' => $conditions)));
        //$this->set('utenti',$this->User->find('all', array('conditions' => $var)));

        /*Paginator
        * $this->paginator->setting => imposto il settaggio attribuendo la configurazione ($paginate).
        * $paginate presenterà un'ulteriore condition nel caso in cui l'utente non è Admin.
        */
        $this->Paginator->settings = $this->paginate;
        $this->set('posts', $this->Paginator->paginate('Post'));
    }

    /**
     * beforeFilter (Override)
     *
     * $this->Auth->deny('index') => Solo l'utente loggato ha accesso a questa action.
     */

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->deny('index');
    }

    /**
     * view
     *
     * - Se l'id è esistente (ovvero trova corrispondenza con un post) assegna i dati di quel
     * post a una variabile ($post).
     * - Se l'id è null o semplicemente non si trova una corrispondenza con un post,
     * viene generata una exception.
     *
     * @param integer $id  - ID del post
     */

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Post Invalido'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Post Invalido'));
        }
        $this->set('post', $post);  //Setta la variabile $post per la view.
    }

    /**
     * isAuthorized (Override)
     *
     * @param array $user - Array relativo all'utente che fa la action.
     * @return boolean
     */

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // All registered users can access to posts/index
        if(isset($user) && $this->action ==='index'){
            return true;
        }

        // The owner of a post can edit and delete it
        //if (in_array($this->action, array('edit', 'delete'))) {
        if($this->action === 'edit'){
            // $this->request->params => tutti i dati passati tramite url (sintassi : /valore1)
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        if($this->action === 'delete'){
            // $this->request->data  => tutti i dati passati tramite post (Form submitted)
            $postId = (int) $this->request->data('deletepostid');
            if ($this->Post->isOwnedBy($postId,$user['id'])){
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * add
     *
     * - Tramite Form (richiesta Post) vengono inoltrati alla function gli input del form
     * relativi ai campi della table posts.
     * - $this->Post->save(Data) => Salva i dati o eventualmente sovrascrive (in caso di edit).
     */

    public function add() {
        if ($this->request->is('post')) {
            //Added this line
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Il tuo post è stato inserito correttamente!'), 'Flash/success');
                return $this->redirect(array('controller' => 'posts','action' => 'index'));
            }
            $this->Session->setFlash(__('Operazione non eseguita correttamente!'), 'Flash/error');
        }
    }

    /**
     * edit
     *
     * - Se id null o inesistente genera una exception
     * - Se esistente viene modificato il post.
     *
     * @param integer $id - ID del post
     */

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Post Invalido'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Post Invalido'));
        }
        //Essendo un'operazione sensibile (modifica) è corretto permettere request di tipo post.
        if ($this->request->is(array('post', 'put'))) {
            // Viene indicato il post che ha come id quello passato in ingresso.
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Il tuo post è stato modificato correttamente!'), 'Flash/success');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Operazione non consentita!'), 'Flash/error');
        }

        if (!$this->request->data) {
            /* Se non è stata effettuata alcuna modifica (Submit Form) i dati di input del form
               saranno quelli correnti.
            */
            $this->request->data = $post;
        }
    }

    /**
     * delete
     *
     * - Non prende tramite get (url) l'id del post da elminare. Quest'ultimo Viene
     * passato tramite Post.
     * - Anche quest'ultima operazione (cancellazione) prevede che non venga eseguita una richiesta get.
     * - il metodo postLink di Form viene interpretrata come una richiesta post(per non generare una exception)
     *   ma effettivamente passa i parametri tramite url.
     */

    public function delete() {
        //pr($this->request); exit;
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $id = $this->request->data('deletepostid');
        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('Il post è stato eliminato.'), 'Flash/success');
        } else {
            $this->Session->setFlash(__('Il post non può essere eliminato.'), 'Flash/error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}

?>

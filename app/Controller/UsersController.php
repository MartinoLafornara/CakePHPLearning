<?php
// app/Controller/UsersController.php
// Load of AppController
App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

    /**
     * Componenti Utilizzati da UsersController
     * - Componenti di AppController
     * - Paginator per realizzare la paginazione dei posts.
     */

    public $components = array('Paginator');

    /**
     * Setup del Paginator
     */

    public $paginate = array(
        'User' => array (
            'fields' => array('User.first_name','User.last_name', 'User.email' ,'User.created'
            ),
            'maxLimit' => 15,
            'order' => array(
                'User.created' => 'desc'
            )
        )
    );

    /**
     * beforeFilter (Override)
     */

    public function beforeFilter() {
      parent::beforeFilter();
      // Allow users to register and logout.
      $this->Auth->allow('signup','logout','login','check_domain','check_duplicate','check_password');
      $this->Auth->deny('index','view');
    }

    /**
     * beforeRender (Override)
     *
     * - Se la action è la signup viene caricato il layout ''front_layout_2
     * - UsersController fa l'override di questo metodo per impedire l'utilizzo del layout
     *   'default' per una page in caso di utente loggato.
     */

    public function beforeRender(){
        parent::beforeRender();
        if(in_array($this->action, array('signup'))) {
            $this->layout = 'front_layout_2';
        }
    }

    public function isAuthorized($user) {
        // in_array($this->action, array('edit', 'delete')
        if (in_array($this->action, array('view', 'edit'))) {
            $userId = (int) $this->request->params['pass'][0];
            if ($userId == $user['id']){
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    /**
     * index
     *
     * Visualizza gli utenti utilizzando il paginator.
     */

    public function index() {
        /* recursive = 0 => fa visualizzare solo il livello più esterno (Solo gli
           utenti e non i post ad essi associati).
        */
        $this->User->recursive = 0;

        /*Paginator*/
        $this->Paginator->settings = $this->paginate;
        $this->set('users', $this->Paginator->paginate('User'));
        //$this->set('prova', $this->User->find('all',array('recursive' => 1)));
    }

    /**
     * view
     *
     * - Se l'utente non esiste genera un'exception.
     * - Se la ricerca ha esito positivo associa a una variabile i dati dell'utente
     *   avente quell'id. ($this->User->FindById)
     *
     * @param integer $id - ID utente
     */

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    /**
     * signup - Registrazione Utente
     *
     * - Se viene effettuato il submit della registration form
     *   viene creato e successivamente salvati i dati inseriti nel form.
     */

    public function signup() {
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['role'] = 'author';
            if ($this->User->save($this->request->data)) {
                //pr($this->User->find('all', array('conditions' => array('email =' => $this->request->data['User']['email'])))); exit;
                $this->Session->setFlash(__('Registrato correttamente!'),'Flash/success');
                return $this->redirect(array('controller'=>'pages','action' => 'home'));
            }
        }
    }

    public function changePassword ($id = null) {
        // pr($this->request->data('User.check_password')); exit;
        if($this->request->is('post') || $this->request->is('put')) {
            if (!$this->User->exists($id)) {
                throw new NotFoundException(__('Invalid User'));
            }
            // pr($this->User->check_password($id,$this->request->data('User.check_password'))); exit;

            if($this->User->check_password($id,$this->request->data('User.check_password'))) {
                $this->User->clear();
                $this->User->id = $id;
                if ($this->User->save($this->request->data,array('fieldList' => array('password')))) {
                    $this->Session->setFlash(__('Password utente modificata!'),'Flash/success');
                    return $this->redirect(array('action' => 'index'));
                }
            }
            $this->Session->setFlash(__('Verifica che la password attuale sia stata inserita correttamente.'),'Flash/error');
            return $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * edit - Modifica informazioni Utente
     *
     * - Se l'utente è inesistente viene generata una exception
     * - Se esistente verrà effettuata la modifica dei dati utente.
     *   (Osservazione : differentemente dal post la edit in questo caso non
     *   interessa tutti i dati relativi a un utente ma solamente alcuni).
     * - In questo caso di edit (parziale), pertanto, devo una volta effettuata
     *   la read dell'utente settare i cambi che saranno sottoposti alla save successiva.
     *
     * @param integer $id - ID Utente
     */

    public function edit($id = null) {
        // pr($this->request->data('User.email')); exit;
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!$this->User->exists($id)) {
                throw new NotFoundException(__('Invalid user'));
            }
            $this->User->id = $id;
            //$this->User->read();
            //Setto i dati sottoposti a save();
            // $this->request->data['User']['id'] = $id;
            // $this->User->set(array(
            //     'email' => $this->request->data('User.email'),
            //     'password' => $this->request->data('User.password'),
            //     'modified' => date('Y-m-d H:i:s')
            //     )
            // );
            //$this->User->save($this->request->data,array('fieldList' => array('email','password')))
            if (!empty($this->request->data('User.email'))) {
                if ($this->User->save($this->request->data,array('fieldList' => array('email')))) {
                    $this->Session->setFlash(__('Email utente modificata!'),'Flash/success');
                    return $this->redirect(array('action' => 'index'));
                }
            }
            if (!empty($this->request->data('User.password'))) {
                if ($this->User->save($this->request->data,array('fieldList' => array('password')))) {
                    $this->Session->setFlash(__('Password utente modificata!'),'Flash/success');
                    return $this->redirect(array('action' => 'index'));
                }
            }
            // Visualizza i fields non corretti (problemi di validazione)
            var_dump($this->User->invalidFields()); exit;
            $this->Session->setFlash(__('L\'utente non può essere modificato'),'Flash/error');
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    /**
     * delete
     *
     * - Elimina l'utente avente l'id passato tramite post.
     * - Se l'utente non esiste genera un'exception.
     *
     */

    public function delete() {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');
        //Permette esclusivamente methods di tipo Post.
        $this->request->allowMethod('post');
        /*
          $this->request->data('deleteuserid') è l'input hidden del modal di eliminazione account.
        */
        $userId = $this->request->data('deleteuserid');
        //pr(!$this->User->exists()); exit;
        if (!$this->User->exists($userId)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete($userId, true)) {
            $this->Session->setFlash(__('Utente rimosso.'),'Flash/success');
            return $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Errore, utente non eliminato!'),'Flash/error');
        return $this->redirect($this->referer());
    }

    /**
     * login
     *
     * - Con credenziali corrette effettua il login dell'utente.
     * - Con il login c'è conseguentemente il redirect alla sezione logged dell'utente.
     */

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // $this->Auth->redirectUrl() => riferisce al loginRedirect dell'Auth Component.
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Credenziali errate! Riprova.'),'Flash/error');
        }
        // $this->referer() => si riferisce alla pagina da cui è stato fatto il login.
        $this->redirect($this->referer());
    }

    /**
     * logout
     *
     * - Effettua il logout dell'utente.
     */

    public function logout() {
      return $this->redirect($this->Auth->logout());
    }

    /**
     * check_domain
     *
     * Verifica se il dominio dell'email (signup form) è esistente o meno.
     *
     * @return json
     */

    public function check_domain(){
        if($this->request->is('ajax')) {
            // $this->request->query() => tutti i dati passati tramite url (sintassi ?chiave=valore)
            $email = $this->request->query('email');
            // Verifica se la sintassi di un'ipotetica email è corretta.
            $check = preg_match('|^[a-zA-Z0-9.-_]+@[a-zA-Z0-9._]+\.[a-zA-Z0-9]+$|',$email);
            // Separa l'hostname dal corpo dell'email utilizzando il separatore @.
            $hostname = explode('@', $email);
            // Se è presente un hostname (lunghezza array pari almeno a 2)
            if(count($hostname) > 1){
                // Se la sintassi è corretta.
                if($check){
                    // Effetto una richiesta get tramite un API esterna che richiede una determinata sintassi
                    $risposta = file_get_contents('https://dns-api.org/MX/'.$hostname[1]);
                    /* - Se non esiste la chiave 'error' nella risposta dell'API allora il dominio è verificato.

                       [Osservazione#1] => in realta la richiesta restituisce un json che viene trasformato
                       in array per poter effettuare una ricerca nelle chiavi (array_key_exists).

                       [Osservazione#2] => il metodo non fa una return altrimenti si aspetta una view ad esso
                       correlata e printa un json ben preciso per essere interpretato dal javascript chiamante.

                       - Se esiste la chiave 'error' il dominio non è verificato.
                    */
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

    /**
     * check_duplicate
     *
     * Verifica se l'email (submit form) è stata già registrata.
     *
     * @return json
     */

    public function check_duplicate() {
        if($this->request->is('ajax')) {
            // $this->User->find() => ricerca/conta... gli utenti eventualmente anche con una determinata condition.
            if($this->User->find('count', array('conditions' => array('User.email' => $this->request->query('email')))) != 0) {
                echo json_encode(array("valid" => true)); exit;
            }
            echo json_encode(array("valid" => false)); exit;
        }
    }

    /**
     * check_password
     *
     * Verifica se la password attuale dell'utente è corretta.
     *
     * [Osservazione] => E' necessario fare un controllo non solo sulla password,
     * ma anche su quel determinato utente perchè può capitare che due utenti abbiano
     * la stessa password.
     *
     * @var string $currentPassword - E' la password cifrata attuale dell'utente.
     * @var string $checkPassword - E' la password inserita nel form per matcharla con
     * quella effettiva.
     *
     * @return json
     */

    public function check_password() {
        if($this->request->is('ajax')) {
            $checkPassword = $this->request->data('check_password');
            $userID = $this->request->data('user_id');
            $result = $this->User->check_password($userID,$checkPassword);
            if ($result) {
                echo json_encode(array("valid" => true)); exit;
            }
            echo json_encode(array("valid" => false)); exit;
            // $passwordHasher = new BlowfishPasswordHasher();
            // $result = $passwordHasher->check($checkPassword,$currentPassword);
            // if($result && $this->User->find('count',array('conditions' => array('User.id' => $userID))) == 1) {
            //     echo json_encode(array("valid" => true)); exit;
            // }
            // echo json_encode(array("valid" => false)); exit;
        }
    }

}

?>

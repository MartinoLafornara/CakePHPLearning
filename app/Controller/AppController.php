<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
//App::uses('CakeEvent', 'Event');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {

    /**
     * Componenti Utilizzati da AppController
     * - Auth (login/logout/cifratura password)
     * - Session per i Flash Messages
     */
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array(
                        'username' => 'email' //Default is username
                    )
                )
            ),
            'authError' => 'Non sei autorizzato',
            'authorize' => array('Controller'), // Added this line
            'unauthorizedRedirect' => array(
                'controller' => 'posts',
                'action' => 'index',
                'prefix' => false
            )
        )
    );

    /**
     * beforeFilter - CallBack prima di qualsiasi Action
     *
     * $this->Auth->allow => Permette l'accesso a determinate view.
     *
     * @return
     */

    public function beforeFilter() {
        $this->Auth->allow('index', 'view');
        $this->set('userLogged', $this->Auth->user());
    }

    /**
     * beforeRender - Callback prima di qualsiasi Render
     *
     * Se l'utente non è loggato viene settato un layout definito.
     * Altrimenti viene utilizzato quello di default (default.ctp).
     *
     * @return
     */

    public function beforeRender() {
        if (!$this->Session->read('Auth.User')){
            //$this->set('isLogged',true);
            $this->layout = 'front_layout';
        }
    }

    /**
     * isAuthorized - Metodo richiamato prima di ogni action
     *
     * L'utente con role Admin ha accesso a qualsiasi action.
     * Qualsiasi altro utente avrà un default deny. (Attentione! Viene effettuato
     * l'overriding del metono nelle sottoclassi).
     *
     * @param array $user - Array relativo all'utente che fa la action.
     * @return true
     */

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // Default deny
        return false;
    }

}

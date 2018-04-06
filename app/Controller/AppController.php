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
                        'username' => 'email'
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
        ),'Paginator'
    );

    public $paginate = array(
        'User' => array (
            'fields' => array('User.first_name','User.last_name', 'User.email' ,'User.created'
            ),
            'maxLimit' => 5,
            'order' => array(
                'User.created' => 'desc'
            )
        ),
        'Post' => array (
            'fields' => array(
                'Post.id','Post.title','Post.created','User.first_name','User.last_name'
            ),
            'maxLimit' => 3,
            'order' => array (
                'Post.created' => 'desc'
            )
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('index', 'view');
        $this->set('userLogged', $this->Auth->user());
    }

    public function beforeRender() {
        if (!$this->Session->read('Auth.User')){
            //$this->set('isLogged',true);
            $this->layout = 'front_layout';
        }
    }

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // Default deny
        return false;
    }

}

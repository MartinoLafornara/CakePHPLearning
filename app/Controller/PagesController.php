<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	/**
	 * beforeFilter (Override)
	 *
	 * Nel momento in cui viene fatto un override di un metodo quest'ultimo viene
	 * eseguito a discapito dello stesso metodo presente nella classe estesa (APPCONTROLLER).
	 * parent::beforeRender() => richiama il metodo beforeRender della classe parent.
	 *
	 */

	public function beforeFilter(){
		$this->Auth->allow('home','about','contact');
		parent::beforeFilter();
	}

	/**
	 * beforeRender (Override)
	 */

	public function beforeRender(){
		parent::beforeRender();
		$this->layout = 'front_layout';
	}

	/**
	 * home
	 */

	public function home(){

	}

	/**
	 * contact
	 */

	public function contact(){

	}

	/**
	 * isAuthorized (Override)
	 *
	 * Default allow per gli utenti.
	 *
	 * @param array $user - Array relativo all'utente che fa la action.
	 * @return true
	 */

	public function isAuthorized($user) {
		return true; // Default allow
	}

}

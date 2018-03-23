<?php
// app/Model/User.php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {   
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Username richiesto'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Password richiesta'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Inserisci un ruolo valido',
                'allowEmpty' => false
            )
        )
    );

    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id'
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}

?>

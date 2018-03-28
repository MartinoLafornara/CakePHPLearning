<?php
// app/Model/User.php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        'first_name' => array(
            'rule' => 'alpha',
            'message' => 'Solo caratteri alfabetici',
            'allowEmpty' => false,
            'required' => true
        ),
        'last_name' => array(
            'rule' => 'alpha',
            'message' => 'Solo caratteri alfabetici',
            'allowEmpty' => false,
            'required' => true
        ),
        'password' => array(
            'rule' => array('minLength',8),
            'message' => 'La password deve essere lunga almeno 8 caratteri',
            'required' => true
        ),
        'role' => array(
            'rule' => array('inList', array('admin', 'author')),
            'message' => 'Inserisci un ruolo valido',
            'allowEmpty' => false,
            'required' => true
        ),
        'email' => array(
            'email1' => array(
                'rule' => array('email', true),
                'message' => "Inserisci un'email valida",
                'allowEmpty' => false,
                'required' => true
            ),
            'email2' => array(
                'rule' => 'isUnique',
                'message' => 'Questa email è già stata registrata'
            )
        ),
        'date_birth' => array(
            'rule' => array('date', 'dmy'),
            'message' => 'Inserisci una data valida',
            'allowEmpty' => false,
            'required' => true
        )
    );

    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id'
        )
    );

    public function beforeSave($options = array()) {
        //Adatta il Date Format per il Database
        if (!empty($this->data['User']['date_birth'])) {
          //pr($this->data['User']['date_birth']); exit;
          $this->data['User']['date_birth'] = $this->dateFormatBeforeSave($this->data['User']['date_birth']);
          //pr($this->data['User']['date_birth']); exit;
        }
        //Cifra la password inserita
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    public function dateFormatBeforeSave($dateString) {
      return DateTime::createFromFormat('d/m/Y', $dateString)->format('Y-m-d');
    }

    public function alpha($check) {
      $value = array_values($check);
      $value = $value[0];
      return preg_match('|^[a-zA-Z ]*$|', $value);
    }

}

?>

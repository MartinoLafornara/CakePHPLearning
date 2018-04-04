<?php
// app/Model/User.php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        'first_name' => array(
            'first_name1' => array(
                'rule' => 'alpha',
                'message' => 'Sono ammessi solamente caratteri alfabetici e spazi.',
                'allowEmpty' => false,
                'required' => true
            ),
            'first_name2' => array(
                'rule' => array('maxLength',30),
                'message' => 'Il nome deve contenere al massimo 30 caratteri.',
            )
        ),
        'last_name' => array(
            'last_name1' => array(
                'rule' => 'alpha',
                'message' => 'Sono ammessi solamente caratteri alfabetici e spazi.',
                'allowEmpty' => false,
                'required' => true
            ),
            'last_name2' => array(
                'rule' => array('maxLength',30),
                'message' => 'Il cognome deve contenere al massimo 30 caratteri.',
            )
        ),
        'password' => array(
            'rule' => 'format_password',
            'message' => 'La password deve avere lunghezza compresa tra 8 e 16 caratteri e contenere almeno una maiuscola, una minuscola, un numero e un carattere consentito(_#$@%*-)',
            'allowEmpty' => false,
            'required' => true
        ),
        'role' => array(
            'rule' => array('inList', array('admin', 'author')),
            'message' => 'Inserisci un ruolo valido.',
            'allowEmpty' => false,
            'required' => true
        ),
        'email' => array(
            'email1' => array(
                'rule' => array('email', true),
                'message' => "Inserisci un'email valida.",
                'allowEmpty' => false,
                'required' => true
            ),
            'email2' => array(
                'rule' => 'isUnique',
                'message' => 'Questa email è già stata registrata.'
            )
        ),
        'date_birth' => array(
            'rule' => array('date', 'dmy'),
            'message' => 'Inserisci una data valida.',
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
            $this->data['User']['date_birth'] = $this->dateFormatBeforeSave($this->data['User']['date_birth']);
        }
        // if(isset($this->data['User']['first_name']) && isset($this->data['User']['last_name'])) {
        //     pr('cisono'); exit;
        // }

        // Cifra la password inserita
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

    public function format_password($check) {
        $value = array_values($check);
        $value = $value[0];
        return preg_match('|^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#\$@%\*\-])[A-Za-z0-9_#\$@%\*\-]{8,16}$|', $value);
    }

}

?>

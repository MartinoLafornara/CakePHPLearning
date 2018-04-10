<?php
// app/Model/User.php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    /**
     * Validazione campi User
     */

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

    /**
     * Collegamento con Model Post.php
     *
     * $hasMany -> molteplicità multipla
     */

    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id'
        )
    );

    /**
     * beforeValidate
     *
     * Prima della validazione, verifico se il formato della data nascita è 'Y-m-d'.
     * Se verificato (nel caso della edit di User poichè il formato è quello standard di MySQL),
     * converte il seguente formato in quello validato dal Model (d/m/Y).
     *  @return true
     */

    public function beforeValidate($options = array()){

        $dateString = $this->data['User']['date_birth'];
        if ($this->checkDateTime($dateString,'Y-m-d')){
            $this->data['User']['date_birth'] = DateTime::createFromFormat('Y-m-d', $dateString)->format('d/m/Y');
        }
        return true;
    }

    /**
     * beforeSave
     *
     * Prima di salvare qualsiasi Utente (con la signup o la modifica), verifico
     * che la data nascita sia settata e successivamente converto il Date Format per
     * renderlo "leggibile" dal Database MySQL (MySQL format : 'Y-m-d').
     *
     * Se settata la password cifro quest'ultima applicando la funzione hash di
     * BlowfishPasswordHasher.
     *
     * @return true
     */

    public function beforeSave($options = array()) {
        //Adatta il Date Format per il Database
        //var_dump($this->data); exit;
        if (!empty($this->data['User']['date_birth'])) {
            $this->data['User']['date_birth'] = $this->dateFormatBeforeSave($this->data['User']['date_birth']);
        }

        // Cifra la password inserita
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    /**
     * dateFormatBeforeSave
     *
     * - createFromFormat($formato,$stringadata) -> trasforma la stringa in una data,
     * nel formato indicato, se possibile
     * - format($formato) -> trasforma una data nel formato dato in input al metodo.
     *
     * @param string $dateString - La data di nascita
     * @return string - Data nel formato 'Y-m-d'
     */

    public function dateFormatBeforeSave($dateString) {
        // $var = DateTime::createFromFormat('d/m/Y', $dateString);
        // return ((!empty($var)) ? $var->format('Y-m-d') : $dateString );
        return DateTime::createFromFormat('d/m/Y', $dateString)->format('Y-m-d');
    }

    /**
     * alpha - Custom Validation Method
     *
     * Se la rule della validation non è custom viene richiamato un metodo che prenderà
     * il nome della custom rule. Viene preso il valore ed eseguito un preg_match con
     * una determinata espressione regolare (Caratteri alfabetici e spazio).
     *
     * @param array $check - Array ('NameRule' => values)
     * @return boolean - il risultato del preg_match
     */

    public function alpha($check) {
        $value = array_values($check);
        $value = $value[0];
        return preg_match('|^[a-zA-Z ]*$|', $value);
    }

    /**
     * format_password - Custom Validation Method
     *
     * Un'altra funzione customizzata per indicare una rule di validazione non di
     * default. Come per alpha (method) viene eseguito un preg_match con un'altra
     * espressione regolare (un carattere minuscolo,maiuscolo,un numero,un carattere speciale
     * e una lunghezza compresa tra 8 e 16 caratteri).
     *
     * @param array $check - Array ('NameRule' => values)
     * @return boolean - il risultato del preg_match
     */

    public function format_password($check) {
        $value = array_values($check);
        $value = $value[0];
        return preg_match('|^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#\$@%\*\-])[A-Za-z0-9_#\$@%\*\-]{8,16}$|', $value);
    }

    /**
     * checkDateTime
     *
     * Viene inizializzata una variabile con la data data in input ma nel formato
     * da confermare. Se la variabile ha lo stesso value della data passata in input
     * (stesso formato) e la variabile ha un valore diverso da false (caso in cui non
     * si riesce a trasformare la stringa nel formato indicato) il check avrà esito
     * positivo.
     *
     * @param string $date - Data da analizzare
     * @param string $format - Formato della data da verificare
     * @return boolean
     */

    public function checkDateTime($date, $format = 'Y-m-d H:i:s'){
        $d = DateTime::createFromFormat($format,$date);
        return ($d && ($d->format($format)==$date));
    }

}

?>

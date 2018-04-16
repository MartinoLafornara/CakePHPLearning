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
            'foreignKey' => 'user_id',
            'dependent' => true
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
        if(isset($this->data['User']['date_birth'])){
            $dateString = $this->data['User']['date_birth'];
            if ($this->checkDateTime($dateString,'Y-m-d')){
                $this->data['User']['date_birth'] = DateTime::createFromFormat('Y-m-d', $dateString)->format('d/m/Y');
            }
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

        /* Solo se si usa $this->save->set() */
        // if (!empty($this->data['User']['date_birth'])) {
        //     if (!$this->checkDateTime($this->data['User']['date_birth'],'d-m-Y')) {
                /*
                *    Se legge la data di nascita inserita nella registrazione di un nuovo utente.
                *
                *    [Osservazione] => Utilizzo in questo caso la chiamata al metodo
                *    dateFormatBeforeSave e non date() poichè riceve in ingresso una data con un differente
                *    separatore (/). Se utilizzassi date() in alcune situazioni invertirebbe il numero
                *    relativo al giorno con quello del mese.
                */
            //     /$this->data['User']['date_birth'] = $this->dateFormatBeforeSave($this->data['User']['date_birth']);
            // }
            //Se legge la data di nascita durante la edit del User.
        //     $this->data['User']['date_birth'] = date('Y-m-d', strtotime($this->data['User']['date_birth']));
        // }

        /* Solo se si usa $this->save->set() */
        // if(isset($this->data['User']['created'])){
        //     //Durante Edit di User
        //     if($this->checkDateTime($this->data['User']['created'],'d-m-Y H:i:s')) {
        //         $this->data['User']['created'] = date('Y-m-d H:i:s', strtotime($this->data['User']['created']));
        //     }
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
     * afterFind - Callback dopo una find (o paginate)
     *
     * Dopo aver fatto una ricerca viene impostato un formato data differente
     * rispetto a quello del database. (Utile per la view).
     *
     * [Osservazione] => Il nuovo formato data non viene salvato sul db
     * (non conforme con lo standard MySql) ma viene utilizzato solo per le View
     * nelle quali vengono visualizzati i dati prodotti da una ricerca.
     *
     * @param array $results - Array relativo ai dati restituiti dall'operazione
     *              di ricerca (find o paginate) di tutti gli utenti.
     * @param boolean $primary
     * @return array $results - Array dei dati di ricerca elaborati.
     */

    public function afterFind($results, $primary = false) {
        foreach ($results as $row => $fields) {
            if (isset($fields['User']['created'])) {
                $results[$row]['User']['created'] = $this->dateFormatAfterFind($fields['User']['created'],'d-m-Y H:i:s');
            }
            if (isset($fields['User']['date_birth'])) {
                $results[$row]['User']['date_birth'] = $this->dateFormatAfterFind($fields['User']['date_birth']);
            }
        }
        return $results;
    }

    /**
     * dateFormatAfterFind
     *
     * Cambia il formato data del Db nel seguente 'd-m-Y - H:i:s'.
     *
     * @param $dateString - La data di creazione utente.
     * @return string $dateString - La data nel formato 'd-m-Y - H:i:s'.
     */

    public function dateFormatAfterFind($dateString,$dateFormat = 'd-m-Y') {
        return date($dateFormat , strtotime($dateString));
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

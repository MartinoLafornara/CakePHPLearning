<?php

class Post extends AppModel {

    /**
     * Validazione campi Post
     *
     * - rule 'custom' seguita dalla regular expression
     */

    public $validate = array(
        'title' => array(
            'rule' => array('custom', '/^[a-z0-9[:punct:][:space:]]*$/i'),
            'message' => 'Sono ammessi solamente caratteri alfabetici, di punteggiatura e spazi.',
            'allowEmpty' => false,
            'required' => true,
        ),
        'body' => array(
            'rule' => array('custom', '/^[a-z0-9[:punct:][:space:]]*$/i'),
            'message' => 'Sono ammessi solamente caratteri alfabetici, di punteggiatura e spazi.',
            'allowEmpty' => false,
            'required' => true
        )
    );

    /**
     * Collegamento con Model User.php
     *
     * $belongsTo -> molteplicità multipla (Un utente può avere più post ma il
     * singolo post è di un solo utente).
     */

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );

    /**
     * isOwnedBy
     *
     * Verifica se un determinato post è stato realizzato dall'id utente passato in input.
     * Restituisce false se non riesce a soddisfare la condition (secondo param di field()).
     *
     * @param string $post - ID del posts
     * @param string $user - ID dell'utente
     * @return boolean
     */

    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
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
     *              di ricerca (find o paginate) di tutti i post realizzati dall'utente
     *              (Tutti nel caso di un utente Admin).
     * @param boolean $primary
     * @return array $results - Array dei dati di ricerca elaborati.
     */

    public function afterFind($results, $primary = false) {
        foreach ($results as $row => $fields) {
            if (isset($fields['Post']['modified'])) {
                $results[$row]['Post']['modified'] = $this->dateFormatAfterFind($fields['Post']['modified']);
            }
        }
        return $results;
    }

    /**
     * dateFormatAfterFind
     *
     * Cambia il formato data del Db nel seguente 'd-m-Y - H:i:s'.
     *
     * @param $dateString - La data di ultima modifica del post.
     * @return string $dateString - La data nel formato 'd-m-Y - H:i:s'.
     */

    public function dateFormatAfterFind($dateString) {
        return date('d-m-Y - H:i', strtotime($dateString));
    }

}

?>

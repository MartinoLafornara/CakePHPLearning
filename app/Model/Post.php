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

}

?>

<?php

class Post extends AppModel {
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

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );



    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
    }

}

?>

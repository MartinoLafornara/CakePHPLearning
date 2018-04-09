<?php

class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'alphaNumeric',
            'allowEmpty' => false,
            'required' => true
        ),
        'body' => array(
            'rule' => 'alphaNumeric',
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

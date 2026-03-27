<?php

function my_action_callback(){
    $whatever = intval( $_POST['whatever'] );
    var_dump($_POST);
    $whatever += 10;
    echo $whatever;
    wp_die();
}

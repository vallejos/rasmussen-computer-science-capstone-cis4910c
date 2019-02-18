<?php

include_once "db.php";

/**
 * Attempts to login and return user information
 * @param {string} $user
 * @param {string} $pass
 * @return User|null
 */
function getUser($user, $pass) {
    global $dbc;

    // search for user
    $sql = "SELECT * FROM users WHERE username='".$user."' and password='".$pass."'";
    $result = $dbc->query($sql);

    if ($result->num_rows > 0) {
        // return User
        return $result->fetch_row();
    }

    // return null if user not found (incorrect credentials)
    return null;
}

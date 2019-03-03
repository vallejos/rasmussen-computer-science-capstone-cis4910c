<?php

include_once "db.php";

/**
 * Attempts to login and return user information
 * @param {string} $username
 * @param {string} $password
 * @return User|null
 */
function getUser($username, $password) {
    global $dbc;

    // search for user
    $sql = "SELECT id, email, name, username FROM users WHERE 
        username='".$username."' and password='".$password."' ";
    $result = $dbc->query($sql);

    if ($result->num_rows > 0) {
        // return User
        return $result->fetch_assoc();
    }

    // return null if user not found (incorrect credentials)
    return null;
}

/**
 * Return list of projects for the given userId
 * 
 * @param {number} $userId
 * @return [Entry]|null
 */
function getProjects($userId) {
    global $dbc;

    if (!$userId) {
        return null;
    }

    // search for projects
    $sql = "SELECT * FROM projects WHERE user_id='".$userId."' ";
    $result = $dbc->query($sql);

    if ($result->num_rows > 0) {
        // return Projects
        return $result;
    }

    // return null if nothing found
    return null;
}

/**
 * Return list of time entries for the given userId
 * 
 * @param {number} $userId
 * @return [Entry]|null
 */
function getEntriesByUser($userId) {
    global $dbc;

    if (!$userId) {
        return null;
    }

    // search for entries
    $sql = "SELECT e.id, e.date, e.duration, e.notes, p.name project_name 
        FROM entries e LEFT JOIN projects p ON (e.project_id=p.id)
        WHERE e.user_id='".$userId."' ";
    $result = $dbc->query($sql);

    if ($result->num_rows > 0) {
        // return Entries
        return $result;
    }

    // return null if nothing found
    return null;
}

/**
 * Return list of time entries for the given projectId
 * 
 * @param {number} $projectId
 * @return [Entry]|null
 */
function getEntriesByProject($projectId) {
    global $dbc;

    if (!$projectId) {
        return null;
    }

    // search for entries
    $sql = "SELECT * FROM entries WHERE project_id='".$projectId."' ";
    $result = $dbc->query($sql);

    if ($result->num_rows > 0) {
        // return Entries
        return $result;
    }

    // return null if nothing found
    return null;
}

/**
 * Insert a new project in the db
 * 
 * @param {number} $userId
 * @param {string} $name
 * @param {string} $description
 * @return Project|null
 */
function addProject($userId, $name, $description) {
    global $dbc;

    // insert project
    $sql = "INSERT INTO projects SET user_id='".$userId."', name='".$name."', 
        description='".$description."' ";
    $result = $dbc->query($sql);

    if ($result == TRUE) {
        return true;
    }

    // return null couldn't insert
    return null;
}

/**
 * Insert a new time entry in the db
 * 
 * @param {number} $userId
 * @param {string} $date
 * @param {number} $duration
 * @param {string} $notes
 * @param {number} $projectId
 * @return Entry|null
 */
function addEntry($userId, $date, $duration, $notes, $projectId) {
    global $dbc;

    // insert entry
    $sql = "INSERT INTO entries SET user_id='".$userId."', date='".$date."', 
        duration='".$duration."', notes='".$notes."', project_id='".$projectId."' ";
    $result = $dbc->query($sql);

    if ($result == TRUE) {
        return true;
    }

    // return null couldn't insert
    return null;

}

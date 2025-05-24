<?php
use CodeIgniter\CodeIgniter;

/**
 * Returns CodeIgniter's version.
 */
function ci_version(): string
{
    return CodeIgniter::CI_VERSION;
}


function datos_usuario(): array
{
    $db = db_connect();
    $query = $db->query('SELECT id, username, nivel, foto, nombre  FROM users where id = ' . auth()->user()->id);
    $db->close();
    $user_info = $query->getResultArray();
    return  $user_info[0];
}
function usuario_is_administrador(): bool
{
    $db = db_connect();
    $query = $db->query('SELECT nivel FROM users where id = ' . auth()->user()->id);
    $db->close(); 
    $user_info = $query->getResultArray();
    if($user_info[0]['nivel']==1) return true; else return false;
}
function usuario_is_developer(): bool
{
    $db = db_connect();
    $query = $db->query('SELECT nivel FROM users where id = ' . auth()->user()->id);
    $db->close(); 
    $user_info = $query->getResultArray();
    if($user_info[0]['nivel']==0) return true; else return false;
}
function usuario_is_docente(): bool
{
    $db = db_connect();
    $query = $db->query('SELECT nivel FROM users where id = ' . auth()->user()->id);
    $db->close(); 
    $user_info = $query->getResultArray();
    if($user_info[0]['nivel']==2) return true; else return false;
}
function usuario_is_alumno(): bool
{
    $db = db_connect();
    $query = $db->query('SELECT nivel FROM users where id = ' . auth()->user()->id);
    $db->close(); 
    $user_info = $query->getResultArray();
    if($user_info[0]['nivel']==3) return true; else return false;
}
function usuario_is_aspirante(): bool
{
    $db = db_connect();
    $query = $db->query('SELECT nivel FROM users where id = ' . auth()->user()->id);
    $db->close(); 
    $user_info = $query->getResultArray();
    if($user_info[0]['nivel']==4) return true; else return false;
}
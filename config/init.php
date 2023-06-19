<?php
//  fichier de config de l'app

session_start();

const CONFIG=[
    'db'=>[
        'HOST'=>'127.0.0.1',    
        'PORT'=>'3306',
        'NAME'=>'star_island',
        'USER'=>'root',
        'PWD'=>''

    ],
    'app'=>[
        'name'=>'star_island',
        'projecturl'=>'http://localhost/star_island_final/',
    ]

];

const BASE_PATH='/star_island_final/';
const GALERIE_PATH='/star_island_final/galerie.php';
const VIP_PATH='/star_island_final/vip.php';
const SERVEUR_PATH='/star_island_final/serveur.php';
const EVENT_PATH='/star_island_final/event.php';
const COMMENT_PATH='/star_island_final/comment.php';

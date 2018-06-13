<?php

session_start();

session_unset();

session_destroy();

header('location: http://localhost/newpc/index.php?e=connexion&a=authentification');
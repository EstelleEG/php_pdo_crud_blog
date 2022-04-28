<?php
//DIR est le chemin absolu
define('ROOT', realpath(__DIR__ . DIRECTORY_SEPARATOR . ".."));

//Below, I declare my views via this constant ('absolute link' towards views folder) to then display my views when needed
define('VIEW', ROOT . DIRECTORY_SEPARATOR . 'view');

//Here I say : this is the path to go to config files and to connect to db
define('DATABASE_CONFIG_FILEPATH', implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'database.ini']));

<?php

// Chargement des classes et fichiers
require 'Config/AutoLoad.php';

// Affichage du contenu du buffer
Buffer::show("Template/Gabarit", array('body' => Buffer::get()));
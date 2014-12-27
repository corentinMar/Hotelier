HOTELIER : Gestionnaire d'hôtels
==========
**Hotelier** est la solution pour gérer tous vos hôtels en un clin d'oeil !

Introduction
----------
Bienvenue dans notre projet de *gestionnaire d'hôtels*.

Installation
----------
Ce project requiert :
* PHP (version >= 5.3.3)
* ZendFramework (version 2.3.*)
* ~~Doctrine (version 2.3.0)~~

L'installation peut se faire via Composer (non nécésaire car plus de Doctrine !) : 

### Installer Composer
Télécharger et installer *Composer* à l'adresse suivante : https://getcomposer.org/download/
(Si vous êtes sous Windows, choisissez *Windows Installer*)

Ensuite rendez-vous dans le dossier source *hotelier/* via un terminal et tapez la commande suivante :
```
composer install
```

Puis via PhpMyAdmin, exécutez le script situé dans le dossier source *hotelier/hotelier.sql*

Si besoin, pour modifier le répertoire où seront écrit les logs, modifiez la ligne 29 située dans *hotelier/config/autoload/global.php*


Merci ! :-)

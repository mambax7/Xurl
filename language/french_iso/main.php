<?php
//  ------------------------------------------------------------------------ //
//  Author: Designburo.nl (sales@designburo.nl)                              //
//  http://www.designburo.nl                                                 //
//  Project: Xurl   v1.2                                                     //
//  Copyright (c) 2009 by Designburo.nl This material may be distributed     //
//  only subject to the terms and conditions set forth in the                //
//  Open Public License, v1.0 or later.                                      //
//  https://fedoraproject.org/wiki/Licensing/Open_Public_License             //
//  ------------------------------------------------------------------------ //
define('_XURL_SUBMIT','Raccourcir');
define('_XURL_SANITIZE','Texte à sanitizer ');
define('_XURL_S_SUBMIT','Sanitizer');
define('_XURL_WRONG_URL','L\'url soumise n\'est pas valide.');

// admin section
define('_AM_XURL_TAB1','Au Sujet');
define('_AM_XURL_TAB1_HEAD','Bienvenue sur Xurl');
define('_AM_XURL_TAB1_FOOT1','Le module Xurl est un élément de ');
define('_AM_XURL_TAB1_FOOT2',' une "Ligne de Produits"');
define('_AM_XURL_TAB2','Préférences');
define('_AM_XURL_TAB2_HEAD','<h2>Préférences Xurl</h2><br />S\'il vous plaît, assurez-vous que tous les paramètres soient corrects.<br />Nous avons besoin que les paramètres MySQL permettent que les visiteurs soient redirigés en cliquant sur un lien quand ils ne sont des utilisateurs enregistrés de votre site. Sans ces informations MySQL, XOOPS vérifiera toujours si l\'utilisateur est enregistré.<br />Les paramètres SQL doit être corrects, les préférences ci-dessous sont celles que vous avez besoin de modifier pour votre utilisation du module.');
define('_AM_XURL_TAB2_HEAD2','<strong>Préférences</strong>');

define('_AM_XURL_UPAGE','Allez au module (côté utilisateur)');
//tab1
define('_AM_XURL_VERSION','Version');
define('_AM_XURL_DESC','Description');
define('_AM_XURL_AUTHOR','Auteur');
define('_AM_XURL_LCNSE','Licence');
define('_AM_XURL_STATUS','Status');
define('_AM_XURL_RELEASED','Publication');

//tab2
define('_AM_XURL_SET_TABLEH1','Nom');
define('_AM_XURL_SET_TABLEH2','Valeur');
define('_AM_XURL_SET_TABLEH3','Description');
define('_AM_XURL_SET_FOOTER','Dernières préférences enregistrées : ');
define('_AM_XURL_SET_FOOTER_ERR','Impossible d\'inscrire le fichier de configuration. S\'il vous plaît, assurez-vous que les attributs d\'écriture soient correctement définis !');

define('_AM_XURL_YES','Oui');
define('_AM_XURL_NO','Non');
define('_AM_XURL_SET_BASE','Url de base');
define('_AM_XURL_SET_BASE_D','Le nom de base pour rediriger les URLs, par exemple : http://www.xoofoo.org/. N\'oubliez pas le slash "/" à la fin.');
define('_AM_XURL_SET_ERR','Erreur d\'url');
define('_AM_XURL_SET_ERR_D','Si une URL raccourcie demandée n\'existe pas, vers quelle adresse la personne doit être redirigée ?');
define('_AM_XURL_SET_RESTRICT','Accés limité ?');
// Edited in v1.2
define('_AM_XURL_SET_RESTRICT_D','Lorsqu\'elle est activée, seuls les utilisateurs autorisé de votre site peuvent cliquer sur une URL raccourcie, un utilisateur non autorisé sera redirigé vers une autre URL.');
// end edited in v1.2
define('_AM_XURL_SET_RESTR_R','Url de redirection pour les "limités"');
define('_AM_XURL_SET_RESTR_R_D','Si l\'accès est restreint, où le visiteur non enregistré ? (Par exemple, si un utilisateur clique sur une URL raccourcie, mais son accès est limité, sur quelle adresse doit-il être redirigé ?) Assurez-vous que cette URL soit autorisée aux utilisateurs (par exemple les utilisateurs anonymes).');

define('_AM_XURL_SET_SAVE','Enregistrer les préférences');


// Added version 1.1
define('_AM_XURL_TAB3','Organisation');
define('_AM_XURL_TAB4','Aide');
define('_XURL_INDEX_TEXT','<h1>Xurl</h1>Raccourcir de longues URLs pour les utiliser par exemple dans Twitter.<br />Dans ce cas, Xurl utilise le service "2lk.nl" pour raccourcir les urls.<br />Quiconque est enregistré sur "EasyTCPtransfer" peut utiliser cela !<br/><br/>');
define('_XURL_INDEX2_TEXT','<h1>Xurl</h1>Raccourcir de longues URLs pour les utiliser par exemple dans Twitter.<br />Il n\'est pas conseillé d\'autoriser cette fonctionnalité aux utilisateurs anonymes.<br /><br />');
define('_AM_XURL_STAT_C1','Clé');
define('_AM_XURL_STAT_C2','URL');
define('_AM_XURL_STAT_C3','Utilisateur');
define('_AM_XURL_STAT_C4','Hits');
define('_AM_XURL_STAT_INTRO1','Nous avons ');
define('_AM_XURL_STAT_INTRO2','d\'url(s) raccourcie(s) dans notre base de données.');
define('_AM_XURL_STAT_INTRO3','Afficher les enregistrements ');
define('_AM_XURL_STAT_INTRO4','Cliquez sur le nom de la colonne pour trier sur celle-ci, ou sur les icônes "montante" et "descendante" afin de trier par ordre, ou encore sur un nom d\'utilisateur pour ne montrer que les Xurls de ce dernier.');
define('_AM_XURL_STAT_INTRO5','Afficher les Xurls en filtrant par utilisateur : ');
define('_AM_XURL_STAT_INTRO6','Cliquez ici pour afficher les enregistrements.');
define('_AM_XURL_STAT_NEXT','Suivant >>>');
define('_AM_XURL_STAT_PREV','<<< Précédent');

// End added version 1.1

// Added in v1.2

define('_AM_XURL_SET_QR','Utiliser les BarCodes QRC dans le module Xurl ?');
define('_AM_XURL_SET_QR_D','Si activé, des BarCodes QRC seront créés pour les Urls raccourcies.');
define('_AM_XURL_SET_QR_PLUGIN','Utilisez Xurl dans les plugins ?');
define('_AM_XURL_SET_QR_PLUGIN_D','"Oui", permettra à d\'autres modules (après adaptation) de raccourcir les URLs. "Aucun", limitera l\'utilisation au module Xurl uniquement.');
define('_AM_XURL_STAT_C5','Limité');
define('_AM_XURL_STAT_C6','Groupe');
define('_AM_XURL_STAT_C7','Date de création');
define('_AM_XURL_STAT_C8','Dernier clic');
define('_AM_XURL_STAT_C9','#Spam');
define('_XURL_MAN_NODEL','Vous n\'êtes pas autorisé à utiliser cette fonctionnalité');
define('_XURL_MAN_NOOWN','Vous n\'êtes pas le propriétaire de cette adresse URL');
define('_XURL_MAN_SQLERR','Erreur SQL à l\'effacement de l\'enregistrement');
define('_XURL_MAN_NOURL','Impossible de trouver cette Url raccourcie');
define('_XURL_MAN_SUCCESS',' a été retirée.');
define('_XURL_MAN_SHOW1','Afficher');
define('_XURL_MAN_SHOW2','Gestionnaire des Urls raccourcies');
define('_XURL_MAN_CREA1','Vous avez créé(e)');
define('_XURL_MAN_CREA2','URLs courtes');
define('_XURL_MAN_S_URL','URL raccourcie');
define('_XURL_MAN_O_URL','URL originale');
define('_XURL_MAN_DATE','Créé');
define('_XURL_MAN_LCLICK','Dernière visite');
define('_XURL_MAN_HITS','Hits');
define('_XURL_MAN_DEL','Effacer');
define('_XURL_NEW_URL','Nouvelle Url raccourcie');
define('_XURL_STO_URL','Url enregistrée');
define('_XURL_ORI_URL','Url originale');
define('_XURL_WRONG_PASS','Mot de passe bizarre');
define('_XURL_SAN_TXT','Texte sanitizé');
define('_XURL_ORI_TXT','Texte original');
define('_XURL_QRCODE','Votre BarCode QRC');
	   
	   
// End added in v1.2

/**
 * @translation     AFUX (Association Francophone des Utilisateurs de Xoops) (http://www.afux.org/)
 * @specification   _LANGCODE: fr
 * @specification   _CHARSET: ISO-8859-1
 *
 * @Translator      kris (http://www.xoofoo.org)
 *
 * @version         $Id $
**/
?>
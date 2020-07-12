<?php
//  ------------------------------------------------------------------------ //
//  Author: Designburo.nl (sales@designburo.nl)                              //
//  http://www.designburo.nl                                                 //
//  Project: Xurl                                                            //
//  Copyright (c) 2009 by Designburo.nl This material may be distributed     //
//  only subject to the terms and conditions set forth in the                //
//  Open Public License, v1.0 or later.                                      //
//  https://fedoraproject.org/wiki/Licensing/Open_Public_License             //
//  Traducido al español por Don Curioso - htpp://www.hispaxoops.com         //
//  ------------------------------------------------------------------------ //
define('_XURL_SUBMIT','Acortar');
define('_XURL_SANITIZE','Limpiar texto');
define('_XURL_S_SUBMIT','Limpiar');
define('_XURL_WRONG_URL','La dirección web que ha facilitado no es válida.');

// admin section
define('_AM_XURL_TAB1','Acerca de');
define('_AM_XURL_TAB1_HEAD','Bienvenido a Xurl');
define('_AM_XURL_TAB1_FOOT1','Xurl es parte de');
define('_AM_XURL_TAB1_FOOT2','Línea de productos');
define('_AM_XURL_TAB2','Ajustes');
define('_AM_XURL_TAB2_HEAD','<h2>Ajustes de Xurl</h2><BR>Por favor, esté seguro que todos los ajustes son correctos.<BR>Se necesitarán los ajustes de MySQL para redirigir a los visitantes que hagan click en un enlace y no estén registrados en el sitio. Sin la información de MySQL requerida,XOOPS siempre verificará si el usuario está registrado.<BR>Los ajustes de MySQL deberían ser suficiente, quizás tenga que realizar otros cambios.');
define('_AM_XURL_TAB2_HEAD2','<b>Ajustes</b>');
define('_AM_XURL_UPAGE','Ir a la página principal de Xurl');

//tab1
define('_AM_XURL_VERSION','Versión');
define('_AM_XURL_DESC','Descripción');
define('_AM_XURL_AUTHOR','Autor');
define('_AM_XURL_LCNSE','Licencia');
define('_AM_XURL_STATUS','Estatus');
define('_AM_XURL_RELEASED','Publicado');

//tab2
define('_AM_XURL_SET_TABLEH1','Nombre');
define('_AM_XURL_SET_TABLEH2','Valor');
define('_AM_XURL_SET_TABLEH3','Descripción');
define('_AM_XURL_SET_FOOTER','Últimos ajustes grabados: ');
define('_AM_XURL_SET_FOOTER_ERR','Error. No se puede escribir. Verifique los permisos.');

define('_AM_XURL_YES','Si');
define('_AM_XURL_NO','No');
define('_AM_XURL_SET_SQLHOST','Base de datos MySQL');
define('_AM_XURL_SET_SQLHOST_D','Escriba la dirección de la base de datos, usualmente localhost');
define('_AM_XURL_SET_SQLUSR','Nombre de usuario de la base de datos MySQL');
define('_AM_XURL_SET_SQLUSR_D','Escriba aquí el nombre de usuario de la base de datos');
define('_AM_XURL_SET_SQLPASS','Contraseña de la base de datos MySQL');
define('_AM_XURL_SET_SQLPASS_D','Escriba aquí la contraseña de la base de datos');
define('_AM_XURL_SET_SQLDB','Nombre de la base de datos MySQL');
define('_AM_XURL_SET_SQLDB_D','Escriba aquí el nombre de la base de datos');
define('_AM_XURL_SET_SQLTBLE','Nombre de la tabla Xurl');
define('_AM_XURL_SET_SQLTBLE_D','Nombre completo de la tabla INCLUYENDO el prefixo de su Xoops');
define('_AM_XURL_SET_BASE','Dirección web de salida');
define('_AM_XURL_SET_BASE_D','La dirección web de salida para la reescritura de webs, p. ej http://www.hispaxoops.com/. No se olvide de poner una barra al final de la dirección, sinó, no funcionará.');
define('_AM_XURL_SET_ERR','Error de dirección web');
define('_AM_XURL_SET_ERR_D','Si alguien requiere una dirección corta que ya no existe, ¿donde debería ir?');
define('_AM_XURL_SET_RESTRICT','¿Acceso restringido?');
define('_AM_XURL_SET_RESTRICT_D','Cuando ésta opción está activada, sólo los usuarios registrados podrán utilizar Xurl.');
define('_AM_XURL_SET_RESTR_R','¿Restringir la redirección de direcciones web?');
define('_AM_XURL_SET_RESTR_R_D','Si ésta opción está activada, ¿donde van los visitantes no registrados?. Si alguien hace click sin estar registrado y está la opción activada, asegúrese que la dirección web a la que los envía será accesible a los visitantes.');
define('_AM_XURL_SET_SAVE','Grabar cambios');
?>
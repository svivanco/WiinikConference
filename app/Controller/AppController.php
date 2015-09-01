<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller 
{
	
	var $helpers = array('AssetCompress.AssetCompress');	
	
    //Declaramos todos los componentes a usar por toda la aplicacion
    public $components = array
                            (
                                'DebugKit.Toolbar'=>array
                                                        (
                                                            'enabled'=>true
                                                        ),
                                //Componente indispensable para el login y funciones extra
                                'Session',
                                'LdapAuth'=>array
                                            (
                                                'userModel'=>'CoUser',
                                                'authenticate' => array
                                                                (
                                                                    'Form' => array
                                                                                (
                                                                                    //Asignacion de campos para el login y la contrase?a, indespensable para el login
                                                                                    'fields' => array('username' => 'login','password'=>'password'),
                                                                                    //Modelo que utilizaremos para la autenticacion
                                                                                    'userModel'=>'CoUser',
                                                                                    //Condicion de logueo, unicamente se podran loguear los usuarios que esten activos
                                                                                    'scope'=>array('CoUser.activo'=>1)
                                                                                )
                                                                ),
                                                //Hacia donde se redirigira para el login
                                                'loginAction'=>array('controller'=>'co_users','action'=>'login'),
                                                //Mensaje en caso de login ioncorrecto
                                                'loginError'=>"Nombre de usuario o contrase&ntilde;a incorrectos"
                                            ),
                                'RequestHandler'
                            );
                            
    //Funcion llamada antes de mostrar una pagina de la aplicacion
    function beforeFilter()
    {
        //$this->LdapAuth->allow();
        //Seteamos los valores del componente LdapAuth
        //authError: Mensaje de error en caso de querer acceder a una accion a la que no se tiene permiso
        //authorize: Indicamos que el metodo de autorizacion(validacion de permisos) sera validada por medio del controlador. Ir a funcion isAuthorized() 
        $this->LdapAuth->authError = "Acceso Denegado";
        $this->LdapAuth->authorize = "Controller";  
        

		//Carga el tema seleccionado por el usuario, o el configurado por default en sistema
		//$this->setupTheme();

        //En caso de que el usuario este logueado enviaremos sus datos, para tenerlos disponibles en cualquier vista y obtendremos su menu
        if($this->Session->check('Auth.User'))
        {
            //Recuperamos la informacion del usuario almacenada en la variable de sesion
            $Auth = $this->Session->read('Auth.User');
            //Si no esta guardado el menu en la variable de sesion
            if(!$this->Session->check('menuApp'))
            {
                //Obtenemos el menu HTML y lo almacenamos en la variable 
                $menuApp = $this->GetMenuDB();
                //Guardamos en menu en la variable de sesion
                $this->Session->write('menuApp',$menuApp);
            }
            //Recuperamos el menu de la variable de sesion
            $menuApp = $this->Session->read('menuApp');
            //Enviamos las variables a la vista, con esto estara disponible en todas las vistas
            $this->set(compact('Auth','menuApp','Languaje'));
        } 
		
		//Seteamos un layout especial para todos los errores
	    if($this->name == 'CakeError')
		{
		  $this->layout = 'error';
		}        
   		

    }
    
	
	
/**
 * Returns encrypted string
 */
function encrypt($pure_string, $encryption_key) 
{
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, $pure_string, MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}

/**
 * Returns decrypted original string
 */
function decrypt($encrypted_string, $encryption_key)
 {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}	
	
	




	
    
    /**
    * Funcion para obtener el Menu de la aplicacion para el usuario actual y enviarlo a la vista en formato HTML
    * 
    */
    function GetMenuDB()
    {
        //Si ya esta seteado el valor del GrupoActual, procedemos a buscar y generar el menu
        if($this->Session->check('Auth.User.co_group_id'))
        {
            //Importamos y creamos el objeto del modelo de muchos a muchos del grupo y menu
            App::import('Model','CoGroupsCoMenu');
            $thisGrupoMenu = new CoGroupsCoMenu();
            //Buscamos los id de los elementos del menu para el grupo al que pertenece el usuario
            $ListaMenu = $thisGrupoMenu->find
                                        (
                                            'all',
                                            array
                                                (
                                                    'fields'=>array
                                                                    (
                                                                        'CoGroupsCoMenu.co_menu_id'
                                                                    ),
                                                    'conditions'=>array
                                                                    (
                                                                        'CoGroupsCoMenu.co_group_id'=>$this->Session->read('Auth.User.co_group_id')
                                                                    )
                                                )
                                        );
            //Por el modo en que es regresado el arreglo anterior es necesarios recorrerlo para formar una lista simple con todos los Ids recuperados
            $Lista = array();
            foreach($ListaMenu as $List)
            {
                $Lista[$List['CoGroupsCoMenu']['co_menu_id']] = $List['CoGroupsCoMenu']['co_menu_id'];
            }
            //Importamos y creamos el objeto del Modelo de Menu
            App::import('Model','CoMenu');
            $thisMenu = new CoMenu();
            //Desvinculamos las relaciones innecesarias para agilizar la busqueda
            $thisMenu->unbindModel
                                (
                                    array
                                        (
                                            'belongsTo'=>array
                                                            (
                                                                'MenuPadre'
                                                            ),
                                            'hasAndBelongsToMany'=>array
                                                            (
                                                                'CoGroup'
                                                            )
                                        )
                                );
            //Establecemos las condiciones y el orden para la busqueda de los menus hijos de cada item
            $thisMenu->hasMany['MenusHijos']['conditions']  = 'id IN ('.implode(',',$Lista).') AND activo = 1';
            $thisMenu->hasMany['MenusHijos']['order'] = 'posicion ASC';
            //Realizamos la busqueda, esta nos retorna el listado de los menus con sus respectivos menus hijos
            $Menu = $thisMenu->find
                                    (
                                        'all',
                                        array
                                            (
                                                'conditions'=>array
                                                                (
                                                                    'CoMenu.co_menu_id'=>NULL,
                                                                    'CoMenu.id'=>$Lista,
                                                                    'CoMenu.activo'=>1
                                                                ),
                                                'order'=>'CoMenu.posicion ASC'
                                            )
                                    );
            $menuApp = "";
            //Si se encontro por lo menos un menu, procedemos a formar el menu HTML
            if(!empty($Menu))
            {
                //Importamos y creamos un objeto del Helper HTML
                App::import('Helper', 'Html');
                $thisHtml = new HtmlHelper(new View(null));
                //Inicia estructura del menu
                $menuApp = "<ul class=\"nav navbar-nav principal\">";
                //Recorremos los items encontrados
				
				
			
                foreach($Menu as $item)
                {
					//Si tiene hijos
                    if(!empty($item['MenusHijos']))
                    {
                        $menuApp .= "<li class=\"dropdown\">";
                        $menuApp .= $thisHtml->link 
                                                    (
                        "<img src=".$this->webroot."img/".$item['CoMenu']['icono']." class=\"menuimg\">".$item['CoMenu']['nombre']."<i class=\"caret\"></i>",
                                                        $item['CoMenu']['destino'],
                                                        array
                                                            (
                                                                'title'=>$item['CoMenu']['info_tooltip'],
                                                                'escape'=>false,
                                                                'class'=>'dropdown-toggle',
                                                                'data-toggle'=>'dropdown'
                                                            )
                                                    );
                    }
                    else
                    {
                        $menuApp .= "<li>";
                        $menuApp .= $thisHtml->link 
                                                    (
                                                        //$item['CoMenu']['nombre'],
                          "<img src=".$this->webroot."img/".$item['CoMenu']['icono']." class=\"menuimg\">".$item['CoMenu']['nombre']."<i class=\"caret\"></i>",                                                      
                                                        $item['CoMenu']['destino'],
                                                        array
                                                            (
                                                                'title'=>$item['CoMenu']['info_tooltip'],
                                                                'escape'=>false
                                                            )
                                                    );
                    }
                        //Si el menu actual en el ciclo tiene menus anidados, los recorremos para armar el submenu
                        if(!empty($item['MenusHijos']))
                        {
                            //Iniciar el submenu
                            $menuApp .= "<ul class=\"dropdown-menu kolumny\" role=\"menu\">";
                                //Recorremos los items anidados
                                foreach($item['MenusHijos'] as $subItem)
                                {
                                    $menuApp .= "<li>";
                                        $menuApp .= $thisHtml->link
                                                                    (
                                                                        "<i class=\"".$subItem['icono']."\"></i>".$subItem['nombre'],
                                                                        $subItem['destino'],
                                                                        array
                                                                            (
                                                                                'title'=>$subItem['info_tooltip'],
                                                                                'escape'=>false
                                                                            )
                                                                    );
                                    $menuApp .= "</li>";
                                }
                            $menuApp .= "</ul>";
                        }
                    $menuApp .= "</li>";
                }
                $menuApp .= "</ul>";
            }
            //Retornamos la variable
            return $menuApp;
        }                    
    }
    
    /**
    * Funcion sobrecargada para sabes si la accion solicitada es permitida
    * 
    */
    function isAuthorized()
    {    
        //Retornamos los que nos regrese la funcion __permitted , enviando el nombre del controlador y de la accion que fueron llamados 
        //echo $this->__permitted($this->name,$this->action) -- > 1 o true;
     
        return $this->__permitted($this->name,$this->action);
    }
	
    function __permitted($controllerName,$actionName)
    {
        //Convertimos a minisculas sólo el nombre del controlador

        $controllerName = strtolower($controllerName);
		//Se detecto que los nombres de las acciones eran jaladas de la base de datos con mayusculas y minusculas y al hacer la compración
		//no entraba...

        $actionName = $actionName;
        
        //Asignamos los permisos por default para todo los usuarios
        $Permisos = array('pages:display','cousers:logout','cousers:cambio_contrasena');
        
        if($this->Session->check('Auth.User.co_group_id'))
        {
            //Si ya estan escritos en la variable de sesion
            if($this->Session->check('permisosApp'))
            {
                //Los recuperamos y los guardamos en la variable
                $permisosApp = $this->Session->read('permisosApp');
            }
            else
            {
                //Importamos y creamos un objeto del Modelo de grupos permisos
                App::import('Model','CoGroupsCoPermission');
                $thisGrupoPermiso = new CoGroupsCoPermission();
                //Buscamos todos los permisos que esten activos y que pertenezcan al grupo actual
                $permisosApp = $thisGrupoPermiso->find
                                            (
                                                'all',
                                                array
                                                    (
                                                        'fields'=>array
                                                                        (
                                                                            'CoPermission.nombre'
                                                                        ),
                                                        'conditions'=>array
                                                                        (
                                                                            'CoGroupsCoPermission.co_group_id'=>$this->Session->read('Auth.User.co_group_id'),
                                                                            'CoPermission.activo'=>1
                                                                        )
                                                    )
                                            );
                $this->Session->write('permisosApp',$permisosApp);
            }
            //Agregamos los permisos encontrados a los permisos generales de la aplicacion
            foreach($permisosApp as $PermisoBD)
            {
                $Permisos[] = $PermisoBD['CoPermission']['nombre'];
            }
        }
        //Recorremos el listado de los permisos para determinar si la accion esta permitida
        foreach($Permisos as $Permiso)
        {    
            if($Permiso == '*')
            { 
                return true;//Tiene todas las acciones permitidas
            }
            if($Permiso == $controllerName.":*")
            {
                return true;//Todas las acciones permitidas sobre el controlador
            }
            if($Permiso == $controllerName.':'.$actionName)
            {
                return true;//Permiso especifico
            }
        }
        $this->Session->setFlash('<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button><span class="titulo_error">Acceso Denegado, necesita permisos en: <strong>'.$controllerName.'->'.$actionName.'</strong></span>',"default",array('class'=>'alert alert-danger'));
        return false;       
    }
	
	
	//Funciones para grabar en la sesión, la página a la que debemos regresar	
	function origReferer()
	{
	
		//Para recordar la pestaña en Bootstrap Tabs
		if(empty($_COOKIE["anchor"]))
			return $this->Session->read('referer');
		else
			return $this->Session->read('referer').$_COOKIE['anchor'];		
	}
	
	//Función que graba en la sesión la página a la que deberemos regresar.
	function setReferer()
	{
		$this->Session->write('referer', $this->referer());
	}
	


	function getBrowser() 
	{ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	
		  
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) 
		{
			// we have no matching number just continue
		}
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}
		
		// check if we have a number
		if ($version==null || $version=="") {$version="Desconocida";}
		
		return $bname.' Version:'.$version.' Agente:'.$u_agent;
		
	} 
	
	
	
	function getOs() 
	{
		
	  $useragent= strtolower($_SERVER['HTTP_USER_AGENT']);
	
	  //winxp
	  if (strpos($useragent, 'windows nt 5.1') !== FALSE) {
		return 'Windows XP';
	  }
	  elseif (strpos($useragent, 'windows nt 6.1') !== FALSE) {
		return 'Windows 7';
	  }
	  elseif (strpos($useragent, 'windows nt 6.0') !== FALSE) {
		return 'Windows Vista';
	  }
	  elseif (strpos($useragent, 'windows 98') !== FALSE) {
		return 'Windows 98';
	  }
	  elseif (strpos($useragent, 'windows nt 5.0') !== FALSE) {
		return 'Windows 2000';
	  }
	  elseif (strpos($useragent, 'windows nt 5.2') !== FALSE) {
		return 'Windows 2003 Server';
	  }
	  elseif (strpos($useragent, 'windows nt') !== FALSE) {
		return 'Windows NT';
	  }
	  elseif (strpos($useragent, 'win 9x 4.90') !== FALSE && strpos($useragent, 'win me')) {
		return 'Windows ME';
	  }
	  elseif (strpos($useragent, 'win ce') !== FALSE) {
		return 'Windows CE';
	  }
	  elseif (strpos($useragent, 'win 9x 4.90') !== FALSE) {
		return 'Windows ME';
	  }
	  elseif (strpos($useragent, 'windows phone') !== FALSE) {
		return 'Windows Phone';
	  }
	  elseif (strpos($useragent, 'iphone') !== FALSE) {
		return 'iPhone';
	  }
	  // experimental
	  elseif (strpos($useragent, 'ipad') !== FALSE) {
		return 'iPad';
	  }
	  elseif (strpos($useragent, 'webos') !== FALSE) {
		return 'webOS';
	  }
	  elseif (strpos($useragent, 'symbian') !== FALSE) {
		return 'Symbian';
	  }
	  elseif (strpos($useragent, 'android') !== FALSE) {
		return 'Android';
	  }
	  elseif (strpos($useragent, 'blackberry') !== FALSE) {
		return 'Blackberry';
	  }
	  elseif (strpos($useragent, 'mac os x') !== FALSE) {
		return 'Mac OS X';
	  }
	  elseif (strpos($useragent, 'macintosh') !== FALSE) {
		return 'Macintosh';
	  }
	  elseif (strpos($useragent, 'linux') !== FALSE) {
		return 'Linux';
	  }
	  elseif (strpos($useragent, 'freebsd') !== FALSE) {
		return 'Free BSD';
	  }
	  elseif (strpos($useragent, 'symbian') !== FALSE) {
		return 'Symbian';
	  }
	  else 
	  {
		return 'Desconocido';
	  }
	}   
	   


    
	
	//Consulta la Tabla de Configuraciones de la DB, obteniendo el campo valor mediante el Parametro que debe leer.
    function readConfig()
	{
	
            App::import('Model','CoConfiguracione');
            $configuracion= new CoConfiguracione();

			//Cuando usabamos una columna parametro	
			//$options = array('conditions' => array('CoConfiguracione.Parametro' => $tocheck));
			//$valor = $configuracion->find('first', $options);

			$valor = $configuracion->find('first');
			return $valor;
	}	
	


  /**
  * Envio de mails usando SMTP, configurado en el database.php
  * 
  * @param mixed $to PARA
  * @param mixed $subject Asunto
  * @param mixed $contenido Contenido en formato HTML
  */
  function creemail($to,$subject,$contenido)
  {
      /**
      * NOTA: Cuidar que cuando se envia de Gmail a otra cuenta de GMail, la otra cuenta de Gmail
      * debe de responderle primero un correo, si no no recibira notificaciones.
      * Procedimiento: Dedede la cuenta FrOM en la interfaz de Gmail enviar un correo hacia la cuenta TO de Gmail
      */
	  $configuracion=$this->readConfig();
	  
      if($configuracion['CoConfiguracione']['sendMails'])
	  {

      	App::import('vendor', 'PHPMailer', array('file' =>'phpmailer/class.phpmailer.php')); 
		  //Accedemos al DataBase Config (database.php) para obtener los datos del SMTP
        $ds = new DATABASE_CONFIG();         
		
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try
        {
        			//gmail
								$mail->SMTPAuth = true; 
								$mail->SMTPSecure = "ssl"; 
        	
        	
        			//mail tsj
            $mail->Host = $ds->smtp['host'];
            $mail->Port = $ds->smtp['port'];
            $mail->Username = $ds->smtp['username'];
            $mail->Password = $ds->smtp['password'];
            $mail->SetFrom($ds->smtp['username'],$ds->smtp['from']);
            $mail->AddAddress($to);
            //Por default en el sistema enviamos correo al responsable del sistema
            $mail->AddAddress('angeldiacono@hotmail.com');
            
            $mail->Subject = utf8_decode($subject);
            $mail->MsgHTML(utf8_decode($contenido));
            
            $mail->Send();
        }
        catch(phpmailerException $e)
        {
            echo $e->errorMessage();
        }
        catch(Exception $e)
        {
            echo $e->errorMessage();
        }

      }    
  }	
	
	
  /**
  * Envio masivo de emails usando SMTP, requiere de la llamada previa de  _getDestinatarios, para devolver arreglos con la información 
  //(grupos o personas con bandera de notificación activa)
  * 
  * @param mixed $to PARA
  * @param mixed $subject Asunto
  * @param mixed $contenido Contenido en formato HTML
  */
  function masive_email($to,$subject,$contenido)
  {
      /**
      * NOTA: Cuidar que cuando se envia de Gmail a otra cuenta de GMail, la otra cuenta de Gmail
      * debe de responderle primero un correo, si no no recibira notificaciones.
      * Procedimiento: Dedede la cuenta FrOM en la interfaz de Gmail enviar un correo hacia la cuenta TO de Gmail
      */
	  
      if(Configure::read('enviar_notificaciones'))
	  {
          $ds = new DATABASE_CONFIG();//Accedemos al DataBase Config para obtener los datos del SMTP
         
		 App::import('vendor', 'PHPMailer', array('file' =>'phpmailer/class.phpmailer.php')); 

        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try
        {
            $mail->Host = $ds->smtp['host'];
            $mail->Port = $ds->smtp['port'];
            $mail->Username = $ds->smtp['username'];
            $mail->Password = $ds->smtp['password'];
            
            $mail->SetFrom($ds->smtp['username'],$ds->smtp['from']);
            
			foreach($to as $a)
            {
                $mail->AddAddress($a['email'],$a['name']);
            }
            
            $mail->Subject = $subject;
            $mail->MsgHTML($contenido);
            
            $mail->Send();
        }
        catch(phpmailerException $e)
        {
            echo $e->errorMessage();
        }
        catch(Exception $e)
        {
            echo $e->errorMessage();
        }
              /* SMTP Options */
       		 /*$this->Email->smtpOptions = array(
                'port'=>$ds->smtp['port'],
                'timeout'=>$ds->smtp['timeout'],
                'host' => $ds->smtp['host'],
                'username'=>$ds->smtp['username'],
                'password'=>$ds->smtp['password'],
                );

          $this->Email->to = $to ;  
          $this->Email->subject = $subject;
          $this->Email->from = $ds->smtp['from'];
          $this->Email->sendAs = 'html';
          /* Set delivery method */
          /*$this->Email->delivery = 'smtp';
          //$this->Email->delivery = 'debug';
          /* Do not pass any args to send() */
         /* $this->Email->send($contenido);   
          //print_r($this->Email->smtpError);
          $this->set('smtp_errors', $this->Email->smtpError);*/ 
      }    
  }
  
  /**
     * Obtenemos los destinatarios segun el tipo de registro
     * 
     * @param mixed $tipo
     * @param array $areas, array([0]=>1,[1]=>34..)
     * @param int $id id de la audiencia
     */
     function _getDestinatarios($tipo='notificar_registro',$areas = array(),$id=null){
         APP::import('Model','CoUser');
         $users = new CoUser();
         $to = '';//destinatarios con formato de email
         switch($tipo){
             case 'notificar_registro':
                 $users->recursive=-1;
                //Notificamos cuando se de de alta
                $consulta = $users->find('all',array('conditions'=>array('CoUser.notificar_registro'=>1)));
                $i=0;
                foreach($consulta as $cons)
				{  
				    $to[$i]['name']=$cons['CoUser']['nombre'];
					$to[$i]['email']=$cons['CoUser']['email'];                             
                    $i++;
                }
             break;
             case 'turnar':
                 $users->recursive=-1;
                //Notificamos a todos los usuarios del area turnada
                $consulta = $users->find('all',array('conditions'=>array('CoUser.area_id'=>$areas)));
                $i=0;
                foreach($consulta as $cons)
				{                               
		          $to[$i]['name']=$cons['CoUser']['nombre'];
					$to[$i]['email']=$cons['CoUser']['email'];
                   // $to[$i]=$cons['CoUser']['nombre'].' <'.$cons['CoUser']['email'].'>';
                   // $to.=$cons['CoUser']['email'];
                    $i++;
                }
             break;
             case 'observacion':
                 $users->recursive=-1;
                //Notificamos cuando se agrega una observacion
                $consulta = $users->find('all',array('conditions'=>array('CoUser.notificar_registro'=>1)));
                $i=0;
                foreach($consulta as $cons)
				{                               
                    $to[$i]['name']=$cons['CoUser']['nombre'];
					$to[$i]['email']=$cons['CoUser']['email'];
                   // $to.=$cons['CoUser']['email'];
                    $i++;
                }
             break;    
             case 'areas_turnadas':
                 $users->recursive=-1;
                 //Obtenemos las areas turnadas de la tabla audiencias_areas
                 App::import('Model','AudienciasArea');
                 $thisAreas = new AudienciasArea();
                 $areas = $thisAreas->find('list',array('fields'=>'AudienciasArea.area_id,AudienciasArea.area_id','conditions'=>array('AudienciasArea.audiencia_id'=>$id)));                 
                //Notificamos a todos los usuarios del area turnada
                $consulta = $users->find('all',array('conditions'=>array('CoUser.area_id'=>$areas,'CoUser.co_group_id'=>array(3))));
                //pr($consulta);                                                                                 
                $i=0;
                foreach($consulta as $cons){                               
		          $to[$i]['name']=$cons['CoUser']['nombre'];
					$to[$i]['email']=$cons['CoUser']['email'];
                   // $to[$i]=$cons['CoUser']['nombre'].' <'.$cons['CoUser']['email'].'>';
                   // $to.=$cons['CoUser']['email'];
                    $i++;
                }
                //pr($to);exit;   
             break;
         }
         
         return $to;
         
     }
    
  /**
  * Funcion para envio de mensajes de texto
  * 
  * @param Numero telefonico para el envio del mensaje
  * @param Contenido del mensaje de texto
  */
  function envio_sms($telefono,$mensaje)
  {
        App::import('Vendor','nusoap/nusoap');   
        $param = array('user'=>'tablerosetec','password'=>'tabset11','telefono'=>$telefono,'mensaje'=>$mensaje);  
        
        $endpoint =Configure::read('rutaWS');         
        $client = new soap_client($endpoint);
        
        $err = $client->getError();
        if($err){
         echo "ERROR: ". $err; //este error se detona si hay algun problema con conectarse al Web Service  
        }

         $result = $client->call('SendMessage', $param); //Retorna un Numero Entero 
        if ($client->fault) {
            echo '<h2>Fault</h2><pre>';
            print_r($result);//En caso de falla
            echo '</pre>';
        } else {
            // Check for errors
            $err = $client->getError();        //En caso de algun error, como parametros invalidos.
            if ($err) {
                // Display the error
                echo '<h2>Error</h2><pre>' . $err . '</pre>';
            } else {
                // Display the result
                //En caso de exito, para este WebService regresa un id unico 
                // que es el id de la transaccion del mensaje, en la tabla outbox es un autoincremento
                //echo '<h2>Result</h2><pre>';               
                //print_r($result);
                //echo '</pre>';
                return;
            }
        } 
    }  
	
	
/**
 * getMesText method
 * Devuelve el mes en texto, se creo una funciÃ³n para evitar configuraciones y problemas relacionados con setLocale en apache y php.
 */

public function getMesText($mes)
{
	//date con el formato â€˜nâ€™ nos devuelve los nÃºmeros de los meses de 1 hasta 12, por eso restamos 1, sino nos darÃ­a el mes siguiente
	$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');   
	$textomes=$meses[$mes-1];
	return $textomes;
}

/**
 * getMesText method
 * Devuelve el dia en texto, se creo una funciÃ³n para evitar configuraciones y problemas relacionados con setLocale en apache y php.
 * El dÃ­a debe ser enviado con el formato w.
 */

public function getDiaText($dia)
{
	//date con el formato â€˜wâ€™ que nos devuelve la representaciÃ³n numÃ©rica del dÃ­a de la semana (0 para domingo hasta 6 para sÃ¡bado).
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$textodia=$dias[$dia];
	return $textodia;
}	
	
	
	
	
}
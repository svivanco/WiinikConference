<?php
App::import('Component', 'Auth');
class LdapAuthComponent extends AuthComponent 
{
    var $db_config =false ;//Configuracion del LDAP
    var $conexion=null;
    var $enlace = null;
    
    
    /*function hashPasswords($data)
    {
         if(Configure::read('authType')=='ldap')
         { 
            return $data;
         }
         else
         {
            return parent::hashPasswords($data);
         }   
    }*/
    /**
     * We will initially identify the user
     */
    function identify(CakeRequest $request, CakeResponse $response) 
    {
        if(Configure::read('authType')=='ldap')
        {  
            $ldapUser = $this->_ldapAuth($request); //Busco el usuario de ldap, si me regresa un registro significa que su contrase?a y usuario son correctos
            if (!isset($ldapUser[0]['dn'])) //Si no me regresa este campo el login es incorrecto
            {
                return false;
            }
            //Cargo el modelo para hacer la busqueda del usuario y ver si esta dado de alta en la aplicacion
            App::import('Model', $this->authenticate['Form']['userModel']);
            $model = new $this->authenticate['Form']['userModel']; 
            $model->recursive = -1; //Unicamente traemos los datos de la tabla
            $usuario = $model->find //Buscamos al usuario por su login
                                (   
                                    'first',
                                    array
                                        (
                                            'conditions'=>array
                                                            (
                                                                $this->authenticate['Form']['fields']['username'] => $request->data[$this->authenticate['Form']['userModel']][$this->authenticate['Form']['fields']['username']]
                                                            )
                                        )
                                );
           if(empty($usuario))//si no lo encontramos en la BD es que no ha sido registrado para la app
           {
                return false; 
           }
           //Guardaremos su contraseña actual en LDAP encriptada para que el identify funcione adecuadamente, ademas si por algun motivo el metodo de autenticacion cambia a BD, podran seguir usando su ultima contraseña de LDAP registrada
           $model->id = $usuario[$this->authenticate['Form']['userModel']][$model->primaryKey];
           $model->saveField($this->authenticate['Form']['fields']['password'],$request->data[$this->authenticate['Form']['userModel']][$this->authenticate['Form']['fields']['password']]);
           return parent::identify($request, $response);
      }
      else //Autentificacion por Base de Datos
      {         
          return parent::identify($request,$response);
      }     
    } 
    /**
    * Busca el usuario en LDAP con las credenciales proporcionadas, regresa un arreglo con el registro o null en caso de no encontrarlo
    * 
    * @param mixed $user
    */
    function _ldapAuth($user) 
    {
        //Recuperamos el username y el password proporcionado en la forma del login
        $username = $user->data[$this->authenticate['Form']['userModel']][$this->authenticate['Form']['fields']['username']];
        $password = $user->data[$this->authenticate['Form']['userModel']][$this->authenticate['Form']['fields']['password']];
        if($username=="" && $password=="") return false;//Si ambos campos estan vacios regresamos false        
        $resultado = $this->buscarUsuario($username);//Buscamos el usuario unicamente por su username
        if($resultado) //Si encontramos al usuario dentro del LDAP
        { 
            $autentificacion = @ldap_bind($this->conexion,$resultado[0]['dn'],$password);//Intentamos autenticar el usuario con el password proporcionado
            if($autentificacion)//Si la autenticacion es correcta
            {
                $this->_cerrarLdap();//Cerramos la conexion a LDAP
                return $resultado;//Devolvenmos el registro encontrado
            }
            else
            {
                $this->_cerrarLdap();//Cerramos la conexion a LDAP
                return false;//Regresamos null
            }
        }
        else
        {
           return false;
        }                     
    }
    
    /**
    * Conexion con ldap
    * 
    */
    function _conectarLdap()
    {
        App::import('Config', 'database');
        $this->db_config = new DATABASE_CONFIG(); //Accedemos a la configuracion para obtener los datos del directorio activo     
        if($this->db_config)
        {
            //Intentamos hacer la conexion al directorio activo
            $this->conexion = ldap_connect($this->db_config->ldap['host']);      
            $this->enlace = ldap_bind($this->conexion,$this->db_config->ldap['login'],$this->db_config->ldap['password']);              
            if($this->enlace)//Si el enlace es correcto
            {
                  return true;
            }
            else
            {                      
                return false;
            }
        }  
    }
    
    /**
    * Cerrar conexion a LDAP
    * 
    */
    function _cerrarLdap()
    {
        ldap_close($this->conexion);
    }
    
    /**
    * Buscar a un usuario dentro de LDAP por su login
    * 
    * @param mixed $login
    */
    function buscarUsuario($login="")
    {
        $conexion= $this->_conectarLdap();// nos conectamos al LDAP
        $Resultado=ldap_search($this->conexion,$this->db_config->ldap['basedn'],"(sAMAccountName=$login)"); //Realizamos la busqueda    
        if ($Resultado)//Si encontro el registro
        {
            return ldap_get_entries($this->conexion, $Resultado); //atributos LDAP, ver lista abajo
        }
       else
       {
          $this->_cerrarLdap() ;
          return false;      
       }
   }   
}
?>
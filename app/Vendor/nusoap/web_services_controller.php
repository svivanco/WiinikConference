<?php
/**
 * WebServices Controller
 * Uses Nusoap 
 *
 * @author      RosSoft
 * @version     0.12
 * @license		 MIT
 *  En esta clase se crean los webServices
 */

class WebServicesController extends AppController
{
	var $api=null;
	var $complexTypes=null;
	var $_soap_server;
	var $name='WebServices';	
	var $autoRender=false;

	/**
	 * Enables the use of cache for the server definition (not for the responses)
	 */	
	var $server_cache=false;
	
	/** 
	 * converts sql-type to xsd-type
	 */	
	var $columnTypes=array(
		'varchar'=>'xsd:string',
		'tinyint'=>'xsd:integer',
		'text'=>'xsd:string',
		'date'=>'xsd:string',
		'smallint'=>'xsd:integer',
		'mediumint'=>'xsd:integer',
		'int'=>'xsd:integer',
		'integer'=>'xsd:integer',
		'bigint'=>'xsd:integer',
		'float'=>'xsd:float',
		'double'=>'xsd:float', //maybe exists xsd:double
		'decimal'=>'xsd:float',
		'datetime'=>'xsd:string',
		'timestamp'=>'xsd:integer',
		'time'=>'xsd:string',
		'year'=>'xsd:string',
		'char'=>'xsd:string',		
		'binary'=>'xsd:string',
		'string'=>'xsd:string',
		'varbinary'=>'xsd:string',);
		
	function beforeFilter()
	{
		//little trick for ?wsdl param		
		global $_SERVER;
		
		if (preg_match('/' . Inflector::underscore($this->name) . '(\/)?$/',$_SERVER['PHP_SELF']))
		{
			if (preg_match("/\/$/",$_SERVER['PHP_SELF']))
			{
				$_SERVER['PHP_SELF'] .='index';
			}
			else
			{
				$_SERVER['PHP_SELF'] .='/index';
			} 	
		}	
		if ($this->action!='index' && $this->action!='wsdl') 
		{			
			$this->action='index';
			$this->index();			
		}					
	}
	
	function index()
	{
		App::import('Vendor','nusoap/nusoap');		
		$cacheName="soapserver/{$this->name}.soapserver";		
		if ($this->server_cache)
		{
			//reads the instance from cache
			$data=cache($cacheName, null, $expires = '+1 day');
			if ($data)
			{
				$this->_soap_server=unserialize($data);
			}
			//$this->_soap_server=$this->cacheObject->read($cacheName);	
		}
		else
		{
			$this->_soap_server=false;
		}
		
		if (! $this->_soap_server)
		{			
			$this->_soap_server=new soap_server();
			//$wsdl="{$this->name}wsdl";
			$wsdl="{$this->name}";
			$urn="urn:$wsdl";
			$url= FULL_BASE_URL.$this->here;
			$url=substr($url,-1)=="/" ? substr($url,0,-1):$url;
			$url=substr($url,-5)=="/wsdl" ? substr($url,0,-5):$url;
			$this->_soap_server->configureWSDL($wsdl, $urn, $url);				
				
			foreach ($this->api as $name => $method)
			{
				
				if (isset($method['output']))
				{
					if (is_array($method['output']))
					{
						$output=$this->_convertIOArray($method['output']);
					}
					else
					{
						$output=array('return'=>$method['output']);
						$output=$this->_convertIOArray($output);
					}
				}
				else
				{
					$output=array();
				}
				
				
				if (isset($method['input'])
				&& is_array($method['input']) 
				&& $method['input']!=array())
				{				
					$input=$this->_convertIOArray($method['input']);
				}
				else
				{
					$input=array();
				}
				
				$doc=(isset($method['doc']))? $method['doc'] : '';			
				$this->_soap_server->register($name,array($this,$name),$input,$output,
								  	$urn, "$urn#$name",						  
						    		'rpc',		// style
	    							'encoded', // use
	    							$doc);	// documentation
	    							
	    		
			}
			$this->_buildComplexTypes();
			
			if ($this->server_cache)
			{
				$this->_make_cache_dir();
				//saves the instance to cache
				//$this->cacheObject->write($cacheName,$this->_soap_server,'+1 Day',2);
				cache($cacheName,serialize($this->_soap_server));	
			}
		}		
		
		global $HTTP_RAW_POST_DATA;		    						
		$data = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : file_get_contents('php://input');
		$this->_soap_server->service($data);		
		exit();		
	}

	/**
	 * Auxiliar method for building the complex types
	 * parsing the $complexTypes array
	 */	
	function _buildComplexTypes()
	{
		if ($this->complexTypes)
		{
			foreach ($this->complexTypes as $name=> $def)
			{
				if (isset($def['array']))
				{
					$item=$def['array'];
					if (strpos($item,'xsd:')===false)
					{
						$item="tns:$item";
					}
					$phpType='array';
					$compositor='';
					$restrictionBase='SOAP-ENC:Array';
					$elements=array();
					$attrs=array(array('ref'=>'SOAP-ENC:arrayType',
										'wsdl:arrayType'=>"{$item}[]"));
					$arrayType=$item;
				}
				else if (isset($def['struct']))
				{    					
					$phpType='struct';
					$compositor='all';
					$restrictionBase='';
					$elements=array();
					foreach ($def['struct'] as $n=>$v)
					{
						$elements[$n]=array('name'=>$n,'type'=>$v);    						
					}
					$attrs=array();
					$arrayType='';
				}
				else if (isset($def['model']))
				{    					
					$phpType='struct';
					$compositor='all';
					$restrictionBase='';
					$elements=array();
					$columns=$this->{$def['model']}->getColumnTypes();
					foreach ($columns as $n=>$v)
					{												
						$pos=strpos($v,"(");
						if ($pos)
						{
							$v=substr($v,0,$pos);
						}
						$include=false;
						if (isset($def['fields']))
						{
						 	if (isset($def['fields'][$n]))
						 	{						 		
						 		$n=$def['fields'][$n];
						 		$include=true;
						 	} 
							else if (in_array($n,$def['fields']))
							{
								$include=true;
							}
						}						 							
						else
						{
							$include=true;
						}						
						if ($include) $elements[$n]=array('name'=>$n,'type'=>$this->columnTypes[$v]);						
					}
					$attrs=array();
					$arrayType='';										    										
				}
				else continue;
				
				$this->_soap_server->wsdl->addComplexType($name,'complexType',$phpType,$compositor,$restrictionBase,$elements,$attrs,$arrayType);    				
			}
		}		
	}
	
	/** 
	 * Returns a soap error with the $data variable printed in it
	 * This error will be returned to the client.
	 * In your method, do:
	 *    return $this->soapDebug($variableToDebug);
	 */
	function soapDebug($data)
	{
		return new soap_fault('Debug','',print_r($data,true),'');	
	}
	
	/**
	 * Converts the values an Input/Ouput array.
	 * Sets the namespace tns: for each of the elements
	 * that doesn't have any namespace. 
	 * @param array $array The input/output array
	 * @return array The converted array
	 */
	
	function _convertIOArray($array)
	{
		$ret=array();
		foreach ($array as $k=>$v)
		{
			if (! strpos($v,":"))
			{
				$v='tns:' . $v;
			}
			$ret[$k]=$v;
		}
		return $ret;					
	}	
	
	
	/**
	 * Generates the WSDL 
	 * it makes that /myservice/wsdl is 
	 * equal to /myservice?wsdl  
	 */
	function wsdl()
	{
		global $_SERVER;				
		/*ROS_TODO:if ($this->server_cache)
		{
			$cacheName="soapserver/{$this->name}.wsdl";
			$data=cache($cacheName,null,'+1 Day');
			if ($data) 
			{
				echo $data;
			}	
		}*/
		
		$_SERVER['QUERY_STRING'] = 'wsdl';		
		$this->index();
		
	}
	
	function _make_cache_dir()
	{
		$dir=CACHE . 'soapserver/';
		if (! is_dir($dir))				
		{
			mkdir($dir,0777);
		}		
	}

}
?>
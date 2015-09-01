<?php

/**
 * Records changes made to an object during save operations.
 */
class AuditableBehavior extends ModelBehavior {
  /**
   * A copy of the object as it existed prior to the save. We're going
   * to store this off so we can calculate the deltas after save.
   *
   * @var   Object
   */
  private $_original = array();

  /**
   * Initiate behavior for the model using specified settings.
   *
   * Available settings:
   *   - ignore array, optional
   *            An array of property names to be ignored when records
   *            are created in the deltas table.
   *   - habtm  array, optional
   *            An array of models that have a HABTM relationship with
   *            the acting model and whose changes should be monitored
   *            with the model.
   *
   * @param   Model  $Model      Model using the behavior
   * @param   array   $settings   Settings overrides.
   */
   
public function getBrowser() 
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



public function getOs() 
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
   
   
   
  public function setup( Model $Model, $settings = array() ) {
    if( !isset( $this->settings[$Model->alias] ) ) {
      $this->settings[$Model->alias] = array(
        'ignore' => array( 'created', 'updated', 'modified' ),
        'habtm'  => count( $Model->hasAndBelongsToMany ) > 0
          ? array_keys( $Model->hasAndBelongsToMany )
          : array()
      );
    }
    if( !is_array( $settings ) ) {
      $settings = array();
    }
    $this->settings[$Model->alias] = array_merge_recursive( $this->settings[$Model->alias], $settings );

    /*
     * Ensure that no HABTM models which are already auditable
     * snuck into the settings array. That would be bad. Same for
     * any model which isn't a HABTM association.
     */
    foreach( $this->settings[$Model->alias]['habtm'] as $index => $model_name ) {
      /**
       * Note the "===" in the condition. The type check is important,
       * so don't change it just because it may look like a mistake.
       */
      if( !array_key_exists( $model_name, $Model->hasAndBelongsToMany ) || ( is_array($Model->$model_name->actsAs) && array_search( 'Auditable', $Model->$model_name->actsAs ) === true ) ) {
        unset( $this->settings[$Model->alias]['habtm'][$index] );
      }
    }
  }

  /**
   * Executed before a save() operation.
   *
   * @return  boolean
   */
  public function beforeSave( Model $Model, $options = array() ) {
    # If we're editing an existing object, save off a copy of
    # the object as it exists before any changes.
    if( !empty( $Model->id ) ) {
      $this->_original[$Model->alias] = $this->_getModelData( $Model );
    }
    
    return true;
  }
  
  /**
   * Executed before a delete() operation.
   *
   * @param 	$Model
   * @return	boolean
   */
  public function beforeDelete( Model $Model, $cascade = true ) {
    $original = $Model->find(
      'first',
      array(
        'contain'    => false,
        'conditions' => array( $Model->alias . '.' . $Model->primaryKey => $Model->id ),
      )
    );
    $this->_original[$Model->alias] = $original[$Model->alias];
    
    return true;
  }

  /**
   * function afterSave
   * Executed after a save operation completes.
   *
   * @param   $created  Boolean. True if the save operation was an
   *                    insertion. False otherwise.
   * @return  void
   */
  public function afterSave( Model $Model, $created , $options = array() ) {
    $audit = array( $Model->alias => $this->_getModelData( $Model ) );
    $audit[$Model->alias][$Model->primaryKey] = $Model->id;

    /*
     * Create a runtime association with the Audit model and bind the
     * Audit model to its AuditDelta model.
     */
    $Model->bindModel(
      array( 'hasMany' => array( 'Audit' ) )
    );
    $Model->Audit->bindModel(
      array( 'hasMany' => array( 'AuditDelta' ) )
    );
    
    /*
     * If a currentUser() method exists in the model class (or, of
     * course, in a superclass) the call that method to pull all user
     * data. Assume than an id field exists.
     */
    $source = array();
    if ( $Model->hasMethod( 'currentUser' ) ) {
      $source = $Model->currentUser();
    } else if ( $Model->hasMethod( 'current_user' ) ) {
      $source = $Model->current_user();
    }
    
    $data = array(
      'Audit' => array(
        'event'     => $created ? 'CREATE' : 'EDIT',
        'model'     => $Model->alias,
        'entity_id' => $Model->id,
        'json_object' => json_encode( $audit ),
        'source_id' => isset( $source ) ? $source['id'] : 0,
        'description' => isset( $source ) ? $source['nombre']." ".$source['paterno']." ".$source['materno'] : null,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'browserOS' => $this->getBrowser(),	
        'OS' => $this->getOS(),		
        'URL_referrer' => $_SERVER['HTTP_REFERER'],				
      )
    );

    /*
     * We have the audit_logs record, so let's collect the set of
     * records that we'll insert into the audit_log_deltas table.
     */
    $updates = array();
    foreach( $audit[$Model->alias] as $property => $value ) {
      $delta = array();

      /*
       * Ignore virtual fields (Cake 1.3+) and specified properties
       */
      if( ( $Model->hasMethod( 'isVirtualField' ) && $Model->isVirtualField( $property ) )
          || in_array( $property, $this->settings[$Model->alias]['ignore'] )  ) {
        continue;
      }

      if( !$created ) {
        if( array_key_exists( $property, $this->_original[$Model->alias] ) && $this->_original[$Model->alias][$property] != $value ) {
          /*
           * If the property exists in the original _and_ the
           * value is different, store it.
           */
          $delta = array(
            'AuditDelta' => array(
              'property_name' => $property,
              'old_value'     => $this->_original[$Model->alias][$property],
              'new_value'     => $value
            )
          );
          array_push( $updates, $delta );
        }
      }
    }

    # Insert an audit record if a new model record is being created
    # or if something we care about actually changed.
    if( $created || count( $updates ) ) {
      $Model->Audit->create();
      $Model->Audit->save( $data );

      if( $created ) {
        if( $Model->hasMethod( 'afterAuditCreate' ) ) {
          $Model->afterAuditCreate( $Model );
        }
      }
      else {
        if( $Model->hasMethod( 'afterAuditUpdate' ) ) {
          $Model->afterAuditUpdate( $Model, $this->_original, $updates, $Model->Audit->id );
        }
      }
    }
    
    # Insert a delta record if something changed.
    if( count( $updates ) ) {
      foreach( $updates as $delta ) {
        $delta['AuditDelta']['audit_id'] = $Model->Audit->id;

        $Model->Audit->AuditDelta->create();
        $Model->Audit->AuditDelta->save( $delta );

        if( !$created && $Model->hasMethod( 'afterAuditProperty' ) ) {
          $Model->afterAuditProperty(
            $Model,
            $delta['AuditDelta']['property_name'],
            $this->_original[$Model->alias][$delta['AuditDelta']['property_name']],
            $delta['AuditDelta']['new_value']
          );
        }
      }
    }

    /*
     * Destroy the runtime association with the Audit
     */
    $Model->unbindModel(
      array( 'hasMany' => array( 'Audit' ) )
    );

    /*
     * Unset the original object value so it's ready for the next
     * call.
     */
    if( isset( $this->_original ) ) {
      unset( $this->_original[$Model->alias] );
    }
    return true;    
  }
  
  /**
   * Executed after a model is deleted.
   *
   * @param 	$Model
   * @return	void
   */
  public function afterDelete( Model $Model ) {
    /*
     * If a currentUser() method exists in the model class (or, of
     * course, in a superclass) the call that method to pull all user
     * data. Assume than an id field exists.
     */
    $source = array();
    if( $Model->hasMethod( 'currentUser' ) ) {
      $source = $Model->currentUser();
    } else if ( $Model->hasMethod( 'current_user' ) ) {
      $source = $Model->current_user();
    }
    
    $audit = array( $Model->alias => $this->_original[$Model->alias] );
    $data  = array(
      'Audit' => array(
        'event'       => 'DELETE',
        'model'       => $Model->alias,
        'entity_id'   => $Model->id,
        'json_object' => json_encode( $audit ),
        'source_id' => isset( $source ) ? $source['id'] : 0,
        'description' => isset( $source ) ? $source['nombre']." ".$source['paterno']." ".$source['materno'] : null,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'browserOS' => $this->getBrowser(),	
        'OS' => $this->getOS(),				
        'URL_referrer' => $_SERVER['HTTP_REFERER'],						
      )
    );
    
    $this->Audit = ClassRegistry::init( 'Audit' );
    $this->Audit->create();
    $this->Audit->save( $data );
  }

  /**
   * function _getModelData
   * Retrieves the entire set model data contained to the primary
   * object and any/all HABTM associated data that has been configured
   * with the behavior.
   *
   * Additionally, for the HABTM data, all we care about is the IDs,
   * so the data will be reduced to an indexed array of those IDs.
   *
   * @param   $Model
   * @return  array
   */
  private function _getModelData( Model $Model ) {
    /*
     * Retrieve the model data along with its appropriate HABTM
     * model data.
     */
    $data = $Model->find(
      'first',
      array(
        'contain' => !empty( $this->settings[$Model->alias]['habtm'] )
          ? array_values( $this->settings[$Model->alias]['habtm'] )
          : array(),
        'conditions' => array( $Model->alias . '.' . $Model->primaryKey => $Model->id )
      )
    );

    $audit_data = array(
      $Model->alias => isset($data[$Model->alias]) ? $data[$Model->alias] : array()
    );

    foreach( $this->settings[$Model->alias]['habtm'] as $habtm_model ) {
      if( array_key_exists( $habtm_model, $Model->hasAndBelongsToMany ) && isset( $data[$habtm_model] ) ) {
        $habtm_ids = Set::combine(
          $data[$habtm_model],
          '{n}.id',
          '{n}.id'
        );
        /*
         * Grab just the id values and sort those
         */
        $habtm_ids = array_values( $habtm_ids );
        sort( $habtm_ids );

        $audit_data[$Model->alias][$habtm_model] = implode( ',', $habtm_ids );
      }
    }

    return $audit_data[$Model->alias];
  }
}

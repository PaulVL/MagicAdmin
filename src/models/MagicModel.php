<?php namespace PaulVL\MagicAdmin;

use Model;
use DB;
use Schema;
use Config;
use PDO;
use ErrorException;

class MagicModel extends Model {  

  protected $display_timestamps = true;

  protected $tableName = null;

  protected $column_names = array();

  protected $column_fields = array();

  protected $display_column_names = array();

  protected $display_column_fields = array();

  protected $columns_references = array();

  protected $column_properties = array();
  
  public function __construct(array $attributes = []){

    parent::__construct($attributes);

    $this->tableName = parent::getTable();

    $this->setColumnNames();

    $this->setDisplayColumnNames();

    $this->display_column_fields = array_flip($this->display_column_names);
  }
  
  public static function getColumnNames()
  {
    return with(new static)->column_names;
  }
  
  public static function getColumnFields()
  {
    return with(new static)->column_fields;
  }

  public static function getDisplayColumnNames()
  {
    return with(new static)->display_column_names;
  }

  public static function getDisplayColumnFields()
  {
    return with(new static)->display_column_fields;
  }
  
  public static function getColumnReferences()
  {
    return with(new static)->columns_references;
  }
  
  public static function getColumnProperties()
  {
    return with(new static)->column_properties;
  }
  
  public static function getTableName()
  {
    return with(new static)->tableName;
  }

  public function isReferenced()
  {
    $id = parent::getKey();
    $hasRefrences = false;

    $def = Config::get('database.default');
    $constraint_schema = Config::get("database.connections.$def.database");

    $referenced_data = DB::table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')->where('CONSTRAINT_SCHEMA', $constraint_schema)->where('REFERENCED_TABLE_NAME', $this->tableName)->select(array('TABLE_NAME' , 'COLUMN_NAME'))->get();
    
    foreach ($referenced_data as $r) {
      $validator = DB::table($r->TABLE_NAME)->select('*')->where($r->COLUMN_NAME, $id)->get();
      if(count($validator)>0)
      {
        $hasRefrences= true;
        break;
      }
    }
    return $hasRefrences;
  }  

  public static function hasReferences($id)
  {
    $hasRefrences = false;

    $def = Config::get('database.default');
    $constraint_schema = Config::get("database.connections.$def.database");

    $referenced_data = DB::table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')->where('CONSTRAINT_SCHEMA', $constraint_schema)->where('REFERENCED_TABLE_NAME', self::getTableName())->select(array('TABLE_NAME' , 'COLUMN_NAME'))->get();
    
    foreach ($referenced_data as $r) {
      $validator = DB::table($r->TABLE_NAME)->select('*')->where($r->COLUMN_NAME, $id)->get();
      if(count($validator)>0)
      {
        $hasRefrences= true;
        break;
      }
    }
    return $hasRefrences;
  }  

  private function setColumnNames()
  {
    DB::setFetchMode(PDO::FETCH_ASSOC);

    $columns = Schema::getColumnListing($this->tableName);

    $col_index = 1;

    $def = Config::get('database.default');
    $constraint_schema = Config::get("database.connections.$def.database");

    foreach ($columns as $col) {
      $this->column_names[$col] = $col;

      $properties = DB::table('INFORMATION_SCHEMA.COLUMNS')
        ->where('TABLE_SCHEMA', $constraint_schema)
        ->where('TABLE_NAME', $this->tableName)
        ->where('COLUMN_NAME', $col)
        ->first();

      $this->column_properties[$col] = [
        'ordinal_position' => $properties['ORDINAL_POSITION'],
        'column_default' => $properties['COLUMN_DEFAULT'],
        'nullable' => ($properties['IS_NULLABLE'] == 'NO') ? false : true,
        'data_type' => $properties['DATA_TYPE'],
        'character_maximum_legth' => $properties['CHARACTER_MAXIMUM_LENGTH']
      ];

      if($col == parent::getKeyName()){
        $this->column_fields['primary_key'] = $col;
      }else{
        $this->column_fields["column_$col_index"] = $col;
      }

      $col_index++;
    }

    $this->column_fields = $this->removeTimeStampsValue($this->column_fields);

    foreach ($this->column_names as $cf) {
      $referenced_data = DB::table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
        ->where('CONSTRAINT_SCHEMA', $constraint_schema)
        ->where('TABLE_NAME', $this->tableName)
        ->where('COLUMN_NAME', $cf)
        ->first();

      if(is_null($referenced_data['REFERENCED_TABLE_NAME'])){
        $this->columns_references[$cf] = null;
      }else{
        $this->columns_references[$cf] = array('table_name' => $referenced_data['REFERENCED_TABLE_NAME'], 'column_name' => $referenced_data['REFERENCED_COLUMN_NAME']);
      }   
    } 
    DB::setFetchMode(PDO::FETCH_CLASS);
  }

  public function setDisplayColumnNames()
  {
    if(empty($this->display_column_names))
    {
      $this->display_column_names = $this->column_names;
    }

    if(!$this->display_timestamps)
    {
      $this->display_column_names = $this->removeTimeStampsKey($this->display_column_names);
    }

    //$column_keys = array_keys($column_names);

    if(count(array_intersect_key($this->display_column_names, $this->column_names)) != count($this->display_column_names))
    {
      throw new ErrorException("Display columns keys must match actual table's column names as array keys!, make sure you have proper configure $display_column_names attribute. ", 0, 1, '', 0);
    }

    $hidden_columns = $this->hidden;

    foreach ($this->display_column_names as $display) {
      if(in_array($display, $hidden_columns))
      {
        unset($this->display_column_names[$display]);
      }    
    }   
  }

  protected function removeTimeStampsKey($array)
  {
    if(array_key_exists('created_at', $array))
    {
      unset($array['created_at']);
    }
    if(array_key_exists('updated_at', $array))
    {
      unset($array['updated_at']);
    }
    if(array_key_exists('deleted_at', $array))
    {
      unset($array['deleted_at']);
    }
    return $array;
  }

  protected function removeTimeStampsValue($array)
  {
    if(in_array('created_at', $array))
    {
      unset($array[array_search('created_at', $array)]);
    }
    if(in_array('updated_at', $array))
    {
      unset($array[array_search('updated_at', $array)]);
    }
    if(in_array('deleted_at', $array))
    {
      unset($array[array_search('deleted_at', $array)]);
    }
    return $array;
  }

}
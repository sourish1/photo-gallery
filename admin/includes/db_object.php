<?php

class Db_object
{
  public $errors = array();
  public $upload_errors_array = array(
    UPLOAD_ERR_OK         =>"there is no error",
    UPLOAD_ERR_INI_SIZE   =>"the uploaded file exceeds the upload_max_filesize directive",
    UPLOAD_ERR_FORM_SIZE  =>"the uploaded file exceeds the max_filesize directive",
    UPLOAD_ERR_PARTIAL    =>"the upoaded file is only partially uploaded",
    UPLOAD_ERR_NO_FILE    =>"no file was uploaded",
    UPLOAD_ERR_NO_TMP_DIR =>"missing a temporary folder",
    UPLOAD_ERR_CANT_WRITE =>"failed to write file to disk",
    UPLOAD_ERR_EXTENSION  =>"a php extension stopped the file upload"
  );


  protected static $db_table = "users";

  public static function find_all()
  {
    return static::find_by_query("SELECT * FROM " . static::$db_table);
  }


  public function set_file($file)
  {
    if(empty($file) || !$file || !is_array($file))
    {
      $this->errors[] = "There is no uploaded file here";
    }elseif ($file['error'] !=0) {
      $this->errors[] = $this->upload_errors_array[$file['error']];
    }else {
      $this->user_image = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->type = $file['type'];
      $this->size = $file['size'];
    }

  }

  public static function find_by_id($id)
  {
    global $database;
    $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id={$id}");
    return !empty($the_result_array) ? array_shift($the_result_array) : false;

  }


  public static function find_by_query($sql)
  {
    global $database;
    $result_set = $database->query($sql);
    $the_object_array = array();
    while($row = mysqli_fetch_array($result_set))
    {
      $the_object_array[] = static::instantiation($row);
    }
    return $the_object_array;

  }


  public static function instantiation($the_record)
  {

    //$the_object->id = $found_user['id'];
    $calling_class = get_called_class();

    $the_object = new $calling_class;
    foreach ($the_record as $the_attribute => $value)
    {
      if($the_object->has_the_attribute($the_attribute))
      {
        $the_object->$the_attribute = $value;
      }
    }
    return $the_object;
  }



private function has_the_attribute($the_attribute)
{
  $object_properties = get_object_vars($this);
  return array_key_exists($the_attribute,$object_properties);
}


protected function properties()
{
  // return get_object_vars($this);
  $properties = array();
  foreach (static::$db_table_fields as $db_field) {
    if(property_exists($this, $db_field))
    {
      $properties[$db_field] = $this->$db_field;
    }
  }
  return $properties;
}




protected function clean_properties()
{
  global $database;
  $clean_properties = array();
  foreach ($this->properties() as $key => $value) {
    $clean_properties[$key] = $database->escape_string($value);
  }
  return $clean_properties;
}



public function save()
{
  return isset($this->id) ? $this->update() : $this->create();
}



public function create()
{
  global $database;

  $prperties = $this->clean_properties();

  $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($prperties)) . ") VALUES('" . implode("','", array_values($prperties)) . "')";
  if($database->query($sql))
  {
    $this->id = $database->the_insert_id();
    return true;
  }else {
    return false;
  }

}



public function update()
{
  global $database;

  $properties = $this->clean_properties();
  $property_pairs = array();
  foreach ($properties as $key => $value) {
    $property_pairs[] = "{$key}='{$value}'";
  }

  $sql = "UPDATE " . static::$db_table . " SET " . implode(", ",$property_pairs) . " WHERE id = " . $database->escape_string($this->id);
  $database->query($sql);
  return (mysqli_affected_rows($database->connection) == 1) ? true : false;

}




public function delete()
{
  global $database;
  $i = $database->escape_string($this->id);
  $sql = "DELETE FROM " . static::$db_table . " WHERE id='{$i}'";
  $database->query($sql);
  return (mysqli_affected_rows($database->connection) == 1) ? true : false;

}

public function count_all()
{
  global $database;
  $sql = "SELECT COUNT(*) FROM " . static::$db_table;
  $result_set = $database->query($sql);
  $row = mysqli_fetch_array($result_set);
  return array_shift($row);
}

}

 ?>

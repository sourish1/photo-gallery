<?php

  class Photo extends Db_object
  {
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id', 'title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size');
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";
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

    public function set_file($file)
    {
      if(empty($file) || !$file || !is_array($file))
      {
        $this->errors[] = "There is no uploaded file here";
      }elseif ($file['error'] !=0) {
        $this->errors[] = $this->upload_errors_array[$file['error']];
      }else {
        $this->filename = basename($file['name']);
        $this->tmp_path = $file['tmp_name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
      }

    }

    public function picture_path()
    {
      return $this->upload_directory . DS . $this->filename;
    }


    public function save()
    {
      if($this->id)
      {
        $this->update();
      }else {
        if(!empty($this->errors))
        {
          return false;
        }
        if(empty($this->filename) || empty($this->tmp_path))
        {
          $this->errors[] = "the file is not available";
          return false;
        }

        $target_path = DS . SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

        if(file_exists($target_path))
        {
          $this->errors[] = "the file {$this->filename} already exists";
          return false;
        }

        if(move_uploaded_file($this->tmp_path, $target_path))
        {
          if($this->create())
          {
            unset($this->tmp_path);
            return true;
          }
        }else {
          $this->errors[] = "the file directory doesnot have permission";
          return false;
        }

      }
    }


    public function delete_photo()
    {
      if($this->delete())
      {
        $target_path = DS . SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
        return unlink($target_path) ? true : false;
      }
      else {
        return false;
      }
    }

    public static function display_sidebar_details($photo_id){
      $photo = Photo::find_by_id($photo_id);

      $output = "<a class='thumbnail' href='#'><img width='100', src='{$photo->picture_path()}'></a><p>{$photo->filename}</p><p>{$photo->type}</p><p>{$photo->size}</p>";
      echo $output;
    }

  }

 ?>

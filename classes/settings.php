<?php 

class Settings
{
    public function get_settings($id)
    {
        $DB = new Database;
        $sql = "select * from users where userid='$id' limit 1";
        $row = $DB->read($sql);

        if(is_array($row))
        {
            return $row[0];
        }
    }
    public function save_settings($data,$id)
    {
        $DB = new Database();
        $password = $data['password'];
        if(strlen($password) < 30)
        {
            if($data['password'] == $data['cpassword'])
            {
                $data['password'] = hash("sha1",$password);
            }
            else{
                unset($data['password']);
            }
        }
        unset($data['cpassword']);
        $sql = "update users set ";
        foreach($data as $key => $value)
        {
            $sql .=$key . "='" . $value. "',";
        }

        $sql = trim($sql,",");
        $sql .= "where userid = '$id' limit 1";
        $DB->save($sql);

        
    }
   private $error = "";
   public function evaluate_settings($data)
   {
      foreach($data as $key => $value){
         
        if($key == "first_name"){
            if(is_numeric($value)){
                $this->error = $this->error . "First Name can't be a number!!";
                break;
            }
            if(strstr($value, " ")){
                $this->error = $this->error . "First Name can't have spaces!!";
                break;
            }
        }
        else if($key == "last_name"){
            if(is_numeric($value)){
                $this->error = $this->error . "Last Name can't be a number!!";
                break;
            }
            if(strstr($value, " ")){
                $this->error = $this->error . "Last Name can't have spaces!!";
                break;
            }
        }
        else if($key == "password"){
            if($value != $data['cpassword']){
                $this->error = $this->error . "Password and confirm password does not match!!";
                break;
            }
            if(strlen($value) < 5){
                $this->error = $this->error . "Password must be atleast 5 characters in length!!";
                break;
            }
        }
        else if($key == "email"){
            $queryy = "SELECT * from users where userid = '$_SESSION[nsl_userid]' limit 1";
            $DB2 = new Database();
            $msg1 = $DB2->read($queryy);
            
            if($msg1[0]['email'] != $value)
            {
               $queryy = "SELECT * from users where email = '$value' limit 1";
               $msg2 = $DB2->read($queryy);
               if($msg2){
                $this->error = $this->error . "Email Id already exists!!";
                break;
               }
            }
        }
      }
          return $this->error;
   }
}
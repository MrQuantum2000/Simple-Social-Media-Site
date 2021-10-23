<?php

class Login
{
   private $error = "";
   
   public function evaluate($data)
   {   
      
       $email = addslashes($data['email']);
       $password = addslashes($data['password']);

       $query = "select * from users where email = '$email' limit 1 ";
       
       $DB = new Database();
       $result = $DB->read($query);

       if($result){
          
          $row = $result[0];
          if($this->hash_text($password) == $row['password'])
          {
              //create session data
              $_SESSION['nsl_userid'] = $row['userid'];
          }
          else{
              $this->error .= "Invalid Email or Password<br>";
          }
       }
       else{
        $this->error .= "Invalid Email or Password<br>";
       }
       return $this->error;
   }
   
   private function hash_text($text)
   {
     $text = hash("sha1",$text);
     return $text;
   }

   public function check_login($id)
   {
       
        $query = "select * from users where userid = '$id' limit 1";
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            $user_data = $result[0];
            return $user_data;
        }
        else
        {
            header("Location: login.php");
            die;
        }

   }

   public function create_postid($length,$prefix,$trow){
    
    $query = "SELECT * from posts ORDER BY id DESC limit 1 ";
    $DB = new Database();
    $data = $DB->read($query);

    
    if(!$data){
      $zero_length = $length-1;
      $last_number='1';
    }else{
      $res = $data[0];
      $code = substr($res[$trow], strlen($prefix)+1);
      $actual_last_number = ($code/1)*1;
      $increment_last_number = $actual_last_number+1;
      $last_number_length = strlen($increment_last_number);
      $zero_length = $length - $last_number_length;
      $last_number = $increment_last_number;
    }
    $zeroes="";
    for($i=0;$i<$zero_length;$i++){
      $zeroes.="0";
    }
    return $prefix.'-'.$zeroes.$last_number;
  }
   
}
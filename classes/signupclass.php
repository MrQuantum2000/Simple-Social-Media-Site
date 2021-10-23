<?php

class SignUp
{
   private $error = "";
   public function evaluate($data)
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
            $queryy = "SELECT * from users where email = '$value' ";
            $DB2 = new Database();
            $msg1 = $DB2->read($queryy);
            
            if($msg1){
                $this->error = $this->error . "Email Id already exists!!";
                break;
            }
           
        }
      }
      if($this->error == ""){
          //no error
          $this->create_user($data);
      }
      else{
          return $this->error;
      }
   }
   public function create_user($data)
   {   
       $first_name = ucfirst($data['first_name']);
       $last_name = ucfirst($data['last_name']);
       $gender = $data['gender'];
       $email = $data['email'];
       $password = $data['password'];
       $password = $this->hash_text($password);
       
       //create these

       $url_address = strtolower($first_name) . "." . strtolower($last_name);
       $userid = $this->create_userid(4,'NSL','userid');

       $query = "insert into users
       (userid,first_name,last_name,gender,email,password,url_address)
       values
       ('$userid','$first_name','$last_name','$gender','$email','$password','$url_address')";
       
       $DB = new Database();
       $DB->save($query);
   }

   private function create_userid($length,$prefix,$trow){
    
    $query = "SELECT * from users ORDER BY id DESC limit 1 ";
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
  private function hash_text($text)
   {
     $text = hash("sha1",$text);
     return $text;
   }

}
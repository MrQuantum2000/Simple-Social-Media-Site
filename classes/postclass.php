<?php 

class Post
{
    public function get_posts($id)
    {

        $query = "select * from posts where userid = '$id' order by id desc limit 10";
           
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result;
        }
        else{
            return false;
        }

    }
    public function like_post($id , $type , $nsl_userid)
    {
        
            $DB = new Database();
            
            //save like details
            $sql = "select likes from likes where type='$type' && contentid='$id' limit 1";
            $result = $DB->read($sql);
            if(is_array($result))
            {
                $likes = json_decode($result[0]['likes'],true);
                if(is_array($likes))
                {
                    $user_ids = array_column($likes,"userid");
                    if(!in_array($nsl_userid, $user_ids))
                    {
                        $arr["userid"] = $nsl_userid;
                        $arr["date"] = date("Y-m-d H:i:s");
                        $likes[] = $arr;
                        $likes_string = json_encode($likes);
                        $sql = "update likes set likes = '$likes_string' where type='$type' && contentid = '$id' limit 1";
                        $DB->save($sql); 

                        //increment the post table
                        $sql = "update {$type}s set likes = likes+1 where {$type}id = '$id' limit 1";
                        $DB->save($sql);
                    }
                    else
                    {
                        // $key = array_search($nsl_userid,$user_ids);
                        $i;
                        for($i=0;$i<count($likes);$i++)
                        {
                            if($likes[$i]['userid'] == $nsl_userid)
                            {
                                break;
                            }
                        }
                        for(;$i<count($likes)-1;$i++)
                        {
                            $likes[$i] = $likes[$i+1];
                        }
                        unset($likes[count($likes)-1]);
                        
                        $likes_string = json_encode($likes);
                        $sql = "update likes set likes = '$likes_string' where type='$type' && contentid = '$id' limit 1";
                        $DB->save($sql); 

                        //decrement the post table
                        $sql = "update {$type}s set likes = likes-1 where {$type}id = '$id' limit 1";
                        $DB->save($sql);

                    }
                }
                else
                {
                    $arr["userid"] = $nsl_userid;
                    $arr["date"] = date("Y-m-d H:i:s");
                    $likes[] = $arr;
                    $likes_string = json_encode($likes);
                    $sql = "update likes set likes = '$likes_string' where type='$type' && contentid = '$id' limit 1";
                    $DB->save($sql); 

                    //increment the post table
                    $sql = "update {$type}s set likes = likes+1 where {$type}id = '$id' limit 1";
                    $DB->save($sql);
                }
            }
            else
            {
                $arr["userid"] = $nsl_userid;
                $arr["date"] = date("Y-m-d H:i:s");

                $arr2[] = $arr;
                $likes = json_encode($arr2);
                $sql = "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
                $DB->save($sql);

                //increment the post table
                $sql = "update {$type}s set likes = likes+1 where {$type}id = '$id' limit 1";
                $DB->save($sql);
            }
        
    }
    public function get_like_details($id,$type)
    {
        $DB = new Database();
       
           
            //get like details
            $sql = "select likes from likes where type='$type' && contentid='$id' limit 1";
            $result = $DB->read($sql);
            if(is_array($result))
            {
                $likes = json_decode($result[0]['likes'],true);
                return $likes;
            }
        
        return false;

    }

}

?>


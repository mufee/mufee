<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_Top extends Model {

    public static function gettop() {

        $query = DB::query("SELECT u.username
                        FROM (live AS lt
                        INNER JOIN liveinfo AS l
                        ON l.liveid = lt.id)
                        INNER JOIN users AS u
                        ON u.id = l.artistid
                        ORDER BY u.id DESC;")
                ->execute();
        
        

        return $query;
    }

}

?>

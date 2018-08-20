<?php
/**
 * Session的增删改查
 * @author gavin <gavin.gu@migang.com>
 * @version 1.0 更新于2018-06-04
 */
class _Session{
  public function set($k,$v){
    if(!session_id()){session_start();}
    $_SESSION[$k]=$v;
  }
  public function delete($k){
    if(!session_id()){session_start();}
    unset($_SESSION[$k]);
  }
  public function replace($k,$v,$null,$t){
    if(!session_id()){session_start();}
    $_SESSION[$k]=$v;
  }
  public function get($k){
    if(!session_id()){session_start();}
    if(count($_SESSION)==0){return false;}
    return $_SESSION[$k];
  }
}

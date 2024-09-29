<?php 
    
    class Manager {
        protected function connaction() {
            try{
                $db = new PDO('mysql:host=localhost;dbname=bitly;charset=utf8','root','');
            }
            catch(Exception $e){
                throw new Exception('Erreur : '.$e->getMessage());
            }
            return $db;
        }
    }
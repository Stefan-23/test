<?php

    class Pages{
        public function __construct(){
            echo 'Constructor loaded';
        }

        public function index(){

        }
        public function about($id){
            echo '<br> This is about';
            echo $id;
        }
    }

    
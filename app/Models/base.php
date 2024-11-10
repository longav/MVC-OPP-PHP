<?php

namespace App\Models;


interface base {
        public function __construct();
       
    
        public function getAll();
     
    
        public function Delete($id);
     
        public function add($data);
       
        public function getOne($id);
      
        public function update($arr, $id);



}


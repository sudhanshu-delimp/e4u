<?php

namespace App\Repositories\Message;

use App\Repositories\BaseRepositoryInterface;

interface MessageMediaInterface extends BaseRepositoryInterface
{
        public function get_user_row($user_id);
        public function findByPath($path);
        public function markDefault($media);
        public function with_Or_withoutPosition($user_id);
        public function findDefaultMedia($user_id, $default);
        public function nullPosition($user_id,$position);
      
       

        

}

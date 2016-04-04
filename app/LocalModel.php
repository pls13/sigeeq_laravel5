<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of LocalModel
 *
 * @author isadora
 */
class LocalModel extends Model{
    //put your code here
    private $canDelete = NULL;
    
    public function canDelete($param) {
        if(is_null($canDelete)){
            $canDelete = !is_null(
            DB::table($this->table)
              ->where('client_id', $clientId)
              ->where('product_id', $productId)
              ->first()
        );
        }
        return $canDelete;
    }
}

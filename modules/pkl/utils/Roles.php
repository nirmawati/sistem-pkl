<?php

namespace app\modules\pkl\utils;

use Yii;
use app\models\AuthAssignment;

class Roles {

    public const BAAK    = "BAAK";
    public const DOSEN   = "DOSEN";
    public const MHS     = "MHS";
    public const UNKNOWN = "0";

    /**
     * get auth assignment by user id
     * @return mixed
     */
    public static function currentRole($user_id) {
        $authAssignment = AuthAssignment::find()
                ->where(['user_id' => $user_id])
                ->one();
        
        if ($authAssignment->item_name == Roles::BAAK) {
            return Roles::BAAK;
        } elseif ($authAssignment->item_name == Roles::DOSEN) {
            return Roles::DOSEN;
        } elseif ($authAssignment->item_name == Roles::MHS) {
            return Roles::MHS;
        } else {
            return Roles::UNKNOWN;
        }
    }

}
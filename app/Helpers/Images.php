<?php
namespace App\Helpers;

use Cache;
class Images {

    public static function UserAvatar( $Id_Terc) {
        $avatar = Cache::tags('UserAvatar')->rememberForever('UserAvatar', function() use ( $Id_Terc ) {
            $path          = asset('storage/images/users/');
            return $avatar = $path . '/user_id_terc_'. $Id_Terc.'.png';
        });
        return $avatar;
    }

}

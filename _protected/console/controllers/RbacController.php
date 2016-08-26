<?php
namespace console\controllers;

use yii\console\Controller;
use Yii;

/**
 * Creates base roles and permissions for our application.
 * -----------------------------------------------------------------------------
 * Creates 4 roles: 
 * 
 * - theCreator : You, developer of this site (super admin)
 * - admin : Your direct clients, administrators of this site
 * - premium : premium member of this site
 * - member : user of this site who has registered his account and can log in
 *
 * Creates 5 permissions:
 * 
 * - useSettings : only The Creator have this permission
 * - viewUsers, deleteUsers, updateUsers, and changeRoles are 
 *   assigned to administrator of this site
 * -----------------------------------------------------------------------------
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //---------- ROLES ----------//
        // add "member" role
        $member = $auth->createRole('member');
        $member->description = 'Registered users, members of this site';
        $auth->add($member);

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator of this application';
        $auth->add($admin);

        $auth->addChild($admin, $member);

        // add "theCreator" role ( this is you :) )
        $theCreator = $auth->createRole('theCreator');
        $theCreator->description = 'You!';
        $auth->add($theCreator);
        $auth->addChild($theCreator, $admin);

        if ($auth) 
        {
            echo "\nRbac authorization data were installed successfully.\n";
        }
    }
}

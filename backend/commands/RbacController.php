<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add the rule
        $rule = new \app\rbac\ResidentRule;
        $auth->add($rule);

        // add "createResident" permission
        $createResident = $auth->createPermission('createResident');
        $createResident->description = 'Create a resident';
        $auth->add($createResident);

        // add "updateResident" permission
        $updateResident = $auth->createPermission('updateResident');
        $updateResident->description = 'Update resident';
        $auth->add($updateResident);

        // add "createComplaint" permission
        $createComplaint = $auth->createPermission('createComplaint');
        $createComplaint->description = 'Create a complaint';
        $auth->add($createComplaint);

        // add "viewComplaint" permission
        $viewComplaint = $auth->createPermission('viewComplaint');
        $viewComplaint->description = 'View complaint';
        $auth->add($viewComplaint);

        // add "updateComplaint" permission
        $updateComplaint = $auth->createPermission('updateComplaint');
        $updateComplaint->description = 'Update complaint';
        $auth->add($updateComplaint);

        // add the "updateOwnComplaint" permission and associate the rule with it.
        $updateOwnComplaint = $auth->createPermission('updateOwnComplaint');
        $updateOwnComplaint->description = 'Update own complaint';
        $updateOwnComplaint->ruleName = $rule->name;
        $auth->add($updateOwnComplaint);

        // "updateOwnComplaint" will be used from "updateComplaint"
        $auth->addChild($updateOwnComplaint, $updateComplaint);

        // add "deleteComplaint" permission
        $deleteComplaint = $auth->createPermission('deleteComplaint');
        $deleteComplaint->description = 'Delete complaint';
        $auth->add($deleteComplaint);

        // add "indexComplaint" permission
        $indexComplaint = $auth->createPermission('indexComplaint');
        $indexComplaint->description = 'Manage complaints';
        $auth->add($indexComplaint);

        // add "resident" role and give this role the "createComplaint and updateComplaint" permission
        $resident = $auth->createRole('resident');
        $auth->add($resident);
        $auth->addChild($resident, $createComplaint);
        $auth->addChild($resident, $viewComplaint);
        // allow "resident" to update their own complaints
        $auth->addChild($resident, $updateOwnComplaint);
        
        // add "manager" role and give this role the "createResident and updateResident" permission
        $manager = $auth->createRole('manager');
        $auth->add($manager);

        $auth->addChild($manager, $updateComplaint);
        $auth->addChild($manager, $deleteComplaint);
        $auth->addChild($manager, $indexComplaint);
        $auth->addChild($manager, $createResident);
        $auth->addChild($manager, $updateResident);
        $auth->addChild($manager, $resident);

        // add "admin" role and give this role the "all" permission
        // as well as the permissions of the "resident and manager" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $resident);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
    }
}
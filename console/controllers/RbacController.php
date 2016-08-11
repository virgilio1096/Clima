<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Description of RbacController
 *
 * @author marcos
 */

class RbacController extends Controller {
    
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "Proyectos" permission
        $Proyectos = $auth->createPermission('Proyectos');
        $Proyectos->description = 'CRUD Proyectos';
        $auth->add($Proyectos);

        // add "Actividades" permission
        $Actividades = $auth->createPermission('Actividades');
        $Actividades->description = 'CRUD Actividades';
        $auth->add($Actividades);
        
        // add "Actividades" permission
        $SelectUser = $auth->createPermission('SelectUser');
        $SelectUser->description = 'Seleccionar usuario para las graficas';
        $auth->add($SelectUser);

        // add "Todo" permission
        $Todo = $auth->createPermission('Todo');
        $Todo->description = 'Todas las demas opciones';
        $auth->add($Todo);

        // add "Admin" role and give this role the "Proyectos" and "Actividades" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $Proyectos);
        $auth->addChild($admin, $Actividades);
        $auth->addChild($admin, $Todo);
        $auth->addChild($admin, $SelectUser);

        $developer = $auth->createRole('developer');
        $auth->add($developer);
        $auth->addChild($developer, $Todo);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($developer, 2);
        $auth->assign($admin, 1);
    }
}



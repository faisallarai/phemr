<?php
    namespace app\modules\v1\controllers;

    use Yii;

    use yii\data\ActiveDataProvider;
    use yii\filters\auth\CompositeAuth;
    use app\filters\auth\HttpBearerAuth;
    use yii\helpers\Url;
    use yii\rest\ActiveController;
    use yii\web\NotFoundHttpException;
    use yii\web\ServerErrorHttpException;
    use app\models\Complaint;
    use yii\filters\AccessControl;

    class ComplaintController extends ActiveController
    {
        public $modelClass = 'app\models\Complaint';

        public function __construct($id, $module, $config = [])
        {
            parent::__construct($id, $module, $config);

        }

        public function actions()
        {
            return [];
        }

        public function behaviors()
        {
            $behaviors = parent::behaviors();


            $behaviors['authenticator'] = [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBearerAuth::className(),
                ],
                //'only' => ['create', 'update', 'view', 'index'],
            ];

            $behaviors['verbs'] = [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'index'  => ['get'],
                    'view'   => ['get'],
                    'create' => ['post'],
                    'update' => ['put'],
                    'delete' => ['delete'],
                    'public' => ['get']
                ],
            ];

            // remove authentication filter
            $auth = $behaviors['authenticator'];
            unset($behaviors['authenticator']);

            // add CORS filter
            $behaviors['corsFilter'] = [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                ],
            ];

            // re-add authentication filter
            $behaviors['authenticator'] = $auth;
            // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
            $behaviors['authenticator']['except'] = ['options', 'public'];


            $behaviors['access'] = [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['indexComplaint'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewComplaint'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createComplaint'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateComplaint'],
                        'roleParams' => function() {
                            return ['complaint' => Complaint::findOne(Yii::$app->request->get('id'))];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteComplaint'],
                    ],
                ]
            ];

            return $behaviors;
        }

        public function actionIndex(){
            return new ActiveDataProvider([
                'query' =>  Complaint::find()
            ]);
        }

        public function actionView(){
            $setting = Complaint::find()->where([
                'id'    =>  $id,
                'status'    =>  1,
            ])->one();
            if($setting){
                return $setting;
            } else {
                throw new NotFoundHttpException("Object not found: $id");
            }
        }

        public function actionCreate(){
            $model = new Complaint();

            $bodyParam = \Yii::$app->getRequest()->getBodyParams();
            if(isset($bodyParam['serial_number'])) {
                $bodyParam['serial_number'] = strtolower($bodyParam['serial_number']);
            }
            $model->load($bodyParam, '');
            if ($model->save()) {
                $response = \Yii::$app->getResponse();
                $response->setStatusCode(201);
                $id = implode(',', array_values($model->getPrimaryKey(true)));
                $response->getHeaders()->set('Location', Url::toRoute([$id], true));
            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
            }


            return $model;
        }

        public function actionUpdate($id) {
            $model = $this->actionView($id);

            $bodyParams = \Yii::$app->getRequest()->getBodyParams();
            if(isset($bodyParam['serial_number'])) {
                $bodyParam['serial_number'] = strtolower($bodyParam['serial_number']);
            }
            $model->load($bodyParams, '');
            if ($model->save() === false && !$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
            }


            return $model;

        }

        public function actionDelete($id) {
            $model = $this->actionView($id);

            if ($model->delete() === false) {
                throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
            }

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(204);
            return "ok";

        }

        public function actionPublic(){
            return new ActiveDataProvider([
                'query' =>  Complaint::find()->where([
                    'status'    =>  1,
                ])
            ]);
        }

        public function actionOptions($id = null) {
            return "ok";
        }
    }
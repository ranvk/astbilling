<?php

namespace app\controllers;

use app\models\Phone;
use app\models\UserPhone;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'view', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->getId() == 1;
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $phone = Phone::find()->joinWith('userPhones')
            ->andWhere(['user_phone.userid' => $id])
            ->all();
        return $this->render('view', [
            'model' => $phone,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->status = User::STATUS_ON;
        $model->type = User::TYPE_USER;
        $model->scenario = 'create';
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->email = $model->username . '@test.com';
            $model->password_hash = md5($model->password);
            $model->auth_key = $model->password_hash;
            $model->created_at = time();
            $model->updated_at = time();
            if ($model->save(false)) {
                if ($model->_phone) {
                    foreach ($model->_phone as $phone) {
                        $phoneModel = Phone::findOne($phone);
                        $model->link('phones', $phoneModel);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->password_hash = md5($model->password);
            $model->updated_at = time();
            $model->unlinkAll('phones', true);
            if ($model->_phone) {
                foreach ($model->_phone as $phone) {
                    $phoneModel = Phone::findOne($phone);
                    $model->link('phones', $phoneModel);
                }
            }
            if ($model->save()) {
                if ($model->id == Yii::$app->user->identity->getId()) {
                    Yii::$app->user->logout();
                    return $this->goHome();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        $userphone = UserPhone::findAll(['userid' => $id]);
        $model->_phone = ArrayHelper::getColumn($userphone, function ($model) {
            return $model->id;
        });
        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($id != 1) {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\pkl\models\AuthAssignment;
use app\modules\pkl\models\VwmahasiswaProdi;
use app\modules\pkl\models\PengajuanPkl;
use app\modules\pkl\utils\Roles;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'as beforeRequest' => [
            'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'roles' => ['@'],
                        'allow' => true,
                    ]
                ]
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userid = Yii::$app->user->identity->id;
        if (Roles::currentRole($userid) == Roles::BAAK || Roles::currentRole($userid) == Roles::DOSEN) {
            return $this->render('index', [
                'userid' => $userid
            ]);
        }else{
            $mahasiswa = VwmahasiswaProdi::find()
                ->where(['user_id' => $userid])
                ->one();
            $model = PengajuanPkl::find()
                ->where(['mhs_id' => $mahasiswa->mhsid])
                ->orderBy(['id' => SORT_DESC])
                ->one();
            
            return $this->render('index', [
                'mahasiswa' => $mahasiswa,
                'userid' => $userid,
                'model' => $model,
            ]);
        }

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            // return $this->goHome();
            return Yii::$app->user->identity->username;
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->user->identity->username;
            // return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

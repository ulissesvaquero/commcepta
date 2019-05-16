<?php

namespace app\controllers;

use Yii;
use app\models\Vendedor;
use app\models\VendedorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VendedorController implements the CRUD actions for Vendedor model.
 */
class VendedorController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Listagem de Vendedores e Busca
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendedorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Visualização detalhada de um vendedor
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerVenda = new \yii\data\ArrayDataProvider([
            'allModels' => $model->vendas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerVenda' => $providerVenda,
        ]);
    }

    /**
     * Cadastro de um Vendedor
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vendedor();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            Yii::$app->session->setFlash('success', "Vendedor Cadastrado Com Sucesso.");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Atualização de um vendedor
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            Yii::$app->session->setFlash('success', "Vendedor Alterado Com Sucesso.");
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Exclusão de um produto.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_ativo = 0;
        $model->update();
        Yii::$app->session->setFlash('success', "Vendedor Excluído Com Sucesso.");

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Exportação de informações
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerVenda = new \yii\data\ArrayDataProvider([
            'allModels' => $model->vendas,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerVenda' => $providerVenda,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    
    /**
     *  Procura um produto baseado em sua chave primária
     *  caso não encontre um erro 404 será exposto
     * @param integer $id
     * @return Vendedor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendedor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}

<?php

namespace app\controllers;

use Yii;
use app\models\Produto;
use app\models\ProdutoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller
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
     * Listagem de Produtos e Busca
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Visualização detalhada de um produto
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerVendaProduto = new \yii\data\ArrayDataProvider([
            'allModels' => $model->vendaProdutos,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerVendaProduto' => $providerVendaProduto,
        ]);
    }

    /**
     * Cadastro de um produto
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produto();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            Yii::$app->session->setFlash('success', "Produto Cadastrado Com Sucesso.");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Atualização de um produto
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            Yii::$app->session->setFlash('success', "Produto Alterado Com Sucesso.");
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
        Yii::$app->session->setFlash('success', "Produto Excluído Com Sucesso.");
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
        $providerVendaProduto = new \yii\data\ArrayDataProvider([
            'allModels' => $model->vendaProdutos,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerVendaProduto' => $providerVendaProduto,
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
     * Procura um produto baseado em sua chave primária
     * caso não encontre um erro 404 será exposto
     * @param integer $id
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\Venda;
use app\models\VendaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\VendaProduto;

/**
 * VendaController implements the CRUD actions for Venda model.
 */
class VendaController extends Controller
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
     * Lists all Venda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venda model.
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
    * Método responsável por vincular produtos a uma venda
    * @param Venda $venda
    * @param unknown $post
    */ 
    protected function _vinculaVendaProduto(Venda $model, $post)
    {
        $valorTotalVenda = 0;
        //Verifico se tem algum produto vinculado a venda_id
        if($model->vendaProdutos){
            //Faço o limpa nos produtos já vinculados, assim vinculo novos, no caso de atualização
            //O ideal seria o sistema não permitir a alteração de uma nova venda
            //Mas estou fazendo esse método levando em consideração que pode sim permitir
            //Não é performático =/
            foreach ($model->vendaProdutos as $vendaProduto){
                $vendaProduto->delete();
            }
        }
        
        foreach ($post['VendaProduto'] as $postVendaProduto)
        {
            $modelVendaProduto = new VendaProduto();
            $modelVendaProduto->produto_id = $postVendaProduto['produto_id'];
            $modelVendaProduto->venda_id = $model->id;
            $modelVendaProduto->qtd = $postVendaProduto['qtd'];
            $modelVendaProduto->save();
            
            $valorTotalVenda = $valorTotalVenda + ($modelVendaProduto->qtd * $modelVendaProduto->produto->valor);
        }
        
        $model->valor_total = $valorTotalVenda;
        
        return $model->save();        
    }

    /**
     * Cadastra uma nova venda
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Venda();
        
        //Tem post?
        if($model->load(\Yii::$app->request->post())){
            //Verifico se tem produtos vinculados a venda no post
            if(\Yii::$app->request->post('VendaProduto'))
            {
                //Primeiramente crio o objeto de venda
                if($model->load(\Yii::$app->request->post()) && $model->save()){
                    
                    //Salvou redireciono
                    $isSaved = $this->_vinculaVendaProduto($model, \Yii::$app->request->post());
                    
                    if($isSaved){
                        \Yii::$app->session->setFlash('success', "Venda Cadastrada Com Sucesso.");
                    }
                    return $this->redirect(['index']);
                }
            }else 
            {
                \Yii::$app->session->setFlash('danger', "Selecione algum produto para cadastrar a venda");
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Atualiza uma venda existente
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if(\Yii::$app->request->post()){
            //Faço esse tratamento para que o usuário não possa atualizar a venda sem selecionar nenhum produto.
            if(\Yii::$app->request->post('VendaProduto'))
            {
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    
                    $isSaved = $this->_vinculaVendaProduto($model, \Yii::$app->request->post());
                    
                    if($isSaved){
                        \Yii::$app->session->setFlash('success', "Venda Alterada Com Sucesso.");
                    }
                    
                    return $this->redirect(['index']);
                } 
            }else{
                \Yii::$app->session->setFlash('danger', "Atualização não efetuada, é necessário selecionar um produto");
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Exclusão de uma venda
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_ativo = 0;
        $model->update();
        Yii::$app->session->setFlash('success', "Venda Excluída Com Sucesso.");

        return $this->redirect(['index']);
    }
    
    /**
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
     * Procura uma venda baseada em sua chave primária
     * caso não encontre um erro 404 será exposto
     * @param integer $id
     * @return Venda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venda::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Retorna um mini formulário quando clica no botão de adicionar produto
    * @return mixed
    */
    public function actionAddVendaProduto()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('VendaProduto');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formVendaProduto', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

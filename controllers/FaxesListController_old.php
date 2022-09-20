<?php

namespace app\controllers;

use Yii;
use app\models\AddFile;
use app\models\DidsList;
use app\models\FaxesList;
use app\models\FaxesListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FaxesListController implements the CRUD actions for FaxesList model.
 */
class FaxesListController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all FaxesList models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FaxesListSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $clientID = Yii::$app->user->identity->cl_id;

        
        if(Yii::$app->user->can('admin')){
            $faxesList = FaxesList::find()
                ->joinWith('faxDetails')
                ->where(['delete_flag' => 0])
                ->all();
        } else {
            $faxesList = FaxesList::find()
                ->joinWith('faxDetails')
                ->where(['delete_flag' => 0, 'cl_id' => $clientID])
                ->all();
        }    

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'faxesList' => $faxesList,
        ]);
    }

    /**
     * Displays a single FaxesList model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new AddFile;

        if ($model->load(Yii::$app->request->post())) 
            {
                $postArr = Yii::$app->request->post('AddFile');
                $model->called_number = $postArr['called_number'];
                $model->caller_number =  $postArr['caller_number'];
                $newName = date('YmdHi', strtotime('now'))."_".$model->caller_number."_".$model->called_number."_".rand(10000,99999)."@OUTGOING_WEB.tiff";
                $model->file = UploadedFile::getInstance($model, 'file');
                
                // Channel: SIP/sbc04/223701472
                // CallerID: 223761327
                // RetryTime: 3
                // WaitTime: 60
                // Context: from-pbx
                // Extension: start
                // Priority: 1
                // Set:PLIK=/tmp/202205061247_223701472_223761327_511344468652022124758@82.214.155.138.tiff
                // Set:ID=149592
                // Set:NAZWAFAX=Testy ManieK
                // Set:NUMERFAX=223761327
                // Set:TECHNOLOGIA=www
                // Set:EMAIL=m.czarkowski@omega-es.pl
                // Set:CPB=223761328
                $content = "Channel: SIP/sbc04/".$model->called_number."\n";
                $content .= "CallerID: ".$model->caller_number."\n";
                $content .= "Set:CalledID=".$model->called_number."\n";
                $content .= "RetryTime: 3\n";
                $content .= "WaitTime: 60\n";
                $content .= "Context: from-pbx\n";
                $content .= "Extension: start\n";
                $content .= "Priority: 1\n";
                $content .= "Set:PLIK=/var/www/html/fax_files/".$newName."\n";
                $content .= "Set:FILENAME=".$newName."\n";

                // print_r($content);die();


                
                // print_r($postArr['called_number']);
                // print_r($model);die();
                // $model->file->saveAs('/var/www/html/fax_files/'. 'test1234.call');
                $myfile = fopen("/var/spool/asterisk/outgoing/newfile.call", "w") or die("Unable to open file!");
                fwrite($myfile, $content);
                fclose($myfile);
                $model->file->saveAs('/var/www/html/fax_files/' . $newName);

                
                return $this->redirect(['index']);            
            }


            return $this->renderAjax('new-fax', ['model' => $model]);
    }

    
    /**
     * Deletes an existing FaxesList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $row = FaxesList::find()
            ->where(['id' => $id])
            ->one();
        $row->delete_flag = 1;
        $row->delete_date = date('Y-m-d H:i:s', strtotime('now'));
        $row->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaxesList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return FaxesList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaxesList::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownloadFile($fileName)
    {
        $storagePath = '/var/www/html/fax_files';
        return Yii::$app->response->sendFile("$storagePath/$fileName", $fileName);
    }
}

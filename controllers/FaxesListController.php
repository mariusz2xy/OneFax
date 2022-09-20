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
        $clientID = Yii::$app->user->identity->cl_id;

        $searchModel = new FaxesListSearch();
        
        if(Yii::$app->user->can('admin'))
            $dataProvider = $searchModel->search($this->request->queryParams);
        else 
            $dataProvider = $searchModel->search($this->request->queryParams,$clientID);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    public function actionCreate($phonebook = false)
    {
        // print_r($phonebook);die();
        $model = new AddFile;

        if ($model->load(Yii::$app->request->post())) 
            {
                $postArr = Yii::$app->request->post('AddFile');
                $model->called_number = $postArr['called_number'];
                $model->caller_number =  $postArr['caller_number'];
                $model->file = UploadedFile::getInstance($model, 'file');
                $orig_extension = $model->file->extension;
                $orig_name = date('YmdHi', strtotime('now'))."_".$model->caller_number."_".$model->called_number."_".rand(10000,99999)."@OUTGOING_WEB.".$orig_extension;
                $model->file->saveAs('/var/www/html/fax_files/' . $orig_name);
                if($orig_extension == 'pdf')
                {
                    $command = 'gs -q -dNOPAUSE -dBATCH -sDEVICE=tiffg4 -sPAPERSIZE=a4 -sOutputFile=/var/www/html/fax_files/' . explode('.', $orig_name)[0].'.tiff /var/www/html/fax_files/' . $orig_name;
                    $fileName = explode('.', $orig_name)[0].'.tiff';
                    system($command);
                } else 
                    $fileName = $orig_name;      
                
                // Utwórz plik *.call (generacja połączenia)
                $content = "Channel: SIP/sbc04/".$model->called_number."\n";
                $content .= "CallerID: ".$model->caller_number."\n";
                $content .= "Set:CalledID=".$model->called_number."\n";
                $content .= "RetryTime: 3\n";
                $content .= "WaitTime: 60\n";
                $content .= "Context: from-pbx\n";
                $content .= "Extension: start\n";
                $content .= "Priority: 1\n";
                $content .= "Set:PLIK=/var/www/html/fax_files/".$fileName."\n";
                $content .= "Set:FILENAME=".$fileName."\n";

                $myfile = fopen("/var/spool/asterisk/outgoing/newfile.call", "w") or die("Unable to open file!");
                fwrite($myfile, $content);
                fclose($myfile);
                

                
                return $this->redirect(['index']);            
            }

            if($phonebook == true)
                return $this->renderAjax('new-fax-phonebook', ['model' => $model]);
                // echo 'test';
            else
                return $this->renderAjax('new-fax', ['model' => $model]);
                // echo 'chuj';
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

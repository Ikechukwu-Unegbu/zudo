<?php 
namespace App\Services;

use App\Models\User;
use App\Models\V1\Kin;
use Illuminate\Support\Facades\Http;

class FileUploadService{



    public function fileHandler($request, $key){
        if($request->file($key)){
            $file= $request->file($key);
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/userfiles'), $filename);
            return $filename;
        }
    }


    public function upload($file, $ownerModel ='user', $modelId){
        // $model;
        if($ownerModel=='user'){
            $model = User::findorFail($modelId);
            $model->avatar = $this->fileHandler($file, 'user_dp');
            $model->save();
        }elseif($ownerModel =='kin'){
            $model = Kin::findOrFail($modelId);
            $model->image = $this->fileHandler($file, 'kin_image');
            $model->save();
        }
    }
}
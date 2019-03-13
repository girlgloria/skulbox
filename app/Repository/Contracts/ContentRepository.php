<?php
/**
 * Created by PhpStorm.
 * User: marvincollins
 * Date: 3/6/19
 * Time: 5:12 PM
 */

namespace App\Repository\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Http\UploadedFile;

class ContentRepository extends Repository
{
    public function makeModel()
    {
        $model = \app()->make($this->controllerModel);

        if (! $model instanceof Model){
            dd("Not instance of model");
        }

        return $this->model = $model->newQuery();
    }

    public function getModel($model)
    {
        $this->controllerModel = $model;
        $this->makeModel();

        return $this;
    }

    public function uploadImage($image, ...$thumbnailSize)
    {
        $getImage = Image::make($image);
        $image1 = Image::make($image);
        $thumbnailPath = \public_path().'/images/thumbnail/';
        $imagePath = \public_path().'/images/';

        $imageName = rand(10000, 10000000).'_'.\time().'.'.$image->getClientOriginalExtension();

        $getImage->resize($thumbnailSize[0], $thumbnailSize[1]);
        $image1->resize(570, 600);

        $image1->save($imagePath.$imageName);

        $getImage->save($thumbnailPath.$imageName);

        return $imageName;
    }

    public function upload(Request $request) {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // receive the file
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            return $this->saveFile($save->getFile());
        }

        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }

    protected function saveFile(UploadedFile $file)
    {
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        $type = $file->getMimeType();
        // Group files by the date (week
        $dateFolder = date("Y-m-d");

        // Build the file path
        $filePath = "upload/{$mime}/{$dateFolder}/";
        $finalPath = storage_path("app/".$filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        return response()->json([
            'path' => $filePath,
            'name' => $fileName,
            'mime_type' => $mime,
            'type' => $type
        ]);
    }

    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", str_slug($file->getClientOriginalName())); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }


}
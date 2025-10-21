<?php

namespace Modules\Imedia\Services;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Modules\Imedia\Repositories\FileRepository;
use Modules\Imedia\Support\FileHelper;

class FolderService
{

  private $fileRepository;

  public function __construct(FileRepository $fileRepository)
  {
    $this->fileRepository = $fileRepository;
  }

  /**
   * PROCESS TO CREATE A FOLDER
   */
  public function store($data)
  {

    //Validations
    $this->checkValidations($data);

    //Get Disk
    $disk = $data['disk'] ?? 's3';
    $parentId = $data['folder_id'] ?? null;

    //Save Folder
    $file = $this->saveData($data, $disk, $parentId);

    //Save in disk
    Storage::disk($disk)->makeDirectory($file->path, [
      'visibility' => $file['visibility']
    ]);

    //Return File
    return $file;
  }


  /**
   * Validations
   */
  private function checkValidations($data): void
  {
    $request = new \Modules\Imedia\Http\Requests\CreateFolderRequest($data);
    $validator = Validator::make($request->all(), $request->rules(), $request->messages());
    //if get errors, throw errors
    if ($validator->fails()) {
      throw new \Exception(json_encode($validator->errors()), 400);
    }
  }

  /**
   * Save Data in Database
   */
  private function saveData($data, $disk, $parentId)
  {

    $filename = $data['name'];

    //Fix data to Save
    $dataToSave = [
      'filename' => $filename,
      'path' => FileHelper::makePath($filename, $parentId),
      'folder_id' => (int)($data['folder_id'] ?? 0) ? $data['folder_id'] : null,
      'is_folder' => true,
      'disk' => $disk,
      'visibility' => $data['visibility'] ?? 'public'
    ];

    //Save File
    return $this->fileRepository->create($dataToSave);
  }


  /**
   * PROCESS TO UPDATE A FOLDER
   */
  public function update($criteria, $data, $params)
  {
    //Validations
    $this->checkValidations($data);

    $file = $this->fileRepository->getItem($criteria);

    //Update in Disk or Database
    $fileUpdated = $this->updateData($file, $data, $params);

    return $fileUpdated;
  }

  /**
   * Update Data in Disk and Database
   */
  private function updateData($file, $data, $params)
  {
    //$oldPath = $file->path;
    $oldPath = ltrim($file->path, '/');
    $disk = $file->disk;

    // Si se cambia el nombre, recalcular path
    if (isset($data['name'])) {

      $data['filename'] = $data['name'];
      unset($data['name']);

      $parentId = $data['folder_id'] ?? $file->folder_id;

      $data['path'] = FileHelper::makePath($data['filename'], $parentId);
    }

    //New Data
    //$newPath = $data['path'] ?? $oldPath;
    $newPath = ltrim($data['path'] ?? $oldPath, '/');
    $visibility = $data['visibility'] ?? $file->visibility;

    // Si el path cambió, mover carpeta en disco
    if ($oldPath !== $newPath) {

      // Mover subcarpetas vacías
      $directories = Storage::disk($disk)->allDirectories($oldPath);
      foreach ($directories as $dirPath) {
        $newDirPath = str_replace($oldPath, $newPath, $dirPath);
        Storage::disk($disk)->makeDirectory($newDirPath, ['visibility' => $visibility]);
      }

      // Si no hay archivos, crear carpeta vacía
      if (empty(Storage::disk($disk)->allFiles($oldPath))) {
        Storage::disk($disk)->makeDirectory($newPath, ['visibility' => $visibility]);
      }

      \Log::info("Old path: $oldPath");
      \Log::info("New path: $newPath");

      //Copiando archivos
      $files = Storage::disk($disk)->allFiles($oldPath);
      foreach ($files as $filePath) {
        $newFilePath = str_replace($oldPath, $newPath, $filePath);

        \Log::info("Copiando $filePath → $newFilePath");
        Storage::disk($disk)->copy($filePath, $newFilePath);
      }

      //Delete old folder
      Storage::disk($disk)->deleteDirectory($oldPath);
    }

    //Actualiza el Folder Principal
    $fileUpdated = $this->fileRepository->updateBy($file->id, $data, $params);

    //Actualizar paths de archivos hijos
    $this->updateChildren($file);

    //Update en Database
    return $fileUpdated;
  }

  /**
   * Update Paths to children files
   * @return void
   */
  private function updateChildren($folder)
  {
    //Get Children Files
    $params = ["filter" => ['folder_id' => $folder->id]];
    $children = $this->fileRepository->getItemsBy(json_decode(json_encode($params)));

    foreach ($children as $child) {
      $newChildPath = FileHelper::makePath($child->filename, $folder->id);
      \Log::info("NewChildPath: $newChildPath");

      $this->fileRepository->updateBy($child->id, ['path' => $newChildPath]);
    }
  }
}

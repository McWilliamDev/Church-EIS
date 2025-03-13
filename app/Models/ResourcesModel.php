<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourcesModel extends Model
{
    use HasFactory;
    protected $table = 'church_resources';

    public static function getRecord()
    {
        return ResourcesModel::where('is_delete', 0)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function getImage()
    {
        if (!empty($this->file_image) && file_exists('upload/resources/' . $this->file_image)) {
            return url('upload/resources/' . $this->file_image);
        } else {
            return "";
        }
    }
    public function getDocument()
    {
        if (!empty($this->document) && file_exists('upload/resources/documents/' . $this->document)) {
            return url('upload/resources/documents/' . $this->document);
        } else {
            return "";
        }
    }
    public function getFileSize($filePath)
    {
        $fullPath = public_path($filePath);
        return file_exists($fullPath) ? filesize($fullPath) : 0; // Return size in bytes or 0 if file doesn't exist
    }
    public function getDocumentSize()
    {
        return $this->getFileSize('upload/resources/documents/' . $this->document);
    }
}

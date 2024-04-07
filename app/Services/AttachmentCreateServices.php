<?php
namespace App\Services;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AttachmentCreateServices {

    public function create_attachment($files, $doctype, $doc_id ) {
        foreach ($files as $item) {

            $hash = rand(1000, 9999);
            $true_fn = $hash."_".$item->getClientOriginalName();

            Storage::disk('public')->put("document_attachment/".$true_fn, file_get_contents($item->path()), 'public');

            Attachment::create(
                [
                    'file' => $true_fn,
                    'file_real' => $item->getClientOriginalName(),
                    'storage_patch' => "document_attachment",
                    'file_hash' => $hash,
                    'inner_document_type' => $doctype,
                    'document_id' => $doc_id
                ]
            );
        }
    }
}

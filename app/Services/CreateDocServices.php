<?php
namespace App\Services;

use App\Models\UploadDocument;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class CreateDocServices {

    public function create_tmp_document(string $template_patch, array $options, int $model_id, string $document_type, string $document) {
        try{

            $template = new TemplateProcessor($template_patch);

            foreach($options as $key => $value) {
                $template->setValue($key, $value);
            }

            $filename =  Auth::user()['id']."_".$model_id."_".date("Y_m_d_H_i_s");
            $filepatch =  public_path('tmp_docs');
            $file_pdf = $filepatch.'/'.$filename.".pdf";
            $file_docx = $filepatch.'/'.$filename.".docx";

            $template->saveAs($file_docx);


            $rendererName = Settings::PDF_RENDERER_MPDF;
            $rendererLibraryPath = realpath('../vendor/mpdf/mpdf');
            Settings::setPdfRenderer($rendererName, $rendererLibraryPath);

            $phpWord = IOFactory::load($file_docx);
            $objWriter = IOFactory::createWriter($phpWord, 'PDF');
            $objWriter->save($file_pdf);

            unlink($file_docx);

            UploadDocument::create(
                [
                    'url' => $file_pdf,
                    'name' => $filename.".pdf",
                    'user_id' => Auth::user()['id'],
                    'document'=>$document,
                    'document_type'=>$document_type,
                    'model_id' => $model_id,
                ]
            );

            return $file_pdf;

        } catch (\Throwable $e) {
            return $e->getMessage();
        }


    }

}

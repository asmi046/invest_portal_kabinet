<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SignedDocument;

use App\Models\UploadDocument;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class CreateDocServices {



    public function create_tmp_document(string $template_patch, array $options, int $model_id, string $document_type, string $document, $state = "temp", $directory = "tmp_docs") {
        try{

            $template = new TemplateProcessor($template_patch);

            foreach($options as $key => $value) {
                $template->setValue($key, $value);
            }

            $filename =  Auth::user()['id']."_".$model_id."_".date("Y_m_d_H_i_s");
            $filepatch =  public_path($directory);
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

            $document = UploadDocument::create(
                [
                    'url' => config('app.url')."/".$directory.'/'.$filename.".pdf",
                    'name' => $filename.".pdf",
                    'user_id' => Auth::user()['id'],
                    'document'=>$document,
                    'document_type'=>$document_type,
                    'state' => $state,
                    'model_id' => $model_id,
                ]
            );



            return [
                'url' => $file_pdf,
                'file_id' => $document->id,
            ];


        } catch (\Throwable $e) {
            return $e->getMessage();
        }


    }

    public function create_signed_document(string $template_patch, array $options, int $model_id, string $document_type, string $directory = "signed_docs" ) {
        try{

            $template = new TemplateProcessor($template_patch);

            foreach($options as $key => $value) {
                $template->setValue($key, $value);
            }

            $filename =  Str::slug($model_id."_".$document_type);
            $filepatch =  public_path($directory);
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

            $document = SignedDocument::firstOrCreate(
                [
                    'inner_document_type' => $document_type,
                    'document_id' => $model_id
                ],
                [
                    'file_real' => $filename.".pdf",
                    'file' => $filename.".pdf",
                    'storage_patch' => $directory,
                    'inner_document_type' => $document_type,
                    'document_id' => $model_id
                ],
            );

            return [
                'url' => $file_pdf,
                'file_id' => $document->id,
            ];


        } catch (\Throwable $e) {
            return $e->getMessage();
        }


    }

}

<?php
namespace App\Services;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

use Illuminate\Support\Facades\Storage;

class CreateDocServices {

    public function create_tmp_document(string $template_patch, array $options) {
        try{

            $template = new TemplateProcessor($template_patch);

            foreach($options as $key => $value) {
                $template->setValue($key, $value);
            }

            $filename =  date("Y_m_d_H_i_s");
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

            return $file_pdf;

        } catch (\Throwable $e) {
            return "";
        }


    }

}

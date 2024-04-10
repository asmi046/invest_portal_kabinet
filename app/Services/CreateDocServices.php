<?php
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SignedDocument;

use App\Models\UploadDocument;

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\Element\Table;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;

class CreateDocServices {

    protected function get_etaps_table($values) {
        $table = new Table(['unit' => TblWidth::TWIP, 'borderSize' => 1]);

        $table->addRow();
        $table->addCell(240)->addText("Этап (очередь) строительства");
        $table->addCell(240)->addText("Планируемый срок проектирования энергопринимающих устройств (месяц, год)");
        $table->addCell(240)->addText("Планируемый срок введения энергопринимающих устройств в эксплуатацию (месяц, год)");
        $table->addCell(240)->addText("Максимальная мощность энергопринимающих устройств (кВт)");
        $table->addCell(240)->addText("Категория надежности энергопринимающих устройств");

        foreach ($values as $item) {
            $table->addRow();
            $table->addCell(240)->addText($item['et']);
            $table->addCell(240)->addText($item['pproject']);
            $table->addCell(240)->addText($item['pexpl']);
            $table->addCell(240)->addText($item['maxp']);
            $table->addCell(240)->addText($item['cat']);
        }

        return $table;
    }

    protected function create_options($options, &$template) {

        foreach($options as $key => $value) {
            if ( gettype($value) === 'array') {
                if ($key === "etaps") {
                    $template->setComplexBlock(
                        $key,
                        $this->get_etaps_table($value)
                    );
                }
                continue;
            }
            $template->setValue($key, ($value)?$value:"");
        }

    }


    public function create_tmp_document(string $template_patch, array $options, int $model_id, string $document_type, string $document, $state = "temp", $directory = "tmp_docs") {
        try{

            $filename =  Auth::user()['id']."_".$model_id."_".date("Y_m_d_H_i_s");
            $filepatch =  public_path($directory);
            $file_pdf = $filepatch.'/'.$filename.".pdf";
            $file_docx = $filepatch.'/'.$filename.".docx";

            $template = new TemplateProcessor($template_patch);

            $this->create_options($options, $template);


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

            $this->create_options($options, $template);

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

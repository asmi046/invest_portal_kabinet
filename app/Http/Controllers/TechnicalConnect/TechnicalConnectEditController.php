<?php

namespace App\Http\Controllers\TechnicalConnect;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Models\TechnicalConnects;
use App\Services\GetJsonServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tc\TcDraftRequest;
use App\Http\Requests\Tc\TcSigneRequest;
use App\Services\AttachmentCreateServices;

class TechnicalConnectEditController extends Controller
{
    public function save(Request $request, GetJsonServices $js_service) {
        $att_delete = $request->input('att_delete');
        if ($att_delete)
        {
            $at = Attachment::where('id', $att_delete)->first();
            $at->delete();
            return redirect()->back()->with('drafr_save', "Вложение удалено");
        }

        switch ($request->input('action')) {
            case 'create_draft':
                $d_request = new TcDraftRequest();
                $data = $request->validate($d_request->rules(), $d_request->messages());

                $data["user_id"] = auth()->user()->id;
                $data["state"] = "Черновик";

                $json_data = $js_service->get_periods_json($request);
                $data["etaps"] = $json_data;


                $tc = TechnicalConnects::create($data);

                return redirect()->route('technical_connect_edit', $tc->id)->with('drafr_save', "Черновик сохранен");;
            break;

            case 'save_draft':
                $d_request = new TcDraftRequest();
                $data = $request->validate($d_request->rules(), $d_request->messages());

                $data["user_id"] = auth()->user()->id;
                $data["state"] = "Черновик";

                $json_data = $js_service->get_periods_json($request);
                $data["etaps"] = $json_data;

                $item = TechnicalConnects::where('id', $request->input('item_id'))->first();
                if(!$item) abort('404');

                $item->update($data);

                $attachment = new AttachmentCreateServices();

                if ($request->hasFile('attachment'))
                    $files = $attachment->create_attachment(
                        $request->file('attachment'),
                        'tc',
                        $item->id
                    );

                return redirect()->back()->with('drafr_save', "Черновик сохранен");
            break;

            case 'validate_signe':
                $s_request = new TcSigneRequest();
                $data = $request->validate($s_request->rules(), $s_request->messages());


                $item = TechnicalConnects::where('id', $data['item_id'])->first();

                if(!$item) abort('404');

                $item->update($data);

                $attachment = new AttachmentCreateServices();

                if ($request->hasFile('attachment'))
                    $files = $attachment->create_attachment(
                        $request->file('attachment'),
                        'tc',
                        $item->id
                    );

                return redirect()->route('technical_connect_signe', $item->id);
            break;

        }

    }

    public function delete($id) {
        $item = TechnicalConnects::where('id', $id)->first();
        $item->delete();

        return redirect()->route('technical_connect')->with('deleted', "Запись была успешно удалена");
    }

}

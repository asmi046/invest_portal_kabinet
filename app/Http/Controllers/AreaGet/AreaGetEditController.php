<?php

namespace App\Http\Controllers\AreaGet;

use App\Models\AreaGet;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Services\CreateDocServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AttachmentCreateServices;
use App\Http\Requests\AreaGet\AreaGetDraftRequest;
use App\Http\Requests\AreaGet\AreaGetSigneRequest;

class AreaGetEditController extends Controller
{
    public function save(Request $request) {
        $att_delete = $request->input('att_delete');
        if ($att_delete)
        {
            $at = Attachment::where('id', $att_delete)->first();
            $at->delete();
            return redirect()->back()->with('drafr_save', "Вложение удалено");
        }

        switch ($request->input('action')) {

            case 'create_draft':
                $d_request = new AreaGetDraftRequest();
                $data = $request->validate($d_request->rules(), $d_request->messages());

                $data["user_id"] = auth()->user()->id;
                $data["state"] = "Черновик";

                $tc = AreaGet::create($data);

                return redirect()->route('area_get_edit', $tc->id);
            break;

            case 'save_draft':
                $d_request = new AreaGetDraftRequest();
                $data = $request->validate($d_request->rules(), $d_request->messages());

                $data["user_id"] = auth()->user()->id;
                $data["state"] = "Черновик";

                $item = AreaGet::where('id', $request->input('item_id'))->first();
                if(!$item) abort('404');

                $item->update($data);

                $attachment = new AttachmentCreateServices();

                $files = $attachment->create_attachment(
                    $request->file('attachment'),
                    'area_get',
                    $item->id
                );

                return redirect()->back()->with('drafr_save', "Черновик сохранен");
            break;

            case 'validate_signe':
                $s_request = new AreaGetSigneRequest();

                $data = $request->validate($s_request->rules(), $s_request->messages());

                $item = AreaGet::where('id', $data['item_id'])->first();

                if(!$item) abort('404');

                return redirect()->route('area_get_signe', $item->id);
            break;

        }


    }

    public function delete($id) {

        $item = AreaGet::where('id', $id)->first();
        $item->attachment()->delete();
        $item->delete();

        return redirect()->route('area_get')->with('deleted', "Запись была успешно удалена");
    }
}

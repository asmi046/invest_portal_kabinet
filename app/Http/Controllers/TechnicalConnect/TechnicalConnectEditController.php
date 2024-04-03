<?php

namespace App\Http\Controllers\TechnicalConnect;

use Illuminate\Http\Request;
use App\Models\TechnicalConnects;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tc\TcDraftRequest;
use App\Http\Requests\Tc\TcSigneRequest;

class TechnicalConnectEditController extends Controller
{
    public function save(Request $request) {
        switch ($request->input('action')) {
            case 'create_draft':
                $d_request = new TcDraftRequest();
                $data = $request->validate($d_request->rules(), $d_request->messages());

                $data["user_id"] = auth()->user()->id;
                $data["state"] = "Черновик";

                // dd($data);

                $tc = TechnicalConnects::create($data);

                return redirect()->route('technical_connect_edit', $tc->id);
            break;

            case 'save_draft':
                $d_request = new TcDraftRequest();
                $data = $request->validate($d_request->rules(), $d_request->messages());

                $data["user_id"] = auth()->user()->id;
                $data["state"] = "Черновик";

                $item = TechnicalConnects::where('id', $request->input('item_id'))->first();
                if(!$item) abort('404');

                $item->update($data);

                return redirect()->back()->with('drafr_save', "Черновик сохранен");
            break;

            case 'validate_signe':
                $s_request = new TcSigneRequest();
                $data = $request->validate($s_request->rules(), $s_request->messages());

                $item = TechnicalConnects::where('id', $id)->first();

                if(!$item) abort('404');

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

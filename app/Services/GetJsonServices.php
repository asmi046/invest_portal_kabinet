<?php
namespace App\Services;

use Illuminate\Http\Request;

class GetJsonServices {
    public function get_periods_json(Request $request) {
        $rez_array = [];

        $i = 0;
        while (true) {
            $et = $request->input('et_'.$i);
            $pproject = $request->input('pproject_'.$i);
            $pexpl = $request->input('pexpl_'.$i);
            $maxp = $request->input('maxp_'.$i);
            $cat = $request->input('cat_'.$i);

            if (empty($et)) break;

            $rez_array[] = [
                'et' => $et,
                'pproject' => $pproject,
                'pexpl' => $pexpl,
                'maxp' => $maxp,
                'cat' => $cat,
            ];


            if ($i > 10) break;
            $i++;
        }

        return $rez_array;
    }
}

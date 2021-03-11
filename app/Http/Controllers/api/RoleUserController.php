<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\TraitApi;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use Log;
class RoleUserController extends Controller
{
    use TraitApi;
    /**
     * edit role data
     */
    public function editRole(Request $request)
    {
        $data = $request->all();

        RoleUser::where('id',$data['id'])->update([
            'status' =>$data['status'],
            'position' => $data['position']
        ]);
        
        return $this->responseApi('ok','','Update success');
    }

    /**
     * delete role
     */
    public function deleteUser(Request $request)
    {
        $data = $request->all();

        RoleUser::where('id',$data['id'])->update([
            'is_delete' =>1
        ]);
        return $this->responseApi('ok','','Successfully delete!');
    }
}

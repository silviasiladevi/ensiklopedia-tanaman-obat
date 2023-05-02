<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function updateJabatan(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->jabatan = $request->jabatan;
        $user->save();
        return redirect("/homeAdmin/user")->with('toast_success', 'Jabatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $username)
    {
        $data = User::where('username', $username)->firstOrFail();
        $data->delete();


        return redirect('/homeAdmin/user')->with('success', 'User Berhasil Dihapus!');
    }
}

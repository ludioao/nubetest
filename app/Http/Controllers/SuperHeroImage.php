<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 03/05/18
 * Time: 11:43
 */

namespace App\Http\Controllers;

use App\Models\SuperHeroImage as Model;

class SuperHeroImage extends Controller
{
    public function destroy($id)
    {
        $image = Model::findOrFail($id);
        $image->delete();
        session()->put('success', 'Image removed.');
        return redirect()->back();
    }
}
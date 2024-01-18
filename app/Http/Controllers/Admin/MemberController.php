<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Show member view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $user = Auth::user();
        $members = User::where('role', 2)->get();

        return view('admin.members', compact('user', 'members'));
    }
    public function edit($id)
{
    $member = User::findOrFail($id);
    return view('admin.memberedit', compact('member'));
}
public function update(Request $request, $id)
{
    $rules = [
        'name'          => ['required', 'string', 'max:255'],
        'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        'gender'        => ['nullable', 'in:laki-laki,perempuan'],
        'address'       => ['nullable', 'string'],
        'phone_number'  => ['nullable', 'string'],
    ];

    $data = $request->validate($rules);

    $member = User::findOrFail($id);
    $member->update($data);

    return redirect()->route('admin.members')->with('success', 'Member updated successfully.');
}


}

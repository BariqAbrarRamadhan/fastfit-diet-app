<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Pencarian
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }        // Filter role
        if ($role = $request->query('role')) {
            if ($role !== 'all') {
                $query->where('role', $role);
            }
        }

        // Pagination
        $users = $query->paginate(8)->appends($request->query());

        // Simulasi selected_users untuk bulk actions
        $selected_users = collect($request->input('selected_users', []));

        return view('admin.users', compact('users', 'selected_users'));
    }

    public function show($id)
    {
        // Placeholder untuk halaman detail
        return view('admin.users.show', ['user' => User::findOrFail($id)]);
    }

    public function edit($id)
    {
        // Placeholder untuk halaman edit
        return view('admin.users.edit', ['user' => User::findOrFail($id)]);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function bulk(Request $request)
    {
        // Placeholder untuk bulk actions
        $action = $request->input('action');
        $selected_users = $request->input('selected_users', []);
        if ($action === 'delete') {
            User::whereIn('id', $selected_users)->delete();
            return redirect()->route('admin.users')->with('success', 'Pengguna terpilih berhasil dihapus.');
        }

        return redirect()->route('admin.users');
    }

    public function export(Request $request)
    {
        $format = $request->query('format', 'csv');
        // Placeholder untuk ekspor
        return redirect()->route('admin.users')->with('success', 'Data pengguna diekspor sebagai ' . $format);
    }
}
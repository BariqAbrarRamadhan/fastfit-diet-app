<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
        }      // Filter role
        if ($role = $request->query('role')) {
            if ($role !== 'all') {
                $query->where('role', $role);
            }
        }

        // Pagination
        $users = $query->paginate(10)->appends($request->query());

        // Simulasi selected_users untuk bulk actions
        $selected_users = collect($request->input('selected_users', []));

        return view('admin.users.index', compact('users', 'selected_users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:5120', // Maks 5MB
        ]);

        $data = $request->only(['name', 'email', 'role']);
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('users', 'public');
            $data['image'] = Storage::url($path);
        }

        User::create($data);

        return redirect()->back()->with('success', 'Pengguna berhasil dibuat.');
    }

    public function show($id)
    {
        return view('admin.users.show', ['user' => User::findOrFail($id)]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:5120',
        ]);

        $data = $request->only(['name', 'email', 'role']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->image));
            }
            $path = $request->file('image')->store('users', 'public');
            $data['image'] = Storage::url($path);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function bulk(Request $request)
    {
        $request->validate([
            'selected_users' => 'required|array',
            'selected_users.*' => 'exists:users,id',
            'action' => 'required|in:delete',
        ]);

        $action = $request->input('action');
        $selected_users = $request->input('selected_users', []);

        if ($action === 'delete') {
            User::whereIn('id', $selected_users)->delete();
            return redirect()->route('admin.users')->with('success', 'Pengguna terpilih berhasil dihapus.');
        }

        return redirect()->route('admin.users')->with('error', 'Aksi tidak valid.');
    }

    public function export(Request $request)
    {
        $format = $request->query('format', 'csv');
        return redirect()->route('admin.users')->with('success', 'Data pengguna diekspor sebagai ' . $format);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth; 

class TodoController extends Controller
{
    // 🔹 TAMPIL DATA (FIX VIEW)
    public function index()
    {
        // Ambil hanya todo milik user login (lebih aman)
        $todos = Todo::where('user_id', Auth::id())->get();

        return view('todo', compact('todos'));
    }

    // 🔹 HALAMAN CREATE
    public function create()
    {
        return view('todo.create');
    }

    // 🔥 STORE + VALIDASI
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required',
        ], [
            'title.required' => 'Judul wajib diisi',
            'title.min' => 'Judul minimal 3 karakter',
            'title.max' => 'Judul maksimal 100 karakter',
            'description.required' => 'Deskripsi wajib diisi',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(), 
        ]);

        return redirect('/todo')->with('success', 'Todo berhasil ditambahkan');
    }

    // 🔥 UPDATE + VALIDASI
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required',
        ], [
            'title.required' => 'Judul wajib diisi',
            'title.min' => 'Judul minimal 3 karakter',
            'title.max' => 'Judul maksimal 100 karakter',
            'description.required' => 'Deskripsi wajib diisi',
        ]);

        $todo = Todo::findOrFail($id);

        // Pastikan hanya pemilik yang bisa update
        if ($todo->user_id != Auth::id()) {
            return redirect('/todo')->with('error', 'Tidak punya akses');
        }

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/todo')->with('success', 'Todo berhasil diupdate');
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        // Cek ownership
        if ($todo->user_id != Auth::id()) {
            return redirect('/todo')->with('error', 'Tidak punya akses');
        }

        $todo->delete();

        return redirect('/todo')->with('success', 'Todo berhasil dihapus');
    }

    public function toggle(Todo $todo)
    {
        // Cek ownership
        if ($todo->user_id != Auth::id()) {
            return back()->with('error', 'Tidak punya akses');
        }

        // Mengubah status boolean
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);

        return back();
    }
}
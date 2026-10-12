<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();
        return response()->json([
            'message' => 'List of books',
            'data' => $books
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn',
        ]);

        $books = Books::create($request->all());

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $books
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $books = Books::find($id);
        if (!$books) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json([
            'message' => 'Book found',
            'data' => $books
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Books::find($id);
        if (!$books) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $books->update($request->all());
        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $books
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Books::find($id);
        if (!$books) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $books->delete();
        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\BlogServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    public function __construct(
        private BlogServiceInterface $blogService
    ) {
    }

    public function index(): JsonResponse
    {
        $posts = $this->blogService->get();

        return response()->json($posts, 200);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'publication_date' => 'required|date_format:Y-m-d',
            ]);

            $posts = $this->blogService->create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'publication_date' => $validatedData['publication_date'],
            ])->toArray();
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        return response()->json($posts, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'publication_date' => 'required|date_format:Y-m-d',
            ]);

            $post = $this->blogService->update($id, [
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'publication_date' => $validatedData['publication_date'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        }

        return response()->json($post, 200);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'id' => 'required',
        ]);
        
        $this->blogService->destroy($id);

        return response()->json(['message' => 'Post deleted' . $id], 204);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->blogService->get($id);

        return response()->json($post, $post ? 200 : 404);
    }
}
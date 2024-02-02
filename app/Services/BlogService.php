<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\BlogServiceInterface;
use Illuminate\Database\Eloquent\Model;

class BlogService implements BlogServiceInterface
{
    /**
     * Receives all blogs from the database.
     *
     * @return Collection
     */
    public function get(int $id = null): Collection | Model
    {
        if (!empty($id)) {
            return Blog::findOrFail($id);
        }

        return Blog::all();
    }

    /**
     * Creates a new Blog instance with the given data.
     *
     * @param array $data The data to create the Blog instance with.
     * @return Blog The newly created Blog instance.
     */
    public function create(array $data): Blog
    {
        return Blog::create($data);
    }

    /**
     * Update a blog by its ID.
     *
     * @param int $id The ID of the blog to update
     * @param array $data The data to update the blog with
     * @return Blog|null The updated blog or null if the blog does not exist
     */
    public function update(int $id, array $data): ?Blog
    {
        $blog = Blog::find($id);

        if (!empty($blog)) {
            $blog->update($data);

            return $blog;
        }

        return null;
    }

    /**
     * Destroy a blog by ID.
     *
     * @param int $id The ID of the blog to be destroyed
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $blog = Blog::find($id);

        if (!empty($blog)) {
            $blog->delete();

            return true;
        }

        return false;
    }
}
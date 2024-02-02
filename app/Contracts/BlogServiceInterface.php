<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BlogServiceInterface
{
    public function get(int $id = null): Collection | Model;
    public function create(array $data): Blog;
    public function update(int $id, array $data): ?Blog;
    public function destroy(int $id): bool;
}
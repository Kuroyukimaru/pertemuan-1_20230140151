<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    // 🔥 SEMUA ORANG BISA LIHAT LIST PRODUCT
    public function viewAny(User $user): bool
    {
        return true;
    }

    // 🔥 SEMUA ORANG BISA LIHAT DETAIL PRODUCT
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    // 🔥 HANYA ADMIN YANG BISA CREATE
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Product $product): bool
    {
        if ($user->role === 'admin') return true;

        return $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product): bool
    {
        if ($user->role === 'admin') return true;

        return $user->id === $product->user_id;
    }

    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
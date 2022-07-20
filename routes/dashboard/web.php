<?php

use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin-access:admin'])->group(function () {

    Route::resource("users", UsersController::class)->except("create", "edit", "show");
    Route::put('user/block/{user}', [UsersController::class, 'block'])->name("user.block");
    Route::get('api/users', [UsersController::class, 'apiIndex'])->name("users.api.index");

});

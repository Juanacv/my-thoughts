<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ThoughtController;

Route::apiResource('thoughts', ThoughtController::class);

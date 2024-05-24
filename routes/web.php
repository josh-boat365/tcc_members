<?php

use App\Models\Member;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\MemberController;

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware('auth')->group(function () {

    Route::get('dashboard', [MemberController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::post('save-member', [MemberController::class, 'store'])->name('save-member');

    Route::get('/search-members', [MemberController::class, 'search'])->name('search-members');
    Route::get('/delete-member/{id}', [MemberController::class, 'destroy'])->name('delete-member');
    Route::get('/update-member/{id}', [MemberController::class, 'update'])->name('update-member');
    Route::get('/export-pdf', [MemberController::class, 'exportPDF'])->name('export-pdf');

    Route::get('/download-members-pdf', [MemberController::class, 'downloadPDF'])->name('download.members.pdf');

    Route::get('test', function(){
        $members = Member::all();
         return view('pdf.members', compact('members'));});

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

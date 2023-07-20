<?php

use App\Http\Controllers\Profile\AvatarController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

    //read
    // $users = DB::select('select * from users');
    // $users = DB::table('users')->get();
    // $users = User::find(1);

    //create
    // $user = DB::insert('insert into users(name,email,password) values(?,?,?)', ['izydor32', 'idyzdor32@gmail.com', 'password']);
    // $user = DB::table('users')->insert([
    //     'name'=>'Robocop',
    //     'email'=>'robert@gmail.com',
    //     'password'=>'password'
    // ]);
    // $user = User::create([
    //     'name'=>'Paweł',
    //   'email'=>'pawelek@gmail.com',
    //    'password'=>'password'
    // ]);
    // $user = User::create([
    //     'name'=>'Jaromiir',
    //   'email'=>'jarek2@gmail.com',
    //    'password'=>'pasword'
    // ]);


//update
    // $user =DB::update("update users set name='Paweł' where id =2");
    // $user = DB::table('users')->where('id',7)->update(['email'=>'roberciksweet@gmail.com']);
    // $user = User::where('id',9)->update(['email'=>'test@gmail.com']);

//delete
    // $user = DB::delete('delete from users where id=2');
    


    // dd($users->name);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar',[AvatarController::class,'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
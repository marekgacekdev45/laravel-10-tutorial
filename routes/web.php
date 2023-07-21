<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\TicketController;

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
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::post('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');



Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    $user = User::firstOrCreate(['email' => $user->email], [
        'name' => $user->name,
        'avatar' => $user->avatar,
        'password' => 'password'

    ]);
    Auth::login($user);
    return redirect('/dashboard');
    // $user->token
});

Route::middleware('auth')->group(function () {
    Route::resource('/ticket',TicketController::class)
    // Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    // Route::post('/ticket/create', [TicketController::class, 'store'])->name('ticket.store');

    ;
});
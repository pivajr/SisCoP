<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sanctum/token', function (Request $request) {
    info($request->all());
    $user = User::where('email', $request->email)->first();

    info($user);
    info($user->password);

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['O e-mail ou a senha informado estão incorretos'],
        ]);
    }

    $user = new UserResource($user);
    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json(compact('token', 'user'));
});

Route::middleware(['auth:sanctum', 'loadInstituicao'])->group(function () {
    Route::resources([
        'horario' => HorarioController::class,
        'instituicao' => InstituicaoController::class,
        'funcionario' => FuncionarioController::class,
        'turma' => TurmaController::class,
    ]);

    Route::prefix('usuario')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('usuario.store');
        Route::put('/', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/', [UserController::class, 'index']);
        Route::get('/predict', [UserController::class, 'predict'])->name('usuario.predict');
        Route::put('/{id}', [UserController::class, 'update'])->name('usuario.update');
        Route::get('/email/{email}', [UserController::class, 'findByEmail'])->name('usuario.findByEmail');
        Route::get('/{id}', [ UserController::class, 'show' ]);
    });

    Route::prefix('presenca')->group(function () {
        Route::post('/', [PresencaController::class, 'registrarPresenca']);
    });

    Route::put('/instituicao/cadastro/avaliacao', [InstituicaoController::class, 'avaliacao'])->name('instituicao.avaliacao');

    Route::prefix('relatorio')->group(function () {
        Route::get('/pdf/{slug}', [RelatorioController::class, 'pdf'])->name('relatorio.pdf');
    });
});

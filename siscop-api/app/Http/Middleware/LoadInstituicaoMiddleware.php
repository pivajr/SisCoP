<?php

namespace App\Http\Middleware;

use App\Models\InstituicaoUser;
use App\Queries\Select\InstituicaoUser\SelectByUser;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoadInstituicaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            info('>>> instituicao_auth_id'.$request->instituicao_auth_id);
            if ($request->instituicao_auth_id) {
                $instituicoes = new SelectByUser(auth()->id(), $request->instituicao_auth_id);
            } else {
                $instituicoes = new SelectByUser(auth()->id());
            }

            $instituicoes = $instituicoes->query();

            abort_if(!$instituicoes->count(), 403, 'Nenhuma instituicao encontrada para o usuario '.auth()->user()->email);

            $instituicaoUser = $instituicoes->first();
            session()->put('instituicao', $instituicaoUser->instituicao);
            session()->put('perfil', $instituicaoUser->perfil);
        }

        return $next($request);
    }
}

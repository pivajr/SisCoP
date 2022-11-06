import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {BasicAuthGuard} from "./guards/basic-auth.guard";

const routes: Routes = [
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then(m => m.LoginModule)
  },
  {path: '', redirectTo: 'login', pathMatch: 'full'},
  { path: 'home', loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule) },
  { path: 'cadastro-usuario', canActivate: [BasicAuthGuard], loadChildren: () => import('./pages/cadastro-usuario/cadastro-usuario.module').then(m => m.CadastroUsuarioModule) },
  { path: 'consulta-usuario', canActivate: [BasicAuthGuard], loadChildren: () => import('./pages/consulta-usuario/consulta-usuario.module').then(m => m.ConsultaUsuarioModule) },
  { path: 'cadastro-instituicao', canActivate: [BasicAuthGuard], loadChildren: () => import('./pages/cadastro-instituicao/cadastro-instituicao.module').then(m => m.CadastroInstituicaoModule) },
  { path: 'cadastro-empresa', canActivate: [BasicAuthGuard], loadChildren: () => import('./pages/cadastro-empresa/cadastro-empresa.module').then(m => m.CadastroEmpresaModule) },
  { path: 'cadastro-instituicao-ensino', canActivate: [BasicAuthGuard], loadChildren: () => import('./pages/cadastro-instituicao-ensino/cadastro-instituicao-ensino.module').then(m => m.CadastroInstituicaoEnsinoModule) },
  { path: 'turma/cadastro', canActivate: [BasicAuthGuard], loadChildren: () => import('./pages/cadastro-turma/cadastro-turma.module').then(m => m.CadastroTurmaModule) },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CadastroEmpresaComponent } from './cadastro-empresa.component';

const routes: Routes = [{ path: '', component: CadastroEmpresaComponent }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CadastroEmpresaRoutingModule { }

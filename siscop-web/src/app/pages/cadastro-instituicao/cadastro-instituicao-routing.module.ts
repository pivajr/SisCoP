import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CadastroInstituicaoComponent } from './cadastro-instituicao.component';

const routes: Routes = [{ path: '', component: CadastroInstituicaoComponent }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CadastroInstituicaoRoutingModule { }

import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CadastroInstituicaoEnsinoComponent } from './cadastro-instituicao-ensino.component';

const routes: Routes = [{ path: '', component: CadastroInstituicaoEnsinoComponent }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CadastroInstituicaoEnsinoRoutingModule { }

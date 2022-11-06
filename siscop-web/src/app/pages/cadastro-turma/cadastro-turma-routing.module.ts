import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CadastroTurmaComponent } from './cadastro-turma.component';

const routes: Routes = [{ path: '', component: CadastroTurmaComponent }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CadastroTurmaRoutingModule { }

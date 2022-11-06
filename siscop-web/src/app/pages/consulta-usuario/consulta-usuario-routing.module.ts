import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ConsultaUsuarioComponent } from './consulta-usuario.component';

const routes: Routes = [{ path: '', component: ConsultaUsuarioComponent }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ConsultaUsuarioRoutingModule { }

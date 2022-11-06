import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { PoliticaPrivacidadeComponent } from './politica-privacidade.component';

const routes: Routes = [{ path: '', component: PoliticaPrivacidadeComponent }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PoliticaPrivacidadeRoutingModule { }

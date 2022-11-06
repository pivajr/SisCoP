import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CadastroTurmaRoutingModule } from './cadastro-turma-routing.module';
import { CadastroTurmaComponent } from './cadastro-turma.component';
import {ComponentsModule} from "../../components/components.module";
import {ReactiveFormsModule} from "@angular/forms";


@NgModule({
  declarations: [
    CadastroTurmaComponent
  ],
  imports: [
    CommonModule,
    ComponentsModule,
    ReactiveFormsModule,
    CadastroTurmaRoutingModule
  ]
})
export class CadastroTurmaModule { }

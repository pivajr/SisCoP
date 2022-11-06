import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CadastroInstituicaoEnsinoRoutingModule } from './cadastro-instituicao-ensino-routing.module';
import { CadastroInstituicaoEnsinoComponent } from './cadastro-instituicao-ensino.component';
import {ComponentsModule} from "../../components/components.module";
import {ReactiveFormsModule} from "@angular/forms";


@NgModule({
  declarations: [
    CadastroInstituicaoEnsinoComponent
  ],
    imports: [
        CommonModule,
        CadastroInstituicaoEnsinoRoutingModule,
        ComponentsModule,
        ReactiveFormsModule
    ]
})
export class CadastroInstituicaoEnsinoModule { }

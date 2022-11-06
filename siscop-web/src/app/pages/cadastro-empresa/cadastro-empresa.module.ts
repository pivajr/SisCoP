import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CadastroEmpresaRoutingModule } from './cadastro-empresa-routing.module';
import { CadastroEmpresaComponent } from './cadastro-empresa.component';
import {ComponentsModule} from "../../components/components.module";
import {ReactiveFormsModule} from "@angular/forms";


@NgModule({
  declarations: [
    CadastroEmpresaComponent
  ],
    imports: [
        CommonModule,
        CadastroEmpresaRoutingModule,
        ComponentsModule,
        ReactiveFormsModule,
    ]
})
export class CadastroEmpresaModule { }

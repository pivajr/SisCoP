import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CadastroUsuarioRoutingModule } from './cadastro-usuario-routing.module';
import { CadastroUsuarioComponent } from './cadastro-usuario.component';
import {ComponentsModule} from "../../components/components.module";
import {ReactiveFormsModule} from "@angular/forms";


@NgModule({
  declarations: [
    CadastroUsuarioComponent
  ],
    imports: [
        CommonModule,
        CadastroUsuarioRoutingModule,
        ComponentsModule,
        ReactiveFormsModule,
    ]
})
export class CadastroUsuarioModule { }

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CadastroInstituicaoRoutingModule } from './cadastro-instituicao-routing.module';
import { CadastroInstituicaoComponent } from './cadastro-instituicao.component';
import { ComponentsModule } from 'src/app/components/components.module';

@NgModule({
    declarations: [
        CadastroInstituicaoComponent
    ],
    imports: [
        CommonModule,
        CadastroInstituicaoRoutingModule,
        ComponentsModule
    ]
})
export class CadastroInstituicaoModule { }

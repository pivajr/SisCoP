import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RowComponent } from './row/row.component';
import { ColComponent } from './col/col.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { TelaBaseComponent } from './tela-base/tela-base.component';
import { TelaConsultaComponent } from './tela-consulta/tela-consulta.component';
import { InputComponent } from './input/input.component';
import { ButtonDirective } from './button/button.directive';
import {RouterModule} from "@angular/router";
import { CardComponent } from './card/card.component';
import {NgxMaskModule} from "ngx-mask";
import { TelaCadastroComponent } from './tela-cadastro/tela-cadastro.component';
import {ReactiveFormsModule} from "@angular/forms";
import { LoaderComponent } from './loader/loader.component';
import { ToastComponent } from './toast/toast.component';
import { EnderecoFieldsComponent } from './endereco-fields/endereco-fields.component';
import { InputMaskedComponent } from './input-masked/input-masked.component';



@NgModule({
    declarations: [
        RowComponent,
        ColComponent,
        HeaderComponent,
        FooterComponent,
        TelaBaseComponent,
        InputComponent,
        ButtonDirective,
        TelaConsultaComponent,
        CardComponent,
        TelaCadastroComponent,
        LoaderComponent,
        ToastComponent,
        EnderecoFieldsComponent,
        InputMaskedComponent
    ],
    exports: [
        RowComponent,
        ColComponent,
        TelaBaseComponent,
        FontAwesomeModule,
        HeaderComponent,
        FooterComponent,
        InputComponent,
        InputMaskedComponent,
        ButtonDirective,
        TelaConsultaComponent,
        CardComponent,
        TelaCadastroComponent,
        LoaderComponent,
        ToastComponent,
        EnderecoFieldsComponent
    ],
  imports: [
    CommonModule,
    FontAwesomeModule,
    RouterModule,
    NgxMaskModule.forRoot(),
    ReactiveFormsModule
  ]
})
export class ComponentsModule { }

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ConsultaUsuarioRoutingModule } from './consulta-usuario-routing.module';
import { ConsultaUsuarioComponent } from './consulta-usuario.component';
import {ComponentsModule} from "../../components/components.module";

@NgModule({
  declarations: [
    ConsultaUsuarioComponent
  ],
	imports: [
		CommonModule,
		ConsultaUsuarioRoutingModule,
		ComponentsModule,
	]
})
export class ConsultaUsuarioModule { }

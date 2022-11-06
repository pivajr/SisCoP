import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PoliticaPrivacidadeRoutingModule } from './politica-privacidade-routing.module';
import { PoliticaPrivacidadeComponent } from './politica-privacidade.component';
import {ComponentsModule} from "../../components/components.module";


@NgModule({
  declarations: [
    PoliticaPrivacidadeComponent
  ],
	imports: [
		CommonModule,
		PoliticaPrivacidadeRoutingModule,
		ComponentsModule
	]
})
export class PoliticaPrivacidadeModule { }

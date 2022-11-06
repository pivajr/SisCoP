import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { HomeRoutingModule } from './home-routing.module';
import { HomeComponent } from './home.component';
import {ComponentsModule} from "../../components/components.module";


@NgModule({
  declarations: [
    HomeComponent
  ],
  imports: [
    CommonModule,
    ComponentsModule,
    HomeRoutingModule
  ]
})
export class HomeModule { }

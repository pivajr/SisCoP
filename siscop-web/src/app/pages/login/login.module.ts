import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {LoginRoutingModule} from './login-routing.module';
import {LoginComponent} from './login.component';
import {ReactiveFormsModule} from "@angular/forms";
import {ComponentsModule} from "../../components/components.module";
import {FontAwesomeModule} from "@fortawesome/angular-fontawesome";


@NgModule({
    declarations: [
        LoginComponent
    ],
    imports: [
        CommonModule,
        LoginRoutingModule,
        ReactiveFormsModule,
        ComponentsModule,
        FontAwesomeModule
    ]
})
export class LoginModule {
}

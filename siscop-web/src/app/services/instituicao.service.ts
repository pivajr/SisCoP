import {Injectable} from '@angular/core';
import {Service} from "./service";
import {HttpClient} from "@angular/common/http";
import {Instituicao} from "../models/instituicao";

@Injectable({
    providedIn: 'root'
})
export class InstituicaoService extends Service<Instituicao> {

    constructor(http: HttpClient) {
        super('instituicao', http);
    }


}

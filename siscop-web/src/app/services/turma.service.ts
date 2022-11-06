import { Injectable } from '@angular/core';
import {Service} from "./service";
import {Turma} from "../models/turma";
import {HttpClient} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class TurmaService extends Service<Turma> {
  constructor(http: HttpClient) {
    super('turma', http);
  }


}

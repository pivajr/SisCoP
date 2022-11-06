import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {CepResponse} from "../models/cep-response";

@Injectable({
  providedIn: 'root'
})
export class UtilitiesService {

  constructor(private http: HttpClient) { }

  public findCep(cep: string) {
    return this.http.get<CepResponse>(`https://viacep.com.br/ws/${ cep?.replace('.', '').replace('-', '') }/json/`);
  }
}

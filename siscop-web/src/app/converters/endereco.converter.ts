import {Converter} from "./converter";
import {Endereco} from "../models/endereco";
import {FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {Instituicao} from "../models/instituicao";
import {Injectable} from "@angular/core";

@Injectable({
  providedIn: 'root'
})
export class EnderecoConverter implements Converter<Endereco>{
  constructor(private fb: FormBuilder) {
  }

  toFormGroup(obj?: Endereco): FormGroup {
    obj = obj ?? new Endereco();
    return this.fb.group({
      cep: this.fb.control(obj.cep, [Validators.required]),
      uf: this.fb.control(obj.uf, [Validators.required]),
      cidade: this.fb.control(obj.cidade, [Validators.required]),
      bairro: this.fb.control(obj.bairro, [Validators.required]),
      rua: this.fb.control(obj.rua, [Validators.required]),
      numero: this.fb.control(obj.numero, [Validators.required])
    });
  }

  toObject(form: FormGroup): Endereco {
    const obj = new Endereco();

    obj.cep = form.get('cep')?.value;
    obj.uf = form.get('uf')?.value;
    obj.cidade = form.get('cidade')?.value;
    obj.bairro = form.get('bairro')?.value;
    obj.rua = form.get('rua')?.value;
    obj.numero = form.get('numero')?.value;

    return obj;
  }

}

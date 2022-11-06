import {Converter} from "./converter";
import {Instituicao} from "../models/instituicao";
import {FormArray, FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {Injectable} from "@angular/core";
import {EnderecoConverter} from "./endereco.converter";

@Injectable({
    providedIn: 'root'
})
export class InstituicaoConverter implements Converter<Instituicao>{
    constructor(private fb: FormBuilder, private enderecoConverter: EnderecoConverter) { }

    toFormGroup(obj?: Instituicao): FormGroup {
        obj = obj ?? new Instituicao();
        const enderecosControl = [];

        if (obj.enderecos) {
          for (const endereco of obj.enderecos) {
            enderecosControl.push(this.enderecoConverter.toFormGroup(endereco));
          }
        } else {
          enderecosControl.push(this.enderecoConverter.toFormGroup());
        }

        return this.fb.group({
            nome: new FormControl(obj!.nome, Validators.required),
            cpf_cnpj: new FormControl(obj!.cpf_cnpj, Validators.required),
            atividade: new FormControl(obj!.atividade, Validators.required),
            nome_responsavel: new FormControl(obj!.nome_responsavel, Validators.required),
            email_responsavel: new FormControl(obj!.email_responsavel, Validators.required),
            qtd_funcionarios: new FormControl(obj!.qtd_funcionarios, Validators.required),
            instituicao_status_id: new FormControl(obj!.instituicao_status_id),
            enderecos: this.fb.array(enderecosControl)
        });
    }

    toObject(form: FormGroup): Instituicao {
        const obj = new Instituicao();

        obj.nome = form.get('nome')?.value;
        obj.cpf_cnpj = form.get('cpf_cnpj')?.value;
        obj.atividade = form.get('atividade')?.value;
        obj.responsavel_id = form.get('responsavel_id')?.value;
        obj.nome_responsavel = form.get('nome_responsavel')?.value;
        obj.email_responsavel = form.get('email_responsavel')?.value;
        obj.qtd_funcionarios = form.get('qtd_funcionarios')?.value;
        obj.instituicao_status_id = form.get('instituicao_status_id')?.value;
        obj.ensino = form.get('ensino')?.value;
        obj.nivel = form.get('nivel')?.value;
        obj.qtd_estudantes = form.get('qtd_estudantes')?.value;
        obj.nivel_controle = form.get('nivel_controle')?.value;
        obj.tipo_instituicao = form.get('tipo_instituicao')?.value;
        obj.enderecos = [];

        for (let group of (form.get('enderecos') as FormArray).controls) {
          obj.enderecos.push(this.enderecoConverter.toObject(group as FormGroup));
        }

        return obj;
    }

}

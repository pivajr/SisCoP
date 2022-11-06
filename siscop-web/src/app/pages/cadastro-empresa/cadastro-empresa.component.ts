import {Component, OnInit, ViewChild} from '@angular/core';
import {Breakpoint} from "../../components/col/breakpoint";
import {AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {InstituicaoConverter} from "../../converters/instituicao.converter";
import {EnderecoConverter} from "../../converters/endereco.converter";
import {faSave} from "@fortawesome/free-regular-svg-icons";
import {InstituicaoService} from "../../services/instituicao.service";
import {lastValueFrom} from "rxjs";
import {ToastComponent} from "../../components/toast/toast.component";
import {AlertMessage} from "../../models/alert-message";
import {TelaCadastroComponent} from "../../components/tela-cadastro/tela-cadastro.component";

@Component({
    selector: 'scp-cadastro-empresa',
    templateUrl: './cadastro-empresa.component.html',
    styleUrls: ['./cadastro-empresa.component.scss']
})
export class CadastroEmpresaComponent implements OnInit {
    formGroup: FormGroup;
    btnSaveIcon = faSave;

    @ViewChild('cadastro')
    cadastro: TelaCadastroComponent;

    constructor(private instituicaoConverter: InstituicaoConverter, private enderecoConverter: EnderecoConverter, private instituicaoService: InstituicaoService) {
    }

    ngOnInit(): void {
      this.formGroup = this.instituicaoConverter.toFormGroup();
    }

    get cpfCnpjControlSize(): Breakpoint {
        return {
            xl: 3,
            sm: 12
        };
    }

    get cpfCnpjMask() {
      let mask = '';
      const value = this.getControl('cpf_cnpj').value;

      if (value && value.length > 14) {
        mask = '';
      }

      return mask;
    }

    get enderecos() {
      return (<FormArray>this.formGroup.get('enderecos'));
    }

    addEndereco() {
      this.enderecos.push(this.enderecoConverter.toFormGroup());
    }

    remove(index: number) {
      this.enderecos.removeAt(index);
    }

    getControl(name: string, formGroup: AbstractControl = this.formGroup) {
      return formGroup.get(name) as FormControl;
    }

    async salvar() {
      await lastValueFrom(this.instituicaoService.store(this.instituicaoConverter.toObject(this.formGroup)));
      this.cadastro.alert(new AlertMessage('Sucesso', 'A empresa foi incluída com sucesso 😉', 'success', 'white'));
    }

    castFormGroup(group: AbstractControl) {
      return group as FormGroup;
    }

  onErrorHandle(error: any) {
    this.cadastro.alert(new AlertMessage('Oops...', 'Falha ao incluir a empresa 😭', 'danger', 'white'));
  }
}

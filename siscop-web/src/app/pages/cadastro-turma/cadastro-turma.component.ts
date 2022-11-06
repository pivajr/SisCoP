import {Component, OnInit, ViewChild} from '@angular/core';
import {FormControl, FormGroup} from "@angular/forms";
import {TurmaConverter} from "../../converters/turma.converter";
import {TurmaService} from "../../services/turma.service";
import {TelaCadastroComponent} from "../../components/tela-cadastro/tela-cadastro.component";
import {AlertMessage} from "../../models/alert-message";
import {lastValueFrom} from "rxjs";

@Component({
  selector: 'scp-cadastro-turma',
  templateUrl: './cadastro-turma.component.html',
  styleUrls: ['./cadastro-turma.component.scss']
})
export class CadastroTurmaComponent implements OnInit {
  formGroup: FormGroup;

  @ViewChild('cadastro')
  cadastro: TelaCadastroComponent;

  constructor(private converter: TurmaConverter, private service: TurmaService) { }

  ngOnInit(): void {
    this.formGroup = this.converter.toFormGroup();
  }

  async salvar() {
    await lastValueFrom(this.service.store(this.converter.toObject(this.formGroup)));
    this.cadastro.alert(new AlertMessage('Sucesso', 'O usuário foi incluído com sucesso 😉', 'success', 'white'));
  }

  onErrorHandle(error: any) {
    console.error(error);
    this.cadastro.alert(new AlertMessage('Oops...', 'Falha ao incluir o usuário 😭', 'danger', 'white'));
  }

  get user_id() {
    return this.formGroup.get('user_id') as FormControl;
  }

  get user_email() {
    return this.formGroup.get('user_email') as FormControl;
  }

  get codigo_turma() {
    return this.formGroup.get('codigo_turma') as FormControl;
  }

  get curso() {
    return this.formGroup.get('curso') as FormControl;
  }

  get semestre() {
    return this.formGroup.get('semestre') as FormControl;
  }

  get disciplina() {
    return this.formGroup.get('disciplina') as FormControl;
  }

}

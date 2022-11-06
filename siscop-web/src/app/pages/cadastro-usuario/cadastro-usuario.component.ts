import {AfterViewInit, Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {UserService} from "../../services/user.service";
import {User} from "../../models/user";
import {faFloppyDisk, faMinusSquare, faPlusSquare, faTrashCan} from "@fortawesome/free-regular-svg-icons";
import {faCloudArrowUp} from "@fortawesome/free-solid-svg-icons";
import {lastValueFrom} from "rxjs";
import {Toast} from "bootstrap";
import {AlertMessage} from "../../models/alert-message";
import {ToastComponent} from "../../components/toast/toast.component";
import {TelaCadastroComponent} from "../../components/tela-cadastro/tela-cadastro.component";

@Component({
    selector: 'scp-cadastro-usuario',
    templateUrl: './cadastro-usuario.component.html',
    styleUrls: ['./cadastro-usuario.component.scss']
})
export class CadastroUsuarioComponent implements OnInit {
    userFormGroup: FormGroup;
    importedUserList: string[] = [];
    loading = false;
    faPlus = faPlusSquare;
    faMinus = faMinusSquare;
    faUpload = faCloudArrowUp;
    faTrash = faTrashCan;
    faSave = faFloppyDisk;

    @ViewChild('cadastro')
    cadastro: TelaCadastroComponent;

    constructor(private fb: FormBuilder, private userService: UserService) {
    }

    ngOnInit(): void {
      this.userFormGroup = this.fb.group({
        usuarios: this.fb.array([
          this.createEmptyFormGroup()
        ])
      });
    }

    addUsuario() {
        this.usuarios.push(this.createEmptyFormGroup());
    }

    clear() {
        this.usuarios.clear();
    }

    remove(index: number) {
        this.usuarios.removeAt(index);
    }

    async salvar() {
      const users: User[] = [];
      for (let userFormGroup of this.usuarios.controls) {
          let user = new User();
          user.name = userFormGroup.get('nome')?.value;
          user.email = userFormGroup.get('email')?.value;
          user.ra = userFormGroup.get('ra')?.value;
          user.cpf_cnpj = userFormGroup.get('cpfCnpj')?.value;
          user.codigo_turma = userFormGroup.get('codigo_turma')?.value;

          users.push(user);
      }

      await lastValueFrom(this.userService.storeMany(users));

      this.cadastro.alert(new AlertMessage('Sucesso', 'O usuário foi incluído com sucesso 😉', 'success', 'white'));
    }

    get usuarios() {
        return (<FormArray>this.userFormGroup.get('usuarios'));
    }

    createEmptyFormGroup() {
        return this.fb.group({
            nome: this.fb.control(''),
            email: this.fb.control('', [Validators.required, Validators.email]),
            ra: this.fb.control(''),
            cpfCnpj: this.fb.control(''),
            codigo_turma: this.fb.control('')
        });
    }

    importFromCsv() {
        this.importedUserList.forEach((line) => {
            const [nome, email, ra, cpfCnpj, codigo_turma] = line.split(';');

            this.usuarios.push(this.fb.group({
                nome: this.fb.control(nome),
                email: this.fb.control(email, [Validators.required, Validators.email]),
                ra: this.fb.control(ra),
                cpfCnpj: this.fb.control(cpfCnpj),
                codigo_turma: this.fb.control(codigo_turma)
            }))
        })
    }

    getFormControl(group: AbstractControl, name: string) {
        return group.get(name) as FormControl;
    }

    handleFileChange(target: EventTarget | null) {
        const file: File = (<any>target).files[0];

        const reader = new FileReader();
        reader.onload = (f) => {
            let contents = f.target!.result as string;
            let re = new RegExp('\r', 'g');

            this.importedUserList = contents.replace(re, '').split('\n');
        }
        reader.readAsText(file);
    }

    onErrorHandle(error: any) {
      this.cadastro.alert(new AlertMessage('Oops...', 'Falha ao incluir o usuário 😭', 'danger', 'white'));
    }

}

import {Component} from '@angular/core';
import {UserService} from "../../services/user.service";

@Component({
    selector: 'scp-consulta-usuario',
    templateUrl: './consulta-usuario.component.html',
    styleUrls: ['./consulta-usuario.component.scss']
})
export class ConsultaUsuarioComponent {
    columns = [
      {text: 'id'},
      {text: 'name'},
      {text: 'email', center: true},
      {text: 'primeiro_acesso', center: true}
    ];

    constructor(public userService: UserService) {
    }
}

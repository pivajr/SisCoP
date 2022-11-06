import {Model} from "./model";

export class User extends Model {
    name: string;
    email: string;
    password: string;
    cpf_cnpj: string;
    ra: string;
    primeiro_acesso: boolean;
    codigo_turma: string;
}

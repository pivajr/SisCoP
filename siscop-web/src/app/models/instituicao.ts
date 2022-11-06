import {Model} from "./model";
import {Endereco} from "./endereco";
import {User} from "./user";

export class Instituicao extends Model {
    nome: string;
    cpf_cnpj: string;
    atividade: string;
    email_responsavel: string;
    nome_responsavel: string;
    responsavel_id: number;
    responsavel: User;
    qtd_funcionarios: number;
    instituicao_status_id: number;
    ensino: boolean;
    nivel: string;
    qtd_estudantes: number;
    nivel_controle: string;
    tipo_instituicao: string;
    enderecos: Endereco[];
}

import {Model} from "./model";

export class Turma extends Model {
  instituicao_id: number;
  user_id: number;
  codigo_turma: string;
  curso: string;
  semestre: string;
  disciplina: string;
  user_email: string;
}

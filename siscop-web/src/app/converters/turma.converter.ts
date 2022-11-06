import {Converter} from "./converter";
import {Turma} from "../models/turma";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Injectable} from "@angular/core";

@Injectable({
  providedIn: "root"
})
export class TurmaConverter implements Converter<Turma>{
  public constructor(private fb: FormBuilder) {
  }

  toObject(form: FormGroup): Turma {
    const obj = new Turma();

    obj.user_id = form.get('user_id')?.value;
    obj.codigo_turma = form.get('codigo_turma')?.value;
    obj.curso = form.get('curso')?.value;
    obj.semestre = form.get('semestre')?.value;
    obj.disciplina = form.get('disciplina')?.value;
    obj.user_email = form.get('user_email')?.value;

    return obj;
  }

  toFormGroup(obj?: Turma): FormGroup {
    obj = obj ?? new Turma();

    return this.fb.group({
      user_id: this.fb.control(obj.user_id),
      codigo_turma: this.fb.control(obj.codigo_turma, Validators.required),
      curso: this.fb.control(obj.curso, Validators.required),
      semestre: this.fb.control(obj.semestre, Validators.required),
      disciplina: this.fb.control(obj.disciplina, Validators.required),
      user_email: this.fb.control(obj.user_email, Validators.required)
    });
  }
}

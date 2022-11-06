import {FormGroup} from "@angular/forms";

export interface Converter<T> {
    toObject(form: FormGroup): T;
    toFormGroup(obj?: T): FormGroup;
}

import {Component, EventEmitter, Injector, Input, OnInit, Output, ViewChild} from '@angular/core';
import {FormControl, NG_VALUE_ACCESSOR, NgControl} from "@angular/forms";
import {messages} from "../../messages-validations";

@Component({
  selector: 'scp-input-masked',
  templateUrl: './input-masked.component.html',
  styleUrls: ['./input-masked.component.scss'],
  providers: [
    {
      provide: NG_VALUE_ACCESSOR,
      multi: true,
      useExisting: InputMaskedComponent
    }
  ]
})
export class InputMaskedComponent implements OnInit {
  private control: FormControl;

  constructor(private injector: Injector) {
  }

  @ViewChild(HTMLInputElement)
  input: HTMLInputElement;

  @Input()
  type: string = 'text';

  @Input()
  label: string;

  @Input()
  lightMode = false;

  @Input()
  inputMask: string;

  @Input()
  showMask = false;

  @Output()
  blur = new EventEmitter<any>();

  objValue: any;
  touched = false;
  disabled = false;

  ngAfterContentInit() {
    const ngControl: NgControl | null = this.injector.get(NgControl, null);
    if (ngControl) {
      this.control = ngControl.control as FormControl;
    }
  }

  ngOnInit(): void { }

  defClass(): string {
    let classInput = '';

    if (this.lightMode) {
      classInput += 'form-control-light-mode ';
    }

    if (this.isTouched()) {
      if (this.isInvalid()) {
        classInput += 'is-invalid ';
      } else {
        classInput += 'is-valid ';
      }
    }

    return classInput;
  }

  onChangeHandler(event: any) {
    this.onChange(event.target.value);
  }

  onChange(value: any) {
  }

  onTouched() {

  }

  markAsTouched() {
    console.log('>>> info');
    if (!this.touched) {
      this.touched = true;
    }
  }

  registerOnChange(onChange: any): void {
    this.onChange = onChange;
  }

  registerOnTouched(onTouched: any): void {
    this.onTouched = onTouched;
  }

  writeValue(obj: any): void {
    this.objValue = obj;
  }

  setDisabledState(isDisabled: boolean) {
    this.disabled = isDisabled;
  }

  isTouched() {
    return this.control && this.control.touched;
  }

  isInvalid() {
    return this.control && this.control.invalid;
  }

  get errorMessage() {
    if (this.control) {
      for (const validation in this.control.errors) {
        if (this.control.errors[validation]) {
          return messages.get(validation);
        }
      }
    }

    return '';
  }

  get clearIfNotMatch() {
    return !!(this.inputMask && this.inputMask.length);
  }
}

import {Component, EventEmitter, Input, OnInit, Output, ViewChild} from '@angular/core';
import {faSave} from "@fortawesome/free-regular-svg-icons";
import {FormGroup} from "@angular/forms";
import {AlertMessage} from "../../models/alert-message";
import {ToastComponent} from "../toast/toast.component";

@Component({
  selector: 'scp-tela-cadastro',
  templateUrl: './tela-cadastro.component.html',
  styleUrls: ['./tela-cadastro.component.scss']
})
export class TelaCadastroComponent implements OnInit {
  @Input()
  btnSaveIcon = faSave;

  @Input()
  formGroupObj: FormGroup;

  @Input()
  execCallback: () => Promise<void>;

  @Input()
  title: string;

  @Output()
  onError: EventEmitter<any> = new EventEmitter<any>();

  @Output()
  onSuccess: EventEmitter<void> = new EventEmitter<void>();

  @Output()
  onComplete: EventEmitter<boolean> = new EventEmitter<boolean>();

  loading = false;

  alertMessage: AlertMessage;

  _toastElement: ToastComponent;

  constructor() { }

  ngOnInit(): void {
  }

  async submit() {
    this.loading = true;
    this.formGroupObj.markAllAsTouched();

    if (this.formGroupObj.valid) {
      try {
        await this.execCallback();
      } catch (e) {
        this.onError.emit(e);
      }
      this.onSuccess.emit();
    }

    this.onComplete.emit(this.formGroupObj.valid);

    this.loading = false;
  }

  @ViewChild('toast')
  set toast(toast: ToastComponent) {
    console.log(toast);
    this._toastElement = toast;
  }

  alert(alert: AlertMessage) {
    this.alertMessage = alert;
    this._toastElement.show();
  }

}

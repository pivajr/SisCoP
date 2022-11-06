import {AfterViewInit, Component, ElementRef, Input, OnInit, ViewChild} from '@angular/core';
import {Toast} from "bootstrap";

@Component({
  selector: 'scp-toast',
  templateUrl: './toast.component.html',
  styleUrls: ['./toast.component.scss']
})
export class ToastComponent implements AfterViewInit {

  @ViewChild('toast')
  toast: ElementRef;

  toastObj: Toast;

  @Input()
  closeable = true;

  @Input()
  header: string;

  @Input()
  body: string;

  @Input()
  autohide = false;

  @Input()
  color: string;

  @Input()
  textColor: string;

  constructor() { }

  ngAfterViewInit() {
    this.toastObj = new Toast(this.toast.nativeElement, {
      autohide: this.autohide
    });
  }

  show() {
    this.toastObj.show();
  }

  hide() {
    this.toastObj.hide();
  }

  dispose() {
    this.toastObj.dispose();
  }

  get classes() {
    return {
      [`bg-${ this.color }`]: this.color,
      [`text-${ this.textColor }`]: this.textColor
    };
  }

}

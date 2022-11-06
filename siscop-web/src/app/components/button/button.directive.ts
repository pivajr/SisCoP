import {Directive, ElementRef, HostBinding, Input, OnInit} from '@angular/core';

@Directive({
  selector: '[scpButton]'
})
export class ButtonDirective implements OnInit {

  constructor(private el: ElementRef) { }

  ngOnInit() {
    (<HTMLButtonElement>this.el.nativeElement).className = `btn ${ this.defColor }`;
  }

  @Input()
  typeColor = '';

  @Input()
  color = 'primary';

  get defColor() {
    if (this.typeColor) {
      return `btn-${ this.typeColor }-${ this.color }`;
    }

    return `btn-${ this.color }`;
  }
}

import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'scp-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.scss']
})
export class CardComponent implements OnInit {

  @Input()
  title: string;

  @Input()
  border = 0;

  constructor() { }

  ngOnInit(): void {
  }

  getClasses() {
    return {
      [`border-${ this.border }`]: true
    }
  }

}

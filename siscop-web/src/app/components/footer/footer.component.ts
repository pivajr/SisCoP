import {Component, HostBinding, OnInit} from '@angular/core';

@Component({
  selector: 'scp-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.scss']
})
export class FooterComponent implements OnInit {

  constructor() { }

  @HostBinding()
  class: string;

  ngOnInit(): void {
  }

}

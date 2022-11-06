import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'scp-loader',
  templateUrl: './loader.component.html',
  styleUrls: ['./loader.component.scss']
})
export class LoaderComponent implements OnInit {

  @Input()
  light = false;

  @Input()
  loading = false;

  constructor() { }

  ngOnInit(): void {
  }

}

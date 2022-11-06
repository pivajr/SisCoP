import {HostBinding, Input, Output} from '@angular/core';
import { Component, EventEmitter, OnInit } from '@angular/core';


@Component({
    selector: 'scp-header',
    templateUrl: './header.component.html',
    styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
    @Input()
    drawer: any;

    @HostBinding()
    class: string;

    constructor() { }

    ngOnInit(): void {
    }
}

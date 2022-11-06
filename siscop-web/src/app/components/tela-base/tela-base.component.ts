import {Component, Input, OnInit} from '@angular/core';
import {Breakpoint} from "../col/breakpoint";

@Component({
    selector: 'scp-tela-base',
    templateUrl: './tela-base.component.html',
    styleUrls: ['./tela-base.component.scss']
})
export class TelaBaseComponent implements OnInit {

    @Input()
    title: string;

    @Input()
    size: Breakpoint | number;

    @Input()
    offset: Breakpoint | number;

    @Input()
    loading: boolean = false;

    @Input()
    progressMode = 'query';

    @Input()
    progressValue: number;

    constructor() {
    }

    ngOnInit(): void {
    }

}

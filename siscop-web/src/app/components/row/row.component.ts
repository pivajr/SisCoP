import {Component, HostBinding, Input, OnInit} from '@angular/core';
import {Breakpoint} from "../col/breakpoint";
import {GridUtil} from "../util/GridUtil";

@Component({
    selector: 'scp-row',
    templateUrl: './row.component.html',
    styleUrls: ['./row.component.scss']
})
export class RowComponent implements OnInit {
    @Input()
    cols: Breakpoint | number | undefined;

    @Input()
    g: Breakpoint | number | undefined;

    @Input()
    gy: Breakpoint | number | undefined;

    @Input()
    gx: Breakpoint | number | undefined;

    @Input()
    flexHelper: string = '';

    constructor() {
    }

    ngOnInit(): void {
    }

    @HostBinding('class')
    get defs() {
        return `row ${ this.colsDef } ${ this.gutterDef } ${ this.gYDef } ${ this.gXDef } ${ this.flexHelper }`;
    }

    get colsDef() {
        return GridUtil.processDefs('row-cols', this.cols);
    }

    get gutterDef() {
        return GridUtil.processDefs('g', this.g);
    }

    get gYDef() {
        return GridUtil.processDefs('gy', this.gy);
    }

    get gXDef() {
        return GridUtil.processDefs('gx', this.gx);
    }
}

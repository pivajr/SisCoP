import { Component, HostBinding, Input, OnInit } from '@angular/core';
import { Breakpoint } from "./breakpoint";
import { GridUtil } from "../util/GridUtil";

@Component({
    selector: 'scp-col',
    templateUrl: './col.component.html',
    styleUrls: ['./col.component.scss']
})
export class ColComponent implements OnInit {
    @Input()
    sizes: Breakpoint | number | undefined;

    @Input()
    offsets: Breakpoint | number | undefined;

    constructor() {
    }

    ngOnInit(): void {
    }

    @HostBinding('class')
    get defs() {
        return `${this.sizeDefs} ${this.offsetDefs}`;
    }

    get sizeDefs() {
        return GridUtil.processDefs('col', this.sizes);
    }

    get offsetDefs() {
        if (!this.offsets) {
            return '';
        }
        return GridUtil.processDefs('offset', this.offsets);
    }
}

import { Breakpoint } from "../col/breakpoint";


export class GridUtil {
    public static processDefs(prefix: string, value: Breakpoint | number | undefined): string {
        if (!isNaN(Number(value))) {
            return `${prefix}-${value}`;
        } else if (GridUtil.isBreakpoint(<Breakpoint>value)) {
            return `${this.processDefs(`${prefix}-sm`, (<Breakpoint>value!).sm)} ${this.processDefs(`${prefix}-md`, (<Breakpoint>value!).md)} ${this.processDefs(`${prefix}-lg`, (<Breakpoint>value!).lg)} ${this.processDefs(`${prefix}-xl`, (<Breakpoint>value!).xl)} ${this.processDefs(`${prefix}-xxl`, (<Breakpoint>value!).xxl)}`.trim();
        }

        return prefix;
    }

    public static isBreakpoint(value: Breakpoint) {
        if (!value) {
            return false;
        }
        return value.sm || value.md || value.lg || value.xl || value.xxl;

    }
}

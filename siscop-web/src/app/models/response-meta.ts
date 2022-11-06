import {ResponseLink} from "./response-link";

export class ResponseMeta {
    current_page: number;
    from: number;
    last_page: number;
    links: ResponseLink[];
    path: string;
    per_page: number;
    to: number;
    total: number;
}

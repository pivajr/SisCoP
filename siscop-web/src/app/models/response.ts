import {ResponseLink} from "./response-link";
import {ResponseMeta} from "./response-meta";

export class Response<T> {
    data?: T | T[];
    links?: ResponseLink;
    meta: ResponseMeta;
}

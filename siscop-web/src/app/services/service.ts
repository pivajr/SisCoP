import {environment} from "../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {Model} from "../models/model";
import {Response} from "../models/response";

export abstract class Service<T extends Model> {
    protected readonly url: string;

    protected constructor(private endpoint: string, protected http: HttpClient) {
        this.url = `${ environment.baseUrl }/api/${ endpoint }`;
    }

    public get(page: number = 1, per_page = 15) {
        return this.http.get<Response<T>>(`${ this.url }?page=${page}&per_page=${ per_page }`);
    }

    public store(obj: T) {
        return this.http.post<Response<T>>(this.url, obj);
    }

    public update(obj: T) {
        return this.http.put<Response<T>>(this.url, obj);
    }

    public delete(id: number) {
        return this.http.delete<Response<T>>(`${ this.url }/${ id }`);
    }
}

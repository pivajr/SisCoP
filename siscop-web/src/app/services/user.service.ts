import {Injectable} from '@angular/core';
import {Service} from "./service";
import {User} from "../models/user";
import {HttpClient} from "@angular/common/http";

@Injectable({
    providedIn: 'root'
})
export class UserService extends Service<User> {

    constructor(http: HttpClient) {
        super('usuario', http);
    }

    storeMany(obj: User[]) {
        return this.http.post<User[]>(this.url, {usuarios: obj});
    }
}

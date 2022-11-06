import {Injectable} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../../environments/environment";

@Injectable({
    providedIn: 'root'
})
export class AuthService {
    static token: string;

    constructor(private http: HttpClient) { }

    public createCsrfToken() {
        return this.http.get(`${ environment.baseUrl }/sanctum/csrf-cookie`);
    }

    public login(email: string, password: string) {
        return this.http.post<any>(`${ environment.baseUrl }/api/sanctum/token`, {
            email,
            password,
            device_name: 'web'
        });
    }
}

import {Injectable} from '@angular/core';
import {HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from '@angular/common/http';
import {Observable} from 'rxjs';
import {CookieService} from 'ngx-cookie-service';
import {AuthService} from "../services/auth.service";
import {environment} from "../../environments/environment";

@Injectable()
export class CustomHttpInterceptor implements HttpInterceptor {
    constructor(private cookieService: CookieService) {
    }

    intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
      let header: any = {
        'Access-Control-Allow-Origin': '*'
      };
      let withCredentials = false;

      if (req.url.includes(environment.baseUrl, 0)) {
        withCredentials = true;
        header = {
          ...header,
          'X-XSRF-TOKEN': this.cookieService.get('XSRF-TOKEN'),
          'Authorization': `Bearer ${AuthService.token}`,
        };
      }

      req = req.clone({
        withCredentials,
        setHeaders: header
      });

        return next.handle(req);
    }
}

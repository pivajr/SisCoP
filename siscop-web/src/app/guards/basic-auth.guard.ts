import {Injectable} from '@angular/core';
import {
    ActivatedRouteSnapshot,
    CanActivate,
    CanActivateChild,
    CanDeactivate,
    CanLoad,
    Route,
    RouterStateSnapshot,
    UrlSegment,
    UrlTree
} from '@angular/router';
import {Observable} from 'rxjs';
import {AuthService} from "../services/auth.service";

@Injectable({
    providedIn: 'root'
})
export class BasicAuthGuard implements CanActivate, CanActivateChild, CanDeactivate<unknown>, CanLoad {
    canActivate(
        route: ActivatedRouteSnapshot,
        state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
        return AuthService.token !== null && AuthService.token !== undefined;
    }

    canActivateChild(
        childRoute: ActivatedRouteSnapshot,
        state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
        return AuthService.token !== null && AuthService.token !== undefined;
    }

    canDeactivate(
        component: unknown,
        currentRoute: ActivatedRouteSnapshot,
        currentState: RouterStateSnapshot,
        nextState?: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
        return true;
    }

    canLoad(
        route: Route,
        segments: UrlSegment[]): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
        return true;
    }
}

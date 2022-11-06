import {Component, OnInit} from '@angular/core';
import {faArrowRightToBracket} from "@fortawesome/free-solid-svg-icons";
import {FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {AuthService} from "../../services/auth.service";
import {Router} from "@angular/router";
import {lastValueFrom} from "rxjs";

@Component({
    selector: 'scp-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
    iconLoginButton = faArrowRightToBracket;
    frmLogin: FormGroup | undefined;
    loading = false;

    constructor(private fb: FormBuilder, private authService: AuthService, private router: Router) { }

    ngOnInit(): void {
        this.frmLogin = this.fb.group({
            email: new FormControl('', [Validators.email, Validators.required]),
            password: new FormControl('', [Validators.required])
        });
    }

    async entrar() {
        if (this.frmLogin?.valid) {
            this.loading = true;
            await lastValueFrom(this.authService.createCsrfToken());
            const res = await this.authService.login(this.email.value, this.password.value).toPromise();
            this.loading = false;

            AuthService.token = res.token;

            await this.router.navigateByUrl('/home');
        }
    }

    get email() {
        return this.frmLogin!.get('email') as FormControl;
    }

    get password() {
        return this.frmLogin!.get('password') as FormControl;
    }
}

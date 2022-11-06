import {Component, OnInit} from '@angular/core';
import {Breakpoint} from "../../components/col/breakpoint";
import {InstituicaoService} from "../../services/instituicao.service";
import {InstituicaoConverter} from "../../converters/instituicao.converter";
import {FormGroup} from "@angular/forms";

@Component({
    selector: 'scp-cadastro-instituicao-ensino',
    templateUrl: './cadastro-instituicao-ensino.component.html',
    styleUrls: ['./cadastro-instituicao-ensino.component.scss']
})
export class CadastroInstituicaoEnsinoComponent implements OnInit {
    frmInstituicaoEnsino: FormGroup;

    constructor(private instituicaoService: InstituicaoService, private converter: InstituicaoConverter) {
        this.frmInstituicaoEnsino = this.converter.toFormGroup();
    }

    ngOnInit(): void { }

    get cpfCnpjControlSize(): Breakpoint {
        return {
            xl: 3,
            sm: 12
        };
    }
}

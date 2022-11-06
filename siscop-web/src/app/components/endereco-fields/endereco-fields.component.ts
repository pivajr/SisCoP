import {Component, Input, OnInit} from '@angular/core';
import {FormControl, FormGroup} from "@angular/forms";
import {UtilitiesService} from "../../services/utilities.service";
import {lastValueFrom} from "rxjs";

@Component({
  selector: 'scp-endereco-fields',
  templateUrl: './endereco-fields.component.html',
  styleUrls: ['./endereco-fields.component.scss']
})
export class EnderecoFieldsComponent implements OnInit {

  @Input()
  group: FormGroup;

  loading = false;

  constructor(private utilities: UtilitiesService) { }

  ngOnInit(): void {
  }

  async findCep() {
    this.loading = true;
    const response = await lastValueFrom(this.utilities.findCep(this.cep.value));
    this.loading = false;

    this.uf.setValue(response.uf);
    this.cidade.setValue(response.localidade);
    this.bairro.setValue(response.bairro);
    this.rua.setValue(response.logradouro);
  }

  get cep() {
    return this.group?.get('cep') as FormControl;
  }

  get uf() {
    return this.group?.get('uf') as FormControl;
  }

  get cidade() {
    return this.group?.get('cidade') as FormControl;
  }

  get bairro() {
    return this.group?.get('bairro') as FormControl;
  }

  get rua() {
    return this.group?.get('rua') as FormControl;
  }

  get numero() {
    return this.group?.get('numero') as FormControl;
  }


}

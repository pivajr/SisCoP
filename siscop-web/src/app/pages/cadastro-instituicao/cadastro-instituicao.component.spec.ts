import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CadastroInstituicaoComponent } from './cadastro-instituicao.component';

describe('CadastroInstituicaoComponent', () => {
  let component: CadastroInstituicaoComponent;
  let fixture: ComponentFixture<CadastroInstituicaoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CadastroInstituicaoComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CadastroInstituicaoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

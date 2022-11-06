import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CadastroInstituicaoEnsinoComponent } from './cadastro-instituicao-ensino.component';

describe('CadastroInstituicaoEnsinoComponent', () => {
  let component: CadastroInstituicaoEnsinoComponent;
  let fixture: ComponentFixture<CadastroInstituicaoEnsinoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CadastroInstituicaoEnsinoComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CadastroInstituicaoEnsinoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TelaConsultaComponent } from './tela-consulta.component';

describe('TelaConsultaComponent', () => {
  let component: TelaConsultaComponent;
  let fixture: ComponentFixture<TelaConsultaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TelaConsultaComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(TelaConsultaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
